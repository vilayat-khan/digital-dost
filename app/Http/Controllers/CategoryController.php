<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(12);

        $topCategories = Category::whereNull('parent_id')->get();

        return view('category', compact('category', 'posts', 'topCategories'));
    }
}