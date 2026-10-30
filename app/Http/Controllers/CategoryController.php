<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Danh sách bài viết theo danh mục
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $posts = $category->posts()
            ->published()
            ->with(['author', 'tags'])
            ->latest('published_at')
            ->paginate(15);

        return view('categories.show', compact('category', 'posts'));
    }
}
