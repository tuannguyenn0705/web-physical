{{-- E-Commerce Physical Product Affiliate Deal Card --}}
@php
    $seed = ($deal->id ?? 1) * 13;
    $platforms = [
        ['name' => 'Amazon Official', 'color' => 'bg-amber-50 text-amber-800 border-amber-200'],
        ['name' => 'Best Buy', 'color' => 'bg-sky-50 text-sky-700 border-sky-200'],
        ['name' => 'B&H Photo Video', 'color' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
        ['name' => 'Direct Brand Store', 'color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
    ];
    $platform = $platforms[$seed % count($platforms)];
@endphp

<article class="bento-tilt-card relative bg-white rounded-2xl border border-slate-200/80 hover:border-emerald-500/60 p-5 sm:p-6 shadow-[0_2px_10px_-3px_rgba(15,23,42,0.04)] hover:shadow-[0_20px_40px_-12px_rgba(5,150,105,0.12)] transition-all duration-300 ease-out flex flex-col justify-between group">
    <div>
        {{-- Top Row: Product Thumbnail + Discount Badge --}}
        <div class="flex items-start justify-between gap-4 pb-4 mb-4 border-b border-slate-100">
            <a href="{{ route('deals.go', $deal) }}"
               data-affiliate-url="{{ $deal->affiliate_url }}"
               target="_blank"
               rel="noopener noreferrer nofollow"
               class="w-20 h-20 rounded-xl overflow-hidden bg-slate-50 border border-slate-200/80 shrink-0 flex items-center justify-center p-1.5 group-hover:border-slate-300 transition">
                @if($deal->image_url)
                    <img src="{{ $deal->image_url }}"
                         alt="{{ $deal->title }}"
                         class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                @else
                    <div class="w-full h-full rounded-lg bg-gradient-to-br from-slate-900 to-slate-800 flex flex-col items-center justify-center text-white p-2 text-center">
                        <span class="text-[10px] font-mono font-extrabold uppercase text-amber-400">HOT</span>
                        <span class="text-[10px] font-bold text-white mt-0.5 leading-tight">DEAL</span>
                    </div>
                @endif
            </a>

            <div class="flex flex-col items-end text-right">
                <span class="inline-flex items-center gap-1 bg-amber-500 text-slate-950 text-xs font-mono font-extrabold px-3 py-1 rounded-lg shadow-2xs badge-pulse-amber">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $deal->badge_text ?: 'FLASH DEAL' }}</span>
                </span>

                <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold border {{ $platform['color'] }}">
                    {{ $deal->sub_badge_text ?: $platform['name'] }}
                </span>
            </div>
        </div>

        {{-- Middle: Product Deal Title & Highlights --}}
        <div class="flex items-center gap-1.5 text-[11px] font-medium text-emerald-700 mb-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Verified in stock & coupon active</span>
        </div>

        <h3 class="text-base font-extrabold text-slate-900 leading-snug mb-2 group-hover:text-emerald-700 transition">
            <a href="{{ route('deals.go', $deal) }}"
               data-affiliate-url="{{ $deal->affiliate_url }}"
               target="_blank"
               rel="noopener noreferrer nofollow">
                {{ $deal->title }}
            </a>
        </h3>

        @if($deal->description)
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5 line-clamp-2">
                {{ $deal->description }}
            </p>
        @else
            <div class="mb-5"></div>
        @endif
    </div>

    {{-- Bottom Action Row: Copy Voucher + Affiliate CTA --}}
    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2.5">
        @if($deal->coupon_code)
            <button type="button"
                    onclick="navigator.clipboard.writeText('{{ e($deal->coupon_code) }}'); const el = this.querySelector('.coupon-label'); const orig = el.innerText; el.innerText = 'COPIED!'; this.classList.add('border-emerald-500', 'text-emerald-700', 'bg-emerald-50'); setTimeout(() => { el.innerText = orig; this.classList.remove('border-emerald-500', 'text-emerald-700', 'bg-emerald-50'); }, 1800);"
                    title="Click to copy promo code"
                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-50 hover:bg-amber-50 border border-dashed border-slate-300 hover:border-amber-500 rounded-xl text-xs font-mono font-bold text-slate-800 transition cursor-pointer shrink-0">
                <svg class="w-3.5 h-3.5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span class="coupon-label">{{ $deal->coupon_code }}</span>
            </button>
        @else
            <span class="text-[11px] font-mono text-slate-400">Auto-applied at checkout</span>
        @endif

        <a href="{{ route('deals.go', $deal) }}"
           data-affiliate-url="{{ $deal->affiliate_url }}"
           target="_blank"
           rel="noopener noreferrer nofollow"
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition shadow-xs whitespace-nowrap">
            <span>{{ $deal->button_text ?: 'Claim Deal' }}</span>
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
</article>
