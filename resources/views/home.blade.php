@extends('layouts.site')

@section('title', 'Digital Dost — AI, Gadgets Reviews & Guides')
@section('meta_description', 'Latest tech news, mobile reviews, AI, robotics, programming guides in English.')

@section('content')
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">Latest Posts</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse($posts as $post)
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
    </div>
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection