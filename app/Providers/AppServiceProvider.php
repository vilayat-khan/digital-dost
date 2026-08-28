<?php

namespace App\Providers;

use App\Models\AuthorProfile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Observers\AuthorProfileObserver;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use App\Observers\TagObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        Tag::observe(TagObserver::class);
        AuthorProfile::observe(AuthorProfileObserver::class);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}