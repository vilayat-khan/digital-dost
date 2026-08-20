<?php

namespace App\Http\Controllers;

use App\Models\AuthorProfile;
use App\Models\Post;

class AuthorController extends Controller
{
    public function show(AuthorProfile $authorProfile)
    {
        $posts = Post::with(['category', 'author'])
            ->where('author_id', $authorProfile->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(12);

        return view('author-show', [
            'author' => $authorProfile,
            'posts' => $posts,
        ]);
    }
}