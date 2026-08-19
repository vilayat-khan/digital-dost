<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['author', 'category', 'tags'])
            ->firstOrFail();

        $related = Post::published()
            ->with(['author', 'category'])
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('post-show', compact('post', 'related'));
    }
}