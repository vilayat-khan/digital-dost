<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['author', 'category', 'tags'])
            ->firstOrFail();

        // Related: same category, exclude current, latest 4
        $related = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        // Sidebar data (cached, same shape as HomeController)
        $trendingHot = Cache::remember('sidebar_trending_hot', 600, function () {
            return Post::published()->with('author')->latest('published_at')->take(4)->get();
        });

        $trending = Cache::remember('sidebar_trending', 600, function () {
            return Post::published()->with('author')->latest('published_at')->take(5)->get();
        });

        $latestReviews = Cache::remember('sidebar_latest_reviews', 600, function () {
            return Post::published()->where('type', 'review')->with('author')->latest('published_at')->take(4)->get();
        });

        return view('post-show', compact('post', 'related', 'trendingHot', 'trending', 'latestReviews'));
    }
}