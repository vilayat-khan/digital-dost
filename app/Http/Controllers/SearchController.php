<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->get('q'));

        $posts = $query
            ? Post::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%");
                })
                ->with(['author', 'category'])
                ->latest('published_at')
                ->paginate(12)
            : collect();

        return view('search', compact('posts', 'query'));
    }
}