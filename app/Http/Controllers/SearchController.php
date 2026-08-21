<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->get('q'));

        if ($query !== '') {
            $posts = Post::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%")
                        ->orWhere('body', 'like', "%{$query}%");
                })
                ->with([
                    'author:id,display_name,slug,avatar',
                    'category:id,name,slug',
                ])
                ->latest('published_at')
                ->paginate(12)
                ->withQueryString();
        } else {
            $posts = new LengthAwarePaginator([], 0, 12);
        }

        return view('search', compact('posts', 'query'));
    }
}