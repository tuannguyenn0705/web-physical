@extends('layouts.app')

@section('title', 'Topic: #' . $tag->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 mb-8 shadow-2xs">
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-3">
            <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a>
            <span class="text-slate-300">/</span>
            <span class="text-amber-600 font-bold">#{{ $tag->name }}</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Product Reviews Tagged: #{{ $tag->name }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($posts as $post)
            <x-product-review-card :post="$post" />
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200/80 text-slate-500">
                <p class="text-base font-bold text-slate-700">No product reviews found with this tag yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">{{ $posts->links('vendor.pagination.custom') }}</div>
</div>
@endsection
