@extends('layouts.app')

@section('title', 'Home - AI News, Reviews & Exclusive Deals')
@section('meta_description', 'Independent artificial intelligence news, hands-on AI tool reviews, practical tutorials, and verified software discounts.')

@section('content')

{{-- ======================================================== --}}
{{-- 1. HERO SECTION                                          --}}
{{-- ======================================================== --}}
<section class="relative bg-[#FAF9F6] overflow-hidden min-h-screen lg:h-screen flex items-center justify-center pt-20 sm:pt-24 lg:pt-14 pb-8 lg:pb-0 border-b border-gray-200/60">
    <!-- Decorative Ambient Glow Blobs -->
    <div class="absolute top-[-15%] left-[-10%] w-[45vw] h-[45vw] bg-orange-200/35 rounded-full blur-[120px] mix-blend-multiply pointer-events-none"></div>
    <div class="absolute bottom-[-15%] right-[-10%] w-[45vw] h-[45vw] bg-indigo-200/35 rounded-full blur-[120px] mix-blend-multiply pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
            
            {{-- Left: Typography & CTA --}}
            <div class="w-full lg:w-1/2 max-w-xl relative z-20 shrink-0">
                
                {{-- Interactive Micro Badge --}}
                <a href="{{ route('deals.index') }}" class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/80 backdrop-blur-md border border-gray-200/90 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.05)] hover:border-orange-300 hover:shadow-[0_4px_16px_-4px_rgba(249,115,22,0.15)] transition-all duration-300 group cursor-pointer mb-6">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-semibold tracking-wider text-gray-700 uppercase font-sans">AI Trends 2026</span>
                    <span class="text-gray-300 font-light">|</span>
                    <span class="text-xs font-medium text-orange-600 group-hover:translate-x-0.5 transition-transform flex items-center gap-1">
                        Explore AI Deals
                        <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                {{-- Headline with Editorial Serif & Italic Gradient Accent --}}
                <h1 class="text-4xl sm:text-5xl lg:text-[3.25rem] xl:text-[3.75rem] font-bold text-gray-950 leading-[1.1] mb-5 font-serif tracking-tight">
                    The World of AI,<br/>
                    <span class="italic font-normal text-transparent bg-clip-text bg-gradient-to-r from-gray-900 via-stone-700 to-orange-600">
                        At Your Fingertips.
                    </span>
                </h1>

                {{-- Refined Editorial Description --}}
                <p class="text-base sm:text-lg text-gray-600 mb-8 max-w-lg leading-relaxed font-light">
                    <span class="font-normal text-gray-900">Built for creators and developers.</span> Discover breakthrough AI tools, independent benchmarks, and verified software discounts to stay ahead.
                </p>

                {{-- Interactive CTA Buttons --}}
                <div class="flex flex-wrap items-center gap-4">
                    <a href="#latest" 
                       class="relative group overflow-hidden bg-gray-950 text-white px-8 py-3.5 rounded-full font-medium text-sm transition-all duration-300 shadow-[0_12px_24px_-8px_rgba(0,0,0,0.5)] hover:shadow-[0_20px_35px_-10px_rgba(0,0,0,0.65)] hover:-translate-y-0.5 active:translate-y-0 inline-flex items-center gap-2.5 whitespace-nowrap">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out pointer-events-none"></span>
                        <span>Explore Articles</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="{{ route('deals.index') }}" 
                       class="group bg-white/90 backdrop-blur-sm text-gray-800 border border-gray-200/90 px-8 py-3.5 rounded-full font-medium text-sm transition-all duration-300 shadow-xs hover:bg-gray-900 hover:text-white hover:border-gray-900 hover:-translate-y-0.5 active:translate-y-0 inline-flex items-center gap-2 whitespace-nowrap">
                        <span>Browse AI Deals</span>
                        <svg class="w-4 h-4 transition-transform duration-300 text-gray-400 group-hover:text-white group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                {{-- Micro Trust & Authority Proof --}}
                <div class="mt-8 pt-5 border-t border-gray-200/60 flex flex-wrap items-center gap-5">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-orange-500 to-amber-400 border-2 border-white flex items-center justify-center text-[9px] font-bold text-white shadow-xs">AI</div>
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-500 border-2 border-white flex items-center justify-center text-[9px] font-bold text-white shadow-xs">LLM</div>
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-400 border-2 border-white flex items-center justify-center text-[9px] font-bold text-white shadow-xs">PRO</div>
                        </div>
                        <span class="text-xs font-medium text-gray-700"><strong>Independent</strong> AI Reviews & Deals</span>
                    </div>
                    <div class="hidden sm:block h-3.5 w-px bg-gray-300"></div>
                    <div class="flex items-center gap-1.5 text-xs text-gray-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Hands-on benchmarks & verified discounts</span>
                    </div>
                </div>

            </div>

            {{-- Right: Infinite Curved Path Image Carousel --}}
            <div class="w-full lg:w-1/2 relative h-[520px] lg:h-[580px] overflow-hidden pointer-events-none select-none" id="curved-carousel">
                @php
                    $localCards = [
                        asset('images/carousel/card-1.svg'),
                        asset('images/carousel/card-2.svg'),
                        asset('images/carousel/card-3.svg'),
                        asset('images/carousel/card-5.svg'),
                    ];
                @endphp

                @foreach($localCards as $index => $imgUrl)
                    <div class="carousel-card-item absolute top-0 left-0 w-[260px] h-[170px] sm:w-[280px] sm:h-[185px] rounded-2xl md:rounded-3xl overflow-hidden shadow-[0_20px_50px_-10px_rgba(0,0,0,0.25)] border-4 border-white pointer-events-none select-none bg-[#111827]" 
                         style="will-change: transform, opacity; opacity: 0; transform-origin: center center;">
                        <img src="{{ $imgUrl }}" 
                             alt="AI Hub Visual {{ $index + 1 }}" 
                             class="w-full h-full object-cover pointer-events-none select-none block"
                             loading="eager">
                    </div>
                @endforeach
            </div>

            @push('scripts')
            <script>
            (function() {
                function initCurvedCarousel() {
                    const container = document.getElementById('curved-carousel');
                    if (!container) return;

                    const items = Array.from(container.querySelectorAll('.carousel-card-item'));
                    if (!items.length) return;

                    let progressList = items.map((_, i) => i / items.length);
                    const speed = 0.0016; 
                    let lastTimestamp = performance.now();

                    function step(now) {
                        const delta = Math.min((now - lastTimestamp) / 16.666, 3.0);
                        lastTimestamp = now;

                        const w = container.offsetWidth || 500;
                        const h = container.offsetHeight || 580;
                        
                        const cardW = items[0].offsetWidth || 280;
                        const cardH = items[0].offsetHeight || 185;

                        const startX = w * 0.18;
                        const startY = -cardH * 0.50;
                        
                        const arcWidth = w * 1.15; 
                        const arcHeight = h * 0.88;

                        progressList = progressList.map(p => {
                            let np = p + (speed * delta);
                            return np >= 1 ? np - 1 : np;
                        });

                        for (let i = 0; i < items.length; i++) {
                            const item = items[i];
                            const p = progressList[i];
                            const theta = p * (Math.PI / 2);

                            const x = startX + arcWidth * (1 - Math.cos(theta));
                            const y = startY + arcHeight * Math.sin(theta);

                            let scale;
                            if (p <= 0.48) {
                                scale = 0.45 + (0.73 * Math.sin(p * Math.PI));
                            } else {
                                const exitT = (p - 0.48) / 0.52;
                                scale = 1.18 - (0.83 * Math.pow(exitT, 0.75));
                            }

                            let opacity;
                            if (p < 0.20) {
                                opacity = p / 0.20;
                            } else if (p <= 0.55) {
                                opacity = 1.0;
                            } else {
                                const fadeT = (p - 0.55) / 0.35;
                                opacity = Math.max(0, 1.0 - Math.pow(Math.min(fadeT, 1.0), 0.85));
                            }

                            const rotate = -8 + (24 * p);
                            const zIndex = Math.round((1 - Math.abs(p - 0.48)) * 100);

                            const posX = (x - cardW / 2).toFixed(1);
                            const posY = (y - cardH / 2).toFixed(1);

                            item.style.transform = `translate(${posX}px, ${posY}px) scale(${scale.toFixed(3)}) rotate(${rotate.toFixed(1)}deg)`;
                            item.style.opacity = opacity.toFixed(3);
                            item.style.zIndex = zIndex;
                        }

                        requestAnimationFrame(step);
                    }

                    requestAnimationFrame(step);
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initCurvedCarousel);
                } else {
                    initCurvedCarousel();
                }
            })();
            </script>
            @endpush
            
        </div>
    </div>
</section>

{{-- ======================================================== --}}
{{-- 2. EDITOR'S PICKS / FEATURED STORIES (MAGAZINE GRID)     --}}
{{-- ======================================================== --}}
@if($featuredPosts->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
    <div class="flex flex-wrap items-end justify-between mb-8 border-b border-gray-200 pb-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-950 font-serif tracking-tight">Editor's Picks</h2>
            <p class="text-sm text-gray-500 mt-1">In-depth benchmarks, flagship model comparisons, and essential guides.</p>
        </div>
        <a href="{{ route('posts.index', ['type' => 'review']) }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600 flex items-center gap-1 transition">
            <span>All Reviews</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    @php
        $mainFeatured = $featuredPosts->first();
        $sideFeatured = $featuredPosts->slice(1, 3);
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        {{-- Left Spotlight Card (7 cols) --}}
        @if($mainFeatured)
        <article class="relative lg:col-span-7 bg-white rounded-2xl border border-gray-200/90 shadow-xs hover:shadow-xl hover:border-gray-300 hover:scale-[1.03] hover:-translate-y-1 hover:z-20 transition-all duration-300 ease-out overflow-hidden flex flex-col justify-between group">
            <div>
                <a href="{{ route('posts.show', $mainFeatured->slug) }}" class="block aspect-[16/9] bg-slate-900 overflow-hidden relative">
                    @if($mainFeatured->featured_image)
                        <img src="{{ Storage::url($mainFeatured->featured_image) }}"
                             alt="{{ $mainFeatured->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 flex flex-col items-center justify-center p-6 text-center group-hover:scale-110 transition-transform duration-500">
                            <span class="text-xs font-bold tracking-[0.25em] uppercase text-orange-400 mb-2">FEATURED STORY</span>
                            <span class="text-base font-semibold text-white/90 line-clamp-2 max-w-md">{{ $mainFeatured->category->name ?? 'AI Analysis' }}</span>
                        </div>
                    @endif
                </a>

                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-2.5 mb-3">
                        @if($mainFeatured->category)
                            <a href="{{ route('categories.show', $mainFeatured->category->slug) }}"
                               class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full hover:bg-indigo-100 transition">
                                {{ $mainFeatured->category->name }}
                            </a>
                        @endif
                        <span class="text-xs text-gray-400 uppercase font-medium tracking-wider">
                            {{ ucfirst($mainFeatured->type ?? 'article') }}
                        </span>
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-gray-950 group-hover:text-orange-600 transition leading-snug mb-3">
                        <a href="{{ route('posts.show', $mainFeatured->slug) }}">
                            {{ $mainFeatured->title }}
                        </a>
                    </h3>

                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed line-clamp-3">
                        {{ $mainFeatured->excerpt ?? Str::limit(strip_tags($mainFeatured->content), 160) }}
                    </p>
                </div>
            </div>

            <div class="px-6 sm:px-8 pb-6 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-800">{{ $mainFeatured->author->name ?? 'Editorial Team' }}</span>
                    <span>•</span>
                    <span>{{ $mainFeatured->published_at?->format('M d, Y') }}</span>
                </div>
                <span class="font-semibold text-gray-900 group-hover:text-orange-600 transition">Read story →</span>
            </div>
        </article>
        @endif

        {{-- Right Side Stories Stack (5 cols) --}}
        <div class="lg:col-span-5 flex flex-col justify-between gap-4">
            @foreach($sideFeatured as $sidePost)
                <article class="relative bg-white rounded-2xl border border-gray-200/90 p-4 sm:p-5 shadow-xs hover:shadow-xl hover:border-gray-300 hover:scale-[1.05] hover:-translate-y-0.5 hover:z-20 transition-all duration-300 ease-out flex items-start gap-4 group flex-1">
                    <a href="{{ route('posts.show', $sidePost->slug) }}" class="w-28 h-24 sm:w-32 sm:h-24 rounded-xl overflow-hidden bg-slate-900 shrink-0 block">
                        @if($sidePost->featured_image)
                            <img src="{{ Storage::url($sidePost->featured_image) }}"
                                 alt="{{ $sidePost->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-900 to-indigo-950 flex flex-col items-center justify-center p-2 text-center group-hover:scale-110 transition-transform duration-300">
                                <span class="text-[9px] font-bold tracking-widest uppercase text-orange-400">AI HUB</span>
                                <span class="text-[10px] font-medium text-white/80 mt-0.5 line-clamp-1">{{ $sidePost->category->name ?? 'News' }}</span>
                            </div>
                        @endif
                    </a>

                    <div class="min-w-0 flex-1 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                @if($sidePost->category)
                                    <span class="text-[11px] font-semibold text-indigo-600">{{ $sidePost->category->name }}</span>
                                    <span class="text-gray-300">•</span>
                                @endif
                                <span class="text-[11px] text-gray-400">{{ $sidePost->published_at?->format('M d, Y') }}</span>
                            </div>

                            <h3 class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-orange-600 transition line-clamp-2 leading-snug">
                                <a href="{{ route('posts.show', $sidePost->slug) }}">
                                    {{ $sidePost->title }}
                                </a>
                            </h3>
                        </div>

                        <div class="mt-2 flex items-center justify-between text-[11px] text-gray-400">
                            <span>{{ ucfirst($sidePost->type ?? 'Article') }}</span>
                            <span>{{ number_format($sidePost->views_count) }} views</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ======================================================== --}}
{{-- 3. EXCLUSIVE AI DEALS & PROMO CODES SHOWCASE             --}}
{{-- ======================================================== --}}
@if($featuredDeals->count() > 0)
<section class="bg-white border-y border-gray-200/80 py-16 my-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 border border-rose-200/70 text-[#E11D48] text-xs font-bold uppercase tracking-wider mb-3">
                    <span>Verified Partner Offers</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-950 font-serif tracking-tight">
                    Exclusive AI Tool Deals & Discounts
                </h2>
                <p class="text-sm sm:text-base text-gray-500 mt-1">
                    Save up to 70% on top-rated AI coding assistants, writing workspaces, and generative media platforms.
                </p>
            </div>

            <a href="{{ route('deals.index') }}"
               class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-gray-950 hover:bg-gray-800 text-white text-xs sm:text-sm font-semibold transition shrink-0 self-start sm:self-auto">
                <span>View All Deals</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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

{{-- ======================================================== --}}
{{-- 4. LATEST ARTICLES (9 POSTS, NO PAGINATION)              --}}
{{-- ======================================================== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" id="latest">
    {{-- Categories Filter Bar --}}
    @if($categories->count() > 0)
    <section class="mb-12">
        <div class="flex flex-wrap items-center gap-2.5">
            <span class="text-xs font-semibold text-gray-400 mr-2 uppercase tracking-wider">Browse by Topic:</span>
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-900 text-white rounded-full text-xs sm:text-sm font-medium hover:bg-gray-800 transition shadow-2xs">
                All Topics
            </a>
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="px-4 py-2 bg-white text-gray-600 rounded-full text-xs sm:text-sm font-medium border border-gray-200 hover:border-gray-900 hover:text-gray-900 transition shadow-2xs">
                    {{ $category->name }} <span class="ml-1 text-gray-400">({{ $category->posts_count }})</span>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Latest 9 Articles Grid --}}
    <section>
        <div class="flex flex-wrap items-end justify-between mb-8 border-b border-gray-200 pb-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-950 font-serif tracking-tight">Latest Articles</h2>
                <p class="text-sm text-gray-500 mt-1">Fresh news, tutorials, and practical workflows from our editorial desk.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center group">
                <span>View all articles</span>
                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestPosts as $post)
                @include('posts._card', ['post' => $post])
            @empty
                <div class="col-span-3 text-center py-16 text-gray-500 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-lg">No articles published yet.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('posts.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white border border-gray-300 hover:border-gray-900 hover:bg-gray-900 hover:text-white text-gray-800 text-sm font-semibold transition shadow-2xs">
                <span>Explore Full Article Archive</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </section>

    {{-- ======================================================== --}}
    {{-- 5. WEEKLY AI BRIEFING & DEALS NEWSLETTER BANNER          --}}
    {{-- ======================================================== --}}
    <section class="mt-20">
        <div class="bg-gray-950 rounded-3xl p-8 sm:p-12 lg:p-14 border border-gray-800 shadow-lg relative overflow-hidden">
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7">
                    <span class="inline-block text-xs font-bold uppercase tracking-widest text-orange-400 mb-2">
                        Weekly AI Briefing
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-3">
                        Get Verified AI Tool Deals & Benchmarks in Your Inbox
                    </h2>
                    <p class="text-gray-400 text-sm sm:text-base leading-relaxed max-w-xl">
                        Join developers, founders, and creators receiving our curated weekly digest of newly tested AI software, prompt engineering guides, and exclusive partner promo codes.
                    </p>
                </div>

                <div class="lg:col-span-5">
                    @if(session('success'))
                        <div class="bg-emerald-950/90 border border-emerald-700 text-emerald-200 px-4 py-3.5 rounded-2xl text-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                        @csrf
                        <div class="flex-1">
                            <label for="newsletter-email" class="sr-only">Email address</label>
                            <input type="email"
                                   id="newsletter-email"
                                   name="email"
                                   required
                                   placeholder="Enter your work email..."
                                   class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/15 text-white placeholder-gray-400 text-sm focus:outline-none focus:border-orange-400 focus:bg-white/15 transition">
                        </div>
                        <button type="submit"
                                class="px-6 py-3 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-semibold text-sm transition cursor-pointer whitespace-nowrap shadow-xs">
                            Subscribe Free
                        </button>
                    </form>
                    <p class="text-[11px] text-gray-500 mt-3">
                        No spam. Unsubscribe anytime. Read our <a href="{{ route('pages.show', 'privacy-policy') }}" class="text-gray-400 underline hover:text-white">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
