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
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">DD</span>
                </div>
                <span class="text-xl font-bold tracking-tight">Digital Dost</span>
            </a>
            <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                @foreach(($navCategories ?? collect()) as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}"
                    class="text-gray-600 hover:text-red-600 hover:bg-red-50 transition px-3 py-2 rounded-lg">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </nav>
            <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" placeholder="Search..."
                           class="rounded-full pl-9 pr-4 py-2 text-sm bg-gray-100 border-0 focus:outline-none focus:ring-2 focus:ring-red-500 w-56 transition">
                </div>
            </form>
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