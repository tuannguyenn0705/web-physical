@extends('layouts.app')

@section('title', 'Product Reviews & Buying Guides' . (request('type') ? ' — ' . ucfirst(request('type')) : ''))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

    {{-- Page Header Banner --}}
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 mb-8 shadow-2xs">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-900 font-mono text-[11px] font-bold uppercase tracking-wider mb-3">
                    <span>Verdict Lab Archive</span>
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    @if(request('type'))
                        @switch(request('type'))
                            @case('news') Unboxing & First Look Hardware News @break
                            @case('review') In-Depth Product Lab Reviews @break
                            @case('tutorial') Expert Buying Guides & Comparisons @break
                        @endswitch
                    @elseif(request('search'))
                        Search results for: "{{ request('search') }}"
                    @else
                        All Product Reviews & Buying Guides
                    @endif
                </h1>
                <p class="text-sm sm:text-base text-slate-500 mt-2 max-w-2xl">
                    Explore our complete library of hands-on hardware stress tests, objective lab telemetry, and ranked buying recommendations for every budget.
                </p>
            </div>

            {{-- Filter Tabs --}}
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition {{ !request('type') ? 'bg-slate-900 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    All
                </a>
                @foreach(['review' => 'Lab Reviews', 'tutorial' => 'Buying Guides', 'news' => 'First Looks'] as $type => $label)
                    <a href="{{ route('posts.index', ['type' => $type]) }}"
                       class="px-4 py-2.5 rounded-xl text-xs font-extrabold transition {{ request('type') === $type ? 'bg-amber-500 text-slate-950 shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Product Review Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($posts as $post)
            <x-product-review-card :post="$post" />
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200/80 text-slate-500">
                <p class="text-lg font-extrabold text-slate-800">No product reviews found matching your search.</p>
                <p class="text-sm text-slate-400 mt-1">Try searching for a different brand or browse all categories.</p>
                <a href="{{ route('posts.index') }}" class="mt-4 inline-flex px-5 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold">
                    View All Reviews
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
