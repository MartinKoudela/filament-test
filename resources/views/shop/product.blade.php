<x-layouts.app :title="$product->name">

    <a href="{{ route('shop') }}"
       class="inline-flex items-center gap-1.5 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Back to shop
    </a>

    <article
        class="bg-white dark:bg-[#161615] rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] overflow-hidden">

        @php
            $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
            $otherImages = $product->images->where('id', '!=', $primaryImage?->id);
        @endphp

        @if ($primaryImage)
            <div class="w-full aspect-[16/9] bg-[#f5f5f3] dark:bg-[#1a1a19]">
                <img id="main-image" src="{{ asset('storage/' . $primaryImage->path) }}"
                     alt="{{ $primaryImage->alt ?? $product->name }}" class="w-full h-full object-contain">
            </div>
        @else
            <div class="w-full aspect-[16/9] bg-[#f53003]/5 flex items-center justify-center">
                <svg class="w-16 h-16 text-[#f53003]/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/>
                </svg>
            </div>
        @endif

        @if ($otherImages->count())
            <div class="flex gap-2 p-4 overflow-x-auto">
                <img src="{{ asset('storage/' . $primaryImage->path) }}"
                     alt="{{ $primaryImage->alt ?? $product->name }}"
                     onclick="document.getElementById('main-image').src = this.src"
                     class="w-20 h-20 rounded-lg object-cover shrink-0 border-2 border-transparent hover:border-[#f53003] transition-colors cursor-pointer"
                     id="secondary-image">
                @foreach ($otherImages as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->alt ?? $product->name }}"
                         onclick="document.getElementById('main-image').src = this.src"
                         class="w-20 h-20 rounded-lg object-cover shrink-0 border-2 border-transparent hover:border-[#f53003] transition-colors cursor-pointer"
                         id="secondary-image">
                @endforeach
            </div>
        @endif

        <div class="p-6">

            <div class="flex items-start justify-between mb-2">
                <div>
                    @if ($product->category)
                        <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $product->category->name }}</span>
                    @endif
                    <h1 class="text-2xl font-bold dark:text-[#EDEDEC]">{{ $product->name }}</h1>
                </div>
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

            @if ($product->brand)
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-4">{{ $product->brand }}</p>
            @endif

            <div class="flex items-baseline gap-3 mb-6">
                @if ($product->discount_price)
                    <span
                        class="text-3xl font-bold text-[#f53003]">{{ number_format($product->discount_price, 2) }} Kč</span>
                    <span class="text-lg text-[#706f6c] dark:text-[#A1A09A] line-through">{{ number_format($product->price, 2) }} Kč</span>
                    @php
                        $discount = round((1 - $product->discount_price / $product->price) * 100);
                    @endphp
                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-[#f53003]/10 text-[#f53003]">-{{ $discount }}%</span>
                @else
                    <span
                        class="text-3xl font-bold dark:text-[#EDEDEC]">{{ number_format($product->price, 2) }} Kč</span>
                @endif
            </div>

            <div class="flex items-center gap-4 mb-6">
                @if ($product->in_stock)
                    <span class="inline-flex items-center gap-1.5 text-sm text-green-600 dark:text-green-400">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        In stock ({{ $product->stock_quantity }} pcs)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 text-sm text-red-500">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        Out of stock
                    </span>
                @endif

                @if ($product->sku)
                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">SKU: {{ $product->sku }}</span>
                @endif
            </div>

            @if ($product->short_description)
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed mb-6">{{ $product->short_description }}</p>
            @endif

            @if ($product->variants->where('is_active', true)->count())
                <div class="mb-6">
                    <h2 class="text-sm font-semibold dark:text-[#EDEDEC] mb-3">Variants</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->variants->where('is_active', true) as $variant)
                            <div
                                class="px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-sm dark:text-[#EDEDEC] hover:border-[#f53003] transition-colors cursor-pointer">
                                <span class="font-medium">{{ $variant->name }}</span>
                                <span class="text-[#706f6c] dark:text-[#A1A09A] ml-1">
                                    @if ($variant->discount_price)
                                        {{ number_format($variant->discount_price, 2) }} Kč
                                    @else
                                        {{ number_format($variant->price, 2) }} Kč
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-xl text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors {{ !$product->in_stock ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$product->in_stock ? 'disabled' : '' }}>
                    {{ $product->in_stock ? 'Add to cart' : 'Out of stock' }}
                </button>
            </form>
        </div>
    </article>

    @if ($product->description)
        <div
            class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
            <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">Description</h2>
            <div
                class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed whitespace-pre-line">{{ $product->description }}</div>
        </div>
    @endif

    <div
        class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
        <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">Details</h2>
        <div class="space-y-3 text-sm">
            @if ($product->brand)
                <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <span class="text-[#706f6c] dark:text-[#A1A09A]">Brand</span>
                    <span class="font-medium dark:text-[#EDEDEC]">{{ $product->brand }}</span>
                </div>
            @endif
            @if ($product->sku)
                <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <span class="text-[#706f6c] dark:text-[#A1A09A]">SKU</span>
                    <span class="font-medium dark:text-[#EDEDEC]">{{ $product->sku }}</span>
                </div>
            @endif
            @if ($product->category)
                <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <span class="text-[#706f6c] dark:text-[#A1A09A]">Category</span>
                    <span class="font-medium dark:text-[#EDEDEC]">{{ $product->category->name }}</span>
                </div>
            @endif
            <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">VAT</span>
                <span class="font-medium dark:text-[#EDEDEC]">{{ $product->vat_rate }}%</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">Availability</span>
                @if ($product->in_stock)
                    <span class="font-medium text-green-600 dark:text-green-400">In stock ({{ $product->stock_quantity }} pcs)</span>
                @else
                    <span class="font-medium text-red-500">Out of stock</span>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>
