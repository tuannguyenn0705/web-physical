<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Deal;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Homepage - displays featured stories, verified AI deals, and latest 9 articles.
     */
    public function index()
    {
        $featuredPosts = Post::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(4)
            ->get();

        if ($featuredPosts->count() < 4) {
            $excludeIds = $featuredPosts->pluck('id')->all();
            $fillerPosts = Post::published()
                ->whereNotIn('id', $excludeIds)
                ->with(['category', 'author'])
                ->latest('published_at')
                ->take(4 - $featuredPosts->count())
                ->get();
            $featuredPosts = $featuredPosts->concat($fillerPosts);
        }

        $featuredDeals = Deal::active()
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->latest()
            ->take(6)
            ->get();

        $latestPosts = Post::published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(9)
            ->get();

        $categories = Category::active()
            ->root()
            ->withCount(['posts' => function ($query) {
                $query->published();
            }])
            ->orderBy('order')
            ->get();

        return view('home', compact('featuredPosts', 'featuredDeals', 'latestPosts', 'categories'));
    }
}
