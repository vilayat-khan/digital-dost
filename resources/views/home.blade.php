<!-- Home Page -->
@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')

@section('content')
    <div class="space-y-10">

        {{-- Hero: featured --}}
        @if($featured)
            @include('partials.post-card', ['post' => $featured, 'featured' => true])
        @endif

        {{-- Dense news stream --}}
        <div>
            <div class="flex items-baseline gap-3 mb-4">
                <span class="eyebrow text-[11px] text-[#DC2626] font-semibold">// LATEST NEWS</span>
                <div class="h-px flex-1 bg-[#E7E5DF]"></div>
            </div>

            <div class="divide-y divide-[#E7E5DF]">
                @forelse($latest as $i => $post)
                    @include('partials.post-row', ['post' => $post])

                    @if(($i + 1) % 6 === 0)
                        <div class="!border-t-0 py-4">
                            <div class="min-h-[100px] flex items-center justify-center bg-[#F0EEE8] border border-dashed border-[#D8D5CC] rounded-xl text-[11px] font-mono text-[#14151A]/40">
                                AD SLOT — in-feed native
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="py-6 text-center">
                        <h3 class="font-bold text-lg">📢 Stay Tuned</h3>
                        <p class="text-sm text-[#14151A]/60 mt-2">Check back later for the latest tech news, reviews, and guides.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection