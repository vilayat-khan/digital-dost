@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')

@section('content')
    <div class="space-y-12">

        {{-- Hero: featured + secondary --}}
        @if($featured)
            <div class="grid grid-cols-1">
                @include('partials.post-card', ['post' => $featured, 'featured' => true])
            </div>
        @endif

        {{-- Latest --}}
        <div>
            <div class="flex items-baseline gap-3 mb-5">
                <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// LATEST</span>
                <div class="h-px flex-1 bg-[#E7E5DF]"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @forelse($latest as $i => $post)
                    @include('partials.post-card', ['post' => $post])

                    {{-- Native in-feed ad slot every 4 cards --}}
                    @if(($i + 1) % 4 === 0)
                        <div class="sm:col-span-2 min-h-[120px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-xl text-[11px] font-mono text-[#14151A]/40">
                            AD SLOT — in-feed native
                        </div>
                    @endif
                @empty
                    <div class="sm:col-span-2 bg-[#F0EEE8] rounded-2xl p-6 text-center">
                        <h3 class="font-bold text-lg">📢 Stay Tuned</h3>
                        <p class="text-sm text-[#14151A]/60 mt-2">
                            Check back later for the latest tech news, reviews, and guides.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Category sections --}}
        @foreach($categories as $category)
            @if($category->posts->count())
                <div>
                    <div class="flex items-baseline gap-3 mb-5">
                        <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// {{ strtoupper($category->name) }}</span>
                        <div class="h-px flex-1 bg-[#E7E5DF]"></div>
                        <a href="{{ route('category.show', $category->slug) }}" class="text-xs font-semibold text-[#14151A]/60 hover:text-[#DC2626] whitespace-nowrap">View all →</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($category->posts as $post)
                            @include('partials.post-card', ['post' => $post])
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection