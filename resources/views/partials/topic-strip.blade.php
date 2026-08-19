@if(($topCategories ?? collect())->count())
    <div style="border-top:1px solid var(--color-border); background:var(--color-surface);">
        <div class="container" style="display:flex; gap:10px; overflow:auto; padding:10px 16px; scrollbar-width:none;">
            @foreach($topCategories->take(8) as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                   style="white-space:nowrap; font-size:.84rem; padding:8px 12px; border-radius:999px; background:var(--color-bg); border:1px solid var(--color-border);">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
@endif