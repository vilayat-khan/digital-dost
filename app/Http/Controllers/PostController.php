<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        abort_unless(
            $post->status === 'published' &&
            $post->published_at &&
            $post->published_at->lte(now()),
            404
        );

        $post->loadMissing([
            'author:id,name,slug,avatar,bio',
            'category:id,name,slug',
            'tags:id,name,slug',
        ]);

        $related = Post::published()
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
            ->with([
                'author:id,name,slug,avatar',
                'category:id,name,slug',
            ])
            ->where('category_id', $post->category_id)
            ->whereKeyNot($post->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        if ($related->count() < 4) {
            $extra = Post::published()
                ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
                ->with([
                    'author:id,name,slug,avatar',
                    'category:id,name,slug',
                ])
                ->whereKeyNot($post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->latest('published_at')
                ->take(4 - $related->count())
                ->get();

            $related = $related->concat($extra);
        }

        return view('post-show', compact('post', 'related'));
    }
}