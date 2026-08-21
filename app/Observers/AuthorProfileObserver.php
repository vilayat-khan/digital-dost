<?php

namespace App\Observers;

use App\Models\AuthorProfile;
use Illuminate\Support\Facades\Cache;

class AuthorProfileObserver
{
    public bool $afterCommit = true;

    public function saved(AuthorProfile $authorProfile): void
    {
        $this->clearCaches();
    }

    public function deleted(AuthorProfile $authorProfile): void
    {
        $this->clearCaches();
    }

    public function restored(AuthorProfile $authorProfile): void
    {
        $this->clearCaches();
    }

    public function forceDeleted(AuthorProfile $authorProfile): void
    {
        $this->clearCaches();
    }

    private function clearCaches(): void
    {
        Cache::forget('seo:sitemap.xml:v1');
    }
}