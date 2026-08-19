@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, reviews, AI, robotics, mobile coverage, software guides and buying advice.')
@section('og_title', 'Digital Dost — AI, Gadgets Reviews & Guides')

@section('full-width')
@php
    $heroSide = $latest->slice(0, 4);
    $moreStories = $latest->slice(4);
@endphp

<div class="container">
    @if($featured)
        <section style="display:grid; grid-template-columns:1fr; gap:28px; padding:10px 0 36px; border-bottom:1px solid var(--color-border);">
            <div class="hero-grid" style="display:grid; grid-template-columns:1fr; gap:28px;">
                <a href="{{ route('post.show', $featured->slug) }}" style="display:block;">
                    <div style="aspect-ratio:16/10; background:var(--color-surface-2); border-radius:24px; overflow:hidden;">
                        @if($featured->featured_image)
                            <img src="{{ Storage::url($featured->featured_image) }}" alt="{{ $featured->title }}" style="width:100%; height:100%; object-fit:cover;">
                        @endif
                    </div>
                    <div style="margin-top:16px;">
                        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">{{ strtoupper(optional($featured->category)->name ?? 'Featured') }}</div>
                        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 3.4vw, 3.8rem); line-height:1.04; letter-spacing:-.03em; margin:8px 0 10px;">{{ $featured->title }}</h1>
                        @if($featured->excerpt)
                            <p class="muted" style="font-size:1.06rem; max-width:62ch; margin:0;">{{ $featured->excerpt }}</p>
                        @endif
                        <div class="muted" style="margin-top:10px; font-size:.88rem;">By {{ optional($featured->author)->name ?? 'Digital Dost' }}</div>
                    </div>
                </a>

                <div style="display:grid; gap:16px;">
                    @foreach($heroSide as $post)
                        <a href="{{ route('post.show', $post->slug) }}" style="display:grid; grid-template-columns:100px 1fr; gap:14px; align-items:start; padding-bottom:16px; border-bottom:1px solid var(--color-border);">
                            <div style="aspect-ratio:4/3; border-radius:14px; overflow:hidden; background:var(--color-surface-2);">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width:100%; height:100%; object-fit:cover;">
                                @endif
                            </div>
                            <div>
                                <div class="eyebrow" style="font-size:.68rem; color:var(--color-primary); font-weight:800;">{{ strtoupper(optional($post->category)->name ?? 'News') }}</div>
                                <div style="font-weight:800; line-height:1.3; margin-top:5px;">{{ $post->title }}</div>
                                <div class="muted" style="font-size:.82rem; margin-top:5px;">By {{ optional($post->author)->name ?? 'Digital Dost' }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section style="display:grid; grid-template-columns:1fr; gap:32px; margin-top:32px;">
        <div class="content-grid" style="display:grid; grid-template-columns:1fr; gap:32px;">
            <div>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                    <h2 class="section-title">More Stories</h2>
                    <div class="divider" style="flex:1;"></div>
                </div>

                <div style="display:grid; grid-template-columns:1fr; gap:24px;">
                    @forelse($moreStories as $post)
                        @include('partials.story-card', ['post' => $post])
                    @empty
                        <div class="card" style="padding:32px; text-align:center;">
                            <h3 style="margin:0 0 8px;">No stories yet</h3>
                            <p class="muted" style="margin:0;">Check back soon for new articles and reviews.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside>
                @include('partials.sidebar')
            </aside>
        </div>
    </section>
</div>

<style>
    @media (min-width: 1024px) {
        .hero-grid { grid-template-columns: 1.45fr .82fr !important; }
        .content-grid { grid-template-columns: minmax(0, 1.6fr) 340px !important; align-items: start; }
    }
    @media (min-width: 640px) and (max-width: 1023px) {
        .content-grid > div:first-child > div:last-child {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }
</style>
@endsection