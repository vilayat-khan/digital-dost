<!-- site.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Digital Dost — AI, Gadgets Reviews & Guides')</title>
    <meta name="description" content="@yield('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Digital Dost — AI, Gadgets Reviews & Guides')">
    <meta property="og:description" content="@yield('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <script src="{{ asset('js/tailwind-cdn.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- AdSense: uncomment once approved --}}
    {{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXX" crossorigin="anonymous"></script> --}}

    @stack('head')

    <style>
        body { font-family: 'Inter', sans-serif; background:#FAFAF8; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        [x-cloak] { display: none !important; }
        .eyebrow { font-family:'JetBrains Mono',monospace; letter-spacing:.04em; }
        #read-progress { transform-origin: left; transform: scaleX(0); transition: transform .1s linear; }
        ::selection { background:#DC2626; color:#fff; }
        .no-scrollbar::-webkit-scrollbar { display:none; }
        .no-scrollbar { -ms-overflow-style:none; scrollbar-width:none; }
    </style>
</head>
<body class="text-[#14151A] antialiased" x-data="{ mobileNav: false, searchOpen: false }">

    {{-- ===== READING PROGRESS (post pages only) ===== --}}
    @hasSection('article-content')
        <div class="fixed top-0 left-0 right-0 h-[3px] bg-[#E7E5DF] z-[60]">
            <div id="read-progress" class="h-full bg-[#DC2626] w-full"></div>
        </div>
        @push('scripts')
        <script>
            window.addEventListener('scroll', () => {
                const bar = document.getElementById('read-progress');
                const article = document.getElementById('article-body');
                if (!bar || !article) return;
                const start = article.offsetTop;
                const total = article.offsetHeight - window.innerHeight;
                const scrolled = Math.min(Math.max((window.scrollY - start + 200) / total, 0), 1);
                bar.style.transform = `scaleX(${scrolled})`;
            }, { passive: true });
        </script>
        @endpush
    @endif

    {{-- ===== UTILITY BAR ===== --}}
    <div class="hidden md:block bg-[#14151A] text-[#FAFAF8]">
        <div class="max-w-6xl mx-auto px-4 py-1.5 flex items-center justify-between text-[11px] font-mono tracking-wide">
            <span>{{ now()->format('D, d M Y') }}</span>
            <div class="flex items-center gap-4 text-[#FAFAF8]/70">
                <a href="#" class="hover:text-[#FAFAF8] transition">YOUTUBE</a>
                <a href="#" class="hover:text-[#FAFAF8] transition">WHATSAPP</a>
                <a href="#" class="hover:text-[#FAFAF8] transition">INSTAGRAM</a>
            </div>
        </div>
    </div>

    {{-- ===== HEADER ===== --}}
    <header class="sticky top-0 z-50 bg-[#FAFAF8]/90 backdrop-blur-md border-b border-[#E7E5DF]">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-6">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
                <div class="w-9 h-9 bg-[#DC2626] rounded-lg flex items-center justify-center">
                    <span class="text-white font-extrabold text-sm">DD</span>
                </div>
                <span class="text-xl font-extrabold tracking-tight">Digital Dost</span>
            </a>

            <nav x-data="{ open: null }" class="hidden lg:flex items-center gap-0.5 text-[13px] font-semibold overflow-x-auto no-scrollbar min-w-0">
                @foreach(($navCategories ?? collect()) as $cat)
                    <div class="relative" @mouseenter="open = '{{ $cat->id }}'" @mouseleave="open = null">
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="text-[#14151A]/70 hover:text-[#DC2626] transition px-3 py-2 rounded-md flex items-center gap-1">
                            {{ $cat->name }}
                            @if($cat->children->count())
                                <svg class="w-3.5 h-3.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </a>
                        @if($cat->children->count())
                            <div x-show="open === '{{ $cat->id }}'" x-cloak
                                 class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-[#E7E5DF] py-2 z-50">
                                <div class="px-4 pb-1.5 mb-1 border-b border-[#E7E5DF] text-[10px] font-mono text-[#14151A]/40 tracking-wide">
                                    {{ strtoupper($cat->name) }}
                                </div>
                                @foreach($cat->children as $child)
                                    <a href="{{ route('category.show', $child->slug) }}"
                                       class="block px-4 py-2 text-sm text-[#14151A]/80 hover:bg-[#FAFAF8] hover:text-[#DC2626] transition">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>

            <div class="flex items-center gap-2 shrink-0">
                <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#14151A]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="q" placeholder="Search..." autocomplete="off"
                               class="rounded-full pl-9 pr-4 py-2 text-sm bg-[#F0EEE8] border-0 focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50 w-48 lg:w-56 transition">
                    </div>
                </form>

                {{-- Mobile search toggle --}}
                <button @click="searchOpen = !searchOpen" class="md:hidden w-9 h-9 flex items-center justify-center rounded-full bg-[#F0EEE8]" aria-label="Search">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                {{-- Mobile nav toggle --}}
                <button @click="mobileNav = !mobileNav" class="lg:hidden w-9 h-9 flex items-center justify-center rounded-full bg-[#F0EEE8]" aria-label="Menu">
                    <svg x-show="!mobileNav" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileNav" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile search bar --}}
        <div x-show="searchOpen" x-cloak x-transition class="md:hidden border-t border-[#E7E5DF] px-4 py-3">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" placeholder="Search Digital Dost..." autofocus
                       class="w-full rounded-full px-4 py-2.5 text-sm bg-[#F0EEE8] border-0 focus:outline-none focus:ring-2 focus:ring-[#DC2626]/50">
            </form>
        </div>

        {{-- Mobile nav drawer --}}
        <div x-show="mobileNav" x-cloak x-transition class="lg:hidden border-t border-[#E7E5DF] bg-white max-h-[70vh] overflow-y-auto">
            <nav class="px-4 py-3 flex flex-col text-sm font-semibold divide-y divide-[#E7E5DF]">
                @foreach(($navCategories ?? collect()) as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}" class="py-3 text-[#14151A]/80">{{ $cat->name }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    {{-- ===== AD SLOT: LEADERBOARD (below header) ===== --}}
    <div class="max-w-6xl mx-auto px-4 pt-4">
        <div class="w-full min-h-[90px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-lg text-[11px] font-mono text-[#14151A]/40">
            {{-- AdSense unit: leaderboard / responsive --}}
            AD SLOT — 728×90
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-6xl mx-auto px-4 py-8 lg:pt-10">
        @hasSection('full-width')
            @yield('full-width')
        @else
            <div class="flex lg:hidden overflow-x-auto no-scrollbar gap-2 pb-3 mb-8 border-b border-[#E7E5DF]">
                @foreach(($topCategories ?? collect()) as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}"
                       class="px-3.5 py-1.5 rounded-full bg-[#F0EEE8] hover:bg-[#DC2626] hover:text-white text-[13px] font-semibold whitespace-nowrap transition">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-8">
                    @yield('content')
                </div>
                <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-24 self-start">
                    @hasSection('sidebar')
                        @yield('sidebar')
                    @else
                        @include('partials.sidebar')
                    @endif
                </aside>
            </div>
        @endif
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="border-t border-[#E7E5DF] mt-20 bg-[#14151A] text-[#FAFAF8]">
        <div class="max-w-6xl mx-auto px-4 py-12 grid grid-cols-2 md:grid-cols-4 gap-8 text-sm">
            <div class="col-span-2 md:col-span-1">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 bg-[#DC2626] rounded-md flex items-center justify-center">
                        <span class="text-white font-extrabold text-xs">DD</span>
                    </div>
                    <span class="font-extrabold">Digital Dost</span>
                </div>
                <p class="text-[#FAFAF8]/50 text-[13px] leading-relaxed">Tech news, reviews & guides — likha jaata hai simple Hinglish mein.</p>
            </div>
            <div>
                <h4 class="font-mono text-[11px] tracking-wide text-[#FAFAF8]/40 mb-3">EXPLORE</h4>
                <ul class="space-y-2 text-[#FAFAF8]/70">
                    <li><a href="#" class="hover:text-white">Mobiles</a></li>
                    <li><a href="#" class="hover:text-white">Laptops</a></li>
                    <li><a href="#" class="hover:text-white">AI</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-mono text-[11px] tracking-wide text-[#FAFAF8]/40 mb-3">FOLLOW</h4>
                <ul class="space-y-2 text-[#FAFAF8]/70">
                    <li><a href="#" class="hover:text-white">YouTube</a></li>
                    <li><a href="#" class="hover:text-white">WhatsApp</a></li>
                    <li><a href="#" class="hover:text-white">Instagram</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-mono text-[11px] tracking-wide text-[#FAFAF8]/40 mb-3">LEGAL</h4>
                <ul class="space-y-2 text-[#FAFAF8]/70">
                    <li><a href="{{ Route::has('page.privacy') ? route('page.privacy') : '#' }}" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="{{ Route::has('page.contact') ? route('page.contact') : '#' }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-5 text-center text-[12px] text-[#FAFAF8]/40">
            &copy; {{ date('Y') }} Digital Dost. All rights reserved.
        </div>
    </footer>

    {{-- Back to top --}}
    <button x-data="{ show:false }" x-show="show" x-cloak x-transition
            @scroll.window="show = window.scrollY > 600"
            @click="window.scrollTo({top:0,behavior:'smooth'})"
            class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-[#14151A] text-white shadow-lg flex items-center justify-center hover:bg-[#DC2626] transition"
            aria-label="Back to top">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>