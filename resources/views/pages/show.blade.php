@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs sm:text-sm text-slate-500 mb-6 font-medium">
        <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a>
        <span class="text-slate-300">/</span>
        <span class="text-slate-900 font-bold">{{ $page->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        {{-- Left Sidebar: Company, Lab Methodology & Legal Pages Navigation --}}
        <aside class="lg:col-span-3 lg:sticky lg:top-28">
            <div class="bg-white rounded-3xl border border-slate-200/90 p-5 shadow-2xs">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400 mb-3 px-2">
                    Trust & Policies
                </h2>
                <nav class="space-y-1.5">
                    @foreach($allPages as $navPage)
                        @php
                            $isActive = $navPage->slug === $page->slug;
                        @endphp
                        <a href="{{ route('pages.show', $navPage->slug) }}"
                           class="block px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition {{ $isActive ? 'bg-slate-900 text-white shadow-2xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            {{ $navPage->title }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-6 pt-5 border-t border-slate-100 px-2 space-y-3">
                    <div>
                        <p class="text-xs font-extrabold text-slate-900 mb-1">Editorial & Partnerships</p>
                        <p class="text-xs text-slate-500 leading-relaxed mb-1.5">
                            Questions about our hardware test protocols or retail affiliate partnerships?
                        </p>
                        <a href="mailto:editorial@verdictlab.com" class="text-xs font-bold text-emerald-700 hover:underline">
                            editorial@verdictlab.com
                        </a>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">
                        <span class="text-[10px] font-mono uppercase tracking-wider font-bold text-slate-400 block mb-0.5">U.S. Testing Lab</span>
                        <p class="text-slate-700 font-semibold leading-relaxed">
                            VERDICT.LAB LLC<br>
                            1200 17th St NW, Suite 500<br>
                            Washington, D.C. 20036, USA
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Right Main Content --}}
        <div class="lg:col-span-9">
            <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 lg:p-12 shadow-2xs">
                <header class="pb-6 mb-8 border-b border-slate-200/80">
                    <span class="inline-block px-2.5 py-1 rounded-lg bg-amber-100 text-amber-900 font-mono text-[10px] font-bold uppercase tracking-wider mb-3">
                        VERDICT.LAB Official Policy
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight mb-2">
                        {{ $page->title }}
                    </h1>
                    <p class="text-xs font-mono text-slate-400">
                        Last updated: {{ $page->updated_at?->format('F d, Y') ?? now()->format('F d, Y') }}
                    </p>
                </header>

                <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed prose-headings:font-extrabold prose-headings:text-slate-950 prose-headings:tracking-tight prose-a:text-emerald-700 prose-a:font-bold hover:prose-a:text-emerald-800">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
