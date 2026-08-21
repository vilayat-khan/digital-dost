@extends('layouts.site')

@section('canonical', route('editorial'))
@section('title', 'Editorial Policy — Digital Dost')
@section('meta_description', 'Read about the Digital Dost editorial process for reviews, news, tutorials, and buying guides.')

@section('full-width')
<div class="container" style="max-width:920px; padding-block:40px;">
    <article class="card" style="padding:28px;">
        <div class="eyebrow">Editorial Policy</div>
        <h1 style="margin:10px 0 14px;">Editorial Policy</h1>

        <h2 style="margin:26px 0 10px;">Our approach</h2>
        <p>We aim to write clear, useful, and reader-first content in plain language.</p>

        <h2 style="margin:26px 0 10px;">Reviews and recommendations</h2>
        <p>Our reviews and recommendations are based on available information, hands-on testing when possible, comparison research, and editorial judgment.</p>

        <h2 style="margin:26px 0 10px;">Corrections</h2>
        <p>If we make an error, we aim to correct it as quickly and clearly as possible.</p>

        <h2 style="margin:26px 0 10px;">News updates</h2>
        <p>Fast-moving stories may be updated as new facts become available.</p>

        <h2 style="margin:26px 0 10px;">Feedback</h2>
        <p>Readers can report issues or corrections via our <a href="{{ route('contact') }}">Contact page</a>.</p>

        <p style="margin-top:24px;" class="muted">Last updated: {{ now()->format('d M Y') }}</p>
    </article>
</div>
@endsection