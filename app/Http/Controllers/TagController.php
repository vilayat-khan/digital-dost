<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller
{
    public function show(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id))
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(12);

        return view('tag', compact('tag', 'posts'));
    }
}