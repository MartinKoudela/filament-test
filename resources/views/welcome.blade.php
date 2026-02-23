<x-layouts.app title="Mini Blog">

    <div class="flex flex-col items-center mt-12 lg:mt-24">

        <div class="w-16 h-16 rounded-full bg-[#f53003]/10 flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-[#f53003]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold mb-2 dark:text-[#EDEDEC]">Mini Blog</h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-10 text-center max-w-md">
            Welcome to Mini Blog. Sign in to your account, create a new one, or head to the admin panel.
        </p>

        <div class="w-full max-w-sm space-y-3">
            <a href="{{ route('login') }}"
               class="flex items-center justify-between w-full px-6 py-3.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-xl text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                <span>Login</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>

            <a href="{{ route('register') }}"
               class="flex items-center justify-between w-full px-6 py-3.5 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f3] dark:hover:bg-[#1a1a19] transition-colors">
                <span>Register</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>

            <a href="/admin"
               class="flex items-center justify-between w-full px-6 py-3.5 border border-[#f53003]/30 rounded-xl text-sm font-medium text-[#f53003] hover:bg-[#f53003]/5 transition-colors">
                <span>Admin Panel</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

    </div>

</x-layouts.app>
