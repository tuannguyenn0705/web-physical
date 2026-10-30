<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Tạo mới hoặc lấy thẻ Tag đã tồn tại (AJAX từ form bài viết)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:80',
        ]);

        $cleanName = ltrim(trim($validated['name']), '#');
        $slug = Str::slug($cleanName);

        if ($cleanName === '' || $slug === '') {
            return response()->json([
                'success' => false,
                'message' => 'Tên thẻ không hợp lệ.',
            ], 422);
        }

        $tag = Tag::firstOrCreate(
            ['slug' => $slug],
            ['name' => $cleanName]
        );

        return response()->json([
            'success' => true,
            'created' => $tag->wasRecentlyCreated,
            'tag' => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ],
        ]);
    }

    /**
     * Xóa thẻ Tag khỏi hệ thống (AJAX từ form bài viết)
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->posts()->detach();
        $tag->delete();

        return response()->json([
            'success' => true,
            'id' => $tag->id,
        ]);
    }
}
