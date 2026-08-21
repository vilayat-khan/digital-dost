<?php

namespace App\Providers;

use App\Http\View\Composers\SiteSidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(
            [
                'layouts.site',
                'partials.header',
                'partials.sidebar',
                'partials.mobile-drawer',
                'home',
                'post-show',
                'category',
                'tag',
                'search',
                'author',
            ],
            SiteSidebarComposer::class
        );
    }
}