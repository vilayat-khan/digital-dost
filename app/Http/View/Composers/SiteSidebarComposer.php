<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SiteSidebarComposer
{
    public function compose(View $view): void
    {
        $data = Cache::remember('site_shared_blocks', 600, function () {
            return [
                'topCategories' => Category::query()
                    ->whereNull('parent_id')
                    ->orderBy('name')
                    ->get(),

                'trending' => Post::published()
                    ->with(['author', 'category'])
                    ->latest('published_at')
                    ->take(5)
                    ->get(),

                'trendingHot' => Post::published()
                    ->with(['author', 'category'])
                    ->latest('published_at')
                    ->take(4)
                    ->get(),

                'latestReviews' => Post::published()
                    ->where('type', 'review')
                    ->with(['author', 'category'])
                    ->latest('published_at')
                    ->take(4)
                    ->get(),
            ];
        });

        $view->with($data);
    }
}