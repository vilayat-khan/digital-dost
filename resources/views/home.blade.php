<!DOCTYPE html>
<html lang="en">
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- ===== HEADER ===== --}}
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">DD</span>
                </div>
                <span class="text-xl font-bold tracking-tight">Digital Dost</span>
            </a>

            {{-- Main Navigation with Dropdowns --}}
            <nav x-data="{ open: null }" class="hidden md:flex items-center gap-1 text-sm font-medium">
                @foreach(($navCategories ?? collect()) as $cat)
                    <div class="relative" @mouseenter="open = '{{ $cat->id }}'" @mouseleave="open = null">
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="text-gray-600 hover:text-red-600 hover:bg-red-50 transition px-3 py-2 rounded-lg flex items-center gap-1">
                            {{ $cat->name }}
                            @if($cat->children->count())
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </a>
                        @if($cat->children->count())
                            <div x-show="open === '{{ $cat->id }}'" x-cloak
                                 class="absolute left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                                @foreach($cat->children as $child)
                                    <a href="{{ route('category.show', $child->slug) }}"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>

            {{-- Search --}}
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

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-6xl mx-auto px-4 py-6">
        {{-- Global horizontal category chips --}}
        <div class="flex overflow-x-auto gap-4 pb-3 mb-6 border-b border-gray-200">
            @foreach($topCategories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="px-4 py-2 rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-600 text-sm font-medium whitespace-nowrap transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Two‑column grid (content + sidebar) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8">
                @yield('content')
            </div>
            <aside class="lg:col-span-4 space-y-8 sticky top-24">
                @hasSection('sidebar')
                    @yield('sidebar')
                @else
                    @include('partials.default-sidebar')
                @endif
            </aside>
        </div>
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="border-t border-gray-100 mt-20 py-10 text-center">
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Digital Dost. All rights reserved.</p>
    </footer>

</body>
</html>