<x-layouts.app title="Register — Mini Blog">

    <div class="flex flex-col items-center mt-8 lg:mt-16">

        <div class="w-12 h-12 rounded-full bg-[#f53003]/10 flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
        </div>

        <h1 class="text-2xl font-semibold mb-1 dark:text-[#EDEDEC]">Create an account</h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-8">Join Mini Blog today</p>

        <div class="w-full max-w-sm">
            <div class="bg-white dark:bg-[#161615] rounded-xl p-6 shadow-[0_1px_3px_rgba(0,0,0,0.08)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40"
                               placeholder="Your name">
                        @error('name')
                        <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
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
                               placeholder="At least 8 characters">
                        @error('password')
                        <p class="mt-1.5 text-sm text-[#f53003]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-1.5 text-[#706f6c] dark:text-[#A1A09A]">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-2.5 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors placeholder:text-[#706f6c]/50 dark:placeholder:text-[#A1A09A]/40"
                               placeholder="Repeat your password">
                    </div>

                    <button type="submit"
                            class="w-full px-6 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                        Create Account
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#f53003] font-medium hover:underline">Sign in</a>
            </p>
        </div>

    </div>

</x-layouts.app>
