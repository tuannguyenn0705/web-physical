@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600 mt-2">{{ $category->description }}</p>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            @include('posts._card', ['post' => $post])
        @empty
            <div class="col-span-3 text-center py-16 text-gray-500">
                <p class="text-lg">No articles found in this category yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $posts->links('vendor.pagination.custom') }}</div>
</div>
@endsection
