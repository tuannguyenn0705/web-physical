{{-- HakoReview-style Deal Card Component --}}
<article class="relative bg-white rounded-2xl border border-gray-200/90 p-6 shadow-xs hover:shadow-xl hover:border-gray-300 hover:scale-[1.06] hover:-translate-y-1 hover:z-20 transition-all duration-300 ease-out flex flex-col justify-between group">
    <div>
        {{-- Top Section: Left Square Thumbnail + Right "Deal" & "DISCOUNT DEAL" --}}
        <div class="flex items-start justify-between gap-4 pb-5 mb-4 border-b border-gray-100">
            {{-- Left Square Image (80x80px) --}}
            <a href="{{ route('deals.go', $deal) }}"
               data-affiliate-url="{{ $deal->affiliate_url }}"
               target="_blank"
               rel="noopener noreferrer nofollow"
               class="w-20 h-20 rounded-md overflow-hidden bg-stone-100 border border-gray-100 shrink-0 flex items-center justify-center">
                @if($deal->image_url)
                    <img src="{{ $deal->image_url }}"
                         alt="{{ $deal->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-950 flex flex-col items-center justify-center text-white p-2 text-center group-hover:scale-110 transition-transform duration-300">
                        <span class="text-xs font-extrabold tracking-wider uppercase text-orange-400">AI</span>
                        <span class="text-[10px] font-semibold text-slate-200 mt-0.5 leading-tight">DEAL</span>
                    </div>
                @endif
            </a>

            {{-- Right Red "Deal" Badge & "DISCOUNT DEAL" Subtitle --}}
            <div class="flex flex-col items-end text-right pt-1">
                <span class="inline-flex items-center justify-center bg-[#E11D48] text-white text-xs font-bold px-3.5 py-1.5 rounded-md leading-none">
                    {{ $deal->badge_text ?: 'Deal' }}
                </span>
                <span class="text-[11px] font-semibold tracking-wider text-gray-400 uppercase mt-2.5">
                    {{ $deal->sub_badge_text ?: 'DISCOUNT DEAL' }}
                </span>
            </div>
        </div>

        {{-- Middle Section: Bold Offer Title & Muted Description --}}
        <h3 class="text-[15px] sm:text-base font-bold text-gray-900 leading-snug mb-1.5 hover:text-[#E11D48] transition">
            <a href="{{ route('deals.go', $deal) }}"
               data-affiliate-url="{{ $deal->affiliate_url }}"
               target="_blank"
               rel="noopener noreferrer nofollow">
                {{ $deal->title }}
            </a>
        </h3>

        @if($deal->description)
            <p class="text-xs sm:text-sm text-gray-500 leading-relaxed mb-5 line-clamp-2">
                {{ $deal->description }}
            </p>
        @else
            <div class="mb-5"></div>
        @endif
    </div>

    {{-- Bottom Section: Outlined "Shop Now" Button + Optional Copyable Coupon Code --}}
    <div class="flex items-center justify-between gap-2 pt-1">
        <a href="{{ route('deals.go', $deal) }}"
           data-affiliate-url="{{ $deal->affiliate_url }}"
           target="_blank"
           rel="noopener noreferrer nofollow"
           class="inline-flex items-center justify-center px-4 py-1.5 bg-white border border-gray-300 rounded-md text-xs font-bold text-gray-800 hover:bg-gray-900 hover:text-white hover:border-gray-900 transition duration-200">
            {{ $deal->button_text ?: 'Shop Now' }}
        </a>

        @if($deal->coupon_code)
            <button type="button"
                    onclick="navigator.clipboard.writeText('{{ e($deal->coupon_code) }}'); const el = this.querySelector('.coupon-label'); const orig = el.innerText; el.innerText = 'COPIED!'; this.classList.add('border-emerald-500', 'text-emerald-700', 'bg-emerald-50'); setTimeout(() => { el.innerText = orig; this.classList.remove('border-emerald-500', 'text-emerald-700', 'bg-emerald-50'); }, 1800);"
                    title="Click to copy promo code"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1.5 bg-gray-50 hover:bg-gray-100 border border-dashed border-gray-300 hover:border-gray-500 rounded-md text-[11px] font-mono font-bold text-gray-700 transition cursor-pointer">
                <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span class="coupon-label">{{ $deal->coupon_code }}</span>
            </button>
        @endif
    </div>
</article>
