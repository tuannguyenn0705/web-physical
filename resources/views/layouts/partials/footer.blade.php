@php
    try {
        $footerCategories = \App\Models\Category::active()->root()->orderBy('order')->take(6)->get();
    } catch (\Throwable) {
        $footerCategories = collect();
    }
@endphp

<footer class="bg-slate-900 text-slate-300 mt-20 border-t border-slate-800">
    {{-- 1. E-COMMERCE EDITORIAL TRUST & GUARANTEE STRIP --}}
    <div class="border-b border-slate-800/90 bg-slate-950/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/25 text-amber-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">100% Unbiased Reviews</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">We buy our own retail units and never accept paid placements or sponsored ratings.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Multi-Retailer Price Tracking</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Real-time lowest price comparisons across Amazon, Best Buy, Walmart, and B&H Photo.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 border border-sky-500/25 text-sky-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Rigorous Lab Benchmarks</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Every product undergoes 40+ hours of stress testing, thermal imaging, and durability checks.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/25 text-rose-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Verified Promo Codes</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Direct brand partnerships to bring our readers verified coupons saving up to 40% off MSRP.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MAIN 4-COLUMN EDITORIAL & AFFILIATE FOOTER --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800">

            {{-- Col 1: Brand Identity & Lab Info (4 cols) --}}
            <div class="lg:col-span-4 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-center shadow-sm shrink-0">
                        <svg class="w-6 h-6" viewBox="0 0 64 64" fill="none">
                            <path d="M15 23L28 45L49 17" stroke="#F59E0B" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="48" cy="44" r="5.5" fill="#10B981"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-black text-white tracking-tight block leading-none">
                            VERDICT<span class="text-amber-500 font-black">TC</span><span class="text-slate-400 font-bold text-xs sm:text-sm">.com</span>
                        </span>
                        <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            Physical Product Review Hub
                        </span>
                    </div>
                </a>

                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    The independent publication for hands-on consumer hardware reviews, smart home benchmarks, ergonomic workspace gear, and verified retail deals.
                </p>

                <div class="pt-3 space-y-2 border-t border-slate-800/80 text-xs text-slate-400 max-w-sm">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></span>
                        <span>Testing Labs: 1200 17th St NW, Suite 500, Washington, D.C. 20036</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Press & Review Submissions: <a href="mailto:editorial@verdicttc.com" class="text-white hover:text-amber-400 transition font-medium">editorial@verdicttc.com</a></span>
                    </div>
                </div>
            </div>

            {{-- Col 2: Editorial Sections (2 cols) --}}
            <div class="lg:col-span-2">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white mb-4">Editorial</h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition">Home</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'review']) }}" class="hover:text-amber-400 transition">In-Depth Reviews</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'tutorial']) }}" class="hover:text-amber-400 transition">Buying Guides</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'news']) }}" class="hover:text-amber-400 transition">Unboxing & News</a></li>
                    <li>
                        <a href="{{ route('deals.index') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5 font-semibold text-white">
                            <span>Daily Deals</span>
                            <span class="bg-emerald-600 text-white text-[10px] font-mono font-bold px-1.5 py-0.5 rounded leading-none">HOT</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Col 3: Hardware & Gear Categories (3 cols) --}}
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white mb-4">Product Categories</h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    @forelse($footerCategories as $cat)
                        <li>
                            <a href="{{ route('categories.show', $cat->slug) }}" class="hover:text-amber-400 transition flex items-center justify-between max-w-[220px]">
                                <span>{{ $cat->name }}</span>
                                <span class="text-[11px] font-mono text-slate-600">→</span>
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('posts.index') }}" class="hover:text-amber-400 transition">Audio & ANC Headphones</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-amber-400 transition">Smart Home & Robot Vacuums</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-amber-400 transition">Desk Setup & Peripherals</a></li>
                    @endforelse
                </ul>
            </div>

            {{-- Col 4: Testing Methodology & Legal (3 cols) --}}
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white mb-4">Trust & Policies</h4>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('pages.show', 'about-us') }}" class="hover:text-amber-400 transition">About Us & How We Test</a></li>
                    <li><a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="hover:text-amber-400 transition">FTC Affiliate Disclosure</a></li>
                    <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-amber-400 transition">Privacy Policy</a></li>
                    <li><a href="{{ route('pages.show', 'terms-of-service') }}" class="hover:text-amber-400 transition">Terms of Service</a></li>
                    <li><a href="{{ route('pages.show', 'contact') }}" class="hover:text-amber-400 transition">Contact & Partnerships</a></li>
                    <li><a href="{{ route('sitemap') }}" class="hover:text-amber-400 transition">XML Sitemap</a></li>
                </ul>
            </div>
        </div>

        {{-- 3. FTC AFFILIATE DISCLOSURE & COPYRIGHT --}}
        <div class="pt-8 flex flex-col gap-4 text-xs text-slate-500 leading-relaxed">
            <div class="p-4 rounded-xl bg-slate-950/80 border border-slate-800/80 text-slate-400">
                <strong class="text-amber-400 font-semibold">FTC Affiliate Disclosure:</strong>
                VERDICTTC.com is reader-supported. When you buy physical products through retail links on our site (such as Amazon, Best Buy, Walmart, or B&H), we may earn an affiliate commission at <strong>no additional cost to you</strong>. Our laboratory test scores and editorial picks are 100% independent.
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-2 text-slate-500">
                <p>&copy; {{ date('Y') }} VERDICTTC.com LLC &bull; Washington, D.C., USA. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-slate-300 transition">Privacy</a>
                    <a href="{{ route('pages.show', 'terms-of-service') }}" class="hover:text-slate-300 transition">Terms</a>
                    <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="hover:text-slate-300 transition">Disclosure</a>
                    <a href="{{ route('pages.show', 'contact') }}" class="hover:text-slate-300 transition">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>
