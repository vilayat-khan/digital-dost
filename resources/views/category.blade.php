@extends('layouts.site')

@php
    $canonicalUrl = route('category.show', $category->slug);
    $seoTitle = $category->name . ' — Digital Dost';
    $seoDescription = 'Latest posts in ' . $category->name . ' on Digital Dost.';
    $itemList = $posts->values()->map(function ($post, $index) {
        return [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $post->title,
            'url' => route('post.show', $post->slug),
        ];
    })->all();
@endphp

@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'index,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
<!-- @section('og_url', $canonicalUrl) -->
@section('og_image', asset('images/og-default.jpg'))
@section('og_image_alt', $category->name . ' — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', $category->name . ' — Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => $category->name,
    'url' => $canonicalUrl,
    'description' => $seoDescription,
    'inLanguage' => 'en-IN',
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Digital Dost',
        'url' => url('/'),
    ],
    'mainEntity' => [
        '@type' => 'ItemList',
        'numberOfItems' => count($itemList),
        'itemListElement' => $itemList,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => $category->name,
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container">
    <nav style="display:flex; gap:8px; flex-wrap:wrap; font-size:.8rem; color:var(--color-text-faint); margin-bottom:18px;">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        <span style="color:var(--color-text-muted);">{{ $category->name }}</span>
    </nav>

    <section style="padding:8px 0 28px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Category</div>
        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 4vw, 4rem); line-height:1.04; margin:8px 0 8px;">{{ $category->name }}</h1>
        <p class="muted" style="margin:0;">Latest stories, reviews and guides from this section.</p>
    </section>

    <div style="display:grid; grid-template-columns:1fr; gap:24px;">
        <div style="display:grid; grid-template-columns:1fr; gap:20px;">
            @forelse($posts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="card" style="padding:32px; text-align:center;">
                    <h3 style="margin:0 0 8px;">No posts found</h3>
                    <p class="muted" style="margin:0;">This category does not have published posts yet.</p>
                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>
</div>
@endsection