<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.site', function ($view) {
            $categories = Category::whereNull('parent_id')
                ->with('children')
                ->orderBy('sort_order')
                ->get();

            $view->with('navCategories', $categories)   // for dropdowns
                ->with('topCategories', $categories);  // for horizontal chips
        });
    }
}
