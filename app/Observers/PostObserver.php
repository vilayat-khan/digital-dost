<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public bool $afterCommit = true;

    public function saved(Post $post): void
    {
        $this->clearCaches();
    }

    public function deleted(Post $post): void
    {
        $this->clearCaches();
    }

    public function restored(Post $post): void
    {
        $this->clearCaches();
    }

    public function forceDeleted(Post $post): void
    {
        $this->clearCaches();
    }

    private function clearCaches(): void
    {
        Cache::forget('homepage_data');
        Cache::forget('site_shared_data');

        Cache::forget('home:index:v1');
        Cache::forget('site_shared_blocks');
        Cache::forget('seo:sitemap.xml:v1');
    }
}