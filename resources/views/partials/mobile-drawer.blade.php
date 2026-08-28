<div class="mobile-drawer-overlay" data-mobile-drawer hidden>
    <aside class="mobile-drawer" aria-label="Mobile menu">
        <div class="mobile-drawer-top">
            <div class="mobile-drawer-brand">
                <strong>Digital Dost</strong>
                <span>News, reviews, guides</span>
            </div>

            <button
                type="button"
                class="icon-btn"
                data-menu-close
                aria-label="Close menu"
            >
                ✕
            </button>
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
            <section class="mobile-nav-section">
                <div class="mobile-nav-label">Main</div>

                <div class="mobile-nav-primary">
                    <a
                        href="{{ url('/') }}"
                        class="mobile-nav-link {{ request()->is('/') ? 'is-active' : '' }}"
                    >
                        <span class="mobile-nav-text">
                            <strong>Home</strong>
                            <small>Latest stories and highlights</small>
                        </span>
                        <span class="mobile-nav-arrow">→</span>
                    </a>
                </div>
            </section>

            @foreach(($topCategories ?? collect()) as $category)
                <section class="mobile-nav-section">
                    @if($category->children->count())
                        <details class="mobile-disclosure">
                            <summary class="mobile-summary">
                                <span class="mobile-nav-text">
                                    <strong>{{ $category->name }}</strong>
                                    <small>Explore {{ strtolower($category->name) }} topics</small>
                                </span>
                                <span class="mobile-chevron" aria-hidden="true">⌄</span>
                            </summary>

                            <div class="mobile-disclosure-content">
                                <a
                                    href="{{ route('category.show', $category->slug) }}"
                                    class="mobile-nav-link subtle {{ request()->routeIs('category.show') && optional(request()->route('category'))->slug === $category->slug ? 'is-active' : '' }}"
                                >
                                    <span class="mobile-nav-text">
                                        <strong>View all {{ $category->name }}</strong>
                                        <small>See every post in this category</small>
                                    </span>
                                    <span class="mobile-nav-arrow">→</span>
                                </a>

                                <div class="mobile-chip-links">
                                    @foreach($category->children as $child)
                                        <a
                                            href="{{ route('category.show', $child->slug) }}"
                                            class="{{ request()->routeIs('category.show') && optional(request()->route('category'))->slug === $child->slug ? 'is-active' : '' }}"
                                        >
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </details>
                    @else
                        <a
                            href="{{ route('category.show', $category->slug) }}"
                            class="mobile-nav-link {{ request()->routeIs('category.show') && optional(request()->route('category'))->slug === $category->slug ? 'is-active' : '' }}"
                        >
                            <span class="mobile-nav-text">
                                <strong>{{ $category->name }}</strong>
                                <small>Browse {{ strtolower($category->name) }} posts</small>
                            </span>
                            <span class="mobile-nav-arrow">→</span>
                        </a>
                    @endif
                </section>
            @endforeach
        </nav>
    </aside>
</div>