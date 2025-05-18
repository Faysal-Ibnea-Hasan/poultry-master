<?php

namespace App\Filament\Widgets;

use App\Models\PaymentTransaction;
use Filament\Widgets\ChartWidget;

class EarningChart extends ChartWidget
{
    protected static ?string $heading = 'Earnings';
    protected static ?int $sort = 2; // for sorting the widget
    protected int|string|array $columnSpan = 'full'; // Takes the full width
    protected static ?string $maxHeight = '500px';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    public function getDescription(): ?string
    {
        return 'Earning from the app per month.';
    }


    protected function getData(): array
    {
        $query = PaymentTransaction::query()
            ->where('status', 'Completed');

        // Apply the selected filter
        switch ($this->filter) {
            case 'today':
                $query->whereDate('created_at', now());
                break;

            case 'week':
                $query->whereBetween('created_at', [now()->subWeek(), now()]);
                break;

            case 'month':
                $query->whereBetween('created_at', [now()->subMonth(), now()]);
                break;

            case 'year':
            default:
                $query->whereYear('created_at', now()->year);
                break;
        }

        // Group earnings by month for chart (only applies to 'year' filter!)
        $earnings = $query
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $data = collect(range(1, 12))->map(function ($month) use ($earnings) {
            return round($earnings->get($month, 0), 2);
        });

        return [
            'datasets' => [
                [
                    'label' => 'Earnings',
                    'data' => $data->toArray(),
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
