<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public bool $afterCommit = true;

    public function saved(Category $category): void
    {
        $this->clearCaches();
    }

    public function deleted(Category $category): void
    {
        $this->clearCaches();
    }

    public function restored(Category $category): void
    {
        $this->clearCaches();
    }

    public function forceDeleted(Category $category): void
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