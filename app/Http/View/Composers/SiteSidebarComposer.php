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
        $data = Cache::remember('site_shared_blocks', now()->addMinutes(10), function () {
            return [
                'topCategories' => Category::query()
                    ->select('id', 'name', 'slug', 'parent_id', 'sort_order', 'show_on_home')
                    ->whereNull('parent_id')
                    ->with([
                        'children' => function ($query) {
                            $query->select('id', 'name', 'slug', 'parent_id', 'sort_order')
                                ->orderBy('sort_order')
                                ->orderBy('name');
                        },
                    ])
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get(),

                'trending' => Post::query()
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type', 'reading_time')
                    ->with([
                        'author:id,display_name,slug,avatar',
                        'category:id,name,slug',
                    ])
                    ->latest('published_at')
                    ->take(5)
                    ->get(),

                'trendingHot' => Post::query()
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type', 'reading_time')
                    ->with([
                        'author:id,display_name,slug,avatar',
                        'category:id,name,slug',
                    ])
                    ->latest('published_at')
                    ->take(4)
                    ->get(),

                'latestReviews' => Post::query()
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->where('type', 'review')
                    ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type', 'reading_time')
                    ->with([
                        'author:id,display_name,slug,avatar',
                        'category:id,name,slug',
                    ])
                    ->latest('published_at')
                    ->take(4)
                    ->get(),
            ];
        });

        $view->with($data);
    }
}