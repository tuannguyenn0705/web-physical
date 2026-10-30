@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    
    {{-- ======================================================== --}}
    {{-- BLOCK 1: BREADCRUMB & ARTICLE HEADER                     --}}
    {{-- ======================================================== --}}
    <header class="mb-8 sm:mb-10 max-w-4xl">
        {{-- Breadcrumb navigation --}}
        <nav class="flex items-center flex-wrap gap-2 text-xs sm:text-sm text-gray-500 mb-5">
            <a href="{{ route('home') }}" class="hover:text-gray-900 transition">Home</a>
            <span class="text-gray-300">/</span>
            @if($post->category)
                <a href="{{ route('categories.show', $post->category->slug) }}" class="hover:text-gray-900 transition">
                    {{ $post->category->name }}
                </a>
                <span class="text-gray-300">/</span>
            @endif
            <span class="text-gray-900 font-medium truncate max-w-xs sm:max-w-md">{{ $post->title }}</span>
        </nav>

        {{-- Category & Post Type Badges --}}
        <div class="flex flex-wrap items-center gap-2.5 mb-4">
            @if($post->category)
                <a href="{{ route('categories.show', $post->category->slug) }}"
                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200/70 hover:bg-orange-100 transition">
                    {{ $post->category->name }}
                </a>
            @endif

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                @switch($post->type)
                    @case('news') News @break
                    @case('review') Review @break
                    @case('tutorial') Tutorial @break
                    @default Article
                @endswitch
            </span>

            @php
                $wordCount = str_word_count(strip_tags($post->content));
                $readingMinutes = max(1, (int) ceil($wordCount / 200));
            @endphp
            <span class="text-xs text-gray-400 font-medium">
                {{ $readingMinutes }} min read
            </span>
        </div>

        {{-- H1 Article Title --}}
        <h1 class="text-3xl sm:text-4xl lg:text-[2.75rem] font-extrabold text-gray-950 tracking-tight leading-[1.18] font-sans mb-5">
            {{ $post->title }}
        </h1>

        {{-- Excerpt / Lead Summary --}}
        @if($post->excerpt)
            <div class="text-base sm:text-lg text-gray-600 font-normal leading-relaxed mb-6">
                {{ $post->excerpt }}
            </div>
        @endif

        {{-- Author, Published Date, Views --}}
        <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs sm:text-sm text-gray-500 pt-4 border-t border-gray-200/80">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs font-bold uppercase">
                    {{ substr($post->author->name ?? 'A', 0, 1) }}
                </div>
                <span class="font-medium text-gray-800">{{ $post->author->name ?? 'Editorial Team' }}</span>
            </div>
            <span class="text-gray-300">•</span>
            <span>Published: {{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
            <span class="text-gray-300">•</span>
            <span>{{ number_format($post->views_count) }} views</span>
        </div>
    </header>

    {{-- ======================================================== --}}
    {{-- BLOCK 2: 2-COLUMN EDITORIAL LAYOUT (CONTENT + SIDEBAR)   --}}
    {{-- ======================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start mb-16">
        
        {{-- LEFT COLUMN (8 COLS): ARTICLE CONTENT --}}
        <div class="lg:col-span-8 min-w-0">
            {{-- Featured Image --}}
            @if($post->featured_image)
                <div class="mb-8 rounded-2xl overflow-hidden border border-gray-200/90 shadow-xs bg-gray-100">
                    <img src="{{ Storage::url($post->featured_image) }}" 
                         alt="{{ $post->title }}"
                         class="w-full max-h-[480px] aspect-[16/9] object-cover">
                </div>
            @endif

            {{-- FTC Affiliate Disclosure Notice --}}
            <div class="bg-white border border-gray-200/80 rounded-xl px-4 py-3 text-xs text-gray-500 mb-8 leading-relaxed">
                <strong class="text-gray-700 font-semibold">Transparency Disclosure:</strong>
                We independently test and review AI software. Some links on this page may be partner or affiliate links, meaning we may earn a commission at no extra cost to you. Read our full
                <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="text-gray-800 underline hover:text-orange-600 font-medium">Affiliate Disclosure</a>.
            </div>

            {{-- Auto-Generated Table of Contents (Populated via JS if article has >= 2 headings) --}}
            <div id="article-toc-box" class="bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 mb-8 shadow-2xs hidden">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-900">Table of Contents</span>
                    <span class="text-[11px] text-gray-400">Quick Jump</span>
                </div>
                <ol id="article-toc-list" class="space-y-2 text-sm text-gray-600"></ol>
            </div>

            {{-- Article Body Content --}}
            <article class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-10 shadow-2xs mb-8">
                <div id="article-prose-body" class="prose prose-lg max-w-none text-gray-800 leading-relaxed font-sans prose-headings:font-bold prose-headings:text-gray-950 prose-headings:tracking-tight prose-headings:scroll-mt-28 prose-a:text-orange-600 prose-a:font-medium hover:prose-a:text-orange-700 prose-img:rounded-2xl prose-img:shadow-xs prose-img:border prose-img:border-gray-200/90 prose-img:my-8 prose-blockquote:border-l-4 prose-blockquote:border-orange-500 prose-blockquote:bg-orange-50/50 prose-blockquote:rounded-r-2xl prose-blockquote:py-3 prose-blockquote:px-6 prose-blockquote:italic">
                    {!! $post->content !!}
                </div>

                {{-- Article Tags --}}
                @if($post->tags->count() > 0)
                    <div class="flex flex-wrap items-center gap-2 pt-8 mt-8 border-t border-gray-100">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 mr-2">Related Topics:</span>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                               class="px-3 py-1 bg-gray-100 hover:bg-orange-50 hover:text-orange-700 text-gray-700 rounded-full text-xs font-medium transition border border-gray-200/80">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </article>

            {{-- In-Article Featured Partner Deal Callout --}}
            @if(isset($sidebarDeals) && $sidebarDeals->count() > 0)
                @php $calloutDeal = $sidebarDeals->first(); @endphp
                <div class="bg-white rounded-2xl border border-gray-200/90 p-6 shadow-xs hover:shadow-lg hover:border-gray-300 hover:scale-[1.03] transition-all duration-300 ease-out flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                    <div class="flex items-start sm:items-center gap-4">
                        <a href="{{ route('deals.go', $calloutDeal) }}" target="_blank" rel="noopener noreferrer nofollow"
                           class="w-16 h-16 rounded-lg overflow-hidden bg-stone-100 border border-gray-100 shrink-0 flex items-center justify-center">
                            @if($calloutDeal->image_url)
                                <img src="{{ $calloutDeal->image_url }}" alt="{{ $calloutDeal->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-bold text-gray-700">DEAL</span>
                            @endif
                        </a>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="bg-[#E11D48] text-white text-[11px] font-bold px-2.5 py-0.5 rounded">
                                    {{ $calloutDeal->badge_text ?: 'Deal' }}
                                </span>
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">
                                    {{ $calloutDeal->sub_badge_text ?: 'DISCOUNT DEAL' }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900">
                                <a href="{{ route('deals.go', $calloutDeal) }}" target="_blank" rel="noopener noreferrer nofollow" class="hover:text-[#E11D48] transition">
                                    {{ $calloutDeal->title }}
                                </a>
                            </h3>
                            @if($calloutDeal->description)
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $calloutDeal->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        @if($calloutDeal->coupon_code)
                            <span class="px-2.5 py-1.5 bg-gray-50 border border-dashed border-gray-300 rounded-md text-xs font-mono font-bold text-gray-700">
                                {{ $calloutDeal->coupon_code }}
                            </span>
                        @endif
                        <a href="{{ route('deals.go', $calloutDeal) }}" target="_blank" rel="noopener noreferrer nofollow"
                           class="px-4 py-2 bg-gray-950 hover:bg-gray-800 text-white rounded-lg text-xs font-bold transition whitespace-nowrap">
                            {{ $calloutDeal->button_text ?: 'Shop Now' }} →
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- RIGHT COLUMN (4 COLS): STICKY SIDEBAR --}}
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
            
            {{-- WIDGET 1: EXCLUSIVE AI DEALS --}}
            @if(isset($sidebarDeals) && $sidebarDeals->count() > 0)
                <div class="bg-white rounded-2xl border border-gray-200/90 p-5 sm:p-6 shadow-xs">
                    <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-gray-100">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#E11D48] block">Verified Discounts</span>
                            <h3 class="text-base font-bold text-gray-950">Featured AI Deals</h3>
                        </div>
                        <a href="{{ route('deals.index') }}" class="text-xs font-semibold text-gray-600 hover:text-gray-950 transition">
                            See all →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach($sidebarDeals as $deal)
                            <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50/60 hover:bg-white hover:border-gray-200 hover:shadow-md hover:scale-[1.04] transition-all duration-300 ease-out">
                                <div class="flex items-start justify-between gap-3 mb-2.5">
                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow"
                                       class="w-11 h-11 rounded-md overflow-hidden bg-white border border-gray-200/80 shrink-0 flex items-center justify-center">
                                        @if($deal->image_url)
                                            <img src="{{ $deal->image_url }}" alt="{{ $deal->title }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-[10px] font-bold text-gray-700">DEAL</span>
                                        @endif
                                    </a>
                                    <span class="bg-[#E11D48] text-white text-[10px] font-bold px-2.5 py-1 rounded leading-none">
                                        {{ $deal->badge_text ?: 'Deal' }}
                                    </span>
                                </div>

                                <h4 class="text-sm font-bold text-gray-900 leading-snug mb-1 hover:text-[#E11D48] transition">
                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow">
                                        {{ $deal->title }}
                                    </a>
                                </h4>

                                @if($deal->description)
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ $deal->description }}</p>
                                @endif

                                <div class="flex items-center justify-between gap-2">
                                    <a href="{{ route('deals.go', $deal) }}" target="_blank" rel="noopener noreferrer nofollow"
                                       class="inline-flex items-center justify-center px-3 py-1 bg-white border border-gray-300 rounded text-xs font-bold text-gray-800 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition">
                                        {{ $deal->button_text ?: 'Shop Now' }}
                                    </a>
                                    @if($deal->coupon_code)
                                        <span class="text-[11px] font-mono font-bold text-gray-600 bg-white border border-dashed border-gray-300 px-2 py-0.5 rounded">
                                            {{ $deal->coupon_code }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- WIDGET 2: TRENDING ARTICLES --}}
            @if(isset($trendingPosts) && $trendingPosts->count() > 0)
                <div class="bg-white rounded-2xl border border-gray-200/90 p-5 sm:p-6 shadow-xs">
                    <div class="pb-3.5 mb-4 border-b border-gray-100">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-orange-600 block">Popular Now</span>
                        <h3 class="text-base font-bold text-gray-950">Trending Articles</h3>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach($trendingPosts as $index => $trending)
                            <article class="py-3 first:pt-0 last:pb-0 flex items-start gap-3.5 group">
                                <span class="text-xs font-mono font-bold text-gray-400 pt-0.5">
                                    0{{ $index + 1 }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-orange-600 transition line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $trending->slug) }}">
                                            {{ $trending->title }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center gap-2 text-[11px] text-gray-400 mt-1">
                                        <span>{{ $trending->category->name ?? 'AI News' }}</span>
                                        <span>•</span>
                                        <span>{{ number_format($trending->views_count) }} views</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- WIDGET 3: COMPACT NEWSLETTER BOX --}}
            <div class="bg-gray-950 rounded-2xl p-6 text-white border border-gray-800 shadow-xs">
                <span class="text-[11px] font-bold uppercase tracking-widest text-orange-400 block mb-1">Free Newsletter</span>
                <h3 class="text-base font-bold text-white mb-2">Weekly AI Digest & Deals</h3>
                <p class="text-xs text-gray-400 leading-relaxed mb-4">
                    Get the week's top AI breakthroughs and verified promo codes delivered to your inbox.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2.5">
                    @csrf
                    <input type="email" name="email" required placeholder="you@company.com"
                           class="w-full px-3.5 py-2.5 rounded-xl bg-white/10 border border-white/15 text-xs text-white placeholder-gray-400 focus:outline-none focus:border-orange-400">
                    <button type="submit"
                            class="w-full py-2.5 bg-orange-600 hover:bg-orange-500 text-white rounded-xl text-xs font-semibold transition cursor-pointer">
                        Subscribe Free
                    </button>
                </form>
            </div>

        </aside>
    </div>

    {{-- ======================================================== --}}
    {{-- BLOCK 3: RELATED ARTICLES (3-COLUMN GRID)                --}}
    {{-- ======================================================== --}}
    @if($relatedPosts->count() > 0)
        <section class="border-t border-gray-200/90 pt-10 sm:pt-14">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-600 block mb-1">More in this category</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight font-sans">
                        Related Articles
                    </h2>
                </div>
                <a href="{{ route('posts.index') }}" class="text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-950 transition">
                    View all articles →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($relatedPosts as $related)
                    @include('posts._card', ['post' => $related])
                @endforeach
            </div>
        </section>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const proseBody = document.getElementById('article-prose-body');
    const tocBox = document.getElementById('article-toc-box');
    const tocList = document.getElementById('article-toc-list');
    if (!proseBody) return;

    // Bọc các bảng <table> trong khung cuộn ngang mượt mà trên màn hình nhỏ
    proseBody.querySelectorAll('table').forEach(table => {
        if (!table.parentElement.classList.contains('table-scroll-wrapper')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-scroll-wrapper overflow-x-auto my-6';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });

    if (!tocBox || !tocList) return;

    const headings = Array.from(proseBody.querySelectorAll('h2, h3'))
        .filter(heading => heading.textContent.replace(/\u00a0/g, ' ').trim().length > 0);
    if (headings.length < 2) return;

    headings.forEach((heading, idx) => {
        const text = heading.textContent.replace(/\u00a0/g, ' ').trim();
        const stepNumber = idx + 1;
        const id = heading.id || ('section-' + stepNumber);
        heading.id = id;

        const li = document.createElement('li');
        if (heading.tagName.toLowerCase() === 'h3') {
            li.className = 'pl-4 text-xs';
        }

        const link = document.createElement('a');
        link.href = '#' + id;
        link.className = 'hover:text-orange-600 transition flex items-baseline gap-2';
        link.innerHTML = '<span class="font-mono text-xs text-gray-400">' + stepNumber + '.</span><span>' + text + '</span>';
        li.appendChild(link);
        tocList.appendChild(li);
    });

    if (tocList.children.length >= 2) {
        tocBox.classList.remove('hidden');
    }
});
</script>
@endpush
@endsection
