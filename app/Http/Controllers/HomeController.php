<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('homepage_data', 600, function () {
            $featured = Post::published()
                ->where('is_featured', true)
                ->with(['author', 'category'])
                ->latest('published_at')
                ->first();

            $latest = Post::published()
                ->with(['author', 'category'])
                ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
                ->latest('published_at')
                ->take(12)
                ->get();

            return compact('featured', 'latest');
        });

        return view('home', $data);
    }
}