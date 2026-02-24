<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Mini Blog') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col items-center p-6 lg:p-8 font-sans">

<header class="w-full max-w-2xl flex justify-between items-center mb-10">
    <a href="/"
       class="text-base font-semibold dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#f53003] transition-colors">
        Mini Blog
    </a>

    <nav class="flex items-center gap-4">
        @if (request()->is('shop'))
            <a href="{{ route('cart') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#f53003] transition-colors"><i class="fas fa-cart"></i>Cart</a>
        @else
            <a href="{{ route('shop') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#f53003] transition-colors">Visit shop</a>
        @endif
        @auth
            <a href="{{ route('account') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#f53003] transition-colors">{{ Auth::user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">
                    Log Out
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
               class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                Register
            </a>
        @endauth
    </nav>
</header>

@if (session('success'))
    <div
        class="w-full max-w-2xl mb-6 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 text-sm">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div
        class="w-full max-w-2xl mb-6 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 text-sm">
        {{ session('error') }}
    </div>
@endif

<main class="w-full max-w-2xl space-y-8">
    {{ $slot }}
</main>

<footer class="w-full max-w-2xl mt-16 pb-4 text-center">
    <p class="text-xs text-[#706f6c]/60 dark:text-[#A1A09A]/40">Mini Blog &copy; {{ date('Y') }}</p>
</footer>

</body>
</html>
