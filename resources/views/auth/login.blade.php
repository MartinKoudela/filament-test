<x-layouts.app title="Login — Mini Blog">

    <div class="flex flex-col items-center mt-8 lg:mt-16">

        <div class="w-12 h-12 rounded-full bg-[#f53003]/10 flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </div>

        <h1 class="text-2xl font-semibold mb-1 dark:text-[#EDEDEC]">Welcome back</h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-8">Sign in to your account</p>

        <div class="w-full max-w-sm">
            <div class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40"
                               placeholder="you@example.com">
                        @error('email')
                        <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40"
                               placeholder="Your password">
                        @error('password')
                        <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                   class="w-4 h-4 rounded border-[#e3e3e0] dark:border-[#3E3E3A] text-[#f53003] focus:ring-[#f53003]/30 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
                            <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Remember me</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full px-6 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                        Sign In
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#f53003] font-medium hover:underline">Create one</a>
            </p>
        </div>

    </div>

</x-layouts.app>
