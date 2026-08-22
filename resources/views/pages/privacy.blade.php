@extends('layouts.site')

@php
    $canonicalUrl = route('privacy');
    $seoTitle = 'Privacy Policy — Digital Dost';
    $seoDescription = 'Read the Privacy Policy for Digital Dost, including how we collect, use, and protect personal information.';
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
@section('og_image_alt', 'Privacy Policy — Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'Privacy Policy — Digital Dost')

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
            'name' => 'Privacy Policy',
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
        <span style="color:var(--color-text-muted);">Privacy Policy</span>
    </nav>

    <article class="card" style="padding:28px;">
        <div class="eyebrow">Privacy Policy</div>
        <h1 style="margin:10px 0 14px;">Privacy Policy</h1>

        <p class="muted">This Privacy Policy explains what information Digital Dost may collect, how we use it, and what choices are available to users.</p>

        <h2 style="margin:26px 0 10px;">Information we collect</h2>
        <p>We may collect information you submit directly, such as your name, email address, contact form messages, and newsletter subscription details.</p>

        <h2 style="margin:26px 0 10px;">How we use information</h2>
        <p>We may use information to respond to inquiries, send newsletters, improve site performance, protect against abuse, and understand how readers use our content.</p>

        <h2 style="margin:26px 0 10px;">Cookies and analytics</h2>
        <p>We may use cookies, analytics tools, and similar technologies to understand traffic, measure performance, and improve user experience.</p>

        <h2 style="margin:26px 0 10px;">Third-party services</h2>
        <p>We may rely on third-party providers for hosting, analytics, email delivery, embedded content, and related website operations.</p>

        <h2 style="margin:26px 0 10px;">Your choices</h2>
        <p>You may unsubscribe from newsletters at any time using the unsubscribe link in our emails. You may also contact us about your personal information.</p>

        <h2 style="margin:26px 0 10px;">Contact</h2>
        <p>For privacy-related questions, please use our <a href="{{ route('contact') }}">Contact page</a>.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection