{{-- Story Card Partial — used in "More Stories" grid (Engadget-style) --}}
<a href="{{ route('post.show', $post->slug) }}" class="group block">
    <div class="relative aspect-video bg-[#F0EEE8] rounded-xl overflow-hidden">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @endif
        @if(($post->comments_count ?? 0) > 0)
            <span class="absolute top-2 right-2 bg-[#14151A]/80 text-white text-[11px] font-mono px-2 py-0.5 rounded-full backdrop-blur-sm">
                💬 {{ $post->comments_count }}
            </span>
        @endif
    </div>
    <span class="eyebrow inline-block mt-3 text-[10px] font-semibold text-[#DC2626]">
        {{ strtoupper($post->category->name ?? 'NEWS') }}
    </span>
    <h3 class="mt-1 font-bold text-[15px] leading-snug line-clamp-2 group-hover:text-[#DC2626] transition-colors">
        {{ $post->title }}
    </h3>
    @if($post->excerpt)
        <p class="mt-1.5 text-[13px] text-[#14151A]/55 leading-relaxed line-clamp-2">{{ $post->excerpt }}</p>
    @endif
    <div class="mt-2 text-[11px] font-mono text-[#14151A]/40">
        By {{ $post->author->name ?? 'Digital Dost' }} · {{ $post->published_at?->diffForHumans() }}
    </div>
</a>