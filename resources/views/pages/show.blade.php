@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-gray-900 transition">Home</a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-900 font-medium">{{ $page->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        {{-- Left Sidebar: Company & Legal Pages Navigation --}}
        <aside class="lg:col-span-3 lg:sticky lg:top-28">
            <div class="bg-white rounded-2xl border border-gray-200/90 p-5 shadow-2xs">
                <h2 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3 px-2">
                    Company & Policies
                </h2>
                <nav class="space-y-1">
                    @foreach($allPages as $navPage)
                        @php
                            $isActive = $navPage->slug === $page->slug;
                        @endphp
                        <a href="{{ route('pages.show', $navPage->slug) }}"
                           class="block px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition {{ $isActive ? 'bg-gray-950 text-white font-semibold shadow-2xs' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            {{ $navPage->title }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-6 pt-5 border-t border-gray-100 px-2 space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-gray-800 mb-1">Editorial & Partnerships</p>
                        <p class="text-xs text-gray-500 leading-relaxed mb-1.5">
                            Questions about our reviews or partner deals?
                        </p>
                        <a href="mailto:aihubinsider@gmail.com" class="text-xs font-semibold text-orange-600 hover:underline">
                            aihubinsider@gmail.com
                        </a>
                    </div>
                    <div class="pt-3 border-t border-gray-100 text-xs text-gray-500">
                        <span class="text-[10px] uppercase tracking-wider font-bold text-gray-400 block mb-0.5">U.S. Headquarters</span>
                        <p class="text-gray-700 font-medium leading-relaxed">
                            1200 17th St NW, Suite 500<br>
                            Washington, D.C. 20036, USA
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Right Main Content --}}
        <div class="lg:col-span-9">
            <div class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-10 lg:p-12 shadow-2xs">
                <header class="pb-6 mb-8 border-b border-gray-100">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-950 tracking-tight mb-2">
                        {{ $page->title }}
                    </h1>
                    <p class="text-xs text-gray-400">
                        Last updated: {{ $page->updated_at?->format('F d, Y') ?? now()->format('F d, Y') }}
                    </p>
                </header>

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed prose-headings:font-bold prose-headings:text-gray-950 prose-headings:tracking-tight prose-a:text-orange-600 prose-a:font-medium hover:prose-a:text-orange-700">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
