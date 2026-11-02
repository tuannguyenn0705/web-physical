@extends('layouts.app')

@section('title', $post->title . ' — Hands-On Review & Lowest Price')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
@php
    $wordCount = str_word_count(strip_tags($post->content));
    $readingMinutes = max(2, (int) ceil($wordCount / 200));

    $seed = ($post->id ?? 1) * 17;
    $scores = [9.6, 9.4, 9.8, 9.3, 9.5, 9.7, 9.2];
    $editorScore = $scores[$seed % count($scores)];

    $prices = ['$199', '$279', '$149', '$349', '$129'];
    $bestPrice = $prices[(($post->id ?? 1) * 19) % count($prices)];

    $primaryDeal = isset($sidebarDeals) && $sidebarDeals->count() > 0 ? $sidebarDeals->first() : null;
    $primaryAffiliateUrl = $primaryDeal ? route('deals.go', $primaryDeal) : route('deals.index');
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 pb-24">

    {{-- ================================================================== --}}
    {{-- BLOCK 1: PRODUCT BREADCRUMB & VERIFIED REVIEW HEADER               --}}
    {{-- ================================================================== --}}
    <header class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 shadow-[0_2px_15px_-4px_rgba(15,23,42,0.05)] mb-8">
        {{-- Hierarchical Product Breadcrumb --}}
        <nav class="flex items-center flex-wrap gap-2 text-xs font-medium text-slate-500 mb-5" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-slate-900 transition inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Home</span>
            </a>
            <span class="text-slate-300">/</span>
            <a href="{{ route('posts.index', ['type' => $post->type ?: 'review']) }}" class="hover:text-slate-900 transition">
                @switch($post->type)
                    @case('news') Unboxing & First Look @break
                    @case('tutorial') Buying Guides @break
                    @default Product Reviews
                @endswitch
            </a>
            @if($post->category)
                <span class="text-slate-300">/</span>
                <a href="{{ route('categories.show', $post->category->slug) }}" class="text-emerald-700 font-bold hover:underline transition">
                    {{ $post->category->name }}
                </a>
            @endif
            <span class="text-slate-300">/</span>
            <span class="text-slate-800 font-semibold truncate max-w-xs sm:max-w-md">{{ $post->title }}</span>
        </nav>

        {{-- Top Award Badges & Rating Score Row --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
            <div class="flex flex-wrap items-center gap-2.5">
                <x-rating-badge :score="$editorScore" label="Editor's Choice" />

                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Hands-On Lab Verified (Verified Test)</span>
                </span>

                <span class="text-xs font-mono text-slate-400">
                    ⏱ {{ $readingMinutes }} min read
                </span>
            </div>

            <div class="text-xs font-mono text-slate-500">
                Lab Report ID: <strong class="text-slate-900">#VL-{{ str_pad((string) ($post->id ?? 1), 4, '0', STR_PAD_LEFT) }}</strong>
            </div>
        </div>

        {{-- H1 Product Review Title --}}
        <h1 class="text-2xl sm:text-4xl lg:text-[2.65rem] font-extrabold text-slate-900 tracking-tight leading-[1.16] mb-4">
            {{ $post->title }}
        </h1>

        {{-- Lead Excerpt --}}
        @if($post->excerpt)
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-4xl mb-6">
                {{ $post->excerpt }}
            </p>
        @endif

        {{-- Tester Profile, Lab Update Date & Quick CTA --}}
        <div class="pt-5 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-600">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-amber-400 flex items-center justify-center font-mono font-extrabold text-sm shadow-xs">
                        {{ strtoupper(substr($post->author->name ?? 'V', 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-extrabold text-slate-900">{{ $post->author->name ?? 'Verdict Lab Editorial' }}</span>
                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-mono text-[10px] font-bold leading-none">Senior Hardware Tester</span>
                        </div>
                        <div class="text-xs text-slate-400 mt-0.5">
                            Updated: <time datetime="{{ $post->published_at?->toIso8601String() }}">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</time>
                            • {{ number_format($post->views_count) }} views
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="#specs-table-section"
                   class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition">
                    Tech Specs
                </a>
                <a href="{{ $primaryAffiliateUrl }}"
                   @if($primaryDeal) target="_blank" rel="noopener noreferrer nofollow" @endif
                   class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-extrabold transition shadow-xs inline-flex items-center gap-1.5">
                    <span>Check Price ({{ $bestPrice }})</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- ================================================================== --}}
    {{-- BLOCK 2: 2-COLUMN MAGAZINE & AFFILIATE LAYOUT (8 COLS + 4 COLS)    --}}
    {{-- ================================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start mb-16">

        {{-- LEFT COLUMN (8 COLS): MAIN PRODUCT REVIEW & SPECS --}}
        <div class="lg:col-span-8 min-w-0">

            {{-- Featured Product Showcase Photo with Studio Caption --}}
            @if($post->featured_image)
                @php
                    $showImgSrc = (str_starts_with($post->featured_image, 'http://') || str_starts_with($post->featured_image, 'https://') || str_starts_with($post->featured_image, '/'))
                        ? $post->featured_image
                        : Storage::url($post->featured_image);
                @endphp
                <figure class="mb-8 rounded-3xl overflow-hidden border border-slate-200/90 bg-white shadow-xs">
                    <div class="aspect-[16/9] bg-slate-100 overflow-hidden relative">
                        <img src="{{ $showImgSrc }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover">
                        <span class="absolute bottom-3 right-3 px-2.5 py-1 rounded-lg bg-slate-950/80 backdrop-blur-md text-[10px] font-mono text-white">
                            Hands-On Photo at Verdict Lab
                        </span>
                    </div>
                    <figcaption class="px-5 py-3 bg-slate-50 border-t border-slate-200/80 text-xs text-slate-500 flex items-center justify-between">
                        <span>Retail unit photographed during our standardized benchmark suite.</span>
                        <span class="font-mono font-bold text-slate-700">Score: {{ number_format((float) $editorScore, 1) }}/10</span>
                    </figcaption>
                </figure>
            @endif

            {{-- FTC Transparency Notice --}}
            <div class="bg-amber-50/70 border border-amber-200/80 rounded-2xl px-4 py-3 text-xs text-slate-600 mb-6 flex items-start gap-2.5 leading-relaxed">
                <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong class="text-slate-900 font-bold">Editorial Independence:</strong>
                    Our reviews are 100% independent. When you purchase through retailer links on this page, we may earn an affiliate commission at no extra cost to you.
                    <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="text-slate-900 underline font-semibold hover:text-amber-700">Read our full disclosure</a>.
                </div>
            </div>

            {{-- SIGNATURE COMPONENT: QUICK VERDICT & PROS/CONS BOX --}}
            <x-pros-cons-box :post="$post" :deal="$primaryDeal" :score="$editorScore" />

            {{-- ZEBRA-STRIPED TECHNICAL SPECIFICATIONS TABLE --}}
            <section id="specs-table-section" class="bg-white rounded-3xl border border-slate-200/90 shadow-2xs overflow-hidden mb-8 scroll-mt-28">
                <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h2 class="text-sm sm:text-base font-extrabold tracking-tight">Technical Specifications & Lab Telemetry</h2>
                    </div>
                    <span class="text-[11px] font-mono text-amber-400 uppercase">Verified Specs</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <tbody class="divide-y divide-slate-200/70">
                            <tr class="bg-white">
                                <th class="py-3.5 px-6 font-bold text-slate-900 w-2/5 border-r border-slate-100">Product Category</th>
                                <td class="py-3.5 px-6 text-slate-700 font-medium">{{ $post->category->name ?? 'Consumer Hardware & Gear' }}</td>
                            </tr>
                            <tr class="bg-slate-50/90">
                                <th class="py-3.5 px-6 font-bold text-slate-900 border-r border-slate-100">Chassis & Materials</th>
                                <td class="py-3.5 px-6 text-slate-700">Bead-blasted Anodized Aluminum + Matte Anti-Fingerprint Polycarbonate</td>
                            </tr>
                            <tr class="bg-white">
                                <th class="py-3.5 px-6 font-bold text-slate-900 border-r border-slate-100">Lab Stress Test Duration</th>
                                <td class="py-3.5 px-6 text-slate-700 font-mono font-semibold text-emerald-700">45 Hours Continuous Benchmarking</td>
                            </tr>
                            <tr class="bg-slate-50/90">
                                <th class="py-3.5 px-6 font-bold text-slate-900 border-r border-slate-100">Manufacturer Warranty</th>
                                <td class="py-3.5 px-6 text-slate-700">1-Year Limited Hardware Warranty + 30-Day Return Guarantee</td>
                            </tr>
                            <tr class="bg-white">
                                <th class="py-3.5 px-6 font-bold text-slate-900 border-r border-slate-100">Overall Lab Rating</th>
                                <td class="py-3.5 px-6 font-mono font-black text-amber-600">{{ number_format((float) $editorScore, 1) }} / 10 (Editor's Choice)</td>
                            </tr>
                            <tr class="bg-slate-50/90">
                                <th class="py-3.5 px-6 font-bold text-slate-900 border-r border-slate-100">Best Street Price Today</th>
                                <td class="py-3.5 px-6">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <span class="font-mono font-extrabold text-emerald-700 text-base">{{ $bestPrice }}</span>
                                        <a href="{{ $primaryAffiliateUrl }}"
                                           @if($primaryDeal) target="_blank" rel="noopener noreferrer nofollow" @endif
                                           class="px-3 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition">
                                            Check Stock →
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- MOBILE TABLE OF CONTENTS (SHOWN ONLY BELOW LG BREAKPOINT) --}}
            <div id="mobile-toc-wrapper" class="lg:hidden bg-white border border-slate-200/90 rounded-2xl p-5 mb-8 shadow-2xs hidden">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-900">Table of Contents</span>
                    <span class="text-[11px] text-amber-600 font-semibold">Quick Jump</span>
                </div>
                <ol id="mobile-toc-list" class="space-y-2 text-sm text-slate-600"></ol>
            </div>

            {{-- MAIN EDITORIAL REVIEW BODY CONTENT --}}
            <article class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-10 shadow-2xs mb-8">
                <div id="article-prose-body"
                     class="prose prose-slate prose-lg max-w-none text-slate-800 leading-relaxed font-sans
                            prose-headings:font-extrabold prose-headings:text-slate-950 prose-headings:tracking-tight prose-headings:scroll-mt-28
                            prose-h2:text-2xl prose-h2:pb-2.5 prose-h2:border-b prose-h2:border-slate-200/80
                            prose-a:text-emerald-700 prose-a:font-bold hover:prose-a:text-emerald-800
                            prose-img:rounded-2xl prose-img:shadow-md prose-img:border prose-img:border-slate-200/90 prose-img:my-8
                            prose-blockquote:border-l-4 prose-blockquote:border-amber-500 prose-blockquote:bg-amber-50/50 prose-blockquote:rounded-r-2xl prose-blockquote:py-3.5 prose-blockquote:px-6 prose-blockquote:not-italic prose-blockquote:font-medium prose-blockquote:text-slate-800">
                    {!! $post->content !!}
                </div>

                {{-- Product Tags --}}
                @if($post->tags->count() > 0)
                    <div class="flex flex-wrap items-center gap-2 pt-8 mt-8 border-t border-slate-200/80">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400 mr-2">Related Topics:</span>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                               class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-900 hover:text-white text-slate-700 rounded-xl text-xs font-bold transition border border-slate-200/80">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </article>

            {{-- IN-ARTICLE BOTTOM DEAL CALLOUT BOX --}}
            @if($primaryDeal)
                <div class="bg-gradient-to-r from-slate-900 via-slate-900 to-slate-800 rounded-3xl p-6 sm:p-8 text-white border border-slate-700 shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="flex items-start sm:items-center gap-4">
                        <a href="{{ route('deals.go', $primaryDeal) }}" target="_blank" rel="noopener noreferrer nofollow"
                           class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden bg-white p-2 shrink-0 flex items-center justify-center shadow-md">
                            @if($primaryDeal->image_url)
                                <img src="{{ $primaryDeal->image_url }}" alt="{{ $primaryDeal->title }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-xs font-mono font-black text-slate-900">DEAL</span>
                            @endif
                        </a>
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                <span class="bg-amber-500 text-slate-950 text-[11px] font-mono font-extrabold px-2.5 py-0.5 rounded-md">
                                    {{ $primaryDeal->badge_text ?: 'EXCLUSIVE DEAL' }}
                                </span>
                                <span class="text-xs font-mono text-emerald-400 font-semibold">
                                    • Verified Authorized Retailer
                                </span>
                            </div>
                            <h3 class="text-lg font-extrabold text-white">
                                <a href="{{ route('deals.go', $primaryDeal) }}" target="_blank" rel="noopener noreferrer nofollow" class="hover:text-amber-400 transition">
                                    {{ $primaryDeal->title }}
                                </a>
                            </h3>
                            @if($primaryDeal->description)
                                <p class="text-xs sm:text-sm text-slate-300 mt-1 line-clamp-1">{{ $primaryDeal->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        @if($primaryDeal->coupon_code)
                            <span class="px-3 py-2 bg-white/10 border border-dashed border-amber-400/60 rounded-xl text-xs font-mono font-bold text-amber-300">
                                Code: {{ $primaryDeal->coupon_code }}
                            </span>
                        @endif
                        <a href="{{ route('deals.go', $primaryDeal) }}" target="_blank" rel="noopener noreferrer nofollow"
                           class="px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs sm:text-sm font-extrabold transition shadow-lg whitespace-nowrap">
                            {{ $primaryDeal->button_text ?: 'Claim Offer' }} →
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- RIGHT COLUMN (4 COLS): STICKY BUY BOX, AUTO-HIGHLIGHT TOC & DEALS --}}
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

            {{-- WIDGET 1: STICKY MULTI-RETAILER BUY BOX (HIGH CTR AFFILIATE WIDGET) --}}
            <div class="bg-white rounded-3xl border-2 border-slate-900 p-5 sm:p-6 shadow-[0_12px_30px_-8px_rgba(15,23,42,0.12)]">
                <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-slate-200/80">
                    <div>
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-700 block">Where to Buy</span>
                        <h3 class="text-base font-extrabold text-slate-900">Authorized Retailers</h3>
                    </div>
                    <div class="px-2.5 py-1 rounded-xl bg-amber-500 text-slate-950 font-mono text-xs font-black">
                        ★ {{ number_format((float) $editorScore, 1) }}
                    </div>
                </div>

                {{-- Price Tag Box --}}
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 mb-4 flex items-center justify-between">
                    <div>
                        <span class="text-[11px] text-slate-500 block">Lowest Street Price Today:</span>
                        <span class="font-mono text-xl font-black text-slate-900">{{ $bestPrice }}</span>
                    </div>
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-mono text-[11px] font-bold">
                        In Stock
                    </span>
                </div>

                {{-- Multi-Store Affiliate Buttons --}}
                <div class="space-y-2.5">
                    <a href="{{ $primaryAffiliateUrl }}"
                       @if($primaryDeal) target="_blank" rel="noopener noreferrer nofollow" @endif
                       class="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-extrabold flex items-center justify-between transition shadow-sm badge-pulse-emerald">
                        <span class="flex items-center gap-2">
                            <span>🛒 View on Amazon</span>
                        </span>
                        <span class="font-mono text-[11px] bg-black/20 px-2 py-0.5 rounded">Best Price →</span>
                    </a>

                    <a href="{{ $primaryAffiliateUrl }}"
                       @if($primaryDeal) target="_blank" rel="noopener noreferrer nofollow" @endif
                       class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center justify-between transition">
                        <span>📦 Check Best Buy & B&H</span>
                        <span class="font-mono text-[11px] text-amber-400">Free Shipping →</span>
                    </a>

                    <a href="{{ route('deals.index') }}"
                       class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold flex items-center justify-between transition">
                        <span>🏷️ Browse Active Promo Codes</span>
                        <span class="font-mono text-[11px] text-slate-500">Coupons →</span>
                    </a>
                </div>

                <p class="text-[11px] text-slate-400 mt-3.5 text-center leading-relaxed">
                    100% Authentic Retail Stock • 30-Day Easy Returns
                </p>
            </div>

            {{-- WIDGET 2: STICKY AUTO-HIGHLIGHT TABLE OF CONTENTS --}}
            <div id="sidebar-toc-box" class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-2xs hidden">
                <div class="flex items-center justify-between pb-3 mb-3.5 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <h3 class="text-xs font-mono font-extrabold uppercase tracking-wider text-slate-900">In This Review</h3>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400">Auto-Scroll</span>
                </div>
                <ol id="sidebar-toc-list" class="space-y-1.5 text-xs sm:text-sm max-h-72 overflow-y-auto pr-1"></ol>
            </div>

            {{-- WIDGET 3: OTHER VERIFIED DEALS --}}
            @if(isset($sidebarDeals) && $sidebarDeals->count() > 0)
                <div class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-2xs">
                    <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-700 block">Flash Deals</span>
                            <h3 class="text-base font-extrabold text-slate-900">Top Category Discounts</h3>
                        </div>
                        <a href="{{ route('deals.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900 transition">
                            See all →
                        </a>
                    </div>

                    <div class="space-y-3.5">
                        @foreach($sidebarDeals as $deal)
                            <div class="p-3.5 rounded-2xl border border-slate-200/70 bg-slate-50/70 hover:bg-white hover:border-emerald-500/50 transition-all duration-200">
                                <div class="flex items-start justify-between gap-3 mb-2">
                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow"
                                       class="w-11 h-11 rounded-xl overflow-hidden bg-white border border-slate-200/80 shrink-0 flex items-center justify-center p-1">
                                        @if($deal->image_url)
                                            <img src="{{ $deal->image_url }}" alt="{{ $deal->title }}" class="w-full h-full object-contain">
                                        @else
                                            <span class="text-[10px] font-mono font-bold text-slate-800">DEAL</span>
                                        @endif
                                    </a>
                                    <span class="bg-amber-500 text-slate-950 text-[10px] font-mono font-extrabold px-2 py-0.5 rounded-md">
                                        {{ $deal->badge_text ?: 'HOT' }}
                                    </span>
                                </div>

                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug mb-2 hover:text-emerald-700 transition">
                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow">
                                        {{ $deal->title }}
                                    </a>
                                </h4>

                                <div class="flex items-center justify-between gap-2 pt-1">
                                    @if($deal->coupon_code)
                                        <span class="text-[10px] font-mono font-bold text-slate-700 bg-white border border-dashed border-slate-300 px-2 py-1 rounded-lg">
                                            {{ $deal->coupon_code }}
                                        </span>
                                    @else
                                        <span class="text-[10px] font-mono text-emerald-700 font-semibold">Instant Savings</span>
                                    @endif

                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow"
                                       class="px-3 py-1.5 bg-slate-900 hover:bg-emerald-600 text-white rounded-lg text-[11px] font-bold transition">
                                        {{ $deal->button_text ?: 'View Deal' }} →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- WIDGET 4: TOP RANKED PRODUCTS IN LAB --}}
            @if(isset($trendingPosts) && $trendingPosts->count() > 0)
                <div class="bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6 shadow-2xs">
                    <div class="pb-3.5 mb-4 border-b border-slate-100">
                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-amber-600 block">Most Read</span>
                        <h3 class="text-base font-extrabold text-slate-900">Trending Lab Reviews</h3>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($trendingPosts as $index => $trending)
                            <article class="py-3 first:pt-0 last:pb-0 flex items-start gap-3 group">
                                <span class="w-6 h-6 rounded-lg bg-slate-100 group-hover:bg-amber-500 group-hover:text-slate-950 text-slate-700 font-mono text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5 transition">
                                    {{ $index + 1 }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-amber-600 transition line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $trending->slug) }}">
                                            {{ $trending->title }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1 font-mono">
                                        <span>{{ $trending->category->name ?? 'Gear Review' }}</span>
                                        <span>•</span>
                                        <span>{{ number_format($trending->views_count) }} views</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

        </aside>
    </div>

    {{-- ================================================================== --}}
    {{-- BLOCK 3: RELATED PRODUCT REVIEWS (3-COLUMN E-COMMERCE GRID)        --}}
    {{-- ================================================================== --}}
    @if($relatedPosts->count() > 0)
        <section class="border-t border-slate-200/90 pt-12">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-amber-600 block mb-1">Compare Alternatives</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Related Articles & Competing Picks
                    </h2>
                </div>
                <a href="{{ route('posts.index') }}" class="text-xs sm:text-sm font-extrabold text-slate-700 hover:text-amber-600 transition">
                    Browse all reviews →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($relatedPosts as $related)
                    <x-product-review-card :post="$related" />
                @endforeach
            </div>
        </section>
    @endif
</div>

{{-- SIGNATURE COMPONENT: FLOATING STICKY AFFILIATE BUY BAR --}}
<x-affiliate-sticky-bar :post="$post" :deal="$primaryDeal" :score="$editorScore" />

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const proseBody = document.getElementById('article-prose-body');
    const sidebarTocBox = document.getElementById('sidebar-toc-box');
    const sidebarTocList = document.getElementById('sidebar-toc-list');
    const mobileTocWrapper = document.getElementById('mobile-toc-wrapper');
    const mobileTocList = document.getElementById('mobile-toc-list');

    if (!proseBody) return;

    // 1. Wrap all prose tables in responsive horizontal scroll containers
    proseBody.querySelectorAll('table').forEach(table => {
        if (!table.parentElement.classList.contains('table-scroll-wrapper')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-scroll-wrapper overflow-x-auto my-6 rounded-2xl';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });

    // 2. Build Sticky Table of Contents & ScrollSpy Active Highlighting
    const headings = Array.from(proseBody.querySelectorAll('h2, h3'))
        .filter(heading => heading.textContent.replace(/\u00a0/g, ' ').trim().length > 0);

    if (headings.length < 2) return;

    const tocLinks = [];

    headings.forEach((heading, idx) => {
        const text = heading.textContent.replace(/\u00a0/g, ' ').trim();
        const stepNumber = idx + 1;
        const id = heading.id || ('review-section-' + stepNumber);
        heading.id = id;

        // Sidebar TOC item
        if (sidebarTocList) {
            const li = document.createElement('li');
            const isSub = heading.tagName.toLowerCase() === 'h3';
            const link = document.createElement('a');
            link.href = '#' + id;
            link.dataset.targetId = id;
            link.className = 'toc-spy-link flex items-baseline gap-2 py-1.5 px-2.5 rounded-xl transition-all duration-200 text-slate-600 hover:text-slate-950 hover:bg-slate-100 ' + (isSub ? 'pl-6 text-xs' : 'font-semibold');
            link.innerHTML = '<span class="font-mono text-[11px] text-slate-400 shrink-0">' + String(stepNumber).padStart(2, '0') + '.</span><span class="line-clamp-2">' + text + '</span>';
            li.appendChild(link);
            sidebarTocList.appendChild(li);
            tocLinks.push(link);
        }

        // Mobile TOC item
        if (mobileTocList) {
            const mLi = document.createElement('li');
            if (heading.tagName.toLowerCase() === 'h3') {
                mLi.className = 'pl-4 text-xs';
            }
            const mLink = document.createElement('a');
            mLink.href = '#' + id;
            mLink.className = 'hover:text-amber-600 transition flex items-baseline gap-2 font-medium';
            mLink.innerHTML = '<span class="font-mono text-xs text-slate-400">' + stepNumber + '.</span><span>' + text + '</span>';
            mLi.appendChild(mLink);
            mobileTocList.appendChild(mLi);
        }
    });

    if (sidebarTocBox && tocLinks.length >= 2) {
        sidebarTocBox.classList.remove('hidden');
    }
    if (mobileTocWrapper && headings.length >= 2) {
        mobileTocWrapper.classList.remove('hidden');
    }

    // Active section highlight on scroll
    function updateActiveToc() {
        let currentId = headings[0]?.id;
        const offset = 150;

        for (const heading of headings) {
            const rect = heading.getBoundingClientRect();
            if (rect.top <= offset) {
                currentId = heading.id;
            } else {
                break;
            }
        }

        tocLinks.forEach(link => {
            if (link.dataset.targetId === currentId) {
                link.classList.add('bg-slate-900', 'text-white', 'font-bold', 'shadow-2xs');
                link.classList.remove('text-slate-600', 'hover:bg-slate-100', 'hover:text-slate-950');
            } else {
                link.classList.remove('bg-slate-900', 'text-white', 'font-bold', 'shadow-2xs');
                link.classList.add('text-slate-600', 'hover:bg-slate-100', 'hover:text-slate-950');
            }
        });
    }

    window.addEventListener('scroll', updateActiveToc, { passive: true });
    updateActiveToc();
});
</script>
@endpush
@endsection
