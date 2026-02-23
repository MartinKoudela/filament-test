<x-layouts.app title="Mini Blog">

    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold dark:text-[#EDEDEC] mb-2">Mini Blog</h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Share your thoughts with the world</p>
    </div>

    @auth
        <div
            class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
            <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">Create a Post</h2>
            <form action="{{ route('post.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name"
                           class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Title</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Post title"
                           class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40">
                    @error('name')
                    <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Content</label>
                    <textarea id="content" name="content" rows="3" placeholder="What's on your mind?"
                              class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors resize-none placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                    Post
                </button>
            </form>
        </div>
    @else
        <div
            class="bg-white dark:bg-[#161615] rounded-xl p-8 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] text-center">
            <div class="w-14 h-14 rounded-full bg-[#f53003]/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold mb-2 dark:text-[#EDEDEC]">Welcome to Mini Blog</h2>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-6">Sign in to create posts and join the
                conversation.</p>
            <div class="flex justify-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-6 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-2.5 rounded-lg text-sm font-medium border border-[#e3e3e0] dark:border-[#3E3E3A] text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:border-[#f53003] transition-colors">
                    Register
                </a>
            </div>
        </div>
    @endauth

    <div class="space-y-4">
        <h2 class="text-lg font-semibold dark:text-[#EDEDEC]">Recent Posts</h2>

        @forelse ($posts as $post)
            <a href="{{ route('post.show', $post) }}"
               class="flex bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-md dark:hover:shadow-[inset_0px_0px_0px_1px_#f53003] transition-shadow gap-4">
                <div class="flex flex-col items-center gap-1.5 shrink-0">
                    @if ($post->user->avatar)
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Avatar"
                             class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full bg-[#f53003]/10 flex items-center justify-center">
                            <span
                                class="text-lg font-bold text-[#f53003]">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $post->user->name }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-medium dark:text-[#EDEDEC] mb-2">{{ $post->name }}</h3>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed">{{ Str::limit($post->content, 150) }}</p>
                </div>
                <div class="flex flex-col items-center gap-1.5 shrink-0">
                    <span
                        class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </a>
        @empty
            <div
                class="bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] text-center">
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">No posts yet. Be the first to share something!</p>
            </div>
        @endforelse
    </div>

    <div
        class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
        <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">How it works</h2>
        <ol class="space-y-3 text-sm text-[#706f6c] dark:text-[#A1A09A]">
            <li class="flex items-center gap-3">
                <span
                    class="flex-shrink-0 w-6 h-6 rounded-full bg-[#f53003] text-white text-xs font-bold flex items-center justify-center">1</span>
                Type something <span class="font-medium text-[#f53003]">wise</span>
            </li>
            <li class="flex items-center gap-3">
                <span
                    class="flex-shrink-0 w-6 h-6 rounded-full bg-[#f53003] text-white text-xs font-bold flex items-center justify-center">2</span>
                Post it for <span class="font-medium text-[#f53003]">everyone</span>
            </li>
            <li class="flex items-center gap-3">
                <span
                    class="flex-shrink-0 w-6 h-6 rounded-full bg-[#f53003] text-white text-xs font-bold flex items-center justify-center">3</span>
                <span class="font-medium text-[#f53003]">Browse</span> other people's posts
            </li>
        </ol>
    </div>

</x-layouts.app>
