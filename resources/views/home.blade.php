@extends('layouts.site')

@section('content')
    @if($featured)
        <a href="{{ route('post.show', $featured->slug) }}" class="group block bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 mb-14">
            <div class="grid md:grid-cols-2">
                <div class="aspect-video md:aspect-auto bg-gray-100 overflow-hidden">
                    @if($featured->featured_image)
                        <img src="{{ Storage::url($featured->featured_image) }}" alt="{{ $featured->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
                <div class="p-8 md:p-10 flex flex-col justify-center">
                    <span class="text-xs font-bold tracking-wide text-red-600 uppercase">{{ $featured->category->name }}</span>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight group-hover:text-red-600 transition-colors">
                        {{ $featured->title }}
                    </h1>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $featured->excerpt }}</p>
                    <div class="mt-6 flex items-center gap-2 text-sm text-gray-500">
                        <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-[10px] font-bold text-gray-600">
                            {{ strtoupper(substr($featured->author->name ?? 'D', 0, 1)) }}
                        </div>
                        <span>{{ $featured->author->name ?? 'Digital Dost' }}</span>
                        <span class="text-gray-300">&middot;</span>
                        <span>{{ $featured->published_at?->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </a>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-extrabold tracking-tight">Latest</h2>
        <div class="h-1 w-16 bg-red-600 rounded-full"></div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($latest as $post)
            @include('partials.post-card', ['post' => $post])
        @empty
            <p class="text-gray-500 col-span-full">No posts yet. Publish your first one from /admin.</p>
        @endforelse
    </div>
@endsection