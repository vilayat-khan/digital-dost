<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public bool $afterCommit = true;

    public function saved(Category $category): void
    {
        Cache::forget('site_shared_data');
    }

    public function deleted(Category $category): void
    {
        Cache::forget('site_shared_data');
    }
}