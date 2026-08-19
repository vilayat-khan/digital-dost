<header class="site-header">
    <div class="container header-shell">
        <a href="{{ url('/') }}" class="brand" aria-label="Digital Dost home">
            <span class="brand-mark">DD</span>
            <span class="brand-text">Digital Dost</span>
        </a>

        <nav class="main-nav" aria-label="Primary navigation">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'is-active' : '' }}">Home</a>

            @foreach(($topCategories ?? collect()) as $category)
                <a
                    href="{{ route('category.show', $category->slug) }}"
                    class="{{ request()->routeIs('category.show') && request()->route('slug') === $category->slug ? 'is-active' : '' }}"
                >
                    {{ $category->name }}
                </a>
            @endforeach
        </nav>

        <div class="header-actions">
            <form action="{{ route('search') }}" method="GET" class="header-search" role="search">
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search articles..."
                    aria-label="Search articles"
                >
            </form>

            <button type="button" class="icon-btn" data-theme-toggle aria-label="Toggle theme">
                <span>◐</span>
            </button>

            <button type="button" class="icon-btn mobile-only" data-menu-open aria-label="Open menu">
                <span>☰</span>
            </button>
        </div>
    </div>
</header>