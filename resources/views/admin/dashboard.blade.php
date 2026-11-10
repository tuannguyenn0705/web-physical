@extends('layouts.admin')

@section('title', 'Editorial Dashboard')
@section('header_title', 'Editorial Dashboard')

@section('header_actions')
<a href="{{ route('admin.posts.create') }}" 
   class="inline-flex items-center bg-gray-950 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs hover:shadow-sm">
    Create New Article
</a>
@endsection

@section('content')
<div class="space-y-6">
    {{-- Main Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <a href="{{ route('admin.posts.index') }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Articles</p>
            <p class="text-3xl font-bold text-gray-900 mt-2 font-sans">{{ $stats['total_posts'] }}</p>
            <p class="mt-3 text-xs text-indigo-600 font-medium">
                View all articles →
            </p>
        </a>

        <a href="{{ route('admin.posts.index', ['status' => 'published']) }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Published</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2 font-sans">{{ $stats['published_posts'] }}</p>
            <p class="mt-3 text-xs text-emerald-600 font-medium">
                Live on website →
            </p>
        </a>

        <a href="{{ route('admin.posts.index', ['status' => 'draft']) }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Drafts</p>
            <p class="text-3xl font-bold text-amber-600 mt-2 font-sans">{{ $stats['draft_posts'] }}</p>
            <p class="mt-3 text-xs text-amber-600 font-medium">
                Review &amp; approve →
            </p>
        </a>

        <a href="{{ route('admin.deals.index') }}" class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-5 hover:border-gray-300 transition group block">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Affiliate Clicks</p>
            <p class="text-3xl font-bold text-rose-600 mt-2 font-sans">{{ number_format($stats['total_deal_clicks'] ?? 0) }}</p>
            <p class="mt-3 text-xs text-rose-600 font-medium">
                Managing {{ $stats['total_deals'] ?? 0 }} active deals →
            </p>
        </a>
    </div>

    {{-- 4 Content Category Shortcuts --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
        <a href="{{ route('admin.posts.index', ['type' => 'news']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-blue-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">First Looks &amp; News</p>
            <p class="text-xs text-gray-500 mt-0.5">Manage section</p>
        </a>
        <a href="{{ route('admin.posts.index', ['type' => 'review']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-amber-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">In-Depth Reviews</p>
            <p class="text-xs text-gray-500 mt-0.5">Manage section</p>
        </a>
        <a href="{{ route('admin.posts.index', ['type' => 'tutorial']) }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-purple-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Buying Guides &amp; How-To</p>
            <p class="text-xs text-gray-500 mt-0.5">Manage section</p>
        </a>
        <a href="{{ route('admin.deals.index') }}" class="bg-white p-4 rounded-xl border border-gray-200/90 hover:border-rose-400 hover:shadow-xs transition block">
            <p class="text-sm font-bold text-gray-900">Affiliate Deals</p>
            <p class="text-xs text-gray-500 mt-0.5">Manage {{ $stats['total_deals'] ?? 0 }} offers</p>
        </a>
    </div>

    {{-- Two Columns: Recent Articles & Top Affiliate Deals --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Posts --}}
        <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h2 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Recent Articles</h2>
                <a href="{{ route('admin.posts.create') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">New Article</a>
            </div>
            <div class="space-y-3">
                @forelse($recentPosts as $post)
                    <div class="flex items-center justify-between py-2.5 border-b border-gray-100 last:border-0">
                        <div class="min-w-0 pr-3">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-sm font-semibold text-gray-900 hover:text-orange-600 transition truncate block">
                                {{ $post->title }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $post->category->name ?? 'Uncategorized' }} · {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full whitespace-nowrap {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $post->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm py-4 text-center">No articles written yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Top Deals Affiliate --}}
        <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs p-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                <h2 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Top Affiliate Deals</h2>
                <a href="{{ route('admin.deals.index') }}" class="text-xs font-semibold text-orange-600 hover:text-orange-700">Manage Deals</a>
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
                    <p class="text-gray-400 text-sm py-4 text-center">No active deals yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
