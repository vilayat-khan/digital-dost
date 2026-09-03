<footer style="margin-top:48px; border-top:1px solid var(--color-border); background:var(--color-surface);">
    <div class="container" style="padding:32px 16px;">
        <div style="display:grid; gap:24px; grid-template-columns:repeat(auto-fit,minmax(180px,1fr));">
            <div>
                <div style="display:flex; align-items:center; gap:10px; font-weight:800; margin-bottom:10px;">
                    <span style="display:grid; place-items:center; width:32px; height:32px; border-radius:8px; background:var(--color-primary); color:#fff; font-size:.8rem;">DD</span>
                    <span>Digital Dost</span>
                </div>
                <p style="color:var(--color-text-muted); font-size:.95rem;">
                    Tech news, reviews, buying guides, AI aur simple English explainers.
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
                    <a href="https://www.youtube.com/@HeyDigitalDost" target="_blank" rel="noopener noreferrer">YouTube</a>
                    <a href="https://whatsapp.com/channel/0029Vb8S7jRGU3BH4gF7GE3u" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    <a href="https://instagram.com/digitaldost.hq" target="_blank" rel="noopener noreferrer">Instagram</a>
                </div>
            </div>

            <div>
                <div style="font-weight:700; margin-bottom:12px;">Company</div>
                <div style="display:grid; gap:8px;">
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('editorial') }}">Editorial Policy</a>
                </div>
            </div>

            <div>
                <div style="font-weight:700; margin-bottom:12px;">Legal</div>
                <div style="display:grid; gap:8px;">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('terms') }}">Terms of Use</a>
                    <a href="{{ route('disclaimer') }}">Disclaimer</a>
                    <a href="{{ route('cookies') }}">Cookie Policy</a>
                    <a href="{{ route('affiliate') }}">Affiliate Disclosure</a>
                </div>
            </div>
            
        </div>

        <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--color-border); color:var(--color-text-muted); font-size:.9rem;">
            © {{ date('Y') }} Digital Dost. All rights reserved.
        </div>
    </div>
</footer>