@php
    $badgeColors = [
        'article' => 'bg-blue-50 text-blue-700',
        'review' => 'bg-amber-50 text-amber-700',
        'news' => 'bg-red-50 text-red-700',
        'buying_guide' => 'bg-emerald-50 text-emerald-700',
        'tutorial' => 'bg-purple-50 text-purple-700',
        'comparison' => 'bg-pink-50 text-pink-700',
    ];
@endphp
<a href="{{ route('post.show', $post->slug) }}" class="group block bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <div class="aspect-video bg-gray-100 overflow-hidden">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @endif
    </div>
    <div class="p-5">
        <span class="text-[11px] font-bold tracking-wide px-2.5 py-1 rounded-full {{ $badgeColors[$post->type] ?? 'bg-gray-50 text-gray-700' }}">
            {{ strtoupper(str_replace('_', ' ', $post->type)) }}
        </span>
        <h3 class="mt-3 font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-red-600 transition-colors">
            {{ $post->title }}
        </h3>
        <div class="mt-3 flex items-center gap-2 text-xs text-gray-500">
            <div class="w-5 h-5 rounded-full bg-gray-200 flex items-center justify-center text-[9px] font-bold text-gray-600">
                {{ strtoupper(substr($post->author->name ?? 'D', 0, 1)) }}
            </div>
            <span>{{ $post->author->name ?? 'Digital Dost' }}</span>
            <span class="text-gray-300">&middot;</span>
            <span>{{ $post->published_at?->diffForHumans() }}</span>
        </div>
    </div>
</a>