{{-- home.blade.php — Engadget-style layout --}}
@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')

@section('full-width')

@php
    $heroSide = $latest->slice(0, 4);
    $moreStories = $latest->slice(4);
@endphp

<div class="max-w-6xl mx-auto">

    {{-- ===== HERO ROW: big story + 4-item side list (Engadget pattern) ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-10 border-b border-[#E7E5DF]">

        {{-- Big featured story --}}
        @if($featured)
            <a href="{{ route('post.show', $featured->slug) }}" class="lg:col-span-7 group block">
                <div class="aspect-[16/10] bg-[#F0EEE8] rounded-2xl overflow-hidden">
                    @if($featured->featured_image)
                        <img src="{{ Storage::url($featured->featured_image) }}" alt="{{ $featured->title }}"
                             class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                    @endif
                </div>
                <span class="eyebrow inline-block mt-4 text-[11px] font-semibold text-[#DC2626] tracking-wide">
                    {{ strtoupper($featured->category->name ?? 'NEWS') }}
                </span>
                <h1 class="mt-2 text-2xl md:text-[32px] font-extrabold leading-[1.15] tracking-tight group-hover:text-[#DC2626] transition-colors">
                    {{ $featured->title }}
                </h1>
                @if($featured->excerpt)
                    <p class="mt-2 text-[15px] text-[#14151A]/60 leading-relaxed line-clamp-2">{{ $featured->excerpt }}</p>
                @endif
                <div class="mt-3 flex items-center gap-2 text-[12px] font-mono text-[#14151A]/45">
                    <span>By {{ $featured->author->name ?? 'Digital Dost' }}</span>
                </div>
            </a>
        @endif

        {{-- 4-item side list --}}
        <div class="lg:col-span-5 divide-y divide-[#E7E5DF]">
            @foreach($heroSide as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="group flex gap-4 py-4 first:pt-0">
                    <div class="w-24 h-20 sm:w-28 sm:h-24 shrink-0 bg-[#F0EEE8] rounded-lg overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="eyebrow text-[10px] font-semibold text-[#DC2626]">
                            {{ strtoupper($post->category->name ?? 'NEWS') }}
                        </span>
                        <h3 class="mt-1 font-bold text-[14px] sm:text-[15px] leading-snug line-clamp-2 group-hover:text-[#DC2626] transition-colors">
                            {{ $post->title }}
                        </h3>
                        <span class="text-[11px] font-mono text-[#14151A]/40">By {{ $post->author->name ?? 'Digital Dost' }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- ===== MORE STORIES: content (8) + sidebar (4) split ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mt-10">
        <div class="lg:col-span-8">
            <div class="flex items-baseline gap-3 mb-6">
                <h2 class="text-lg font-extrabold tracking-tight">More Stories</h2>
                <div class="h-px flex-1 bg-[#E7E5DF]"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                @forelse($moreStories as $i => $post)
                    @include('partials.story-card', ['post' => $post])

                    @if(($i + 1) % 6 === 0)
                        <div class="sm:col-span-2 min-h-[100px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-xl text-[11px] font-mono text-[#14151A]/40">
                            AD SLOT — in-feed native
                        </div>
                    @endif
                @empty
                    <div class="sm:col-span-2 py-10 text-center">
                        <h3 class="font-bold text-lg">📢 Stay Tuned</h3>
                        <p class="text-sm text-[#14151A]/60 mt-2">Check back later for the latest tech news, reviews, and guides.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start">
            @include('partials.sidebar')
        </aside>
    </div>
</div>

@endsection