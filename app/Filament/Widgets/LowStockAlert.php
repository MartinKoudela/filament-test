<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LowStockAlert extends TableWidget
{
    protected static ?string $heading = 'Low Stock Alert';

    protected static ?int $sort = 7;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('is_active', true)
                    ->where('stock_quantity', '<=', 10)
                    ->orderBy('stock_quantity')
            )
            ->columns([
                TextColumn::make('name')
                    ->limit(30),
                TextColumn::make('sku')
                    ->label('SKU'),
                TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->numeric()
                    ->color(fn ($state) => $state === 0 ? 'danger' : 'warning'),
                TextColumn::make('price')
                    ->money('CZK'),
            ])
            ->paginated(false);
    }
}
