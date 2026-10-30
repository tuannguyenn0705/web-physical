{{-- Professional 4-Column International Footer with FTC Affiliate Disclosure --}}
<footer class="bg-gray-950 text-gray-300 mt-16 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-gray-800/80">
            
            {{-- Col 1: Brand & Editorial Mission (4 cols) --}}
            <div class="lg:col-span-4 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-xl bg-orange-600 flex items-center justify-center text-white font-bold text-xs">
                        AI
                    </div>
                    <span class="text-lg font-bold text-white tracking-tight">AI Hub Insider</span>
                </a>
                <p class="text-sm text-gray-400 leading-relaxed max-w-sm">
                    Independent artificial intelligence news, hands-on software benchmarks, practical tutorials, and verified promo codes for developers and creators worldwide.
                </p>
                <div class="pt-2 text-xs text-gray-400 space-y-2 border-t border-gray-800/80 max-w-sm">
                    <div class="flex items-start gap-2.5 text-gray-300">
                        <svg class="w-4 h-4 text-orange-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div class="leading-relaxed">
                            <span class="text-gray-500 uppercase tracking-wider text-[10px] font-bold block">U.S. Headquarters</span>
                            <span>1200 17th St NW, Suite 500, Washington, D.C. 20036, United States</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 pt-0.5">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span><span class="text-gray-500">Contact & Partnerships:</span> <a href="mailto:aihubinsider@gmail.com" class="text-gray-300 hover:text-white transition">aihubinsider@gmail.com</a></span>
                    </div>
                </div>
            </div>

            {{-- Col 2: Explore Sections (2 cols) --}}
            <div class="lg:col-span-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Explore</h4>
                <ul class="space-y-2.5 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'news']) }}" class="hover:text-white transition">AI News</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'review']) }}" class="hover:text-white transition">Tool Reviews</a></li>
                    <li><a href="{{ route('posts.index', ['type' => 'tutorial']) }}" class="hover:text-white transition">Tutorials & Guides</a></li>
                    <li>
                        <a href="{{ route('deals.index') }}" class="hover:text-white transition inline-flex items-center gap-1.5">
                            <span>AI Deals</span>
                            <span class="bg-[#E11D48] text-white text-[10px] font-bold px-1.5 py-0.5 rounded leading-none">HOT</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Col 3: Popular Topics (3 cols) --}}
            <div class="lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Popular Topics</h4>
                <ul class="space-y-2.5 text-sm text-gray-400">
                    <li><a href="{{ route('categories.show', 'chatgpt-openai') }}" class="hover:text-white transition">ChatGPT & OpenAI</a></li>
                    <li><a href="{{ route('categories.show', 'google-ai') }}" class="hover:text-white transition">Google Gemini & DeepMind</a></li>
                    <li><a href="{{ route('categories.show', 'ai-tools') }}" class="hover:text-white transition">AI Productivity Tools</a></li>
                    <li><a href="{{ route('categories.show', 'ai-coding') }}" class="hover:text-white transition">AI for Coding & DevTools</a></li>
                    <li><a href="{{ route('categories.show', 'ai-art-design') }}" class="hover:text-white transition">Generative Art & Video</a></li>
                </ul>
            </div>

            {{-- Col 4: Company, Trust & Legal (3 cols) --}}
            <div class="lg:col-span-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white mb-4">Company & Legal</h4>
                <ul class="space-y-2.5 text-sm text-gray-400">
                    <li><a href="{{ route('pages.show', 'about-us') }}" class="hover:text-white transition">About Us & Methodology</a></li>
                    <li><a href="{{ route('pages.show', 'contact') }}" class="hover:text-white transition">Contact & Advertise</a></li>
                    <li><a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="hover:text-white transition">Affiliate Disclosure</a></li>
                    <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="{{ route('pages.show', 'terms-of-service') }}" class="hover:text-white transition">Terms of Service</a></li>
                    <li><a href="{{ route('sitemap') }}" class="hover:text-white transition">XML Sitemap</a></li>
                </ul>
            </div>

        </div>

        {{-- FTC Affiliate Disclaimer & Copyright Bar --}}
        <div class="pt-8 flex flex-col gap-4 text-xs text-gray-500 leading-relaxed">
            <p>
                <strong class="text-gray-400">FTC Affiliate Disclosure:</strong>
                AI Hub Insider is reader-supported. When you buy software or claim discounts through links on our site, we may earn an affiliate commission at no additional cost to you. Our editorial reviews and benchmark ratings remain 100% independent.
            </p>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-2 border-t border-gray-900 text-gray-500">
                <p>&copy; {{ date('Y') }} AI Hub Insider LLC &bull; Washington, D.C., USA. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-gray-300 transition">Privacy</a>
                    <a href="{{ route('pages.show', 'terms-of-service') }}" class="hover:text-gray-300 transition">Terms</a>
                    <a href="{{ route('pages.show', 'affiliate-disclosure') }}" class="hover:text-gray-300 transition">Disclosure</a>
                    <a href="{{ route('pages.show', 'contact') }}" class="hover:text-gray-300 transition">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>
