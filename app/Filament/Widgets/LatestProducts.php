<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestProducts extends TableWidget
{
    protected static ?string $heading = 'Latest Products';

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query()->with('category')->latest()->limit(5))
            ->columns([
                TextColumn::make('name')
                    ->limit(30),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge(),
                TextColumn::make('price')
                    ->money('CZK')
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->numeric(),
                IconColumn::make('in_stock')
                    ->boolean()
                    ->label('Available'),
                TextColumn::make('created_at')
                    ->label('Added')
                    ->since(),
            ])
            ->paginated(false);
    }
}
