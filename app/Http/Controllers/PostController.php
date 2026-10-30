<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Danh sách bài viết
     */
    public function index(Request $request)
    {
        $query = Post::published()->with(['category', 'author', 'tags']);

        // Lọc theo loại bài viết
        if ($request->filled('type') && in_array($request->type, ['news', 'review', 'tutorial'])) {
            $query->ofType($request->type);
        }

        // Tìm kiếm
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(15)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    /**
     * Chi tiết bài viết
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->with(['category', 'author', 'tags'])
            ->firstOrFail();

        // Tăng lượt xem
        $post->incrementViews();

        // Bài viết liên quan (ưu tiên cùng danh mục, lấy 3 bài cho lưới 3 cột)
        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $excludeIds = $relatedPosts->pluck('id')->push($post->id)->all();
            $morePosts = Post::published()
                ->whereNotIn('id', $excludeIds)
                ->with(['category', 'author'])
                ->latest('published_at')
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($morePosts);
        }

        // Top Deals cho Sidebar & In-article Callout
        $sidebarDeals = Deal::active()
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->latest()
            ->take(3)
            ->get();

        // Bài viết đọc nhiều nhất cho Sidebar
        $trendingPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->with('category')
            ->orderByDesc('views_count')
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts', 'sidebarDeals', 'trendingPosts'));
    }
}
