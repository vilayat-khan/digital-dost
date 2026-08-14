<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('homepage_data', 600, function () {
            $featured = Post::published()
                ->where('is_featured', true)
                ->with('author', 'category')
                ->latest('published_at')
                ->first();

            $latest = Post::published()
                ->with('author', 'category')
                ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
                ->latest('published_at')
                ->take(6)
                ->get();

            $categories = Category::with(['posts' => function ($q) {
                    $q->published()->with('author')->latest('published_at')->take(4);
                }])
                ->whereNull('parent_id')
                ->get();

            $trending = Post::published()
                ->with('author')
                ->latest('published_at')
                ->take(5)
                ->get();

            $latestReviews = Post::published()
                ->where('type', 'review')
                ->with('author')
                ->latest('published_at')
                ->take(4)
                ->get();

            $topCategories = Category::whereNull('parent_id')->get();

            return compact('featured', 'latest', 'categories', 'trending', 'latestReviews', 'topCategories');
        });

        return view('home', $data);
    }
}