@extends('layouts.site')

@php
    $canonicalUrl = route('terms');
    $seoTitle = 'Terms of Use — Digital Dost';
    $seoDescription = 'Read the Terms of Use for accessing and using Digital Dost.';
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
@section('og_image_alt', 'Terms of Use — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'Terms of Use — Digital Dost')

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
            'name' => 'Terms of Use',
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
        <span style="color:var(--color-text-muted);" aria-current="page">Terms of Use</span>
    </nav>

    <article class="card" style="padding:28px;">
        <div class="eyebrow">Terms of Use</div>
        <h1 style="margin:10px 0 14px;">Terms of Use</h1>

        <h2 style="margin:26px 0 10px;">Acceptance</h2>
        <p>By using Digital Dost, you agree to these Terms of Use and all applicable laws.</p>

        <h2 style="margin:26px 0 10px;">Content ownership</h2>
        <p>Unless stated otherwise, website content including articles, branding, layouts, graphics, and original editorial material belongs to Digital Dost or its licensors.</p>

        <h2 style="margin:26px 0 10px;">Permitted use</h2>
        <p>You may browse, share, and reference our content for personal, non-commercial use. You may not copy, republish, scrape, or redistribute substantial portions without permission.</p>

        <h2 style="margin:26px 0 10px;">No warranty</h2>
        <p>The website and its content are provided on an as-is basis without warranties of any kind.</p>

        <h2 style="margin:26px 0 10px;">Limitation of liability</h2>
        <p>Digital Dost is not liable for direct, indirect, incidental, or consequential losses arising from the use of the website or reliance on its content.</p>

        <h2 style="margin:26px 0 10px;">Changes</h2>
        <p>We may update these terms by posting revised text on this page.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection