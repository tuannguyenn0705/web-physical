<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Trang Dashboard Admin
     */
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'total_deals' => Deal::count(),
            'total_deal_clicks' => (int) Deal::sum('clicks_count'),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
        ];

        $recentPosts = Post::with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();

        $topDeals = Deal::orderByDesc('clicks_count')
            ->orderBy('order')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'topDeals'));
    }
}
