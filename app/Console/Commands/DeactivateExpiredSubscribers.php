<?php

namespace App\Console\Commands;

use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeactivateExpiredSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-expired-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate users whose subscriptions have expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () {
            $expiredSubscribers = Subscriber::where('is_active', 1)
                ->where('end_date', '<', now())
                ->get();

            foreach ($expiredSubscribers as $subscriber) {
                $subscriber->update(['is_active' => 0]);

                $subscriber->user?->update(['isPro' => 0]);
            }
        });

        $this->info('Expired subscriptions deactivated successfully.');
    }
}
