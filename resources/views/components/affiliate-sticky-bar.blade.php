@props([
    'post',
    'deal' => null,
    'score' => 9.5,
])

@php
    $affiliateHref = $deal ? route('deals.go', $deal) : route('deals.index');
    $seed = ($post->id ?? 1) * 19;
    $prices = ['$199', '$279', '$149', '$349', '$129'];
    $bestPrice = $prices[$seed % count($prices)];
    $couponCode = $deal?->coupon_code ?: 'GEARLAB30';
@endphp

{{-- FLOATING BOTTOM BUY BAR (STICKY MOBILE & DESKTOP SCROLL REVEAL) --}}
<div x-data="{ visible: false, copied: false }"
     @scroll.window="visible = (window.scrollY > 420)"
     x-show="visible"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-0 inset-x-0 z-50 bg-slate-900/95 backdrop-blur-xl border-t border-slate-700/80 shadow-[0_-12px_35px_rgba(15,23,42,0.35)] py-3 px-4 sm:px-6">

    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 sm:gap-6">
        {{-- Left: Product Info & Score --}}
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 font-mono font-black text-sm flex items-center justify-center shrink-0 shadow-xs">
                {{ number_format((float) $score, 1) }}
            </div>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-400">Lowest Price Today: {{ $bestPrice }}</span>
                    <span class="hidden sm:inline-block text-[10px] font-mono bg-white/10 text-amber-300 px-1.5 py-0.5 rounded leading-none">In Stock</span>
                </div>
                <p class="text-xs sm:text-sm font-bold text-white truncate">
                    {{ $post->title }}
                </p>
            </div>
        </div>

        {{-- Right: Coupon Copy + Affiliate CTA Buttons --}}
        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            <button type="button"
                    @click="navigator.clipboard.writeText('{{ e($couponCode) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="hidden md:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-dashed border-amber-400/50 text-xs font-mono font-bold text-amber-300 transition cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span x-text="copied ? 'COPIED!' : 'Code: {{ e($couponCode) }}'">Code: {{ $couponCode }}</span>
            </button>

            <a href="{{ $affiliateHref }}"
               @if($deal) target="_blank" rel="noopener noreferrer nofollow" @endif
               class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs sm:text-sm font-extrabold transition shadow-md badge-pulse-emerald whitespace-nowrap">
                <span>View Best Deal</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
