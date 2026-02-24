<?php

namespace App\Filament\Widgets;

use App\Models\CartItem;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $outOfStock = Product::where('in_stock', false)->count();
        $avgPrice = Product::avg('price');

        $cartItemsCount = CartItem::sum('quantity');
        $cartTotalValue = CartItem::with('product')->get()->sum(function ($item) {
            return ($item->product->discount_price ?? $item->product->price) * $item->quantity;
        });

        return [
            Stat::make('Total Products', $totalProducts)
                ->description($activeProducts . ' active')
                ->color('primary'),
            Stat::make('Out of Stock', $outOfStock)
                ->description('products unavailable')
                ->color($outOfStock > 0 ? 'danger' : 'success'),
            Stat::make('Avg Price', number_format($avgPrice, 2) . ' Kč')
                ->description('across all products')
                ->color('info'),
            Stat::make('Items in Carts', $cartItemsCount)
                ->description(number_format($cartTotalValue, 2) . ' Kč total value')
                ->color('warning'),
        ];
    }
}
