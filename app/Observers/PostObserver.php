<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public bool $afterCommit = true;

    public function saved(Post $post): void
    {
        Cache::forget('homepage_data');
        Cache::forget('site_shared_data');
    }

    public function deleted(Post $post): void
    {
        Cache::forget('homepage_data');
        Cache::forget('site_shared_data');
    }
}