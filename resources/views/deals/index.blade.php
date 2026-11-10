@extends('layouts.app')

@section('title', 'Daily Hardware Deals, Price Drops & Promo Codes')
@section('meta_description', 'Discover verified discounts, promo codes, and historic low prices on top-rated headphones, keyboards, smart home gear, and workspace essentials.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">

    {{-- Hero Deal Banner --}}
    <div class="bg-slate-900 text-white rounded-3xl p-6 sm:p-10 mb-8 border border-slate-800 shadow-xl relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-72 h-72 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 font-mono text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Live Price Tracker • Synced Every 30 Minutes</span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                    Verified Hardware Deals & Exclusive Promo Codes
                </h1>
                <p class="text-slate-300 text-sm sm:text-base mt-2 max-w-2xl">
                    Hand-picked retail price drops across Amazon, Best Buy, Walmart, and B&H Photo, vetted against 90-day price history by the VerdictTC deals desk.
                </p>
            </div>

            {{-- Search Deals Form --}}
            <form action="{{ route('deals.index') }}" method="GET" class="w-full lg:w-80 relative shrink-0">
                @if(request('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search headphones, chargers, deals..."
                       class="w-full bg-slate-950/90 border border-slate-700 rounded-2xl py-3 pl-4 pr-24 text-sm text-white placeholder-slate-400 focus:outline-none focus:border-amber-400">
                <button type="submit"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-extrabold rounded-xl transition cursor-pointer">
                    Search
                </button>
            </form>
        </div>
    </div>

    {{-- Filter Tabs & FTC Transparency Strip --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-5 border-b border-slate-200/80">
        <div class="flex flex-wrap items-center gap-2">
            @php
                $dealFilters = [
                    null => 'All Deals',
                    'featured' => 'Featured Offers',
                    'coupon' => 'Promo Codes',
                ];
            @endphp
            @foreach($dealFilters as $key => $label)
                @php
                    $isActive = (request('filter') === $key) || ($key === null && !request('filter'));
                @endphp
                <a href="{{ route('deals.index', array_filter(['filter' => $key, 'search' => request('search')])) }}"
                   class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold transition {{ $isActive ? 'bg-slate-900 text-white shadow-xs' : 'bg-white text-slate-700 border border-slate-200 hover:border-slate-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <p class="text-xs text-slate-500">
            Partner offers are verified daily •
            <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="text-slate-800 font-bold underline hover:text-amber-600">Affiliate Disclosure</a>
        </p>
    </div>

    @if(request('search'))
        <div class="mb-6 flex items-center justify-between bg-white px-5 py-3.5 rounded-2xl border border-slate-200/90 text-sm text-slate-600">
            <span>Search results for: <strong class="text-slate-900">"{{ request('search') }}"</strong> ({{ $deals->total() }} deals)</span>
            <a href="{{ route('deals.index', array_filter(['filter' => request('filter')])) }}" class="text-xs font-bold text-rose-600 hover:underline">Clear search</a>
        </div>
    @endif

    {{-- Deals Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($deals as $deal)
            @include('deals._card', ['deal' => $deal])
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200/80 text-slate-500">
                <p class="text-lg font-extrabold text-slate-800">No active deals found matching your criteria.</p>
                <p class="text-sm text-slate-400 mt-1">Try clearing your filter or check back soon for new verified hardware discounts.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $deals->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
