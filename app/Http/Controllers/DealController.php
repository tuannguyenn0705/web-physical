<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DealController extends Controller
{
    /**
     * Danh sách các Deals / Affiliate ưu đãi AI trên trang Client
     */
    public function index(Request $request): View
    {
        $query = Deal::active();

        if ($request->filled('filter')) {
            if ($request->filter === 'featured') {
                $query->where('is_featured', true);
            } elseif ($request->filter === 'coupon') {
                $query->whereNotNull('coupon_code')->where('coupon_code', '!=', '');
            }
        }

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('coupon_code', 'like', "%{$search}%");
            });
        }

        $deals = $query->orderBy('order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('deals.index', compact('deals'));
    }

    /**
     * Ghi nhận lượt click vào Deal Affiliate và chuyển hướng sang link đối tác
     */
    public function go(Deal $deal): RedirectResponse
    {
        $deal->increment('clicks_count');

        return redirect()->away($deal->affiliate_url);
    }
}
