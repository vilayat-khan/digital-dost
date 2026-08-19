<a href="{{ route('post.show', $post->slug) }}" class="card" style="display:block; overflow:hidden;">
    <div style="aspect-ratio:16/10; background:var(--color-surface-2);">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 style="width:100%; height:100%; object-fit:cover;">
        @endif
    </div>
    <div style="padding:16px;">
        <div class="eyebrow" style="font-size:.7rem; color:var(--color-primary); font-weight:800;">
            {{ strtoupper(optional($post->category)->name ?? 'Article') }}
        </div>
        <h3 style="margin:8px 0 6px; font-size:1.08rem; line-height:1.25; letter-spacing:-.02em;">{{ $post->title }}</h3>
        @if($post->excerpt)
            <p class="muted" style="font-size:.95rem; margin:0;">{{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</p>
        @endif
    </div>
</a>