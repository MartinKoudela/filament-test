<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UsersChart extends ChartWidget
{
    protected ?string $heading = 'New Users (Last 7 Days)';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($d) => now()->subDays($d));

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $days->map(fn ($day) => User::whereDate('created_at', $day)->count())->toArray(),
                    'backgroundColor' => 'rgba(245, 48, 3, 0.2)',
                    'borderColor' => 'rgb(245, 48, 3)',
                ],
            ],
            'labels' => $days->map(fn ($day) => $day->format('D d.m'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
