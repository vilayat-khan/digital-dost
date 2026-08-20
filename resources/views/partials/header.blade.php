<header class="site-header">
    <div class="container header-shell">
        <div class="header-top">
            <a href="{{ url('/') }}" class="brand" aria-label="Digital Dost home">
                <span class="brand-mark">DD</span>
                <span class="brand-text">Digital Dost</span>
            </a>

            <nav class="main-nav" aria-label="Primary navigation">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'is-active' : '' }}">Home</a>

                @foreach(($topCategories ?? collect()) as $category)
                    <div class="nav-item has-dropdown">
                        <a
                            href="{{ route('category.show', $category->slug) }}"
                            class="{{ request()->routeIs('category.show') && request()->route('slug') === $category->slug ? 'is-active' : '' }}"
                        >
                            {{ $category->name }}
                        </a>

                        @if($category->children->count())
                            <div class="nav-dropdown">
                                <a href="{{ route('category.show', $category->slug) }}" class="dropdown-parent-link">
                                    View all {{ $category->name }}
                                </a>

                                <div class="dropdown-links">
                                    @foreach($category->children as $child)
                                        <a href="{{ route('category.show', $child->slug) }}">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>

            <div class="header-actions">
                <form action="{{ route('search') }}" method="GET" class="header-search desktop-search" role="search">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search articles..." aria-label="Search articles">
                </form>

                <button type="button" class="icon-btn" data-theme-toggle aria-label="Toggle theme">
                    <span>◐</span>
                </button>

                <button type="button" class="icon-btn mobile-only" data-menu-open aria-label="Open menu">
                    <span>☰</span>
                </button>
            </div>
        </div>

        <form action="{{ route('search') }}" method="GET" class="mobile-header-search" role="search">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search articles..." aria-label="Search articles">
        </form>
    </div>
</header>