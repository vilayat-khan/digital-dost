<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SiteSidebarComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(
            ['layouts.site', 'partials.header', 'partials.sidebar', 'home', 'post-show', 'category', 'tag', 'search'],
            SiteSidebarComposer::class
        );
    }
}