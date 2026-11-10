@extends('layouts.app')

@section('title', 'VerdictTC.com — Hands-On Physical Product Reviews, Lab Benchmarks & Daily Deals')
@section('meta_description', 'Independent consumer hardware reviews, smart home benchmarks, ergonomic desk setup guides, and verified retail discounts across Amazon, Best Buy, and B&H.')

@section('content')

@php
    $heroKingPost = $featuredPosts->first();
    $heroBentoPosts = $featuredPosts->slice(1, 3);
@endphp

{{-- ====================================================================== --}}
{{-- 1. HERO BENTO GRID SECTION (1 KING PRODUCT CARD + 3 BENTO SIDE CARDS)  --}}
{{-- ====================================================================== --}}
<section class="relative bg-white border-b border-slate-200/80 pt-6 sm:pt-8 pb-12 sm:pb-16 overflow-hidden">
    {{-- Subtle Ambient Studio Lighting --}}
    <div class="absolute -top-32 left-1/4 w-[500px] h-[500px] bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 right-1/4 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header Strip --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900 text-amber-400 font-mono text-[11px] font-bold uppercase tracking-wider shadow-2xs shrink-0">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    Spotlight of the Week
                </span>
                <span class="text-xs sm:text-sm font-semibold text-slate-600">
                    Top-performing gear that survived our toughest 60-hour laboratory stress tests
                </span>
            </div>

            <div class="flex items-center gap-4 text-xs font-bold shrink-0">
                <a href="#comparison-lab" class="text-slate-600 hover:text-slate-900 inline-flex items-center gap-1 transition">
                    <span>Head-to-Head Matrix</span>
                    <svg class="w-3.5 h-3.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
                <span class="text-slate-300">|</span>
                <a href="{{ route('deals.index') }}" class="text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1 transition">
                    <span>Today's Promo Codes →</span>
                </a>
            </div>
        </div>

        {{-- BENTO GRID (12 COLUMNS) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            {{-- LEFT: KING PRODUCT OF THE WEEK (7 COLUMNS) --}}
            @if($heroKingPost)
                <article class="bento-tilt-card lg:col-span-7 relative rounded-3xl bg-slate-900 text-white overflow-hidden border border-slate-800 shadow-[0_24px_60px_-15px_rgba(15,23,42,0.3)] flex flex-col justify-between min-h-[480px] sm:min-h-[540px] group">
                    {{-- Full-bleed Product Image with Smooth Zoom --}}
                    <div class="absolute inset-0 overflow-hidden">
                        @if($heroKingPost->featured_image)
                            @php
                                $kingImgSrc = (str_starts_with($heroKingPost->featured_image, 'http://') || str_starts_with($heroKingPost->featured_image, 'https://') || str_starts_with($heroKingPost->featured_image, '/'))
                                    ? $heroKingPost->featured_image
                                    : Storage::url($heroKingPost->featured_image);
                            @endphp
                            <img src="{{ $kingImgSrc }}"
                                 alt="{{ $heroKingPost->title }}"
                                 class="w-full h-full object-cover opacity-55 group-hover:scale-108 transition-transform duration-500 ease-out">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 group-hover:scale-105 transition-transform duration-500 ease-out"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-950/20"></div>
                    </div>

                    {{-- Top Bar Badges inside King Card --}}
                    <div class="relative z-10 p-6 sm:p-8 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-500 text-slate-950 font-mono text-xs font-black uppercase tracking-wider badge-pulse-amber">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span>Flagship Winner of the Week</span>
                            </span>

                            @if($heroKingPost->category)
                                <a href="{{ route('categories.show', $heroKingPost->category->slug) }}"
                                   class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/15 text-xs font-bold text-white transition">
                                    {{ $heroKingPost->category->name }}
                                </a>
                            @endif
                        </div>

                        {{-- Score 9.8/10 Box --}}
                        <div class="px-3.5 py-2 rounded-2xl bg-slate-950/90 backdrop-blur-md border border-amber-400/40 flex items-center gap-2.5 shadow-lg">
                            <div class="text-right">
                                <span class="block text-[9px] font-mono uppercase tracking-widest text-amber-400 font-bold">Lab Score</span>
                                <span class="text-[11px] font-bold text-emerald-400">Outstanding</span>
                            </div>
                            <span class="font-mono text-2xl font-black text-white">9.8<span class="text-xs text-slate-400">/10</span></span>
                        </div>
                    </div>

                    {{-- Bottom Content & High-CTR CTAs --}}
                    <div class="relative z-10 p-6 sm:p-8 pt-0">
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-300 mb-3 font-mono">
                            <span class="inline-flex items-center gap-1 text-emerald-400 font-bold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                60-Hour Continuous Stress Test
                            </span>
                            <span>•</span>
                            <span>Tester: {{ $heroKingPost->author->name ?? 'Lead Engineer' }}</span>
                            <span>•</span>
                            <span>{{ number_format($heroKingPost->views_count) }} views</span>
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-[1.15] mb-3 group-hover:text-amber-300 transition-colors">
                            <a href="{{ route('posts.show', $heroKingPost->slug) }}">
                                {{ $heroKingPost->title }}
                            </a>
                        </h1>

                        <p class="text-sm sm:text-base text-slate-300 leading-relaxed line-clamp-2 mb-6 max-w-2xl">
                            {{ $heroKingPost->excerpt ?? Str::limit(strip_tags($heroKingPost->content), 170) }}
                        </p>

                        {{-- Mini Specs Strip --}}
                        <div class="grid grid-cols-3 gap-2.5 sm:gap-4 p-3.5 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 mb-6">
                            <div>
                                <span class="block text-[10px] font-mono uppercase text-slate-400">Build Standard</span>
                                <span class="text-xs sm:text-sm font-bold text-white">CNC Alloy & MIL-STD</span>
                            </div>
                            <div class="border-x border-white/10 px-2.5 sm:px-4">
                                <span class="block text-[10px] font-mono uppercase text-slate-400">Lowest Street Price</span>
                                <span class="text-xs sm:text-sm font-mono font-bold text-emerald-400">$279 (-28%)</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-mono uppercase text-slate-400">Lab Award</span>
                                <span class="text-xs sm:text-sm font-bold text-amber-400">#1 Pick of 2026</span>
                            </div>
                        </div>

                        {{-- Dual Action Buttons --}}
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('posts.show', $heroKingPost->slug) }}"
                               class="px-5 sm:px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs sm:text-sm transition shadow-lg inline-flex items-center gap-2">
                                <span>Read Full Lab Review</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>

                            <a href="{{ route('deals.index') }}"
                               class="px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm transition shadow-md inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>Compare & Buy Now</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endif

            {{-- RIGHT: 3 BENTO UNBOXING & QUICK REVIEW CARDS (5 COLUMNS) --}}
            <div class="lg:col-span-5 flex flex-col justify-between gap-4">
                @php
                    $bentoBadges = [
                        ['tag' => 'UNBOXING & FIRST LOOK', 'score' => '9.5', 'price' => '$189', 'pill' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                        ['tag' => 'HEAD-TO-HEAD TEST', 'score' => '9.4', 'price' => '$329', 'pill' => 'bg-amber-50 text-amber-800 border-amber-200'],
                        ['tag' => 'BEST SELLER 2026', 'score' => '9.6', 'price' => '$129', 'pill' => 'bg-sky-50 text-sky-700 border-sky-200'],
                    ];
                @endphp

                @foreach($heroBentoPosts as $idx => $bentoPost)
                    @php $meta = $bentoBadges[$idx % count($bentoBadges)]; @endphp
                    <article class="bento-tilt-card group relative bg-slate-50/90 hover:bg-white rounded-2xl border border-slate-200/90 hover:border-slate-300 p-4 sm:p-5 shadow-2xs hover:shadow-xl transition-all duration-500 ease-out flex items-center gap-4 flex-1">
                        {{-- Square Product Image --}}
                        <a href="{{ route('posts.show', $bentoPost->slug) }}"
                           class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden bg-slate-900 shrink-0 relative block border border-slate-200/60">
                            @if($bentoPost->featured_image)
                                @php
                                    $bentoImgSrc = (str_starts_with($bentoPost->featured_image, 'http://') || str_starts_with($bentoPost->featured_image, 'https://') || str_starts_with($bentoPost->featured_image, '/'))
                                        ? $bentoPost->featured_image
                                        : Storage::url($bentoPost->featured_image);
                                @endphp
                                <img src="{{ $bentoImgSrc }}"
                                     alt="{{ $bentoPost->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-900 to-slate-800 flex flex-col items-center justify-center p-2 text-center group-hover:scale-110 transition-transform duration-500 ease-out">
                                    <span class="text-[9px] font-mono font-bold tracking-widest uppercase text-amber-400">LAB GEAR</span>
                                    <span class="text-[10px] font-semibold text-white/90 mt-1 line-clamp-1">{{ $bentoPost->category->name ?? 'Review' }}</span>
                                </div>
                            @endif

                            {{-- Corner Rating Pill --}}
                            <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-slate-950/90 text-amber-400 font-mono text-[11px] font-extrabold shadow-xs">
                                ★ {{ $meta['score'] }}
                            </span>
                        </a>

                        {{-- Card Details --}}
                        <div class="min-w-0 flex-1 flex flex-col justify-between h-full">
                            <div>
                                <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold border {{ $meta['pill'] }}">
                                        {{ $meta['tag'] }}
                                    </span>
                                    @if($bentoPost->category)
                                        <span class="text-[11px] font-semibold text-slate-400 truncate">• {{ $bentoPost->category->name }}</span>
                                    @endif
                                </div>

                                <h2 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-amber-600 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('posts.show', $bentoPost->slug) }}">
                                        {{ $bentoPost->title }}
                                    </a>
                                </h2>
                            </div>

                            <div class="pt-2.5 mt-2 border-t border-slate-200/70 flex items-center justify-between gap-2">
                                <div>
                                    <span class="text-[10px] font-mono text-slate-400 block">Street Price</span>
                                    <span class="text-xs font-mono font-extrabold text-slate-900">{{ $meta['price'] }}</span>
                                </div>
                                <a href="{{ route('posts.show', $bentoPost->slug) }}"
                                   class="inline-flex items-center gap-1 text-xs font-bold text-slate-900 group-hover:text-emerald-600 transition whitespace-nowrap">
                                    <span>Full Verdict</span>
                                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ====================================================================== --}}
{{-- 2. INTERACTIVE TOP 3 PRODUCT COMPARISON MATRIX (RTINGS / WIRECUTTER)   --}}
{{-- ====================================================================== --}}
<section id="comparison-lab"
         x-data="{ activeSegment: 'anc_headphones' }"
         class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16">

    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100/80 border border-amber-300/70 text-amber-900 text-xs font-mono font-bold uppercase tracking-wider mb-2.5">
                <span>Head-to-Head Lab Matrix</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Interactive Top 3 Product Comparison & Lab Rankings
            </h2>
            <p class="text-sm sm:text-base text-slate-500 mt-1">
                Side-by-side technical telemetry of the top 3 winners in each hardware category.
            </p>
        </div>

        {{-- Segment Switcher Tabs --}}
        <div class="inline-flex flex-wrap items-center gap-1.5 p-1.5 rounded-2xl bg-slate-200/70 border border-slate-200 self-start">
            <button type="button"
                    @click="activeSegment = 'anc_headphones'"
                    :class="activeSegment === 'anc_headphones' ? 'bg-slate-900 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer">
                🎧 ANC Headphones
            </button>
            <button type="button"
                    @click="activeSegment = 'mech_keyboards'"
                    :class="activeSegment === 'mech_keyboards' ? 'bg-slate-900 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer">
                ⌨️ Mechanical Keyboards
            </button>
            <button type="button"
                    @click="activeSegment = 'robot_vacuums'"
                    :class="activeSegment === 'robot_vacuums' ? 'bg-slate-900 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition cursor-pointer">
                🤖 Robot Vacuums
            </button>
        </div>
    </div>

    {{-- Comparison Table Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-[0_8px_30px_rgba(15,23,42,0.05)] overflow-hidden">
        <div class="overflow-x-auto">
            {{-- TAB 1: ANC HEADPHONES --}}
            <table x-show="activeSegment === 'anc_headphones'" class="w-full text-left border-collapse min-w-[720px]">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs font-mono uppercase tracking-wider">
                        <th class="py-4 px-6 w-1/4">Benchmark Metric</th>
                        <th class="py-4 px-6 w-1/4 bg-amber-500/15 border-x border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-amber-500 text-slate-950 font-extrabold text-[10px] mb-1">🏆 #1 OVERALL WINNER</span>
                            <div class="text-sm font-sans font-extrabold text-white">Sony WH-1000XM5</div>
                        </th>
                        <th class="py-4 px-6 w-1/4 border-r border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-600 text-white font-extrabold text-[10px] mb-1">💎 BEST NOISE ISOLATION</span>
                            <div class="text-sm font-sans font-extrabold text-white">Bose QuietComfort Ultra</div>
                        </th>
                        <th class="py-4 px-6 w-1/4">
                            <span class="inline-block px-2 py-0.5 rounded bg-slate-700 text-slate-200 font-extrabold text-[10px] mb-1">⚡ 60H BATTERY KING</span>
                            <div class="text-sm font-sans font-extrabold text-white">Sennheiser Momentum 4</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 text-sm">
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">VerdictTC Score</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80 font-mono font-black text-lg text-amber-600">9.8 / 10</td>
                        <td class="py-4 px-6 border-r border-slate-200/80 font-mono font-black text-lg text-slate-900">9.6 / 10</td>
                        <td class="py-4 px-6 font-mono font-black text-lg text-slate-900">9.4 / 10</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Active Noise Cancellation (ANC)</td>
                        <td class="py-3.5 px-6 bg-amber-50/20 border-x border-slate-200/80 font-semibold text-emerald-700">-39.5 dB (8-Mic Auto NC)</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 font-semibold text-emerald-700">-41.2 dB (CustomTune)</td>
                        <td class="py-3.5 px-6 text-slate-600">-34.0 dB (Adaptive ANC)</td>
                    </tr>
                    <tr class="bg-slate-50/70">
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Measured Battery Life (ANC On)</td>
                        <td class="py-3.5 px-6 bg-amber-50/40 border-x border-slate-200/80 font-mono font-semibold text-slate-800">31 hrs 40 mins</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 font-mono text-slate-600">24 hrs 15 mins</td>
                        <td class="py-3.5 px-6 font-mono font-bold text-emerald-700">58 hrs 20 mins</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Weight & Clamping Comfort</td>
                        <td class="py-3.5 px-6 bg-amber-50/20 border-x border-slate-200/80 text-slate-800">250g (Soft Fit Leather)</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 text-slate-800">254g (Plush Deep Earcups)</td>
                        <td class="py-3.5 px-6 text-slate-600">293g (Padded Headband)</td>
                    </tr>
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">Best Verified Price</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80">
                            <span class="font-mono font-extrabold text-emerald-700 block">$298.00</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition">
                                Check Amazon Price →
                            </a>
                        </td>
                        <td class="py-4 px-6 border-r border-slate-200/80">
                            <span class="font-mono font-extrabold text-slate-900 block">$349.00</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                Check Best Buy →
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-mono font-extrabold text-slate-900 block">$269.95</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                Check B&H Photo →
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- TAB 2: MECHANICAL KEYBOARDS --}}
            <table x-show="activeSegment === 'mech_keyboards'" x-cloak class="w-full text-left border-collapse min-w-[720px]">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs font-mono uppercase tracking-wider">
                        <th class="py-4 px-6 w-1/4">Benchmark Metric</th>
                        <th class="py-4 px-6 w-1/4 bg-amber-500/15 border-x border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-amber-500 text-slate-950 font-extrabold text-[10px] mb-1">🏆 EDITOR'S CHOICE</span>
                            <div class="text-sm font-sans font-extrabold text-white">Keychron Q1 Max (CNC Alu)</div>
                        </th>
                        <th class="py-4 px-6 w-1/4 border-r border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-600 text-white font-extrabold text-[10px] mb-1">🔥 BEST VALUE PICK</span>
                            <div class="text-sm font-sans font-extrabold text-white">Rainy75 Pro Aluminum</div>
                        </th>
                        <th class="py-4 px-6 w-1/4">
                            <span class="inline-block px-2 py-0.5 rounded bg-slate-700 text-slate-200 font-extrabold text-[10px] mb-1">💼 BEST LOW-PROFILE</span>
                            <div class="text-sm font-sans font-extrabold text-white">NuPhy Air75 V2 Wireless</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 text-sm">
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">VerdictTC Score</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80 font-mono font-black text-lg text-amber-600">9.7 / 10</td>
                        <td class="py-4 px-6 border-r border-slate-200/80 font-mono font-black text-lg text-slate-900">9.6 / 10</td>
                        <td class="py-4 px-6 font-mono font-black text-lg text-slate-900">9.4 / 10</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Chassis & Mounting Style</td>
                        <td class="py-3.5 px-6 bg-amber-50/20 border-x border-slate-200/80 font-semibold text-slate-900">6063 CNC Aluminum, Double-Gasket</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 font-semibold text-slate-900">Anodized Alu + Mirror Weight</td>
                        <td class="py-3.5 px-6 text-slate-600">Ultra-slim 13.5mm Alu Top Frame</td>
                    </tr>
                    <tr class="bg-slate-50/70">
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Wireless Latency & Firmware</td>
                        <td class="py-3.5 px-6 bg-amber-50/40 border-x border-slate-200/80 font-mono text-emerald-700 font-bold">2.4GHz (1000Hz) / BT 5.1 / QMK</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 font-mono text-slate-700">Tri-Mode Wireless, 7000mAh</td>
                        <td class="py-3.5 px-6 font-mono text-slate-700">2.4GHz 1000Hz / VIA Web Config</td>
                    </tr>
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">Best Verified Price</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80">
                            <span class="font-mono font-extrabold text-emerald-700 block">$189.00</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition">
                                Claim Promo Code →
                            </a>
                        </td>
                        <td class="py-4 px-6 border-r border-slate-200/80">
                            <span class="font-mono font-extrabold text-slate-900 block">$109.00</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                Check Amazon →
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-mono font-extrabold text-slate-900 block">$119.95</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                Check Official Store →
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- TAB 3: ROBOT VACUUMS --}}
            <table x-show="activeSegment === 'robot_vacuums'" x-cloak class="w-full text-left border-collapse min-w-[720px]">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs font-mono uppercase tracking-wider">
                        <th class="py-4 px-6 w-1/4">Benchmark Metric</th>
                        <th class="py-4 px-6 w-1/4 bg-amber-500/15 border-x border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-amber-500 text-slate-950 font-extrabold text-[10px] mb-1">🏆 #1 HANDS-FREE FLAGSHIP</span>
                            <div class="text-sm font-sans font-extrabold text-white">Roborock S8 MaxV Ultra</div>
                        </th>
                        <th class="py-4 px-6 w-1/4 border-r border-slate-800">
                            <span class="inline-block px-2 py-0.5 rounded bg-emerald-600 text-white font-extrabold text-[10px] mb-1">✨ BEST EDGE MOPPING</span>
                            <div class="text-sm font-sans font-extrabold text-white">Dreame X40 Ultra</div>
                        </th>
                        <th class="py-4 px-6 w-1/4">
                            <span class="inline-block px-2 py-0.5 rounded bg-slate-700 text-slate-200 font-extrabold text-[10px] mb-1">💰 BEST MID-RANGE VALUE</span>
                            <div class="text-sm font-sans font-extrabold text-white">Roborock Qrevo Pro</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 text-sm">
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">VerdictTC Score</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80 font-mono font-black text-lg text-amber-600">9.8 / 10</td>
                        <td class="py-4 px-6 border-r border-slate-200/80 font-mono font-black text-lg text-slate-900">9.7 / 10</td>
                        <td class="py-4 px-6 font-mono font-black text-lg text-slate-900">9.3 / 10</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-6 font-semibold text-slate-700">Suction Power & Hot Water Mop Wash</td>
                        <td class="py-3.5 px-6 bg-amber-50/20 border-x border-slate-200/80 font-semibold text-emerald-700">10,000 Pa • 140°F Hot Wash</td>
                        <td class="py-3.5 px-6 border-r border-slate-200/80 font-semibold text-emerald-700">12,000 Pa • 158°F Hot Wash</td>
                        <td class="py-3.5 px-6 text-slate-600">7,000 Pa • Warm Wash & Auto Dry</td>
                    </tr>
                    <tr class="bg-slate-50/70">
                        <td class="py-4 px-6 font-bold text-slate-900">Best Verified Price</td>
                        <td class="py-4 px-6 bg-amber-50/40 border-x border-slate-200/80">
                            <span class="font-mono font-extrabold text-emerald-700 block">$1,099.99</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition">
                                View Amazon Deal →
                            </a>
                        </td>
                        <td class="py-4 px-6 border-r border-slate-200/80">
                            <span class="font-mono font-extrabold text-slate-900 block">$999.99</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                View Best Buy →
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-mono font-extrabold text-slate-900 block">$659.99</span>
                            <a href="{{ route('deals.index') }}" class="mt-2 inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition">
                                View Deal →
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- ====================================================================== --}}
{{-- 3. VERIFIED FLASH DEALS & COUPONS HUB                                  --}}
{{-- ====================================================================== --}}
@if($featuredDeals->count() > 0)
<section class="bg-white border-y border-slate-200/80 py-14 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-mono font-bold uppercase tracking-wider mb-2.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Verified Retail Discounts</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Today's Best Hardware Deals & Promo Codes
                </h2>
                <p class="text-sm sm:text-base text-slate-500 mt-1">
                    Hand-verified price drops checked against 90-day historical pricing to filter out fake markups.
                </p>
            </div>

            <a href="{{ route('deals.index') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-900 hover:bg-emerald-600 text-white text-xs sm:text-sm font-bold transition shrink-0 self-start sm:self-auto shadow-xs">
                <span>Browse All Deals</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredDeals as $deal)
                @include('deals._card', ['deal' => $deal])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ====================================================================== --}}
{{-- 4. E-COMMERCE PRODUCT REVIEW FEED & CATEGORY FILTER BAR                --}}
{{-- ====================================================================== --}}
<section id="latest" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16">
    {{-- Category Filter Pills --}}
    @if($categories->count() > 0)
        <div class="mb-10 p-4 sm:p-5 rounded-2xl bg-white border border-slate-200/80 shadow-2xs flex flex-wrap items-center justify-between gap-3">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400 mr-1">Filter by Category:</span>
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold transition shadow-2xs">
                    All Products
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}"
                       class="px-3.5 py-2 rounded-xl bg-slate-50 hover:bg-amber-50 text-slate-700 hover:text-slate-950 border border-slate-200/80 hover:border-amber-400 text-xs font-bold transition">
                        {{ $category->name }}
                        <span class="ml-1 font-mono text-[11px] text-slate-400">({{ $category->posts_count }})</span>
                    </a>
                @endforeach
            </div>

            <a href="{{ route('posts.index', ['type' => 'review']) }}"
               class="text-xs font-bold text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1">
                <span>Lab Reviews Only</span>
                <span>→</span>
            </a>
        </div>
    @endif

    {{-- Section Heading --}}
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-mono font-bold uppercase tracking-wider text-amber-600 block mb-1">Fresh from the Testing Lab</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Latest Product Reviews & Buying Guides
            </h2>
        </div>

        <a href="{{ route('posts.index') }}"
           class="text-xs sm:text-sm font-extrabold text-slate-700 hover:text-amber-600 inline-flex items-center gap-1.5 transition">
            <span>View Full Archive ({{ $latestPosts->count() }}+ Reviews)</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- 3-Column E-Commerce Product Review Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($latestPosts as $post)
            <x-product-review-card :post="$post" />
        @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-200/80 text-slate-500">
                <p class="text-base font-bold text-slate-700">No product reviews published yet.</p>
            </div>
        @endforelse
    </div>

    {{-- Archive CTA --}}
    <div class="mt-12 text-center">
        <a href="{{ route('posts.index') }}"
           class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl bg-white hover:bg-slate-900 text-slate-900 hover:text-white border border-slate-300 hover:border-slate-900 text-sm font-extrabold transition shadow-xs">
            <span>Explore Full Product Review Archive</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>

    {{-- ====================================================================== --}}
    {{-- 5. E-COMMERCE DEAL HUNTER NEWSLETTER & HONESTY PLEDGE                  --}}
    {{-- ====================================================================== --}}
    <div class="mt-20 bg-slate-900 rounded-3xl p-8 sm:p-12 lg:p-14 border border-slate-800 shadow-2xl relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-amber-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/15 border border-amber-400/30 text-amber-300 font-mono text-xs font-bold uppercase tracking-wider">
                    <span>Weekly Lab Briefing & Price Drops</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-snug">
                    Get Verified Price Drops & Lab-Tested Picks in Your Inbox
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                    Join 25,000+ smart shoppers receiving our weekly roundup of newly benchmarked hardware, long-term durability reports, and verified 30%+ retail discounts.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs text-slate-400">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        100% Independent Lab Ratings
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        Verified Price Drops Only (25%+ Off)
                    </span>
                </div>
            </div>

            <div class="lg:col-span-5">
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="bg-white/5 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-white/10 space-y-3">
                    @csrf
                    <div>
                        <label for="home-newsletter-email" class="block text-xs font-bold text-slate-200 mb-1.5">Email Address for Deal Alerts:</label>
                        <input type="email"
                               id="home-newsletter-email"
                               name="email"
                               required
                               placeholder="you@example.com"
                               class="w-full px-4 py-3 rounded-xl bg-slate-950/90 border border-slate-700 text-white placeholder-slate-400 text-sm focus:outline-none focus:border-amber-400 transition">
                    </div>
                    <button type="submit"
                            class="w-full py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs sm:text-sm uppercase tracking-wider transition cursor-pointer shadow-md">
                        Subscribe Free →
                    </button>
                    <p class="text-[11px] text-slate-400 text-center">
                        Zero spam. Unsubscribe anytime. Read our <a href="{{ route('pages.show', 'privacy-policy') }}" class="text-slate-300 underline hover:text-white">Privacy Policy</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
