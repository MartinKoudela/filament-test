<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class PostsChart extends ChartWidget
{
    protected ?string $heading = 'Posts (Last 30 Days)';

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $days = collect(range(29, 0))->map(fn ($d) => now()->subDays($d));

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $days->map(fn ($day) => Post::whereDate('created_at', $day)->count())->toArray(),
                    'fill' => true,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'borderColor' => 'rgb(16, 185, 129)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $days->map(fn ($day) => $day->format('d.m'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
