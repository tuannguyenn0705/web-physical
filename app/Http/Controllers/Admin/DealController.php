<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DealController extends Controller
{
    /**
     * Danh sách các Deals trong trang quản trị
     */
    public function index(Request $request): View
    {
        $query = Deal::query();

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('affiliate_url', 'like', "%{$search}%");
            });
        }

        $deals = $query->orderBy('order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'all' => Deal::count(),
            'active' => Deal::where('is_active', true)->count(),
            'inactive' => Deal::where('is_active', false)->count(),
        ];

        return view('admin.deals.index', compact('deals', 'counts'));
    }

    /**
     * Form tạo Deal mới
     */
    public function create(): View
    {
        return view('admin.deals.create');
    }

    /**
     * Lưu Deal mới vào cơ sở dữ liệu
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'affiliate_url' => 'required|url|max:1000',
            'coupon_code' => 'nullable|string|max:60',
            'badge_text' => 'nullable|string|max:50',
            'sub_badge_text' => 'nullable|string|max:80',
            'button_text' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['coupon_code'] = trim((string) ($validated['coupon_code'] ?? '')) ?: null;
        $validated['badge_text'] = trim((string) ($validated['badge_text'] ?? '')) ?: 'Deal';
        $validated['sub_badge_text'] = trim((string) ($validated['sub_badge_text'] ?? '')) ?: 'DISCOUNT DEAL';
        $validated['button_text'] = trim((string) ($validated['button_text'] ?? '')) ?: 'Shop Now';
        $validated['order'] = (int) ($validated['order'] ?? 0);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->has('is_featured') ? $request->boolean('is_featured') : true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('deals', 'public');
        }

        Deal::create($validated);

        return redirect()->route('admin.deals.index')
            ->with('success', 'Deal mới đã được tạo và hiển thị thành công!');
    }

    /**
     * Form chỉnh sửa Deal
     */
    public function edit(Deal $deal): View
    {
        return view('admin.deals.edit', compact('deal'));
    }

    /**
     * Cập nhật thông tin Deal
     */
    public function update(Request $request, Deal $deal): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'affiliate_url' => 'required|url|max:1000',
            'coupon_code' => 'nullable|string|max:60',
            'badge_text' => 'nullable|string|max:50',
            'sub_badge_text' => 'nullable|string|max:80',
            'button_text' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['coupon_code'] = trim((string) ($validated['coupon_code'] ?? '')) ?: null;
        $validated['badge_text'] = trim((string) ($validated['badge_text'] ?? '')) ?: 'Deal';
        $validated['sub_badge_text'] = trim((string) ($validated['sub_badge_text'] ?? '')) ?: 'DISCOUNT DEAL';
        $validated['button_text'] = trim((string) ($validated['button_text'] ?? '')) ?: 'Shop Now';
        $validated['order'] = (int) ($validated['order'] ?? 0);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->has('is_featured') ? $request->boolean('is_featured') : $deal->is_featured;

        if ($request->hasFile('image')) {
            if ($deal->image && ! str_starts_with($deal->image, 'http') && ! str_starts_with($deal->image, '/')) {
                Storage::disk('public')->delete($deal->image);
            }
            $validated['image'] = $request->file('image')->store('deals', 'public');
        }

        $deal->update($validated);

        return redirect()->route('admin.deals.index')
            ->with('success', 'Thông tin Deal đã được cập nhật thành công!');
    }

    /**
     * Xóa Deal khỏi hệ thống
     */
    public function destroy(Deal $deal): RedirectResponse
    {
        if ($deal->image && ! str_starts_with($deal->image, 'http') && ! str_starts_with($deal->image, '/')) {
            Storage::disk('public')->delete($deal->image);
        }

        $deal->delete();

        return redirect()->route('admin.deals.index')
            ->with('success', 'Deal đã được xóa khỏi hệ thống!');
    }
}
