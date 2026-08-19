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

        <!-- <nav class="mobile-nav" aria-label="Mobile navigation">
            <a href="{{ url('/') }}">Home</a>

            @foreach(($topCategories ?? collect()) as $category)
                <a href="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </nav> -->

        <div class="mobile-menu">
            <a href="{{ url('/') }}">Home</a>

            @foreach(($topCategories ?? collect()) as $category)
                @if($category->children->count())
                    <details>
                        <summary>{{ $category->name }}</summary>
                        <div class="mobile-submenu">
                            <a href="{{ route('category.show', $category->slug) }}">View all {{ $category->name }}</a>

                            @foreach($category->children as $child)
                                <a href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    </details>
                @else
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endif
            @endforeach
        </div>
    </aside>
</div>