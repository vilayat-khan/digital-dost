<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = Post::published()
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
            ->whereHas('tags', fn ($query) => $query->whereKey($tag->id))
            ->with([
                'author:id,name,slug,avatar',
                'category:id,name,slug',
            ])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('tag', compact('tag', 'posts'));
    }
}