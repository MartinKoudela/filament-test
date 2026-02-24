<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductChart extends ChartWidget
{
    protected ?string $heading = 'Products by Category';

    protected static ?int $sort = 5;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();

        $colors = [
            'rgba(245, 48, 3, 0.7)',
            'rgba(59, 130, 246, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(245, 158, 11, 0.7)',
            'rgba(139, 92, 246, 0.7)',
            'rgba(236, 72, 153, 0.7)',
            'rgba(20, 184, 166, 0.7)',
            'rgba(249, 115, 22, 0.7)',
        ];

        return [
            'datasets' => [
                [
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $categories->count()),
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
