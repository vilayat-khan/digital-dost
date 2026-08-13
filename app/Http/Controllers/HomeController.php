<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Post::published()->with('author', 'category')->latest('published_at')->first();

        $latest = Post::published()
            ->with('author', 'category')
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->take(9)
            ->get();

        return view('home', compact('featured', 'latest'));
    }
}

