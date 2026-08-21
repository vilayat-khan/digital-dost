@extends('layouts.site')

@section('canonical', route('affiliate'))
@section('title', 'Affiliate Disclosure — Digital Dost')
@section('meta_description', 'Read how Digital Dost handles affiliate links, sponsorships, and monetized recommendations.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
    <article class="card" style="padding:28px;">
        <div class="eyebrow">Affiliate Disclosure</div>
        <h1 style="margin:10px 0 14px;">Affiliate Disclosure</h1>

        <h2 style="margin:26px 0 10px;">How affiliate links work</h2>
        <p>Some articles may include affiliate links. If you click a link and make a purchase, Digital Dost may earn a commission at no extra cost to you.</p>

        <h2 style="margin:26px 0 10px;">Editorial independence</h2>
        <p>Affiliate relationships do not determine our opinions, rankings, or conclusions. We aim to keep editorial judgment independent.</p>

        <h2 style="margin:26px 0 10px;">Sponsored content</h2>
        <p>If any content is sponsored or paid for by a brand, we aim to label it clearly.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection