@extends('layouts.site')

@section('canonical', route('disclaimer'))
@section('title', 'Disclaimer — Digital Dost')
@section('meta_description', 'Read the Digital Dost disclaimer regarding reviews, opinions, product information, and general informational content.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
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