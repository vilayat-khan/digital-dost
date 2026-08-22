@extends('layouts.site')

@php
    $canonicalUrl = route('disclaimer');
    $seoTitle = 'Disclaimer — Digital Dost';
    $seoDescription = 'Read the Digital Dost disclaimer regarding reviews, opinions, product information, and general informational content.';
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
@section('og_image_alt', 'Disclaimer — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'Disclaimer — Digital Dost')

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
            'name' => 'Disclaimer',
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
    <nav style="display:flex; gap:8px; flex-wrap:wrap; font-size:.8rem; color:var(--color-text-faint); margin-bottom:18px;">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        <span style="color:var(--color-text-muted);" aria-current="page">Disclaimer</span>
    </nav>

    <article class="card" style="padding:28px;">
        <div class="eyebrow">Disclaimer</div>
        <h1 style="margin:10px 0 14px;">Disclaimer</h1>

        <h2 style="margin:26px 0 10px;">General information</h2>
        <p>Content on Digital Dost is published for general informational and editorial purposes only.</p>

        <h2 style="margin:26px 0 10px;">Accuracy</h2>
        <p>We try to keep information accurate and up to date, but specifications, prices, availability, and software behavior may change over time.</p>

        <h2 style="margin:26px 0 10px;">No professional advice</h2>
        <p>Nothing on this website should be treated as legal, financial, medical, or other professional advice.</p>

        <h2 style="margin:26px 0 10px;">Purchase decisions</h2>
        <p>Readers should verify important details directly with brands, sellers, or service providers before making purchase or usage decisions.</p>

        <h2 style="margin:26px 0 10px;">External links</h2>
        <p>We may link to third-party websites for convenience or reference, but we do not control or guarantee external content or services.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection