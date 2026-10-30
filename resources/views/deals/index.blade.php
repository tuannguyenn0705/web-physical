@extends('layouts.app')

@section('title', 'Hot AI Deals & Discounts')
@section('meta_description', 'Discover the best promo codes, discounts, and exclusive deals on top AI tools and software.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
    {{-- Page Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">AI Deals & Exclusive Offers</h1>
            <p class="text-gray-500 text-sm sm:text-base mt-1.5">
                Verified discounts, promo codes, and partner deals on leading AI software and developer tools.
            </p>
        </div>

        {{-- Search Deals --}}
        <form action="{{ route('deals.index') }}" method="GET" class="w-full md:w-80 relative">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search AI tool deals..."
                   class="w-full bg-white border border-gray-200 rounded-xl py-2.5 pl-4 pr-20 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-900 shadow-2xs">
            <button type="submit"
                    class="absolute right-1.5 top-1/2 -translate-y-1/2 px-3.5 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold rounded-lg transition cursor-pointer">
                Search
            </button>
        </form>
    </div>

    {{-- Filter Tabs & FTC Transparency Strip --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-5 border-b border-gray-200/80">
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
                   class="px-4 py-2 rounded-full text-xs sm:text-sm font-medium transition {{ $isActive ? 'bg-gray-950 text-white shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-gray-900 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <p class="text-xs text-gray-400">
            Partner offers are verified regularly.
            <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="text-gray-600 underline hover:text-gray-900">Affiliate Disclosure</a>
        </p>
    </div>

    @if(request('search'))
        <div class="mb-6 flex items-center justify-between bg-white px-4 py-3 rounded-xl border border-gray-200/90 text-sm text-gray-600">
            <span>Search results for: <strong class="text-gray-900">"{{ request('search') }}"</strong> ({{ $deals->total() }} deals)</span>
            <a href="{{ route('deals.index', array_filter(['filter' => request('filter')])) }}" class="text-xs font-semibold text-red-600 hover:underline">Clear search</a>
        </div>
    @endif

    {{-- Deals Grid (3-column HakoReview style) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($deals as $deal)
            @include('deals._card', ['deal' => $deal])
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-gray-200/80 text-gray-500">
                <p class="text-lg font-semibold text-gray-800">No active deals found matching your criteria.</p>
                <p class="text-sm text-gray-400 mt-1">Try clearing your filter or check back soon for new exclusive AI discounts.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $deals->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
