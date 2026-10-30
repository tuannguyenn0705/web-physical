@extends('layouts.admin')

@section('title', 'Bảng Điều Khiển')
@section('header_title', 'Bảng Điều Khiển')

@section('header_actions')
<a href="{{ route('admin.posts.create') }}" 
   class="inline-flex items-center bg-gray-950 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs hover:shadow-sm">
    Viết bài mới
</a>
@endsection

@section('content')
<div class="space-y-6">
    {{-- Thẻ thống kê chính (Sạch sẽ, số to rõ ràng, không icon rối mắt) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <a href="{{ route('admin.posts.index') }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tổng Bài Viết</p>
            <p class="text-3xl font-bold text-gray-900 mt-2 font-sans">{{ $stats['total_posts'] }}</p>
            <p class="mt-3 text-xs text-indigo-600 font-medium">
                Xem tất cả bài viết →
            </p>
        </a>

        <a href="{{ route('admin.posts.index', ['status' => 'published']) }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Đã Xuất Bản</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2 font-sans">{{ $stats['published_posts'] }}</p>
            <p class="mt-3 text-xs text-emerald-600 font-medium">
                Hiển thị trên Client →
            </p>
        </a>

        <a href="{{ route('admin.posts.index', ['status' => 'draft']) }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Bản Nháp</p>
            <p class="text-3xl font-bold text-amber-600 mt-2 font-sans">{{ $stats['draft_posts'] }}</p>
            <p class="mt-3 text-xs text-amber-600 font-medium">
                Chờ duyệt & đăng →
            </p>
        </a>

        <a href="{{ route('admin.deals.index') }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tổng Lượt Click Deals</p>
            <p class="text-3xl font-bold text-rose-600 mt-2 font-sans">{{ number_format($stats['total_deal_clicks'] ?? 0) }}</p>
            <p class="mt-3 text-xs text-rose-600 font-medium">
                {{ $stats['total_deals'] ?? 0 }} Deals đang quản lý →
            </p>
        </a>
    </div>

    {{-- 4 Phân loại nhanh (Dạng khối tối giản, không emoji) --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
        <a href="{{ route('admin.posts.index', ['type' => 'news']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-blue-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Tin Tức AI</p>
            <p class="text-xs text-gray-500 mt-0.5">Quản lý chuyên mục</p>
        </a>
        <a href="{{ route('admin.posts.index', ['type' => 'review']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-amber-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Đánh Giá (Review)</p>
            <p class="text-xs text-gray-500 mt-0.5">Quản lý chuyên mục</p>
        </a>
        <a href="{{ route('admin.posts.index', ['type' => 'tutorial']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-purple-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Hướng Dẫn (Tutorial)</p>
            <p class="text-xs text-gray-500 mt-0.5">Quản lý chuyên mục</p>
        </a>
        <a href="{{ route('admin.deals.index') }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-rose-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Deals (Affiliate)</p>
            <p class="text-xs text-gray-500 mt-0.5">Quản lý {{ $stats['total_deals'] ?? 0 }} ưu đãi</p>
        </a>
    </div>

    {{-- Hai cột: Bài viết gần đây & Top Deals Affiliate --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Posts --}}
        <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h2 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Bài viết gần đây</h2>
                <a href="{{ route('admin.posts.create') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">Tạo mới</a>
            </div>
            <div class="space-y-3">
                @forelse($recentPosts as $post)
                    <div class="flex items-center justify-between py-2.5 border-b border-gray-100 last:border-0">
                        <div class="min-w-0 pr-3">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-sm font-semibold text-gray-900 hover:text-orange-600 transition truncate block">
                                {{ $post->title }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $post->category->name ?? 'Chưa phân loại' }} · {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full whitespace-nowrap {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $post->status === 'published' ? 'Xuất bản' : 'Bản nháp' }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm py-4 text-center">Chưa có bài viết nào.</p>
                @endforelse
            </div>
        </div>

        {{-- Top Deals Affiliate --}}
        <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h2 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Top Deals Affiliate</h2>
                <a href="{{ route('admin.deals.index') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">Quản lý Deals</a>
            </div>
            <div class="space-y-3">
                @forelse($topDeals as $deal)
                    <div class="flex items-center justify-between py-2.5 border-b border-gray-100 last:border-0">
                        <div class="min-w-0 pr-3">
                            <a href="{{ route('admin.deals.edit', $deal) }}" class="text-sm font-semibold text-gray-900 hover:text-orange-600 transition truncate block">
                                {{ $deal->title }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5 truncate">
                                {{ $deal->affiliate_url }}
                            </p>
                        </div>
                        <span class="px-2.5 py-0.5 text-xs font-mono font-bold rounded-full whitespace-nowrap bg-rose-50 text-rose-700">
                            {{ number_format($deal->clicks_count ?? 0) }} clicks
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm py-4 text-center">Chưa có Deal nào.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
