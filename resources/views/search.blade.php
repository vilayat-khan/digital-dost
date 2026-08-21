@extends('layouts.site')

@section('title', $query ? 'Search: ' . $query . ' — Digital Dost' : 'Search — Digital Dost')
@section('meta_description', 'Search articles, reviews, news and guides on Digital Dost.')
@section('canonical', url()->current())
@section('robots', 'noindex,follow')

@section('full-width')
<div class="container">
    <section style="padding:8px 0 24px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Search</div>
        <h1 style="font-family:'Boska', serif; font-size:clamp(2rem, 4vw, 4rem); line-height:1.04; margin:8px 0 12px;">Find articles</h1>

        <form action="{{ route('search') }}" method="GET" style="display:flex; gap:10px; flex-wrap:wrap;">
            <input type="search" name="q" value="{{ $query }}" placeholder="Search phones, AI, apps, laptops..."
                   style="flex:1 1 320px; height:48px; border-radius:16px; border:1px solid var(--color-border); background:var(--color-surface); padding:0 14px;">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </section>

    @if($query)
        <p class="muted" style="margin:0 0 18px;">Showing results for “{{ $query }}”.</p>
    @endif

    <div style="display:grid; grid-template-columns:1fr; gap:20px;">
        @forelse($posts as $post)
            @include('partials.post-card', ['post' => $post])
        @empty
            <div class="card" style="padding:32px; text-align:center;">
                <h3 style="margin:0 0 8px;">No results found</h3>
                <p class="muted" style="margin:0;">Try a different keyword, product name or topic.</p>
            </div>
        @endforelse
    </div>

    @if(method_exists($posts, 'links'))
        {{ $posts->links() }}
    @endif
</div>
@endsection