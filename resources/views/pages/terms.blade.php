@extends('layouts.site')

@section('canonical', route('terms'))
@section('title', 'Terms of Use — Digital Dost')
@section('meta_description', 'Read the Terms of Use for accessing and using Digital Dost.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
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