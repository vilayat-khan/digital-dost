@php
    $badgeColors = [
        'article' => 'text-blue-700',
        'review' => 'text-amber-700',
        'news' => 'text-[#DC2626]',
        'buying_guide' => 'text-emerald-700',
        'tutorial' => 'text-purple-700',
        'comparison' => 'text-pink-700',
    ];
@endphp

<a href="{{ route('post.show', $post->slug) }}" class="group flex gap-4 py-4 first:pt-0">
    <div class="w-28 h-20 sm:w-36 sm:h-24 flex-shrink-0 bg-[#F0EEE8] rounded-lg overflow-hidden">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @endif
    </div>
    <div class="flex-1 min-w-0">
        <span class="eyebrow text-[10px] font-semibold {{ $badgeColors[$post->type] ?? 'text-gray-600' }}">
            {{ strtoupper(str_replace('_', ' ', $post->type)) }}
        </span>
        <h3 class="mt-1 font-bold text-[15px] sm:text-base leading-snug line-clamp-2 group-hover:text-[#DC2626] transition-colors">
            {{ $post->title }}
        </h3>
        <div class="mt-1.5 flex items-center gap-1.5 text-[11px] font-mono text-[#14151A]/45">
            <span>{{ $post->author->name ?? 'Digital Dost' }}</span>
            <span>·</span>
            <span>{{ $post->published_at?->diffForHumans() }}</span>
        </div>
    </div>
</a>