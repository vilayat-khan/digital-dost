<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::with('children')->where('slug', $slug)->firstOrFail();

        $categoryIds = $category->children->pluck('id')->push($category->id);

        $posts = Post::published()
            ->whereIn('category_id', $categoryIds)
            ->with(['author.authorProfile', 'category'])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('category', compact('category', 'posts'));
    }
}