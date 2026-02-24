<?php

namespace App\Filament\Widgets;

use App\Models\CartItem;
use Filament\Widgets\ChartWidget;

class CartActivityChart extends ChartWidget
{
    protected ?string $heading = 'Cart Activity (Last 7 Days)';

    protected static ?int $sort = 9;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($d) => now()->subDays($d));

        return [
            'datasets' => [
                [
                    'label' => 'Items Added',
                    'data' => $days->map(fn ($day) => CartItem::whereDate('created_at', $day)->sum('quantity'))->toArray(),
                    'backgroundColor' => 'rgba(245, 158, 11, 0.7)',
                    'borderColor' => 'rgb(245, 158, 11)',
                ],
            ],
            'labels' => $days->map(fn ($day) => $day->format('d.m'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
