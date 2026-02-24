<x-layouts.app title="Cart">

    <a href="{{ route('shop') }}" class="inline-flex items-center gap-1.5 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back to shop
    </a>

    <h1 class="text-3xl font-bold dark:text-[#EDEDEC] mb-6">Shopping Cart</h1>

    @forelse ($cartItems as $item)
        <div class="bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] mb-4">
            <div class="flex items-center gap-4">
                @if ($item->product->images->where('is_primary', true)->first())
                    <img src="{{ asset('storage/' . $item->product->images->where('is_primary', true)->first()->path) }}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
                @elseif ($item->product->images->first())
                    <img src="{{ asset('storage/' . $item->product->images->first()->path) }}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
                @else
                    <div class="w-16 h-16 rounded-lg bg-[#f53003]/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                        </svg>
                    </div>
                @endif

                <div class="flex-1">
                    <a href="{{ route('product', $item->product) }}" class="font-medium dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#f53003] transition-colors">{{ $item->product->name }}</a>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">
                        @if ($item->product->discount_price)
                            {{ number_format($item->product->discount_price, 2) }} Kč per item
                        @else
                            {{ number_format($item->product->price, 2) }} Kč per item
                        @endif
                    </p>
                </div>

                <span class="text-sm font-bold dark:text-[#EDEDEC] w-24 text-right">
                    @php
                        $itemPrice = $item->product->discount_price ?? $item->product->price;
                    @endphp
                    {{ number_format($itemPrice * $item->quantity, 2) }} Kč
                </span>

                <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white dark:bg-[#161615] rounded-xl p-8 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] text-center">
            <div class="w-14 h-14 rounded-full bg-[#f53003]/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .375.375 0 0 1 .75 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </div>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="inline-block px-6 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                Browse products
            </a>
        </div>
    @endforelse

    @if ($cartItems->count())
        <div class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
            <div class="space-y-3 text-sm">
                @php
                    $subtotal = $cartItems->sum(fn($item) => ($item->product->discount_price ?? $item->product->price) * $item->quantity);
                @endphp
                <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <span class="text-[#706f6c] dark:text-[#A1A09A]">Items ({{ $cartItems->sum('quantity') }})</span>
                    <span class="font-medium dark:text-[#EDEDEC]">{{ number_format($subtotal, 2) }} Kč</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-lg font-bold dark:text-[#EDEDEC]">Total</span>
                    <span class="text-lg font-bold text-[#f53003]">{{ number_format($subtotal, 2) }} Kč</span>
                </div>
            </div>

            <button class="w-full mt-4 px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-xl text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                Checkout
            </button>
        </div>
    @endif

</x-layouts.app>
