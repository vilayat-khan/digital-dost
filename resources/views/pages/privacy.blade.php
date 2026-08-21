@extends('layouts.site')

@section('canonical', route('privacy'))
@section('title', 'Privacy Policy — Digital Dost')
@section('meta_description', 'Read the Privacy Policy for Digital Dost, including how we collect, use, and protect personal information.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
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