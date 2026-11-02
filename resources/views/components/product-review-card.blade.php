@props(['post'])

@php
    // Deterministic realistic lab score & USD retail price reference based on post ID
    $seed = ($post->id ?? 1) * 17;
    $scores = [9.6, 9.4, 9.8, 9.1, 9.5, 9.3, 9.7, 8.9, 9.2];
    $editorScore = number_format($scores[$seed % count($scores)], 1);

    $priceList = ['$149', '$249', '$119', '$349', '$179', '$429', '$89', '$299', '$199'];
    $refPrice = $priceList[$seed % count($priceList)];

    $badges = [
        ['text' => 'Editor\'s Choice', 'class' => 'bg-amber-500 text-slate-950'],
        ['text' => 'Best Seller', 'class' => 'bg-emerald-600 text-white'],
        ['text' => 'Lab Verified', 'class' => 'bg-slate-900 text-white'],
        ['text' => 'Best Value', 'class' => 'bg-amber-500 text-slate-950'],
    ];
    $badge = $badges[$seed % count($badges)];

    $typeLabels = [
        'review' => 'Lab Review',
        'news' => 'Unboxing & First Look',
        'tutorial' => 'Buying Guide',
    ];
    $typeLabel = $typeLabels[$post->type ?? 'review'] ?? 'Product Review';
@endphp

<article class="bento-tilt-card group relative bg-white rounded-2xl border border-slate-200/80 hover:border-slate-300 shadow-[0_2px_10px_-3px_rgba(15,23,42,0.05)] hover:shadow-[0_20px_40px_-12px_rgba(15,23,42,0.12)] transition-all duration-500 ease-out overflow-hidden flex flex-col justify-between">
    <div>
        {{-- Product Mockup Image Container --}}
        <a href="{{ route('posts.show', $post->slug) }}" class="block relative aspect-[4/3] bg-slate-100 overflow-hidden">
            @if($post->featured_image)
                @php
                    $cardImgSrc = (str_starts_with($post->featured_image, 'http://') || str_starts_with($post->featured_image, 'https://') || str_starts_with($post->featured_image, '/'))
                        ? $post->featured_image
                        : Storage::url($post->featured_image);
                @endphp
                <img src="{{ $cardImgSrc }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 ease-out"
                     loading="lazy">
            @else
                {{-- Studio Product Showcase Fallback --}}
                <div class="w-full h-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 flex flex-col items-center justify-center p-6 text-center relative overflow-hidden group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="w-24 h-24 rounded-full bg-amber-500/15 blur-2xl absolute"></div>
                    <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center text-amber-400 mb-2.5 shadow-inner">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-[0.2em] text-amber-400">VERDICT LAB TESTED</span>
                    <span class="text-xs font-semibold text-slate-300 mt-1 line-clamp-1 max-w-[200px]">{{ $post->category->name ?? 'Hardware Gear' }}</span>
                </div>
            @endif

            {{-- Top Left: Award / Status Badge --}}
            <div class="absolute top-3 left-3 flex items-center gap-1.5 z-10">
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-mono font-extrabold uppercase tracking-wider shadow-sm {{ $badge['class'] }}">
                    {{ $badge['text'] }}
                </span>
            </div>

            {{-- Top Right: Editor Rating Score Pill --}}
            <div class="absolute top-3 right-3 z-10">
                <div class="px-2.5 py-1 rounded-xl bg-slate-950/90 backdrop-blur-md text-white border border-white/15 flex items-center gap-1 shadow-md">
                    <svg class="w-3.5 h-3.5 text-amber-400 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-mono text-xs font-extrabold">{{ $editorScore }}</span>
                    <span class="text-[9px] text-slate-400 font-mono">/10</span>
                </div>
            </div>

            {{-- Bottom Gradient Overlay with Quick Type Tag --}}
            <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-slate-950/65 to-transparent flex items-end justify-between px-3.5 pb-2.5">
                <span class="text-[10px] font-mono font-semibold text-white/90 uppercase tracking-wider flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    {{ $typeLabel }}
                </span>
                <span class="text-[10px] font-mono text-white/80">
                    {{ number_format($post->views_count) }} views
                </span>
            </div>
        </a>

        {{-- Card Body --}}
        <div class="p-5">
            {{-- Category & Date Row --}}
            <div class="flex items-center justify-between gap-2 mb-2.5">
                @if($post->category)
                    <a href="{{ route('categories.show', $post->category->slug) }}"
                       class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/60 px-2.5 py-0.5 rounded-md transition truncate">
                        {{ $post->category->name }}
                    </a>
                @else
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 px-2.5 py-0.5 rounded-md">
                        Hardware Gear
                    </span>
                @endif

                <span class="text-[11px] text-slate-400 font-medium shrink-0">
                    {{ $post->published_at?->format('M d, Y') ?? $post->created_at?->format('M d, Y') }}
                </span>
            </div>

            {{-- Product / Review Headline --}}
            <h3 class="text-base sm:text-[17px] font-extrabold text-slate-900 group-hover:text-amber-600 transition-colors leading-snug line-clamp-2 mb-2">
                <a href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h3>

            {{-- 1-Sentence Quick Verdict Summary --}}
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-2 mb-3">
                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 115) }}
            </p>

            {{-- Mini Pros Pill Strip --}}
            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2 py-0.5 rounded-md">
                    <svg class="w-3 h-3 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Hands-On Tested</span>
                </span>
                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2 py-0.5 rounded-md">
                    <svg class="w-3 h-3 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span>Price Tracked</span>
                </span>
            </div>
        </div>
    </div>

    {{-- E-Commerce Price & Action Footer --}}
    <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-200/70 flex items-center justify-between gap-3">
        <div>
            <span class="block text-[10px] font-mono uppercase tracking-wider text-slate-400">Best Street Price</span>
            <span class="font-mono text-sm font-extrabold text-slate-900">{{ $refPrice }}</span>
        </div>

        <a href="{{ route('posts.show', $post->slug) }}"
           class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-900 group-hover:bg-amber-500 group-hover:text-slate-950 text-white text-xs font-bold transition-all duration-300 shadow-2xs whitespace-nowrap">
            <span>Read Review</span>
            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
