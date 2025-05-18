<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Backup DB';
    protected static string $view = 'filament.pages.database-backup';

//    public function backupAndDownload()
//    {
//        $db = env('DB_DATABASE');
//        $user = env('DB_USERNAME');
//        $pass = env('DB_PASSWORD');
//        $host = env('DB_HOST');
//
//        $timestamp = now()->format('Y-m-d_H-i-s');
//        $fileName = "backup-{$timestamp}.sql";
//        $filePath = storage_path("app/{$fileName}");
//
//        // Prepare the dump command
//        $command = "mysqldump --user={$user} --password=\"{$pass}\" --host={$host} {$db} > {$filePath}";
//
//        // Run the command
//        exec($command, $output, $resultCode);
//
//        if ($resultCode !== 0 || !file_exists($filePath)) {
//            Notification::make()
//                ->title('Backup Failed')
//                ->body('Failed to create database backup.')
//                ->danger()
//                ->send();
//
//            return;
//        }
//
//        return response()->download($filePath)->deleteFileAfterSend(true);
//    }
    public function backupAndDownload()
    {
        try {
            Artisan::call('backup:run', ['--only-db' => true]);
            $output = Artisan::output();
            logger('Backup run output: ' . $output);
        } catch (\Exception $e) {
            logger('Backup run error: ' . $e->getMessage());
        }
        // Trigger DB backup (spatie/laravel-backup must already be set up)
        Artisan::call('backup:run --only-db');

        $diskName = config('backup.backup.destination.disks')[0] ?? 'local';
        $disk = Storage::disk($diskName);

        // Path where Spatie stores backups (usually "Laravel" unless configured otherwise)
        $files = collect($disk->files('Laravel'))
            ->filter(fn($file) => str_ends_with($file, '.zip'))
            ->sortDesc();

        $latestFile = $files->first();

        if (!$latestFile) {
            Notification::make()
                ->title('Backup failed')
                ->body('No backup file was found.')
                ->danger()
                ->send();
            return;
        }

        return response()->streamDownload(function () use ($disk, $latestFile) {
            echo $disk->get($latestFile);
        }, basename($latestFile));
    }
}
