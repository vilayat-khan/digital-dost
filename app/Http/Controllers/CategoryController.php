<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category->load([
            'children:id,name,slug,parent_id,sort_order',
        ]);

        $categoryIds = $category->children->pluck('id')
            ->push($category->id);

        $posts = Post::published()
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'author_id', 'category_id', 'published_at', 'type')
            ->whereIn('category_id', $categoryIds)
            ->with([
                'author:id,name,slug,avatar',
                'category:id,name,slug',
            ])
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('category', compact('category', 'posts'));
    }
}