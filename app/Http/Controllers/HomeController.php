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
            // 1. Hero featured (you can keep a single one, or turn into slider)
            $featured = Post::published()
                ->where('is_featured', true)
                ->with('author', 'category')
                ->latest('published_at')
                ->first();

            // 2. Latest posts (exclude featured)
            $latest = Post::published()
                ->with('author', 'category')
                ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
                ->latest('published_at')
                ->take(6)  // we'll show 6 in grid
                ->get();

            // 3. Category sections (4 posts each)
            $categories = Category::where('show_on_home', true)
                ->with(['posts' => function ($q) {
                    $q->published()->with('author')->latest('published_at')->take(4);
                }])
                ->get();

            // 4. Trending (requires a `views` column)
            $trending = Post::published()
                ->with('author')
                ->orderBy('views', 'desc')
                ->take(5)
                ->get();

            // 5. Latest reviews (for sidebar)
            $latestReviews = Post::published()
                ->where('type', 'review')
                ->with('author')
                ->latest('published_at')
                ->take(4)
                ->get();

            // 6. Top categories for the horizontal scroll
            $topCategories = Category::whereNull('parent_id')->get();

            return compact('featured', 'latest', 'categories', 'trending', 'latestReviews', 'topCategories');
        });

        return view('home', $data);
    }
}