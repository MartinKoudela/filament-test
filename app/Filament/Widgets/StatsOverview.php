<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $usersThisWeek = User::where('created_at', '>=', now()->subWeek())->count();
        $postsThisWeek = Post::where('created_at', '>=', now()->subWeek())->count();

        return [
            Stat::make('Total Users', User::count())
                ->description($usersThisWeek . ' this week')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart($this->getUsersPerDay()),
            Stat::make('Total Posts', Post::count())
                ->description($postsThisWeek . ' this week')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success')
                ->chart($this->getPostsPerDay()),
            Stat::make('Posts Today', Post::whereDate('created_at', today())->count())
                ->description('Created today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }

    private function getUsersPerDay(): array
    {
        return collect(range(6, 0))->map(function ($days) {
            return User::whereDate('created_at', now()->subDays($days))->count();
        })->toArray();
    }

    private function getPostsPerDay(): array
    {
        return collect(range(6, 0))->map(function ($days) {
            return Post::whereDate('created_at', now()->subDays($days))->count();
        })->toArray();
    }
}
