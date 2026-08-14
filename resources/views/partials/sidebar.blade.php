{{-- Trending --}}
<div class="bg-gray-50 rounded-2xl p-5">
    <h3 class="font-bold text-lg mb-3 flex items-center gap-2">🔥 Trending</h3>
    @forelse($trending as $post)
        <a href="{{ route('post.show', $post->slug) }}" class="flex gap-3 group border-b border-gray-200 py-3 last:border-0">
            <div class="w-16 h-16 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                @else
                    <div class="w-full h-full bg-gray-300 flex items-center justify-center text-xs text-gray-500">No img</div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-semibold line-clamp-2 group-hover:text-red-600">{{ $post->title }}</h4>
                <span class="text-xs text-gray-500">{{ $post->published_at->diffForHumans() }}</span>
            </div>
        </a>
    @empty
        <p class="text-sm text-gray-500">No trending posts yet.</p>
    @endforelse
</div>

{{-- Latest Reviews --}}
<div class="bg-gray-50 rounded-2xl p-5">
    <h3 class="font-bold text-lg mb-3">📝 Latest Reviews</h3>
    @forelse($latestReviews as $post)
        <a href="{{ route('post.show', $post->slug) }}" class="flex items-center gap-3 group border-b border-gray-200 py-2 last:border-0">
            <span class="text-sm font-medium text-red-600">Review</span>
            <span class="text-sm group-hover:text-red-600 line-clamp-1">{{ $post->title }}</span>
        </a>
    @empty
        <p class="text-sm text-gray-500">No reviews yet.</p>
    @endforelse
</div>

{{-- Newsletter --}}
<div class="bg-red-50 rounded-2xl p-5 text-center">
    <h3 class="font-bold text-lg">✉️ Stay Updated</h3>
    <p class="text-sm text-gray-600 mt-1">Get the latest tech news daily</p>
    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-3 flex gap-2">
        @csrf
        <input type="email" name="email" placeholder="Your email"
               class="flex-1 rounded-full px-4 py-2 text-sm border-0 focus:ring-2 focus:ring-red-500">
        <button class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-red-700">Go</button>
    </form>
</div>