@extends('layouts.site')

@section('canonical', route('cookies'))
@section('title', 'Cookie Policy — Digital Dost')
@section('meta_description', 'Learn how Digital Dost uses cookies and similar technologies.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
    <article class="card" style="padding:28px;">
        <div class="eyebrow">Cookie Policy</div>
        <h1 style="margin:10px 0 14px;">Cookie Policy</h1>

        <h2 style="margin:26px 0 10px;">What are cookies</h2>
        <p>Cookies are small text files placed on your device to help websites remember settings, measure usage, and improve functionality.</p>

        <h2 style="margin:26px 0 10px;">How we use cookies</h2>
        <p>We may use cookies for essential site functions, analytics, performance measurement, and user experience improvements.</p>

        <h2 style="margin:26px 0 10px;">Your choices</h2>
        <p>You can manage or delete cookies through your browser settings, though some site features may stop working properly afterward.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection