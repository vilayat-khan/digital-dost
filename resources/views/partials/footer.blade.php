<footer style="margin-top:48px; border-top:1px solid var(--color-border); background:var(--color-surface);">
    <div class="container" style="padding:32px 16px;">
        <div style="display:grid; gap:24px; grid-template-columns:repeat(auto-fit,minmax(180px,1fr));">
            <div>
                <div style="display:flex; align-items:center; gap:10px; font-weight:800; margin-bottom:10px;">
                    <span style="display:grid; place-items:center; width:32px; height:32px; border-radius:8px; background:var(--color-primary); color:#fff; font-size:.8rem;">DD</span>
                    <span>Digital Dost</span>
                </div>
                <p style="color:var(--color-text-muted); font-size:.95rem;">
                    Tech news, reviews, buying guides, AI aur simple Hinglish explainers.
                </p>
            </div>

            <div>
                <h4 style="margin-bottom:10px; font-size:.95rem;">Explore</h4>
                <div style="display:grid; gap:8px;">
                    <a href="{{ url('/') }}">Home</a>
                    @foreach(($topCategories ?? collect())->take(5) as $category)
                        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 style="margin-bottom:10px; font-size:.95rem;">Follow</h4>
                <div style="display:grid; gap:8px;">
                    <a href="#" target="_blank" rel="noopener noreferrer">YouTube</a>
                    <a href="#" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    <a href="#" target="_blank" rel="noopener noreferrer">Instagram</a>
                </div>
            </div>

            <div>
                <h4 style="margin-bottom:10px; font-size:.95rem;">Legal</h4>
                <div style="display:grid; gap:8px;">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>

        <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--color-border); color:var(--color-text-muted); font-size:.9rem;">
            © {{ date('Y') }} Digital Dost. All rights reserved.
        </div>
    </div>
</footer>