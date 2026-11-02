@php
    try {
        $headerCategories = \App\Models\Category::active()->root()->orderBy('order')->take(5)->get();
    } catch (\Throwable) {
        $headerCategories = collect();
    }
@endphp

<header x-data="{
        mobileMenuOpen: false,
        searchOpen: false,
        subscribeOpen: false,
        searchQuery: '{{ e(request('search', '')) }}',
        copiedPromo: false
    }"
    @keydown.window.escape="searchOpen = false; subscribeOpen = false; mobileMenuOpen = false"
    @keydown.window.slash.prevent="if (!['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) { searchOpen = true; $nextTick(() => $refs.liveSearchInput?.focus()); }"
    class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200/80 shadow-[0_1px_3px_rgba(15,23,42,0.03)]">

    {{-- 1. TOP ANNOUNCEMENT & FLASH DEAL TICKER BAR --}}
    <div class="bg-slate-900 text-slate-200 border-b border-slate-800 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between gap-4">
            {{-- Left Trust Badge --}}
            <div class="hidden lg:flex items-center gap-2 shrink-0 whitespace-nowrap">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 font-mono text-[10px] font-bold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    100% Lab Tested
                </span>
                <span class="text-slate-400 text-[11px]">We buy all retail units independently for hands-on testing</span>
            </div>

            {{-- Center Live Deal Ticker --}}
            <div class="flex-1 overflow-hidden relative min-w-0">
                <div class="animate-ticker flex items-center gap-10 whitespace-nowrap text-[11px] font-medium">
                    <a href="{{ route('deals.index') }}" class="inline-flex items-center gap-2 hover:text-amber-400 transition">
                        <span class="px-1.5 py-0.5 bg-amber-500 text-slate-950 font-mono font-bold rounded text-[10px] uppercase leading-none">FLASH DEAL</span>
                        <span>Sony WH-1000XM5 drops 28% on Amazon & Best Buy today</span>
                        <span class="text-amber-400 font-semibold">Check Price →</span>
                    </a>
                    <span class="text-slate-700">•</span>
                    <a href="{{ route('posts.index', ['type' => 'review']) }}" class="inline-flex items-center gap-2 hover:text-emerald-400 transition">
                        <span class="px-1.5 py-0.5 bg-emerald-600 text-white font-mono font-bold rounded text-[10px] uppercase leading-none">NEW LAB TEST</span>
                        <span>We tested 14 Custom Mechanical Keyboards & Ergonomic Chairs for 2026</span>
                    </a>
                    <span class="text-slate-700">•</span>
                    <button type="button"
                            @click="navigator.clipboard.writeText('GEARLAB30'); copiedPromo = true; setTimeout(() => copiedPromo = false, 2000)"
                            class="inline-flex items-center gap-1.5 hover:text-amber-300 transition cursor-pointer">
                        <span>Exclusive 15% OFF Anker & Ugreen GaN Chargers:</span>
                        <span class="font-mono font-bold text-amber-400 border border-dashed border-amber-400/50 px-1.5 py-0.5 rounded bg-amber-500/10 leading-none"
                              x-text="copiedPromo ? 'COPIED!' : 'GEARLAB30'">GEARLAB30</span>
                    </button>
                    <span class="text-slate-700">•</span>
                    <a href="{{ route('deals.index') }}" class="inline-flex items-center gap-2 hover:text-amber-400 transition">
                        <span class="px-1.5 py-0.5 bg-amber-500 text-slate-950 font-mono font-bold rounded text-[10px] uppercase leading-none">PRICE DROP</span>
                        <span>Live Robot Vacuum & Smart Home price tracker updated hourly</span>
                    </a>
                </div>
            </div>

            {{-- Right Quick Links --}}
            <div class="hidden sm:flex items-center gap-3.5 shrink-0 whitespace-nowrap text-[11px] text-slate-400">
                <a href="{{ route('pages.show', 'about-us') }}" class="hover:text-white transition">How We Test</a>
                <span class="text-slate-700">|</span>
                <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="hover:text-white transition">Editorial Ethics</a>
            </div>
        </div>
    </div>

    {{-- 2. MAIN COMMERCIAL NAVIGATION BAR --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 sm:h-20 flex items-center justify-between gap-4">

            {{-- Brand Logo (Wirecutter / RTINGS / Uncrate Editorial Style) --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                <div class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-700/80 flex items-center justify-center shadow-sm group-hover:scale-105 transition-all duration-300 relative shrink-0">
                    <svg class="w-6 h-6" viewBox="0 0 64 64" fill="none">
                        <path d="M15 23L28 45L49 17" stroke="#F59E0B" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="48" cy="44" r="5.5" fill="#10B981"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <span class="text-lg sm:text-xl font-extrabold tracking-tight text-slate-900 leading-none whitespace-nowrap">
                            VERDICT<span class="text-amber-500">.</span>LAB
                        </span>
                        <span class="hidden sm:inline-block px-1.5 py-0.5 text-[9px] font-mono font-bold uppercase tracking-widest bg-slate-100 text-slate-700 border border-slate-200 rounded whitespace-nowrap">
                            GEAR & DEALS
                        </span>
                    </div>
                    <span class="text-[10px] font-medium text-slate-500 tracking-wide mt-0.5 whitespace-nowrap">
                        Independent Product Testing & Buying Guides
                    </span>
                </div>
            </a>

            {{-- Center Search Trigger Bar (E-commerce Live Search Style) --}}
            <div class="hidden md:flex flex-1 max-w-md mx-2 lg:mx-4 min-w-0">
                <button type="button"
                        @click="searchOpen = true; $nextTick(() => $refs.liveSearchInput?.focus())"
                        class="w-full flex items-center justify-between gap-3 px-4 py-2.5 rounded-xl bg-slate-100/90 hover:bg-slate-100 border border-slate-200/80 hover:border-slate-300 text-left transition-all cursor-pointer group min-w-0">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-700 transition shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span class="text-xs text-slate-500 truncate">
                            {{ request('search') ? 'Searching: "' . request('search') . '"' : 'Search headphones, keyboards, vacuums, promo codes...' }}
                        </span>
                    </div>
                    <kbd class="hidden lg:inline-flex items-center gap-0.5 px-2 py-0.5 text-[10px] font-mono font-semibold text-slate-500 bg-white border border-slate-200 rounded-md shadow-2xs shrink-0">
                        /
                    </kbd>
                </button>
            </div>

            {{-- Right Commercial Actions --}}
            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                {{-- Mobile Search Icon --}}
                <button type="button"
                        @click="searchOpen = true; $nextTick(() => $refs.liveSearchInput?.focus())"
                        class="md:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition cursor-pointer shrink-0"
                        aria-label="Search products">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                {{-- Top Rankings Button --}}
                <a href="{{ route('posts.index', ['type' => 'review']) }}"
                   class="hidden xl:inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:text-slate-900 hover:bg-slate-100 transition whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 text-amber-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>Top Rankings</span>
                </a>

                {{-- Hot Deals Affiliate Hub CTA --}}
                <a href="{{ route('deals.index') }}"
                   class="inline-flex items-center gap-2 px-3.5 sm:px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold tracking-tight transition shadow-sm badge-pulse-emerald whitespace-nowrap shrink-0">
                    <svg class="w-4 h-4 text-amber-300 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                    </svg>
                    <span>Daily Deals</span>
                    <span class="hidden sm:inline-block px-1.5 py-0.5 text-[10px] font-mono bg-slate-950/30 rounded text-amber-200 leading-none">-30%</span>
                </a>

                {{-- Price Drop Alerts Subscribe Button --}}
                <button type="button"
                        @click="subscribeOpen = true"
                        class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition cursor-pointer whitespace-nowrap shrink-0">
                    <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>Price Alerts</span>
                </button>

                {{-- Mobile Menu Toggle --}}
                <button type="button"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 flex items-center justify-center transition cursor-pointer shrink-0"
                        aria-label="Toggle category menu">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- 3. PHYSICAL PRODUCT CATEGORY SUB-NAVIGATION BAR (SINGLE LINE, NO WRAPPING) --}}
        <nav class="hidden lg:flex items-center justify-between gap-4 h-12 border-t border-slate-200/70 text-xs font-semibold text-slate-600">
            <div class="flex items-center gap-1 overflow-x-auto no-scrollbar py-1 min-w-0">
                <a href="{{ route('home') }}"
                   class="px-3 py-1.5 rounded-lg transition whitespace-nowrap shrink-0 {{ request()->routeIs('home') ? 'bg-slate-900 text-white font-bold' : 'hover:bg-slate-100 hover:text-slate-900' }}">
                    Home
                </a>

                <a href="{{ route('posts.index', ['type' => 'review']) }}"
                   class="px-3 py-1.5 rounded-lg transition inline-flex items-center gap-1.5 whitespace-nowrap shrink-0 {{ request('type') === 'review' ? 'bg-slate-900 text-white font-bold' : 'hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>In-Depth Reviews</span>
                    <span class="px-1.5 py-0.5 text-[9px] font-mono font-bold uppercase bg-amber-100 text-amber-800 rounded leading-none">LAB</span>
                </a>

                <a href="{{ route('posts.index', ['type' => 'tutorial']) }}"
                   class="px-3 py-1.5 rounded-lg transition whitespace-nowrap shrink-0 {{ request('type') === 'tutorial' ? 'bg-slate-900 text-white font-bold' : 'hover:bg-slate-100 hover:text-slate-900' }}">
                    Buying Guides
                </a>

                <a href="{{ route('posts.index', ['type' => 'news']) }}"
                   class="px-3 py-1.5 rounded-lg transition whitespace-nowrap shrink-0 {{ request('type') === 'news' ? 'bg-slate-900 text-white font-bold' : 'hover:bg-slate-100 hover:text-slate-900' }}">
                    Unboxing & First Looks
                </a>

                <span class="h-4 w-px bg-slate-200 mx-1 shrink-0"></span>

                {{-- Dynamic Categories from DB --}}
                @foreach($headerCategories as $navCat)
                    <a href="{{ route('categories.show', $navCat->slug) }}"
                       class="px-3 py-1.5 rounded-lg transition whitespace-nowrap shrink-0 {{ request()->is('categories/' . $navCat->slug) ? 'bg-amber-500 text-slate-950 font-bold' : 'hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $navCat->name }}
                    </a>
                @endforeach
            </div>

            <div class="hidden xl:flex items-center gap-2 shrink-0 whitespace-nowrap text-[11px] text-slate-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                <span>Amazon, Best Buy & Walmart prices synced every 30m</span>
            </div>
        </nav>
    </div>

    {{-- 4. MOBILE EXPANDABLE DRAWER --}}
    <div x-show="mobileMenuOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-t border-slate-200/80 shadow-xl px-4 pt-4 pb-6 space-y-4">

        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('home') }}" class="px-3.5 py-2.5 rounded-xl text-xs font-bold border border-slate-200/80 {{ request()->routeIs('home') ? 'bg-slate-900 text-white' : 'bg-slate-50 text-slate-800' }}">
                Home
            </a>
            <a href="{{ route('posts.index', ['type' => 'review']) }}" class="px-3.5 py-2.5 rounded-xl text-xs font-bold border border-slate-200/80 {{ request('type') === 'review' ? 'bg-slate-900 text-white' : 'bg-slate-50 text-slate-800' }}">
                Lab Reviews
            </a>
            <a href="{{ route('posts.index', ['type' => 'tutorial']) }}" class="px-3.5 py-2.5 rounded-xl text-xs font-bold border border-slate-200/80 {{ request('type') === 'tutorial' ? 'bg-slate-900 text-white' : 'bg-slate-50 text-slate-800' }}">
                Buying Guides
            </a>
            <a href="{{ route('deals.index') }}" class="px-3.5 py-2.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-between">
                <span>Daily Deals</span>
                <span class="px-1.5 py-0.5 text-[10px] font-mono bg-emerald-600 text-white rounded leading-none">HOT</span>
            </a>
        </div>

        @if($headerCategories->count() > 0)
            <div>
                <p class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400 mb-2">Product Categories</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach($headerCategories as $navCat)
                        <a href="{{ route('categories.show', $navCat->slug) }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-900 hover:text-white text-slate-700 transition">
                            {{ $navCat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- 5. LIVE SEARCH MODAL POPUP (WITH HOT PRODUCT TAGS) --}}
    <div x-show="searchOpen"
         x-cloak
         class="fixed inset-0 z-[80] flex items-start justify-center pt-16 sm:pt-24 px-4"
         role="dialog"
         aria-modal="true">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs" @click="searchOpen = false"></div>

        {{-- Search Dialog Panel --}}
        <div class="relative w-full max-w-2xl bg-white rounded-2xl border border-slate-200 shadow-2xl overflow-hidden z-10"
             @click.stop>
            <form action="{{ route('posts.index') }}" method="GET" class="p-4 sm:p-5 border-b border-slate-100">
                <div class="relative flex items-center">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           name="search"
                           x-ref="liveSearchInput"
                           x-model="searchQuery"
                           placeholder="Search product reviews, model numbers, or brands (e.g. Sony XM5, Keychron, Roborock)..."
                           autocomplete="off"
                           class="w-full pl-12 pr-28 py-3.5 bg-slate-50 border border-slate-200/90 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-slate-900 focus:bg-white transition">
                    <div class="absolute right-2 flex items-center gap-1.5">
                        <button type="submit"
                                class="px-4 py-2 bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white text-xs font-bold rounded-lg transition cursor-pointer">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            {{-- Trending Product Searches & Quick Filters --}}
            <div class="p-4 sm:p-5 bg-slate-50/70 space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-slate-400">Trending Product Searches</span>
                        <span class="text-[11px] text-emerald-600 font-semibold">Lab Verified</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['ANC Headphones', 'Wireless Mechanical Keyboards', 'Ergonomic Office Chairs', '140W GaN Chargers', 'Robot Vacuums', '4K OLED Monitors', 'Ultralight Gaming Mice'] as $hotTerm)
                            <a href="{{ route('posts.index', ['search' => $hotTerm]) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200/90 hover:border-amber-500 hover:bg-amber-50/40 text-xs font-medium text-slate-700 hover:text-slate-900 transition shadow-2xs">
                                <svg class="w-3 h-3 text-amber-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $hotTerm }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-200/80 flex items-center justify-between text-xs text-slate-500">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('posts.index', ['type' => 'review']) }}" class="font-semibold text-slate-800 hover:text-amber-600 transition">→ Browse All Lab Reviews</a>
                        <span>•</span>
                        <a href="{{ route('deals.index') }}" class="font-semibold text-emerald-700 hover:text-emerald-800 transition">→ Verified Promo Codes</a>
                    </div>
                    <button type="button" @click="searchOpen = false" class="text-slate-400 hover:text-slate-700 font-mono text-[11px] cursor-pointer">
                        ESC to close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 6. QUICK PRICE DROP / DEAL ALERT SUBSCRIBE MODAL --}}
    <div x-show="subscribeOpen"
         x-cloak
         class="fixed inset-0 z-[80] flex items-center justify-center px-4"
         role="dialog"
         aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs" @click="subscribeOpen = false"></div>

        <div class="relative w-full max-w-md bg-white rounded-2xl border border-slate-200 shadow-2xl p-6 z-10" @click.stop>
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-mono text-[10px] font-bold uppercase tracking-wider">
                        Price Drop Alerts
                    </span>
                    <h3 class="text-lg font-extrabold text-slate-900 mt-1.5">Get Instant Deal Alerts & Lab Verdicts</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Never miss 40%+ retail price drops on Amazon, Best Buy, and B&H, plus our latest hands-on hardware test results every week.
                    </p>
                </div>
                <button type="button" @click="subscribeOpen = false" class="text-slate-400 hover:text-slate-700 p-1 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                @csrf
                <input type="email"
                       name="email"
                       required
                       placeholder="Enter your email address..."
                       class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-slate-900">
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-sm cursor-pointer">
                    Subscribe Free
                </button>
            </form>
            <p class="text-[11px] text-slate-400 mt-3 text-center">
                100% spam-free. Unsubscribe with one click anytime.
            </p>
        </div>
    </div>
</header>
