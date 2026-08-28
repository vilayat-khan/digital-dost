@extends('layouts.site')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $authorName = $author->display_name;
    $canonicalUrl = route('author.show', $author->slug);

    $authorDescription = $author->bio
        ? Str::limit(strip_tags($author->bio), 155)
        : 'Read articles by ' . $authorName . ' on Digital Dost.';

    $authorImage = $author->avatar_url ?: asset('images/og-default.jpg');

    $sameAs = array_values(array_filter([
        $author->twitter_url,
        $author->linkedin_url,
        $author->instagram_url,
        $author->website_url,
    ]));

    $itemList = $posts->values()->map(function ($post, $index) {
        return [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $post->title,
            'url' => route('post.show', $post->slug),
        ];
    })->all();
@endphp

@section('title', $authorName . ' — Digital Dost')
@section('meta_description', $authorDescription)
@section('canonical', $canonicalUrl)
@section('robots', 'noindex,follow')

@section('og_type', 'profile')
@section('og_title', $authorName . ' — Digital Dost')
@section('og_description', $authorDescription)
@section('og_image', $authorImage)
@section('og_image_alt', $authorName)

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $authorName . ' — Digital Dost')
@section('twitter_description', $authorDescription)
@section('twitter_image', $authorImage)
@section('twitter_image_alt', $authorName)

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ProfilePage',
    'name' => $authorName . ' — Author Profile',
    'url' => $canonicalUrl,
    'description' => $authorDescription,
    'inLanguage' => 'en-IN',
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Digital Dost',
        'url' => url('/'),
    ],
    'mainEntity' => [
        '@type' => 'Person',
        '@id' => $canonicalUrl . '#person',
        'name' => $authorName,
        'url' => $canonicalUrl,
        'image' => $authorImage,
        'description' => $author->bio ? strip_tags($author->bio) : null,
        'jobTitle' => $author->designation ?: null,
        'worksFor' => [
            '@type' => 'Organization',
            'name' => 'Digital Dost',
            'url' => url('/'),
        ],
        'sameAs' => $sameAs,
    ],
    'hasPart' => count($itemList) ? [[
        '@type' => 'ItemList',
        'numberOfItems' => count($itemList),
        'itemListElement' => $itemList,
    ]] : null,
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
            'name' => $authorName,
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
        <span style="color:var(--color-text-muted);">{{ $authorName }}</span>
    </nav>

    <section class="card" style="padding:24px; margin-bottom:24px;">
        <div style="display:flex; gap:16px; align-items:center; flex-wrap:wrap;">
            <div style="width:72px; height:72px; border-radius:999px; overflow:hidden; background:var(--color-surface-2); display:grid; place-items:center; font-weight:900;">
                @if($author->avatar)
                    <img src="{{ $author->avatar_url }}" alt="{{ $authorName }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    {{ strtoupper(substr($authorName, 0, 1)) }}
                @endif
            </div>

            <div>
                <h1 style="margin:0;">{{ $authorName }}</h1>

                <div class="muted" style="margin-top:6px;">
                    {{ $author->designation ?: 'Author' }} · {{ $author->posts_count }} articles
                </div>

                @if($author->bio)
                    <p class="muted" style="margin-top:8px;">{{ $author->bio }}</p>
                @endif
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Articles by {{ $authorName }}</h2>

        <div style="display:grid; grid-template-columns:1fr; gap:20px; margin-top:18px;">
            @forelse($posts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <p class="muted">No published posts found for this author.</p>
            @endforelse
        </div>

        <div style="margin-top:24px;">
            {{ $posts->links() }}
        </div>
    </section>
</div>
@endsection