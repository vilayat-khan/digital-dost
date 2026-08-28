@extends('layouts.site')

@php
    use Illuminate\Support\Facades\Storage;

    $canonicalUrl = url('/');
    $seoTitle = 'Digital Dost — AI, Gadgets Reviews & Guides';
    $seoDescription = 'Latest tech news, reviews, AI, robotics, mobile coverage, software guides and buying advice.';
    $defaultOgImage = asset('images/og-default.jpg');

    $heroSide = $latest->slice(0, 4);
    $moreStories = $latest->slice(4);

    $sameAs = array_values(array_filter([
        config('services.social.facebook'),
        config('services.social.twitter'),
        config('services.social.instagram'),
        config('services.social.linkedin'),
        config('services.social.youtube'),
    ]));
@endphp

@section('canonical', $canonicalUrl)
@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('robots', 'index,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', $defaultOgImage)
@section('og_image_alt', 'Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', $defaultOgImage)
@section('twitter_image_alt', 'Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => $canonicalUrl . '#organization',
    'name' => 'Digital Dost',
    'url' => $canonicalUrl,
    'logo' => [
        '@type' => 'ImageObject',
        'url' => asset('images/logo.png'),
    ],
    'image' => $defaultOgImage,
    'description' => $seoDescription,
    'sameAs' => $sameAs,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    '@id' => $canonicalUrl . '#website',
    'name' => 'Digital Dost',
    'url' => $canonicalUrl,
    'description' => $seoDescription,
    'inLanguage' => 'en-IN',
    'publisher' => [
        '@id' => $canonicalUrl . '#organization',
    ],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
            '@type' => 'EntryPoint',
            'urlTemplate' => url('/search?q={search_term_string}'),
        ],
        'query-input' => 'required name=search_term_string',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container">
    @if($featured)
        <section style="display:grid; grid-template-columns:1fr; gap:28px; padding:10px 0 36px; border-bottom:1px solid var(--color-border);">
            <div class="hero-grid" style="display:grid; grid-template-columns:1fr; gap:28px;">
                <a href="{{ route('post.show', $featured->slug) }}" style="display:block;">
                    <div style="aspect-ratio:16/10; background:var(--color-surface-2); border-radius:24px; overflow:hidden;">
                        @if($featured->featured_image)
                            <img src="{{ $featured->featured_image_url }}" alt="{{ $featured->title }}" style="width:100%; height:100%; object-fit:cover;">
                        @endif
                    </div>
                    <div style="margin-top:16px;">
                        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">{{ strtoupper(optional($featured->category)->name ?? 'Featured') }}</div>
                        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 3.4vw, 3.8rem); line-height:1.04; letter-spacing:-.03em; margin:8px 0 10px;">{{ $featured->title }}</h1>
                        @if($featured->excerpt)
                            <p class="muted" style="font-size:1.06rem; max-width:62ch; margin:0;">{{ $featured->excerpt }}</p>
                        @endif
                        <div class="muted" style="margin-top:10px; font-size:.88rem;">By {{ optional($featured->author)->display_name ?? 'Digital Dost' }}</div>
                    </div>
                </a>

                <div style="display:grid; gap:16px;">
                    @foreach($heroSide as $post)
                        <a href="{{ route('post.show', $post->slug) }}" style="display:grid; grid-template-columns:100px 1fr; gap:14px; align-items:start; padding-bottom:16px; border-bottom:1px solid var(--color-border);">
                            <div style="aspect-ratio:4/3; border-radius:14px; overflow:hidden; background:var(--color-surface-2);">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width:100%; height:100%; object-fit:cover;">
                                @endif
                            </div>
                            <div>
                                <div class="eyebrow" style="font-size:.68rem; color:var(--color-primary); font-weight:800;">{{ strtoupper(optional($post->category)->name ?? 'News') }}</div>
                                <div style="font-weight:800; line-height:1.3; margin-top:5px;">{{ $post->title }}</div>
                                <div class="muted" style="font-size:.82rem; margin-top:5px;">By {{ optional($post->author)->display_name ?? 'Digital Dost' }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section style="display:grid; grid-template-columns:1fr; gap:32px; margin-top:32px;">
        <div class="content-grid" style="display:grid; grid-template-columns:1fr; gap:32px;">
            <div>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                    <h2 class="section-title">More Stories</h2>
                    <div class="divider" style="flex:1;"></div>
                </div>

                <div style="display:grid; grid-template-columns:1fr; gap:24px;">
                    @forelse($moreStories as $post)
                        @include('partials.story-card', ['post' => $post])
                    @empty
                        <div class="card" style="padding:32px; text-align:center;">
                            <h3 style="margin:0 0 8px;">No stories yet</h3>
                            <p class="muted" style="margin:0;">Check back soon for new articles and reviews.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside>
                @include('partials.sidebar')
            </aside>
        </div>
    </section>
</div>

<style>
    @media (min-width: 1024px) {
        .hero-grid { grid-template-columns: 1.45fr .82fr !important; }
        .content-grid { grid-template-columns: minmax(0, 1.6fr) 340px !important; align-items: start; }
    }
    @media (min-width: 640px) and (max-width: 1023px) {
        .content-grid > div:first-child > div:last-child {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }
</style>
@endsection