<a href="{{ route('post.show', $post->slug) }}" style="display:block;">
    <div style="aspect-ratio:16/10; background:var(--color-surface-2); border-radius:18px; overflow:hidden; border:1px solid var(--color-border);">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 style="width:100%; height:100%; object-fit:cover;">
        @endif
    </div>
    <div style="margin-top:12px;">
        <div class="eyebrow" style="font-size:.7rem; color:var(--color-primary); font-weight:800;">
            {{ strtoupper(optional($post->category)->name ?? 'Story') }}
        </div>
        <h3 style="margin:8px 0 6px; font-size:1.04rem; line-height:1.32;">{{ $post->title }}</h3>
        <div class="muted" style="font-size:.84rem;">By {{ optional($post->author)->name ?? 'Digital Dost' }}</div>
    </div>
</a>