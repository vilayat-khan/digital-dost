@extends('layouts.site')

@php
    $query = trim((string) $query);
    $canonicalUrl = $query ? route('search', ['q' => $query]) : route('search');

    $seoTitle = $query
        ? 'Search: ' . $query . ' — Digital Dost'
        : 'Search — Digital Dost';

    $seoDescription = $query
        ? 'Search results for "' . $query . '" on Digital Dost.'
        : 'Search articles, reviews, news and guides on Digital Dost.';

    $websiteId = url('/') . '#website';
@endphp

@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'noindex,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', asset('images/og-default.jpg'))
@section('og_image_alt', 'Search — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'Search — Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'SearchResultsPage',
    '@id' => $canonicalUrl . '#webpage',
    'name' => $seoTitle,
    'url' => $canonicalUrl,
    'description' => $seoDescription,
    'inLanguage' => 'en-IN',
    'isPartOf' => [
        '@id' => $websiteId,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => array_values(array_filter([
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Search',
            'item' => route('search'),
        ],
        $query ? [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $query,
            'item' => $canonicalUrl,
        ] : null,
    ])),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container">
    <nav aria-label="Breadcrumb" style="margin-bottom:18px;">
        <ol style="display:flex; gap:8px; flex-wrap:wrap; list-style:none; padding:0; margin:0; font-size:.8rem; color:var(--color-text-faint);">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li aria-hidden="true">/</li>
            <li>
                @if($query)
                    <a href="{{ route('search') }}">Search</a>
                @else
                    <a href="{{ route('search') }}" aria-current="page" style="color:var(--color-text-muted);">Search</a>
                @endif
            </li>

            @if($query)
                <li aria-hidden="true">/</li>
                <li>
                    <a href="{{ $canonicalUrl }}" aria-current="page" style="color:var(--color-text-muted);">
                        {{ $query }}
                    </a>
                </li>
            @endif
        </ol>
    </nav>

    <section style="padding:8px 0 24px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Search</div>
        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 4vw, 4rem); line-height:1.04; margin:8px 0 12px;">Find articles</h1>

        <form action="{{ route('search') }}" method="GET" style="display:flex; gap:10px; flex-wrap:wrap;">
            <input
                type="search"
                name="q"
                value="{{ $query }}"
                placeholder="Search phones, AI, apps, laptops..."
                aria-label="Search articles"
                style="flex:1 1 320px; height:48px; border-radius:16px; border:1px solid var(--color-border); background:var(--color-surface); padding:0 14px;"
            >
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </section>

    @if($query)
        <p class="muted" style="margin:0 0 18px;">Showing results for “{{ $query }}”.</p>
    @else
        <p class="muted" style="margin:0 0 18px;">Search articles, reviews, news and guides on Digital Dost.</p>
    @endif

    <div style="display:grid; grid-template-columns:1fr; gap:20px;">
        @forelse($posts as $post)
            @include('partials.post-card', ['post' => $post])
        @empty
            <div class="card" style="padding:32px; text-align:center;">
                <h3 style="margin:0 0 8px;">No results found</h3>
                <p class="muted" style="margin:0;">Try a different keyword, product name or topic.</p>
            </div>
        @endforelse
    </div>

    @if(method_exists($posts, 'links'))
        <div style="margin-top:24px;">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection