<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\PaymentTransaction;
use App\Models\Subscriber;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    public function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Companies', Company::count())
                ->icon('heroicon-s-building-office-2'),
            Stat::make('Total Users', User::query()->count())
                ->icon('heroicon-s-user'),
            Stat::make('Total Subscribers', Subscriber::where('is_active', true)->count())
                ->icon('heroicon-s-user-plus'),
            Stat::make('Earnings', PaymentTransaction::where('status', 'Completed')->sum('amount') . ' ৳')
                ->icon('heroicon-s-currency-dollar'),
        ];
    }
}
