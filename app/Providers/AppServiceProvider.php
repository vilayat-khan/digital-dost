<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    // public function boot(): void
    // {
    //     View::composer(['layouts.site', 'partials.sidebar', 'partials.header'], function ($view) {
    //         $shared = Cache::remember('site_shared_data', 600, function () {
    //             return [
    //                 'topCategories' => Category::whereNull('parent_id')
    //                     ->orderBy('name')
    //                     ->get(),

    //                 'trending' => Post::published()
    //                     ->with(['author', 'category'])
    //                     ->latest('published_at')
    //                     ->take(5)
    //                     ->get(),

    //                 'latestReviews' => Post::published()
    //                     ->where('type', 'review')
    //                     ->with(['author', 'category'])
    //                     ->latest('published_at')
    //                     ->take(4)
    //                     ->get(),
    //             ];
    //         });

    //         $view->with($shared);
    //     });
    // }

    public function boot(): void
    {
        View::composer(
            ['layouts.site', 'partials.header', 'partials.sidebar', 'partials.mobile-drawer'],
            function ($view) {
                $shared = Cache::remember('site_shared_data', 600, function () {
                    return [
                        'topCategories' => Category::query()
                            ->whereNull('parent_id')
                            ->orderBy('sort_order')
                            ->orderBy('name')
                            ->get(),

                        'trending' => Post::published()
                            ->with(['author', 'category'])
                            ->latest('published_at')
                            ->take(5)
                            ->get(),

                        'latestReviews' => Post::published()
                            ->where('type', 'review')
                            ->with(['author', 'category'])
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
