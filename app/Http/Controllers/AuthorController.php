<?php

namespace App\Http\Controllers;

use App\Models\AuthorProfile;
use App\Models\Post;

class AuthorController extends Controller
{
    public function show(AuthorProfile $author)
    {
        $author->loadCount([
            'posts' => fn ($q) => $q->published(),
        ]);

        $posts = Post::published()
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
            ->where('author_id', $author->id)
            ->with([
                'author:id,display_name,slug,avatar',
                'category:id,name,slug',
            ])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('author-show', [
            'author' => $author,
            'posts' => $posts,
        ]);
    }
}