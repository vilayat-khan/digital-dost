@extends('layouts.site')

@php
    $canonicalUrl = url()->current();
    $seoTitle = 'Page Not Found — Digital Dost';
    $seoDescription = 'The page you are looking for could not be found.';
    $websiteId = url('/') . '#website';
@endphp

@section('canonical', $canonicalUrl)
@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('robots', 'noindex,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', asset('images/og-default.jpg'))
@section('og_image_alt', '404 Error — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', '404 Error — Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
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
@endpush

@section('full-width')
<div class="container" style="max-width:980px; padding-block:48px;">
    <section class="card" style="padding:36px; text-align:center;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">404 Error</div>

        <h1 style="font-family:'Boska', serif; font-size:clamp(2.2rem, 5vw, 5rem); line-height:1.02; margin:10px 0 12px;">
            Page not found
        </h1>

        <p class="muted" style="max-width:58ch; margin:0 auto 24px;">
            The page you requested does not exist, may have moved, or the URL may be incorrect. Try searching for the topic or go back to the homepage.
        </p>

        <form action="{{ route('search') }}" method="GET" style="display:flex; gap:10px; flex-wrap:wrap; justify-content:center; max-width:720px; margin:0 auto 20px;">
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search phones, AI, apps, laptops..."
                aria-label="Search Digital Dost"
                style="flex:1 1 320px; height:48px; border-radius:16px; border:1px solid var(--color-border); background:var(--color-surface); padding:0 14px;"
            >
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <div style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap; margin-bottom:26px;">
            <a href="{{ url('/') }}" class="btn btn-primary">Go to homepage</a>
            <a href="{{ route('about') }}" class="btn">About</a>
            <a href="{{ route('contact') }}" class="btn">Contact</a>
        </div>

        <div style="display:grid; grid-template-columns:1fr; gap:14px; text-align:left; margin-top:12px;">
            <div class="card" style="padding:18px;">
                <h2 style="margin:0 0 8px; font-size:1.05rem;">Popular sections</h2>
                <div style="display:flex; flex-wrap:wrap; gap:10px;">
                    <a href="{{ url('/category/news') }}" class="btn">News</a>
                    <a href="{{ url('/category/reviews') }}" class="btn">Reviews</a>
                    <a href="{{ url('/category/buying-guides') }}" class="btn">Buying Guides</a>
                    <a href="{{ url('/category/tutorials') }}" class="btn">Tutorials</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection