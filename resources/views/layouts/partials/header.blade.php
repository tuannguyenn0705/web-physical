{{-- Taste Skill Split Floating Navbar (Logo Left Pill + Navigation Right Pill) --}}
<header id="floatingNavbar" 
        class="fixed top-0 left-0 right-0 z-50 flex justify-center px-4 sm:px-6 lg:px-8 pt-6 sm:pt-7 pointer-events-none transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] translate-y-0 opacity-100">
    
    <div class="w-full max-w-7xl flex items-center justify-between">
        
        {{-- 1. LEFT PILL: Brand & Logo (Taste Skill Style) --}}
        <a href="{{ route('home') }}" 
           class="pointer-events-auto group/logo bg-white/95 backdrop-blur-xl border border-gray-200/90 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:shadow-[0_6px_25px_-4px_rgba(0,0,0,0.12)] hover:border-gray-300 rounded-2xl px-4 py-2 flex items-center gap-3 transition-all duration-300 hover:scale-[1.02] active:scale-95 cursor-pointer">
            
            {{-- Fire / AI Icon Badge --}}
            <div class="w-7 h-7 rounded-xl bg-gray-950 flex items-center justify-center shadow-xs group-hover/logo:bg-orange-600 transition-colors duration-300 flex-shrink-0">
                <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover/logo:scale-110" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C10.5 4.5 10 6.5 10 8.5C10 9.8 10.5 11 11.2 11.9C9.5 11.5 8 10.3 8 8C5.5 10.5 4 13.5 4 16.5C4 20.6 7.6 24 12 24C16.4 24 20 20.6 20 16.5C20 12.2 16.5 7.5 12 2ZM12 21.5C9.5 21.5 7.5 19.5 7.5 17C7.5 15.2 8.5 13.5 9.8 12.5C10.2 13.8 11 15 12.2 15.8C12.8 16.2 13.5 16.5 14.2 16.5C14.8 16.5 15.2 16.2 15.5 15.8C16.1 16.8 16.5 17.8 16.5 19C16.5 20.4 14.5 21.5 12 21.5Z"/>
                </svg>
            </div>
            
            <div class="flex items-center gap-1.5">
                <span class="text-sm font-bold text-gray-900 tracking-tight font-sans">
                    AI Hub Insider
                </span>
                <span class="text-[10px] font-semibold text-orange-600 bg-orange-50 border border-orange-200/60 px-1.5 py-0.5 rounded-md uppercase font-mono">
                    2026
                </span>
            </div>
        </a>

        {{-- 2. RIGHT PILL: Navigation Links & Action Button (Taste Skill Style) --}}
        <div class="pointer-events-auto bg-white/95 backdrop-blur-xl border border-gray-200/90 shadow-[0_4px_25px_-4px_rgba(0,0,0,0.06)] rounded-full px-3 py-1.5 flex items-center gap-2 sm:gap-3.5 transition-all duration-300">
            
            {{-- Navigation Links with Sliding Black Indicator Pill --}}
            <nav id="navItemsList" class="relative hidden md:flex items-center p-0.5">
                {{-- Sliding Black Pill Indicator --}}
                <div id="navIndicator" 
                     class="absolute bg-gray-950 rounded-full pointer-events-none shadow-xs z-0"
                     style="opacity: 0; left: 0; top: 0; width: 0; height: 0;"></div>

                @php
                    $navItems = [
                        ['label' => 'Home', 'route' => route('home'), 'active' => request()->routeIs('home')],
                        ['label' => 'News', 'route' => route('posts.index', ['type' => 'news']), 'active' => request('type') === 'news'],
                        ['label' => 'Reviews', 'route' => route('posts.index', ['type' => 'review']), 'active' => request('type') === 'review'],
                        ['label' => 'Tutorials', 'route' => route('posts.index', ['type' => 'tutorial']), 'active' => request('type') === 'tutorial'],
                        ['label' => 'Deals', 'route' => route('deals.index'), 'active' => request()->routeIs('deals.*')],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ $item['route'] }}" 
                       data-nav-item
                       data-active="{{ $item['active'] ? 'true' : 'false' }}"
                       class="nav-link-item relative z-10 px-3.5 py-1.5 rounded-full text-xs font-medium transition-colors duration-200 select-none {{ $item['active'] ? 'text-white font-semibold' : 'text-gray-600' }}">
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- Divider --}}
            <div class="hidden md:block w-px h-4 bg-gray-200"></div>

            {{-- Quick Search Trigger --}}
            <button type="button" 
                    id="searchTriggerBtn"
                    onclick="toggleSearchModal(event)"
                    title="Search articles"
                    class="w-7 h-7 rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-900 flex items-center justify-center transition-all cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            {{-- Subscribe CTA Pill Button --}}
            <button type="button"
                    id="subscribeTriggerBtn"
                    onclick="toggleSubscribeModal(event)"
                    class="bg-gray-950 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-1.5 rounded-full shadow-xs hover:shadow-md hover:scale-105 active:scale-95 transition-all duration-200 flex items-center gap-1.5 cursor-pointer whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Subscribe</span>
            </button>

            {{-- Mobile Menu Hamburger Toggle --}}
            <button type="button" 
                    onclick="toggleMobileMenu()"
                    class="md:hidden w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-800 flex items-center justify-center transition-all">
                <svg id="hamburgerIcon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="closeIcon" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- Expandable Search Modal Popover --}}
    <div id="navSearchModal" class="pointer-events-auto fixed top-24 left-4 right-4 max-w-md mx-auto bg-white/95 backdrop-blur-2xl border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl p-3 hidden z-50 transition-all duration-300">
        <form action="{{ route('posts.index') }}" method="GET" class="relative flex items-center">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" id="navSearchInput" placeholder="Search AI tools, news, tutorials..."
                   value="{{ request('search') }}"
                   autocomplete="off"
                   class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2 pl-10 pr-24 text-xs text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500">
            <button type="submit" class="absolute right-1.5 px-3 py-1 bg-gray-950 hover:bg-gray-800 text-white text-[11px] font-semibold rounded-lg transition-colors cursor-pointer">
                Search
            </button>
        </form>
    </div>

    {{-- Expandable Quick Subscribe Modal Popover --}}
    <div id="navSubscribeModal" class="pointer-events-auto fixed top-24 left-4 right-4 max-w-md mx-auto bg-white/95 backdrop-blur-2xl border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl p-5 hidden z-50 transition-all duration-300">
        <div class="flex items-start justify-between gap-3 mb-3">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-orange-600 block">Weekly AI Briefing</span>
                <h4 class="text-sm font-bold text-gray-900">Get AI News & Exclusive Deals</h4>
                <p class="text-xs text-gray-500 mt-0.5">Delivered free to your inbox every week. No spam.</p>
            </div>
            <button type="button" onclick="closeSubscribeModal()" class="text-gray-400 hover:text-gray-700 p-1 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex items-center gap-2">
            @csrf
            <input type="email" name="email" id="navSubscribeInput" required placeholder="Enter your email address..."
                   class="flex-1 bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-900">
            <button type="submit" class="px-4 py-2.5 bg-gray-950 hover:bg-orange-600 text-white text-xs font-semibold rounded-xl transition-colors cursor-pointer whitespace-nowrap">
                Join Free
            </button>
        </form>
    </div>

    {{-- Mobile Expandable Floating Sheet --}}
    <div id="mobileMenuSheet" 
         class="pointer-events-auto fixed top-24 left-4 right-4 max-w-xs mx-auto bg-white/95 backdrop-blur-2xl border border-gray-200 shadow-[0_25px_60px_rgba(0,0,0,0.15)] rounded-3xl p-5 transition-all duration-300 opacity-0 scale-95 pointer-events-none hidden z-50">
        
        <div class="flex flex-col space-y-2 text-center">
            @foreach($navItems as $item)
                <a href="{{ $item['route'] }}" 
                   class="text-sm font-medium py-2 px-4 rounded-xl transition-all {{ $item['active'] ? 'bg-gray-950 text-white font-semibold shadow-xs' : 'text-gray-700 hover:text-gray-950 hover:bg-gray-100' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</header>

{{-- Smart Auto-Hide on Scroll Down & Show on Scroll Up + Modal Scripts --}}
<script>
(function() {
    let lastScrollY = window.scrollY;
    const navbar = document.getElementById('floatingNavbar');

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        // At top of page: always show
        if (currentScrollY <= 40) {
            navbar.classList.remove('-translate-y-28', 'opacity-0');
            navbar.classList.add('translate-y-0', 'opacity-100');
            lastScrollY = currentScrollY;
            return;
        }

        // Scrolling DOWN -> Hide completely
        if (currentScrollY > lastScrollY && currentScrollY > 80) {
            navbar.classList.remove('translate-y-0', 'opacity-100');
            navbar.classList.add('-translate-y-28', 'opacity-0');
            
            closeSearchModal();
            closeSubscribeModal();
        } 
        // Scrolling UP -> Reveal smoothly
        else if (currentScrollY < lastScrollY) {
            navbar.classList.remove('-translate-y-28', 'opacity-0');
            navbar.classList.add('translate-y-0', 'opacity-100');
        }

        lastScrollY = currentScrollY;
    }, { passive: true });
})();

function openSearchModal() {
    closeSubscribeModal();
    const modal = document.getElementById('navSearchModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    const input = document.getElementById('navSearchInput') || modal.querySelector('input[name="search"]');
    if (input) {
        setTimeout(() => {
            input.focus();
            input.select();
        }, 50);
    }
}

function closeSearchModal() {
    const modal = document.getElementById('navSearchModal');
    if (modal && !modal.classList.contains('hidden')) {
        modal.classList.add('hidden');
    }
}

function toggleSearchModal(event) {
    if (event) {
        event.stopPropagation();
    }
    const modal = document.getElementById('navSearchModal');
    if (!modal) return;
    
    if (modal.classList.contains('hidden')) {
        openSearchModal();
    } else {
        closeSearchModal();
    }
}

function openSubscribeModal() {
    closeSearchModal();
    const modal = document.getElementById('navSubscribeModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    const input = document.getElementById('navSubscribeInput');
    if (input) {
        setTimeout(() => {
            input.focus();
        }, 50);
    }
}

function closeSubscribeModal() {
    const modal = document.getElementById('navSubscribeModal');
    if (modal && !modal.classList.contains('hidden')) {
        modal.classList.add('hidden');
    }
}

function toggleSubscribeModal(event) {
    if (event) {
        event.stopPropagation();
    }
    const modal = document.getElementById('navSubscribeModal');
    if (!modal) return;

    if (modal.classList.contains('hidden')) {
        openSubscribeModal();
    } else {
        closeSubscribeModal();
    }
}

// Click outside or Escape key to dismiss modals
document.addEventListener('click', function(event) {
    const searchModal = document.getElementById('navSearchModal');
    const searchTrigger = document.getElementById('searchTriggerBtn');
    if (searchModal && !searchModal.classList.contains('hidden')) {
        if (!searchModal.contains(event.target) && (!searchTrigger || !searchTrigger.contains(event.target))) {
            closeSearchModal();
        }
    }

    const subModal = document.getElementById('navSubscribeModal');
    const subTrigger = document.getElementById('subscribeTriggerBtn');
    if (subModal && !subModal.classList.contains('hidden')) {
        if (!subModal.contains(event.target) && (!subTrigger || !subTrigger.contains(event.target))) {
            closeSubscribeModal();
        }
    }
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeSearchModal();
        closeSubscribeModal();
    }
});

function toggleMobileMenu() {
    const sheet = document.getElementById('mobileMenuSheet');
    const hamburger = document.getElementById('hamburgerIcon');
    const close = document.getElementById('closeIcon');

    if (sheet.classList.contains('hidden')) {
        sheet.classList.remove('hidden');
        setTimeout(() => {
            sheet.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            sheet.classList.add('opacity-100', 'scale-100');
        }, 10);
        hamburger.classList.add('hidden');
        close.classList.remove('hidden');
    } else {
        sheet.classList.remove('opacity-100', 'scale-100');
        sheet.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
        setTimeout(() => {
            sheet.classList.add('hidden');
        }, 300);
        hamburger.classList.remove('hidden');
        close.classList.add('hidden');
    }
}

// --------------------------------------------------------------------------
// Sliding Black Pill Nav Indicator (Gooey / Magnetic Pill Tabs)
// --------------------------------------------------------------------------
(function initSlidingNavIndicator() {
    const navList = document.getElementById('navItemsList');
    const indicator = document.getElementById('navIndicator');
    if (!navList || !indicator) return;

    const links = Array.from(navList.querySelectorAll('.nav-link-item'));
    const activeLink = navList.querySelector('.nav-link-item[data-active="true"]');

    function positionIndicator(target, animate = true) {
        if (!target) {
            indicator.style.opacity = '0';
            links.forEach(l => {
                l.classList.remove('text-white', 'font-semibold');
                l.classList.add('text-gray-600');
            });
            return;
        }

        const navRect = navList.getBoundingClientRect();
        const targetRect = target.getBoundingClientRect();

        const left = targetRect.left - navRect.left;
        const top = targetRect.top - navRect.top;
        const width = targetRect.width;
        const height = targetRect.height;

        if (!animate) {
            indicator.style.transition = 'none';
        } else {
            indicator.style.transition = 'left 280ms cubic-bezier(0.16, 1, 0.3, 1), top 280ms cubic-bezier(0.16, 1, 0.3, 1), width 280ms cubic-bezier(0.16, 1, 0.3, 1), height 280ms cubic-bezier(0.16, 1, 0.3, 1), opacity 200ms ease';
        }

        indicator.style.left = `${left}px`;
        indicator.style.top = `${top}px`;
        indicator.style.width = `${width}px`;
        indicator.style.height = `${height}px`;
        indicator.style.opacity = '1';

        // Update text colors: item under indicator turns white, others turn gray
        links.forEach(l => {
            if (l === target) {
                l.classList.remove('text-gray-600');
                l.classList.add('text-white', 'font-semibold');
            } else {
                l.classList.remove('text-white', 'font-semibold');
                l.classList.add('text-gray-600');
            }
        });
    }

    function initActive() {
        if (activeLink) {
            positionIndicator(activeLink, false);
            // Re-arm smooth transition for user hover interactions
            requestAnimationFrame(() => {
                indicator.style.transition = 'left 280ms cubic-bezier(0.16, 1, 0.3, 1), top 280ms cubic-bezier(0.16, 1, 0.3, 1), width 280ms cubic-bezier(0.16, 1, 0.3, 1), height 280ms cubic-bezier(0.16, 1, 0.3, 1), opacity 200ms ease';
            });
        } else {
            indicator.style.opacity = '0';
        }
    }

    // Hover effect: glide pill to hovered item and change text color
    links.forEach(link => {
        link.addEventListener('mouseenter', () => {
            positionIndicator(link, true);
        });
    });

    // Mouse leave: glide pill back to active page item
    navList.addEventListener('mouseleave', () => {
        if (activeLink) {
            positionIndicator(activeLink, true);
        } else {
            positionIndicator(null, true);
        }
    });

    // Run on load and after fonts ready or window resize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initActive);
    } else {
        initActive();
    }

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            if (activeLink) positionIndicator(activeLink, false);
        });
    }

    window.addEventListener('resize', () => {
        if (activeLink) positionIndicator(activeLink, false);
    });
})();
</script>
