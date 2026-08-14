@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')

@section('content')
    <div class="space-y-8">

        {{-- Featured post --}}
        @if($featured)
            <div class="mb-2">
                @include('partials.post-card', ['post' => $featured])
            </div>
        @endif

        <h1 class="text-2xl font-bold">Latest Posts</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse($latest as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="bg-gray-50 rounded-2xl p-5 col-span-full">
                    <h3 class="font-bold text-lg">📢 Stay Tuned</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Check back later for the latest tech news, reviews, and guides.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Category-wise sections --}}
        @foreach($categories as $category)
            @if($category->posts->count())
                <div>
                    <h2 class="text-xl font-bold mb-4">{{ $category->name }}</h2>
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