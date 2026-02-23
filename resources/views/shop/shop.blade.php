<x-layouts.app title="Shop">

    <a href="{{ route('main') }}"
       class="inline-flex items-center gap-1.5 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Back to posts
    </a>

    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold dark:text-[#EDEDEC] mb-2">Shop</h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Browse our products</p>
    </div>

    <div class="space-y-4">
        @forelse ($products as $product)
            <a href="{{ route('product', $product) }}">
                <div
                    class="bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-md dark:hover:shadow-[inset_0px_0px_0px_1px_#f53003] transition-shadow mb-10">
                    <div class="flex gap-4">
                        @if ($product->images->where('is_primary', true)->first())
                            <img
                                src="{{ asset('storage/' . $product->images->where('is_primary', true)->first()->path) }}"
                                alt="{{ $product->name }}" class="w-24 h-24 rounded-lg object-cover shrink-0">
                        @elseif ($product->images->where('is_primary', false)->first())
                            <img
                                src="{{ asset('storage/' . $product->images->where('is_primary', false)->first()->path) }}"
                                alt="{{ $product->name }}" class="w-24 h-24 rounded-lg object-cover shrink-0">
                        @else
                            <div class="w-24 h-24 rounded-lg bg-[#f53003]/10 flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-1">
                                <h2 class="font-medium dark:text-[#EDEDEC]">{{ $product->name }}</h2>
                                <div class="flex items-center gap-2 shrink-0">
                                    @if ($product->is_new)
                                        <span
                                            class="px-2 py-0.5 text-xs font-medium rounded-full bg-[#f53003]/10 text-[#f53003]">New</span>
                                    @endif
                                    @if ($product->is_featured)
                                        <span
                                            class="px-2 py-0.5 text-xs font-medium rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400">Featured</span>
                                    @endif
                                </div>
                            </div>

                            @if ($product->category)
                                <span
                                    class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $product->category->name }}</span>
                            @endif

                            @if ($product->short_description)
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed mt-1">{{ Str::limit($product->short_description, 100) }}</p>
                            @endif

                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-baseline gap-2">
                                    @if ($product->discount_price)
                                        <span class="text-lg font-bold text-[#f53003]">{{ number_format($product->discount_price, 2) }} Kč</span>
                                        <span class="text-sm text-[#706f6c] dark:text-[#A1A09A] line-through">{{ number_format($product->price, 2) }} Kč</span>
                                    @else
                                        <span class="text-lg font-bold dark:text-[#EDEDEC]">{{ number_format($product->price, 2) }} Kč</span>
                                    @endif
                                </div>

                                @if ($product->in_stock)
                                    <span class="text-xs text-green-600 dark:text-green-400">In stock</span>
                                @else
                                    <span class="text-xs text-red-500">Out of stock</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div
                class="bg-white dark:bg-[#161615] rounded-xl p-8 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] text-center">
                <div class="w-14 h-14 rounded-full bg-[#f53003]/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                    </svg>
                </div>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">No products available yet.</p>
            </div>
        @endforelse
    </div>

</x-layouts.app>
