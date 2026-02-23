<x-layouts.app title="Account">

    <a href="{{ route('main') }}" class="inline-flex items-center gap-1.5 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back to posts
    </a>

    <div class="flex items-center gap-4 mb-8">
        <form action="{{ route('account.avatar') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf
            @if (Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover">
            @else
                <div class="w-16 h-16 rounded-full bg-[#f53003]/10 flex items-center justify-center">
                    <span class="text-2xl font-bold text-[#f53003]">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            @endif
            <label class="px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:border-[#f53003] transition-colors cursor-pointer">
                Change Avatar
                <input type="file" name="avatar" accept="image/*" class="hidden" onchange="this.form.submit()">
            </label>
        </form>
        <div>
            <h1 class="text-2xl font-bold dark:text-[#EDEDEC]">{{ Auth::user()->name }}</h1>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <div
        class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] mb-6">
        <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">Account Info</h2>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">Name</span>
                <span class="font-medium dark:text-[#EDEDEC]">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">Email</span>
                <span class="font-medium dark:text-[#EDEDEC]">{{ Auth::user()->email }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">Member since</span>
                <span class="font-medium dark:text-[#EDEDEC]">{{ Auth::user()->created_at->format('d. m. Y') }}</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-[#706f6c] dark:text-[#A1A09A]">Total posts</span>
                <span class="font-medium dark:text-[#EDEDEC]">{{ Auth::user()->posts()->count() }}</span>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold dark:text-[#EDEDEC]">Your Posts</h2>

        @forelse (Auth::user()->posts()->latest()->get() as $post)
            <a href="{{ route('post.show', $post) }}"
               class="block bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-md dark:hover:shadow-[inset_0px_0px_0px_1px_#f53003] transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-medium dark:text-[#EDEDEC]">{{ $post->name }}</h3>
                    <span
                        class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] leading-relaxed">{{ Str::limit($post->content, 150) }}</p>
            </a>
        @empty
            <div
                class="bg-white dark:bg-[#161615] rounded-xl p-5 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] text-center">
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">You haven't created any posts yet.</p>
                <a href="{{ route('main') }}"
                   class="inline-block mt-3 px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                    Create your first post
                </a>
            </div>
        @endforelse
    </div>

</x-layouts.app>
