<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestPosts extends TableWidget
{
    protected static ?string $heading = 'Latest Posts';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Post::query()->with('user')->latest()->limit(5))
            ->columns([
                TextColumn::make('name')
                    ->label('Title')
                    ->limit(40),
                TextColumn::make('user.name')
                    ->label('Author'),
                TextColumn::make('content')
                    ->limit(50)
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->since(),
            ])
            ->paginated(false);
    }
}
