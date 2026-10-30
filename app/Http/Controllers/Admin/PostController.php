<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author']);

        // Lọc theo loại bài viết
        if ($request->filled('type') && in_array($request->type, ['news', 'review', 'tutorial'])) {
            $query->where('type', $request->type);
        }

        // Lọc theo trạng thái
        if ($request->filled('status') && in_array($request->status, ['draft', 'published', 'archived'])) {
            $query->where('status', $request->status);
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Tìm kiếm theo tiêu đề
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest()->paginate(15)->withQueryString();

        $categories = Category::active()->orderBy('name')->get();

        $typeCounts = [
            'all' => Post::count(),
            'news' => Post::where('type', 'news')->count(),
            'review' => Post::where('type', 'review')->count(),
            'tutorial' => Post::where('type', 'tutorial')->count(),
        ];

        return view('admin.posts.index', compact('posts', 'categories', 'typeCounts'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:news,review,tutorial',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $baseSlug = Str::slug($validated['title']) ?: 'post-'.time();
        $slug = $baseSlug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;
        $validated['user_id'] = auth()->id() ?? 1;
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $post = Post::create($validated);

        if ($request->filled('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Bài viết đã được tạo và lưu thành công!');
    }

    public function edit(Post $post)
    {
        $post->load(['category', 'tags']);
        $categories = Category::active()->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:news,review,tutorial',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($post->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']) ?: 'post-'.time();
            $slug = $baseSlug;
            $counter = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && ! $post->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags ?? []);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Bài viết đã được xóa thành công khỏi hệ thống!');
    }

    /**
     * Tải lên hình ảnh chèn vào nội dung bài viết từ trình soạn thảo (WYSIWYG)
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $path = $request->file('image')->store('posts/content', 'public');
        $url = asset('storage/'.$path);

        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }
}
