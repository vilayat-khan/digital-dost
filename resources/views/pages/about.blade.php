@extends('layouts.site')

@php
    $canonicalUrl = route('about');
    $seoTitle = 'About Us — Digital Dost';
    $seoDescription = 'Learn about Digital Dost, our mission, and how we cover tech news, reviews, explainers, and buying guides in simple Hinglish.';
    $organizationId = url('/') . '#organization';
    $websiteId = url('/') . '#website';
@endphp

@section('canonical', $canonicalUrl)
@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('robots', 'index,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', asset('images/og-default.jpg'))
@section('og_image_alt', 'About Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'About Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'AboutPage',
    '@id' => $canonicalUrl . '#webpage',
    'name' => $seoTitle,
    'url' => $canonicalUrl,
    'description' => $seoDescription,
    'inLanguage' => 'en-IN',
    'isPartOf' => [
        '@id' => $websiteId,
    ],
    'about' => [
        '@id' => $organizationId,
    ],
    'mainEntity' => [
        '@id' => $organizationId,
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
            'name' => 'About',
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container" style="max-width:900px; padding-block:40px;">
    <nav style="display:flex; gap:8px; flex-wrap:wrap; font-size:.8rem; color:var(--color-text-faint); margin-bottom:18px;">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        <span style="color:var(--color-text-muted);">About</span>
    </nav>

    <article class="card" style="padding:28px;">
        <div class="eyebrow">About</div>
        <h1 style="margin:10px 0 14px;">About Digital Dost</h1>

        <p class="muted" style="margin-bottom:18px;">
            Digital Dost is a tech publication focused on making technology easier to understand.
        </p>

        <h2 style="margin:26px 0 10px;">What we cover</h2>
        <p>We publish news, reviews, buying guides, comparisons, tutorials, and explainers on smartphones, apps, AI tools, gadgets, and software.</p>

        <h2 style="margin:26px 0 10px;">Why we exist</h2>
        <p>Our goal is to help readers make better tech decisions with clear language, practical context, and useful recommendations.</p>

        <h2 style="margin:26px 0 10px;">Reach us</h2>
        <p>You can contact us for feedback, corrections, business inquiries, or collaborations through our <a href="{{ route('contact') }}">Contact page</a>.</p>
    </article>
</div>
@endsection