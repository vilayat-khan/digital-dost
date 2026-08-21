<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('home:index:v1', now()->addMinutes(10), function () {
            $featured = Post::published()
                ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type', 'reading_time')
                ->with([
                    'author:id,display_name,slug,avatar',
                    'category:id,name,slug',
                ])
                ->where('is_featured', true)
                ->latest('published_at')
                ->first();

            $latest = Post::published()
                ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type', 'reading_time')
                ->with([
                    'author:id,display_name,slug,avatar',
                    'category:id,name,slug',
                ])
                ->when($featured, fn ($q) => $q->whereKeyNot($featured->id))
                ->latest('published_at')
                ->take(12)
                ->get();

            return [
                'featured' => $featured,
                'latest' => $latest,
            ];
        });

        return view('home', $data);
    }
}