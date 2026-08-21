@extends('layouts.site')

@section('canonical', route('about'))
@section('title', 'About Us — Digital Dost')
@section('meta_description', 'Learn about Digital Dost, our mission, and how we cover tech news, reviews, explainers, and buying guides in simple Hinglish.')

@section('full-width')
<div class="container" style="max-width:900px; padding-block:40px;">
    <article class="card" style="padding:28px;">
        <div class="eyebrow">About</div>
        <h1 style="margin:10px 0 14px;">About Digital Dost</h1>

        <p class="muted" style="margin-bottom:18px;">
            Digital Dost is a tech publication focused on making technology easier to understand.
        </p>

        <h2 style="margin:26px 0 10px;">What we cover</h2>
        <p>We publish news, reviews, buying guides, comparisons, tutorials, and explainers on smartphones, apps, AI tools, gadgets, and software.</p>

        <h2 style="margin:26px 0 10px;">Why we exist</h2>
        <p>Our goal is to help readers make better tech decisions with clear language, practical context, and useful recommendations.</p>

        <h2 style="margin:26px 0 10px;">Reach us</h2>
        <p>You can contact us for feedback, corrections, business inquiries, or collaborations through our <a href="{{ route('contact') }}">Contact page</a>.</p>
    </article>
</div>
@endsection