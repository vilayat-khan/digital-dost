<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->whereHas('tags', fn ($q) => $q->where('tags.id', $tag->id))
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('tag', compact('tag', 'posts'));
    }
}