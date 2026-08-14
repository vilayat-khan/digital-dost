<!DOCTYPE html>
<html lang="en">
<!-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Digital Dost — Hinglish Tech News, Reviews & Guides')</title>
    <meta name="description" content="@yield('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in Hinglish.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Digital Dost — English Tech News, Reviews & Guides')</title>
    <meta name="description" content="@yield('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 shrink-0">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">DD</span>
                </div>
                <span class="text-xl font-bold tracking-tight">Digital Dost</span>
            </a>

            <nav class="hidden lg:flex items-center gap-1 text-sm font-medium" aria-label="Main navigation">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Home</a>
                <a href="{{ url('/category/mobiles') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Mobiles</a>
                <a href="{{ url('/category/laptops') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Laptops</a>
                <a href="{{ url('/category/ai') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">AI</a>
                <a href="{{ url('/category/apps') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Apps</a>
                <a href="{{ url('/reviews') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Reviews</a>
                <a href="{{ url('/comparisons') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Comparisons</a>
                <a href="{{ url('/buying-guides') }}" class="text-gray-700 hover:text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Buying Guides</a>
            </nav>

            <div class="hidden md:flex items-center gap-3">
                <form action="{{ route('search') }}" method="GET" class="hidden xl:flex items-center">
                    <label for="desktop-search" class="sr-only">Search</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            id="desktop-search"
                            type="text"
                            name="q"
                            placeholder="Search articles..."
                            class="rounded-full pl-9 pr-4 py-2 text-sm bg-gray-100 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 focus:bg-white w-56 transition"
                        >
                    </div>
                </form>
            </div>

            <button
                type="button"
                class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500"
                aria-label="Open menu"
                x-data
                @click="$dispatch('toggle-mobile-menu')"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div
            x-data="{ open: false }"
            x-on:toggle-mobile-menu.window="open = !open"
            x-show="open"
            x-transition
            class="lg:hidden border-t border-gray-100 bg-white px-4 py-4 space-y-2"
        >
            <form action="{{ route('search') }}" method="GET" class="mb-3">
                <label for="mobile-search" class="sr-only">Search</label>
                <input
                    id="mobile-search"
                    type="text"
                    name="q"
                    placeholder="Search articles..."
                    class="w-full rounded-full px-4 py-2 text-sm bg-gray-100 border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 focus:bg-white"
                >
            </form>

            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Home</a>
            <a href="{{ url('/category/mobiles') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Mobiles</a>
            <a href="{{ url('/category/laptops') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Laptops</a>
            <a href="{{ url('/category/ai') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">AI</a>
            <a href="{{ url('/category/apps') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Apps</a>
            <a href="{{ url('/reviews') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Reviews</a>
            <a href="{{ url('/comparisons') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Comparisons</a>
            <a href="{{ url('/buying-guides') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">Buying Guides</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 mt-20 py-10 text-center">
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Digital Dost. All rights reserved.</p>
    </footer>
</body>
</html>