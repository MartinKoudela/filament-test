<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\DB;

class MostAddedProducts extends TableWidget
{
    protected static ?string $heading = 'Most Added to Cart';

    protected static ?int $sort = 8;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->select('products.*', DB::raw('COALESCE(SUM(cart_items.quantity), 0) as total_in_carts'))
                    ->leftJoin('cart_items', 'products.id', '=', 'cart_items.product_id')
                    ->groupBy('products.id')
                    ->having('total_in_carts', '>', 0)
                    ->orderByDesc('total_in_carts')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->limit(30),
                TextColumn::make('total_in_carts')
                    ->label('In Carts')
                    ->numeric()
                    ->badge()
                    ->color('warning'),
                TextColumn::make('price')
                    ->money('CZK'),
                TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->numeric(),
            ])
            ->paginated(false);
    }
}
