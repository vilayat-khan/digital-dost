<div style="display:grid; gap:20px;">
    <section class="card" style="padding:20px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Trending</div>
        <div style="display:grid; gap:14px; margin-top:12px;">
            @foreach(($trending ?? collect())->take(5) as $item)
                <a href="{{ route('post.show', $item->slug) }}" style="display:grid; grid-template-columns:28px 1fr; gap:12px; align-items:start;">
                    <span style="font-weight:900; color:var(--color-primary);">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span>
                        <span style="display:block; font-weight:700; line-height:1.35;">{{ $item->title }}</span>
                        <span class="muted" style="display:block; font-size:.82rem; margin-top:3px;">{{ optional($item->author)->name }} · {{ optional($item->published_at)?->format('d M Y') }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="card" style="padding:20px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Latest Reviews</div>
        <div style="display:grid; gap:12px; margin-top:12px;">
            @foreach(($latestReviews ?? collect())->take(4) as $item)
                <a href="{{ route('post.show', $item->slug) }}" style="display:block;">
                    <div style="font-weight:700; line-height:1.35;">{{ $item->title }}</div>
                    <div class="muted" style="font-size:.82rem; margin-top:3px;">{{ optional($item->author)->name }}</div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="card" style="padding:20px;">
        <div class="eyebrow" style="font-size:.72rem; color:var(--color-primary); font-weight:800;">Newsletter</div>
        <h3 style="margin:8px 0 6px; font-size:1.15rem; line-height:1.2;">Get the best tech stories</h3>
        <p class="muted" style="margin:0 0 12px;">Weekly updates on AI, gadgets, apps and buying advice.</p>

        <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:grid; gap:10px;">
            @csrf
            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
                style="height:46px; border:1px solid var(--color-border); background:var(--color-bg); border-radius:14px; padding:0 14px;"
            >
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </section>
</div>