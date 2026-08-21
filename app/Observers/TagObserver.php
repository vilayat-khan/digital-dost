<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class TagObserver
{
    public bool $afterCommit = true;

    public function saved(Tag $tag): void
    {
        $this->clearCaches();
    }

    public function deleted(Tag $tag): void
    {
        $this->clearCaches();
    }

    public function restored(Tag $tag): void
    {
        $this->clearCaches();
    }

    public function forceDeleted(Tag $tag): void
    {
        $this->clearCaches();
    }

    private function clearCaches(): void
    {
        Cache::forget('seo:sitemap.xml:v1');
    }
}