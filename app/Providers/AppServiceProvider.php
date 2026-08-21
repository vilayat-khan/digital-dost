<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Category::observe(CategoryObserver::class);

        View::composer(
            ['layouts.site', 'partials.header', 'partials.sidebar', 'partials.mobile-drawer'],
            function ($view) {
                $shared = Cache::remember('site_shared_data', now()->addMinutes(10), function () {
                    return [
                        'topCategories' => Category::query()
                            ->select('id', 'name', 'slug', 'parent_id', 'sort_order', 'show_on_home')
                            ->whereNull('parent_id')
                            ->where('show_on_home', 1)
                            ->with(['children' => function ($query) {
                                $query->select('id', 'name', 'slug', 'parent_id', 'sort_order')
                                    ->orderBy('sort_order')
                                    ->orderBy('name');
                            }])
                            ->orderBy('sort_order')
                            ->orderBy('name')
                            ->get(),

                        'trending' => Post::published()
                            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
                            ->with([
                                'author:id,name,slug,avatar',
                                'category:id,name,slug',
                            ])
                            ->latest('published_at')
                            ->take(5)
                            ->get(),

                        'latestReviews' => Post::published()
                            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
                            ->where('type', 'review')
                            ->with([
                                'author:id,name,slug,avatar',
                                'category:id,name,slug',
                            ])
                            ->latest('published_at')
                            ->take(4)
                            ->get(),
                    ];
                });

                $view->with($shared);
            }
        );
    }
}