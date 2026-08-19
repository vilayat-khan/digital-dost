<div class="mobile-drawer-overlay" data-mobile-drawer hidden>
    <aside class="mobile-drawer" aria-label="Mobile menu">
        <div class="mobile-drawer-top">
            <strong>Menu</strong>
            <button type="button" class="icon-btn" data-menu-close aria-label="Close menu">✕</button>
        </div>

        <form action="{{ route('search') }}" method="GET" class="mobile-search" role="search">
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search articles..."
                aria-label="Search articles"
            >
        </form>

        <nav class="mobile-nav" aria-label="Mobile navigation">
            <a href="{{ url('/') }}">Home</a>

            @foreach(($topCategories ?? collect()) as $category)
                <a href="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </nav>
    </aside>
</div>