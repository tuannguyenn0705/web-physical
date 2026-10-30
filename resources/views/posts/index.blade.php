@extends('layouts.app')

@section('title', 'Articles' . (request('type') ? ' - ' . ucfirst(request('type')) : ''))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            @if(request('type'))
                @switch(request('type'))
                    @case('news') AI News @break
                    @case('review') AI Tool Reviews @break
                    @case('tutorial') Tutorials & Guides @break
                @endswitch
            @elseif(request('search'))
                Search results for: "{{ request('search') }}"
            @else
                All Articles
            @endif
        </h1>
    </div>

    {{-- Filter Tabs --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('posts.index') }}"
           class="px-5 py-2 rounded-full text-sm font-medium {{ !request('type') ? 'bg-gray-950 text-white shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-gray-900 hover:text-gray-900' }} transition">
            All
        </a>
        @foreach(['news' => 'News', 'review' => 'Reviews', 'tutorial' => 'Tutorials'] as $type => $label)
            <a href="{{ route('posts.index', ['type' => $type]) }}"
               class="px-5 py-2 rounded-full text-sm font-medium {{ request('type') === $type ? 'bg-gray-950 text-white shadow-xs' : 'bg-white text-gray-700 border border-gray-200 hover:border-gray-900 hover:text-gray-900' }} transition">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Posts Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            @include('posts._card', ['post' => $post])
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-gray-200/80 text-gray-500">
                <p class="text-lg font-medium text-gray-700">No articles found matching your search.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
