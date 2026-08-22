@extends('layouts.site')

@php
    $canonicalUrl = route('contact');
    $seoTitle = 'Contact Us — Digital Dost';
    $seoDescription = 'Contact Digital Dost for feedback, corrections, partnerships, press inquiries, or general questions.';
    $organizationId = url('/') . '#organization';
    $websiteId = url('/') . '#website';

    $contactEmail = config('mail.from.address');
    $contactPhone = config('services.contact.phone');

    $contactPoint = array_filter([
        '@type' => 'ContactPoint',
        'contactType' => 'customer support',
        'email' => $contactEmail,
        'telephone' => $contactPhone,
        'availableLanguage' => ['en', 'hi'],
    ]);
@endphp

@section('canonical', $canonicalUrl)
@section('title', $seoTitle)
@section('meta_description', $seoDescription)
@section('robots', 'index,follow')

@section('og_type', 'website')
@section('og_title', $seoTitle)
@section('og_description', $seoDescription)
@section('og_image', asset('images/og-default.jpg'))
@section('og_image_alt', 'Contact Digital Dost')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', $seoTitle)
@section('twitter_description', $seoDescription)
@section('twitter_image', asset('images/og-default.jpg'))
@section('twitter_image_alt', 'Contact Digital Dost')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ContactPage',
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

@if($contactEmail || $contactPhone)
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => $organizationId,
    'name' => 'Digital Dost',
    'url' => url('/'),
    'contactPoint' => [$contactPoint],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

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
            'name' => 'Contact',
            'item' => $canonicalUrl,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('full-width')
<div class="container" style="max-width:860px; padding-block:40px;">
    <nav style="display:flex; gap:8px; flex-wrap:wrap; font-size:.8rem; color:var(--color-text-faint); margin-bottom:18px;">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        <span style="color:var(--color-text-muted);">Contact</span>
    </nav>

    <section class="card" style="padding:28px;">
        <div class="eyebrow">Contact</div>
        <h1 style="margin:10px 0 8px;">Contact Digital Dost</h1>
        <p class="muted" style="margin:0 0 20px;">
            Questions, feedback, corrections, collaborations, or press inquiries — send us a message below.
        </p>

        @if (session('contact_success'))
            <div style="margin:0 0 16px; padding:12px 14px; border-radius:12px; background:#ecfdf5; color:#166534; border:1px solid #bbf7d0;">
                {{ session('contact_success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" style="display:grid; gap:14px;">
            @csrf

            <div style="display:grid; gap:6px;">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('name')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('email')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="subject">Subject</label>
                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                    style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;">
                @error('subject')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid; gap:6px;">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="7" required
                    style="border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:14px;">{{ old('message') }}</textarea>
                @error('message')
                    <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
                @enderror
            </div>

            <label style="display:flex; gap:10px; align-items:flex-start; font-size:.95rem;">
                <input type="checkbox" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} style="margin-top:4px;">
                <span>I agree to the <a href="{{ route('privacy') }}">Privacy Policy</a> and consent to my message being processed for support and communication purposes.</span>
            </label>

            @error('consent')
                <div style="color:#b91c1c; font-size:.88rem;">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>
</div>
@endsection