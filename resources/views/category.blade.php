@extends('layouts.site')

@section('title', $category->name . ' — Digital Dost')
@section('meta_description', 'Latest posts in ' . $category->name . ' on Digital Dost.')

@section('full-width')
<div class="container">
    <section style="padding:8px 0 28px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Category</div>
        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 4vw, 4rem); line-height:1.04; margin:8px 0 8px;">{{ $category->name }}</h1>
        <p class="muted" style="margin:0;">Latest stories, reviews and guides from this section.</p>
    </section>

    <div style="display:grid; grid-template-columns:1fr; gap:24px;">
        <div style="display:grid; grid-template-columns:1fr; gap:20px;">
            @forelse($posts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="card" style="padding:32px; text-align:center;">
                    <h3 style="margin:0 0 8px;">No posts found</h3>
                    <p class="muted" style="margin:0;">This category does not have published posts yet.</p>
                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>
</div>
@endsection