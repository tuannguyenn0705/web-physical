<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Danh sách bài viết theo tag
     */
    public function show(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(15);

        return view('tags.show', compact('tag', 'posts'));
    }
}
