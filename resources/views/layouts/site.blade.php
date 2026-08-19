<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Digital Dost')</title>
    <meta name="description" content="@yield('meta_description', 'Latest tech news, reviews, AI, gadgets and buying guides.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:site_name" content="Digital Dost">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Digital Dost')))">
    <meta property="og:description" content="@yield('meta_description', 'Latest tech news, reviews, AI, gadgets and buying guides.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Digital Dost')))">
    <meta name="twitter:description" content="@yield('meta_description', 'Latest tech news, reviews, AI, gadgets and buying guides.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&f[]=boska@400,700&display=swap" rel="stylesheet">

    @stack('head')

    <style>
        :root, [data-theme="light"] {
            --color-bg: #f7f6f2;
            --color-surface: #fbfaf7;
            --color-surface-2: #f0eee8;
            --color-border: #e1ddd4;
            --color-text: #14151a;
            --color-text-muted: rgba(20,21,26,.62);
            --color-text-faint: rgba(20,21,26,.42);
            --color-primary: #dc2626;
            --color-primary-dark: #b91c1c;
            --color-accent: #0f766e;
            --color-inverse: #fafaf8;
            --shadow-sm: 0 1px 2px rgba(15, 23, 42, .04);
            --shadow-md: 0 10px 30px rgba(15, 23, 42, .07);
            --radius-sm: .5rem;
            --radius-md: .875rem;
            --radius-lg: 1.25rem;
            --radius-xl: 1.5rem;
            --max: 1200px;
        }

        [data-theme="dark"] {
            --color-bg: #111317;
            --color-surface: #171a20;
            --color-surface-2: #1c2129;
            --color-border: #2b313b;
            --color-text: #eef2f7;
            --color-text-muted: rgba(238,242,247,.68);
            --color-text-faint: rgba(238,242,247,.44);
            --color-primary: #ef4444;
            --color-primary-dark: #dc2626;
            --color-accent: #14b8a6;
            --color-inverse: #0f1115;
            --shadow-sm: 0 1px 2px rgba(0,0,0,.25);
            --shadow-md: 0 10px 30px rgba(0,0,0,.35);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            background: var(--color-bg);
            color: var(--color-text);
            font-family: 'Satoshi', sans-serif;
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        button, input { font: inherit; }
        .container { max-width: var(--max); margin: 0 auto; padding: 0 16px; }
        .eyebrow { letter-spacing: .08em; text-transform: uppercase; }
        .site-shell { min-height: 100vh; display: flex; flex-direction: column; }
        .main-content { flex: 1; padding: 24px 0 64px; }
        .card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }
        .section-title {
            font-size: 1rem;
            font-weight: 900;
            letter-spacing: -.02em;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            min-height: 44px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid var(--color-border);
            background: var(--color-surface);
        }
        .btn-primary {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }
        .btn:hover { border-color: var(--color-primary); }
        .btn-primary:hover { background: var(--color-primary-dark); }
        .divider { height: 1px; background: var(--color-border); }
        .muted { color: var(--color-text-muted); }
        .faint { color: var(--color-text-faint); }

        .pagination { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 28px; }
        .pagination .page-link, .pagination .page-item span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 999px;
            border: 1px solid var(--color-border);
            background: var(--color-surface);
        }
        .pagination .active span {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: #fff;
        }

        .flash-success {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 12px;
        }

        footer {
            border-top: 1px solid var(--color-border);
            background: var(--color-surface);
            padding: 24px 0 40px;
        }
        /* paste the header + mobile drawer CSS here */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: color-mix(in srgb, var(--color-bg) 88%, transparent);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--color-border);
        }

        .header-shell {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 72px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--color-text);
            text-decoration: none;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: var(--color-primary);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 900;
        }

        .brand-text {
            font-size: 1.1rem;
        }

        .main-nav {
            display: none;
            align-items: center;
            gap: 18px;
        }

        .main-nav a,
        .mobile-nav a {
            color: var(--color-text-muted);
            text-decoration: none;
            font-weight: 600;
        }

        .main-nav a:hover,
        .mobile-nav a:hover,
        .main-nav a.is-active {
            color: var(--color-text);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-search {
            display: none;
        }

        .header-search input,
        .mobile-search input {
            height: 44px;
            border-radius: 999px;
            border: 1px solid var(--color-border);
            background: var(--color-surface);
            color: var(--color-text);
            padding: 0 14px;
            outline: none;
        }

        .header-search input {
            width: 240px;
        }

        .icon-btn {
            min-width: 44px;
            width: 44px;
            height: 44px;
            border: 1px solid var(--color-border);
            border-radius: 999px;
            background: var(--color-surface);
            display: grid;
            place-items: center;
        }

        .mobile-drawer-overlay {
            position: fixed;
            inset: 0;
            z-index: 80;
            background: rgba(0, 0, 0, 0.45);
        }

        .mobile-drawer {
            margin-left: auto;
            width: min(86vw, 380px);
            height: 100%;
            background: var(--color-surface);
            border-left: 1px solid var(--color-border);
            padding: 20px;
            overflow: auto;
        }

        .mobile-drawer-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .mobile-search {
            margin-bottom: 18px;
        }

        .mobile-search input {
            width: 100%;
        }

        .mobile-nav {
            display: grid;
            gap: 10px;
        }

        .mobile-nav a {
            padding: 12px 0;
            border-bottom: 1px solid var(--color-border);
        }

        .share-btn {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            border: 1px solid var(--color-border);
            background: var(--color-surface);
            color: var(--color-text);
            display: inline-grid;
            place-items: center;
            text-decoration: none;
            transition: transform .18s ease, background .18s ease, border-color .18s ease, color .18s ease;
        }

        .share-btn svg {
            width: 18px;
            height: 18px;
        }

        .share-btn:hover {
            transform: translateY(-1px);
            color: white;
        }

        .share-wa:hover { background: #25D366; border-color: #25D366; }
        .share-x:hover { background: #111111; border-color: #111111; }
        .share-telegram:hover { background: #229ED9; border-color: #229ED9; }
        .share-facebook:hover { background: #1877F2; border-color: #1877F2; }
        .share-linkedin:hover { background: #0A66C2; border-color: #0A66C2; }
        .share-copy:hover,
        .share-copy.is-copied { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }
        .share-native:hover { background: #6b7280; border-color: #6b7280; }

        @media (max-width: 640px) {
            .share-btn {
                width: 40px;
                height: 40px;
            }
        }

        @media (min-width: 1024px) {
            .main-nav,
            .header-search {
                display: flex;
            }

            .mobile-only {
                display: none !important;
            }
        }

        @media (max-width: 1023px) {
            .main-content { padding-top: 18px; }
        }
    </style>
</head>
<body>
    @include('partials.header')
    @include('partials.mobile-drawer')

    <main id="content">
        @yield('full-width')
    </main>

    @include('partials.footer')

    @stack('scripts')

    <script>
        (() => {
            const root = document.documentElement;
            const themeBtn = document.querySelector('[data-theme-toggle]');
            let theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            root.setAttribute('data-theme', theme);

            themeBtn?.addEventListener('click', () => {
                theme = theme === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-theme', theme);
            });

            const drawer = document.querySelector('[data-mobile-drawer]');
            const openBtn = document.querySelector('[data-menu-open]');
            const closeBtn = document.querySelector('[data-menu-close]');

            openBtn?.addEventListener('click', () => {
                drawer?.removeAttribute('hidden');
                document.body.style.overflow = 'hidden';
            });

            closeBtn?.addEventListener('click', () => {
                drawer?.setAttribute('hidden', 'hidden');
                document.body.style.overflow = '';
            });

            drawer?.addEventListener('click', (e) => {
                if (e.target === drawer) {
                    drawer.setAttribute('hidden', 'hidden');
                    document.body.style.overflow = '';
                }
            });
        })();
    </script>
</body>
</html>