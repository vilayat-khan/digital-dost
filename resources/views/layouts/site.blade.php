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
        /*
        |--------------------------------------------------------------------------
        | Digital Dost — Global Design System
        |--------------------------------------------------------------------------
        | Mobile-first responsive CSS.
        | Breakpoints:
        | - Base: mobile phones
        | - 640px: large phones / small tablets
        | - 768px: tablets
        | - 1024px: desktop navigation and sidebar layouts
        | - 1280px: wide desktop spacing
        |--------------------------------------------------------------------------
        */

        :root,
        [data-theme="light"] {
            --color-bg: #f7f6f2;
            --color-surface: #fbfaf7;
            --color-surface-2: #f0eee8;
            --color-surface-3: #e9e6de;
            --color-border: #e1ddd4;
            --color-text: #14151a;
            --color-text-muted: rgba(20, 21, 26, .62);
            --color-text-faint: rgba(20, 21, 26, .42);

            --color-primary: #dc2626;
            --color-primary-dark: #b91c1c;
            --color-accent: #0f766e;
            --color-inverse: #fafaf8;

            --color-success-bg: #f0fdf4;
            --color-success-border: #bbf7d0;
            --color-success-text: #166534;

            --shadow-xs: 0 1px 2px rgba(15, 23, 42, .04);
            --shadow-sm: 0 4px 14px rgba(15, 23, 42, .05);
            --shadow-md: 0 10px 30px rgba(15, 23, 42, .08);
            --shadow-lg: 0 20px 50px rgba(15, 23, 42, .14);

            --radius-xs: .375rem;
            --radius-sm: .5rem;
            --radius-md: .875rem;
            --radius-lg: 1.25rem;
            --radius-xl: 1.5rem;
            --radius-full: 999px;

            --max: 1200px;
            --content-reading: 720px;

            --space-1: .25rem;
            --space-2: .5rem;
            --space-3: .75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;

            --transition-fast: 150ms cubic-bezier(.16, 1, .3, 1);
            --transition-base: 220ms cubic-bezier(.16, 1, .3, 1);
        }

        [data-theme="dark"] {
            --color-bg: #111317;
            --color-surface: #171a20;
            --color-surface-2: #1c2129;
            --color-surface-3: #252b35;
            --color-border: #2b313b;
            --color-text: #eef2f7;
            --color-text-muted: rgba(238, 242, 247, .68);
            --color-text-faint: rgba(238, 242, 247, .44);

            --color-primary: #ef4444;
            --color-primary-dark: #dc2626;
            --color-accent: #14b8a6;
            --color-inverse: #0f1115;

            --color-success-bg: #10251a;
            --color-success-border: #166534;
            --color-success-text: #86efac;

            --shadow-xs: 0 1px 2px rgba(0, 0, 0, .25);
            --shadow-sm: 0 4px 14px rgba(0, 0, 0, .22);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, .35);
            --shadow-lg: 0 20px 50px rgba(0, 0, 0, .48);
        }

        /* ---------------------------------------------------------------------
        Reset and base
        --------------------------------------------------------------------- */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            max-width: 100%;
            overflow-x: hidden;
            scroll-behavior: smooth;
            scroll-padding-top: 88px;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }

        body {
            min-width: 320px;
            max-width: 100%;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            background: var(--color-bg);
            color: var(--color-text);
            font-family: 'Satoshi', system-ui, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        body.drawer-is-open {
            overflow: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            color: inherit;
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        img,
        picture,
        video,
        canvas,
        svg,
        iframe {
            display: block;
            max-width: 100%;
        }

        img {
            height: auto;
            background: var(--color-surface-2);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            overflow-wrap: break-word;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            line-height: 1.15;
            text-wrap: balance;
        }

        p {
            margin-top: 0;
            text-wrap: pretty;
        }

        ul,
        ol {
            margin: 0;
            padding: 0;
        }

        input::placeholder {
            color: var(--color-text-faint);
            opacity: 1;
        }

        [hidden] {
            display: none !important;
        }

        :focus-visible {
            outline: 3px solid color-mix(in srgb, var(--color-primary) 60%, transparent);
            outline-offset: 3px;
        }

        ::selection {
            background: color-mix(in srgb, var(--color-primary) 25%, transparent);
            color: var(--color-text);
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }

        /* ---------------------------------------------------------------------
        Layout
        --------------------------------------------------------------------- */

        .site-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
        }

        #content {
            min-width: 0;
            flex: 1 0 auto;
        }

        .main-content {
            min-width: 0;
            padding: var(--space-6) 0 var(--space-16);
        }

        .container {
            width: 100%;
            max-width: var(--max);
            min-width: 0;
            margin-inline: auto;
            padding-inline: 16px;
        }

        .container > *,
        .grid > *,
        .flex > *,
        .card,
        article,
        aside,
        section {
            min-width: 0;
        }

        .grid {
            min-width: 0;
        }

        .divider {
            width: 100%;
            height: 1px;
            background: var(--color-border);
        }

        .muted {
            color: var(--color-text-muted);
        }

        .faint {
            color: var(--color-text-faint);
        }

        .eyebrow {
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* ---------------------------------------------------------------------
        Generic cards and buttons
        --------------------------------------------------------------------- */

        .card {
            overflow: hidden;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xs);
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
            gap: var(--space-2);
            min-height: 44px;
            padding-inline: 14px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            background: var(--color-surface);
            color: var(--color-text);
            transition:
                background var(--transition-fast),
                border-color var(--transition-fast),
                color var(--transition-fast),
                transform var(--transition-fast);
        }

        .btn:hover {
            border-color: var(--color-primary);
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            border-color: var(--color-primary);
            background: var(--color-primary);
            color: #fff;
        }

        .btn-primary:hover {
            border-color: var(--color-primary-dark);
            background: var(--color-primary-dark);
        }

        /* ---------------------------------------------------------------------
        Header
        --------------------------------------------------------------------- */

        .site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            width: 100%;
            background: color-mix(in srgb, var(--color-bg) 90%, transparent);
            border-bottom: 1px solid var(--color-border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .header-shell {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            min-height: 68px;
            min-width: 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
            flex: 0 0 auto;
            color: var(--color-text);
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 10px;
            background: var(--color-primary);
            color: #fff;
            font-size: .78rem;
            font-weight: 900;
        }

        .brand-text {
            max-width: 150px;
            overflow: hidden;
            font-size: 1rem;
            line-height: 1.1;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /*
        Mobile default:
        - Desktop navigation hidden
        - Desktop search hidden
        - Mobile menu button visible
        */

        .main-nav {
            display: none;
            min-width: 0;
        }

        .desktop-search {
            display: none;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 0;
            flex: 0 0 auto;
        }

        .header-search {
            min-width: 0;
        }

        .header-search input,
        .mobile-search input {
            width: 100%;
            min-width: 0;
            height: 42px;
            padding-inline: 14px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            outline: none;
            background: var(--color-surface);
            color: var(--color-text);
            transition:
                border-color var(--transition-fast),
                box-shadow var(--transition-fast);
        }

        .header-search input:focus,
        .mobile-search input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--color-primary) 14%, transparent);
        }

        .icon-btn {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            min-width: 42px;
            flex: 0 0 42px;
            padding: 0;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            background: var(--color-surface);
            color: var(--color-text);
            transition:
                background var(--transition-fast),
                border-color var(--transition-fast),
                color var(--transition-fast),
                transform var(--transition-fast);
        }

        .icon-btn:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
            transform: translateY(-1px);
        }

        .icon-btn:active {
            transform: translateY(0);
        }

        .mobile-only {
            display: inline-grid;
        }

        /* Desktop navigation */

        .main-nav a {
            color: var(--color-text-muted);
            font-size: .92rem;
            font-weight: 600;
            white-space: nowrap;
            transition: color var(--transition-fast);
        }

        .main-nav a:hover,
        .main-nav a.is-active {
            color: var(--color-primary);
        }

        .nav-item {
            position: relative;
            min-width: 0;
        }

        .nav-item > a,
        .main-nav > a {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            z-index: 60;
            width: max-content;
            min-width: 240px;
            max-width: min(300px, calc(100vw - 32px));
            padding: 10px;
            overflow: hidden;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            background: var(--color-surface);
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition:
                opacity var(--transition-base),
                visibility var(--transition-base),
                transform var(--transition-base);
        }

        .nav-item.has-dropdown:hover .nav-dropdown,
        .nav-item.has-dropdown:focus-within .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-parent-link,
        .dropdown-links a {
            display: block;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: var(--color-text);
            font-size: .92rem;
            font-weight: 600;
        }

        .dropdown-links {
            display: grid;
            gap: 3px;
            margin-top: 7px;
            padding-top: 7px;
            border-top: 1px solid var(--color-border);
        }

        .dropdown-links a {
            color: var(--color-text-muted);
            font-weight: 500;
        }

        .dropdown-parent-link:hover,
        .dropdown-links a:hover {
            background: var(--color-surface-2);
            color: var(--color-primary);
        }

        /* ---------------------------------------------------------------------
        Mobile drawer
        --------------------------------------------------------------------- */

        .mobile-drawer-overlay {
            position: fixed;
            inset: 0;
            z-index: 80;
            background: rgba(0, 0, 0, .48);
            opacity: 1;
        }

        .mobile-drawer {
            width: min(88vw, 380px);
            height: 100%;
            margin-left: auto;
            overflow-y: auto;
            overscroll-behavior: contain;
            padding: 18px;
            border-left: 1px solid var(--color-border);
            background: var(--color-surface);
            box-shadow: var(--shadow-lg);
        }

        .mobile-drawer-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .mobile-search {
            width: 100%;
            margin-bottom: 18px;
        }

        .mobile-nav {
            display: grid;
            gap: 4px;
        }

        .mobile-nav a {
            display: block;
            min-height: 44px;
            padding: 10px 0;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-text);
            font-weight: 600;
        }

        .mobile-nav a:hover,
        .mobile-nav a.is-active {
            color: var(--color-primary);
        }

        .mobile-group {
            min-width: 0;
        }

        .mobile-group-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid var(--color-border);
        }

        .mobile-group-head a {
            flex: 1 1 auto;
            border-bottom: 0;
        }

        .mobile-submenu-toggle {
            display: grid;
            place-items: center;
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            background: var(--color-surface);
            color: var(--color-text);
        }

        .mobile-submenu {
            display: grid;
            gap: 0;
            padding: 4px 0 6px 14px;
        }

        .mobile-submenu a {
            min-height: 40px;
            padding: 8px 0;
            border-bottom: 0;
            color: var(--color-text-muted);
            font-size: .94rem;
            font-weight: 500;
        }

        /* ---------------------------------------------------------------------
        Article typography
        --------------------------------------------------------------------- */

        .article-prose {
            max-width: var(--content-reading);
            min-width: 0;
            color: var(--color-text);
            font-size: 1.0625rem;
            line-height: 1.8;
        }

        .article-prose h2 {
            margin-top: 2.4em;
            margin-bottom: .65em;
            color: var(--color-text);
            font-size: clamp(1.35rem, 1.1rem + 1vw, 1.75rem);
            font-weight: 900;
            letter-spacing: -.025em;
            scroll-margin-top: 96px;
        }

        .article-prose h3 {
            margin-top: 1.8em;
            margin-bottom: .55em;
            color: var(--color-text);
            font-size: clamp(1.15rem, 1rem + .5vw, 1.35rem);
            font-weight: 800;
            scroll-margin-top: 96px;
        }

        .article-prose p {
            margin-bottom: 1.25em;
            color: var(--color-text);
        }

        .article-prose p:first-of-type::first-letter {
            float: left;
            padding-right: .08em;
            color: var(--color-primary);
            font-size: 3.3em;
            font-weight: 900;
            line-height: .85;
        }

        .article-prose a {
            color: var(--color-primary);
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        .article-prose ul,
        .article-prose ol {
            margin: 1.25em 0;
            padding-left: 1.4em;
        }

        .article-prose li {
            margin-bottom: .5em;
        }

        .article-prose ul li {
            list-style: disc;
        }

        .article-prose ol li {
            list-style: decimal;
        }

        .article-prose img {
            width: 100%;
            margin: 1.8em 0;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
        }

        .article-prose blockquote {
            margin: 1.6em 0;
            padding-left: 1.2em;
            border-left: 3px solid var(--color-primary);
            color: var(--color-text-muted);
            font-style: italic;
        }

        .article-prose code {
            padding: .15em .4em;
            border-radius: var(--radius-xs);
            background: var(--color-surface-2);
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: .88em;
        }

        .article-prose pre {
            max-width: 100%;
            margin: 1.6em 0;
            padding: 1.2em;
            overflow-x: auto;
            border-radius: var(--radius-md);
            background: #14151a;
            color: #fafaf8;
        }

        .article-prose pre code {
            padding: 0;
            background: transparent;
            color: inherit;
        }

        .article-prose table {
            display: block;
            max-width: 100%;
            margin: 1.6em 0;
            overflow-x: auto;
            border-collapse: collapse;
            font-size: .92em;
        }

        .article-prose th,
        .article-prose td {
            min-width: 140px;
            padding: .6em .8em;
            border: 1px solid var(--color-border);
            text-align: left;
            vertical-align: top;
        }

        .article-prose th {
            background: var(--color-surface-2);
            font-weight: 800;
        }

        /* ---------------------------------------------------------------------
        Share buttons
        --------------------------------------------------------------------- */

        .share-btn {
            display: inline-grid;
            place-items: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            background: var(--color-surface);
            color: var(--color-text);
            transition:
                transform var(--transition-fast),
                background var(--transition-fast),
                border-color var(--transition-fast),
                color var(--transition-fast);
        }

        .share-btn svg {
            width: 18px;
            height: 18px;
        }

        .share-btn:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .share-wa:hover {
            border-color: #25d366;
            background: #25d366;
        }

        .share-x:hover {
            border-color: #111;
            background: #111;
        }

        .share-telegram:hover {
            border-color: #229ed9;
            background: #229ed9;
        }

        .share-facebook:hover {
            border-color: #1877f2;
            background: #1877f2;
        }

        .share-linkedin:hover {
            border-color: #0a66c2;
            background: #0a66c2;
        }

        .share-copy:hover,
        .share-copy.is-copied {
            border-color: var(--color-primary);
            background: var(--color-primary);
            color: #fff;
        }

        .share-native:hover {
            border-color: #6b7280;
            background: #6b7280;
        }

        /* ---------------------------------------------------------------------
        Pagination and messages
        --------------------------------------------------------------------- */

        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 28px;
        }

        .pagination .page-link,
        .pagination .page-item span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding-inline: 12px;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-full);
            background: var(--color-surface);
        }

        .pagination .active span {
            border-color: var(--color-primary);
            background: var(--color-primary);
            color: #fff;
        }

        .flash-success {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid var(--color-success-border);
            border-radius: var(--radius-md);
            background: var(--color-success-bg);
            color: var(--color-success-text);
        }

        /* ---------------------------------------------------------------------
        Footer
        --------------------------------------------------------------------- */

        footer {
            width: 100%;
            margin-top: auto;
            border-top: 1px solid var(--color-border);
            background: var(--color-surface);
            padding: 28px 0 40px;
        }

        /* ---------------------------------------------------------------------
        Tablet
        --------------------------------------------------------------------- */

        @media (min-width: 640px) {
            .container {
                padding-inline: 24px;
            }

            .header-shell {
                gap: 14px;
            }

            .brand-text {
                font-size: 1.05rem;
            }

            .mobile-drawer {
                width: min(72vw, 400px);
            }
        }

        /* ---------------------------------------------------------------------
        Desktop
        --------------------------------------------------------------------- */

        @media (min-width: 1024px) {
            .container {
                padding-inline: 32px;
            }

            .main-content {
                padding-top: 32px;
            }

            .main-nav {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: clamp(12px, 1.5vw, 24px);
                flex: 1 1 auto;
            }

            .desktop-search {
                display: block;
                width: min(240px, 20vw);
                flex: 0 1 240px;
            }

            .mobile-only {
                display: none !important;
            }

            .mobile-drawer-overlay {
                display: none !important;
            }

            .header-shell {
                min-height: 72px;
                gap: 18px;
            }

            .header-actions {
                gap: 8px;
            }

            .brand-text {
                font-size: 1.1rem;
            }
        }

        /* ---------------------------------------------------------------------
        Wide desktop
        --------------------------------------------------------------------- */

        @media (min-width: 1280px) {
            .container {
                padding-inline: 16px;
            }

            .main-nav {
                gap: 24px;
            }
        }

        /* ---------------------------------------------------------------------
        Small phone refinements
        --------------------------------------------------------------------- */

        @media (max-width: 380px) {
            .container {
                padding-inline: 12px;
            }

            .header-shell {
                gap: 6px;
            }

            .brand {
                gap: 7px;
            }

            .brand-mark {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
                border-radius: 9px;
            }

            .brand-text {
                max-width: 112px;
                font-size: .94rem;
            }

            .icon-btn {
                width: 40px;
                height: 40px;
                min-width: 40px;
                flex-basis: 40px;
            }
        }

        /* ---------------------------------------------------------------------
        Print
        --------------------------------------------------------------------- */

        @media print {
            .site-header,
            .mobile-drawer-overlay,
            footer,
            .share-btn,
            .pagination {
                display: none !important;
            }

            body {
                background: #fff;
                color: #000;
            }

            .container {
                max-width: none;
                padding: 0;
            }
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