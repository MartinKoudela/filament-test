<x-layouts.app :title="$post->name">

    <a href="{{ route('main') }}" class="inline-flex items-center gap-1.5 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back to posts
    </a>

    <article class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold dark:text-[#EDEDEC]">{{ $post->name }}</h1>
            <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <div class="flex items-center gap-2 mb-6">
            @if ($post->user->avatar)
                <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Avatar" class="w-7 h-7 rounded-full object-cover">
            @else
                <div class="w-7 h-7 rounded-full bg-[#f53003]/10 flex items-center justify-center">
                    <span class="text-xs font-bold text-[#f53003]">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                </div>
            @endif
            <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ $post->user->name }}</span>
        </div>

        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed whitespace-pre-line">{{ $post->content }}</p>
    </article>

</x-layouts.app>
