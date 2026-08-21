<a href="{{ route('post.show', $post->slug) }}" class="group flex gap-4 rounded-[24px] p-3 hover:bg-white hover:shadow-sm transition duration-300">
    <div class="w-28 h-24 sm:w-36 sm:h-28 rounded-[20px] bg-slate-100 overflow-hidden flex-shrink-0">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @endif
    </div>
    <div class="min-w-0 flex-1">
        <div class="text-[11px] font-mono uppercase tracking-[0.18em] text-red-600">{{ strtoupper(optional($post->category)->name ?? $post->type ?? 'News') }}</div>
        <h3 class="mt-2 text-[15px] sm:text-[17px] font-bold leading-snug text-slate-950 group-hover:text-red-600 transition line-clamp-2">{{ $post->title }}</h3>
        @if($post->excerpt)
            <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $post->excerpt }}</p>
        @endif
        <div class="mt-3 text-[11px] font-mono uppercase tracking-[0.14em] text-slate-400">{{ optional($post->author)->display_name ?? 'Digital Dost' }} · {{ $post->published_at?->diffForHumans() }}</div>
    </div>
</a>
