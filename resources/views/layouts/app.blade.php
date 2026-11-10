<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'VerdictTC.com — Independent Hands-On Physical Product Reviews, Lab Benchmarks, Comparisons & Verified Retail Deals')">
    <title>@yield('title', 'VerdictTC.com — Lab-Tested Product Reviews & Daily Deals')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg?v=3') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon.png?v=3') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=3') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=3') }}">

    <!-- Google Fonts: Plus Jakarta Sans, Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js for Interactive E-Commerce Widgets -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-amber-400 selection:text-slate-950">

    {{-- Top Reading Progress Bar --}}
    <div class="fixed top-0 left-0 right-0 z-[70] h-1 bg-transparent pointer-events-none">
        <div id="readingProgressBar"
             class="h-full w-0 bg-gradient-to-r from-amber-500 via-orange-500 to-emerald-500 transition-[width] duration-150 ease-out shadow-[0_0_10px_rgba(245,158,11,0.65)]"></div>
    </div>

    {{-- Commercial E-Commerce Header & Ticker --}}
    @include('layouts.partials.header')

    {{-- Main Page Content --}}
    <main class="min-h-screen">
        {{-- Flash Notifications --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 px-5 py-3.5 rounded-2xl flex items-center justify-between gap-3 shadow-2xs" role="alert">
                    <div class="flex items-center gap-2.5 text-sm font-semibold">
                        <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-rose-50 border border-rose-200 text-rose-900 px-5 py-3.5 rounded-2xl flex items-center justify-between gap-3 shadow-2xs" role="alert">
                    <div class="flex items-center gap-2.5 text-sm font-semibold">
                        <span class="w-6 h-6 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0">!</span>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- E-Commerce Editorial Footer --}}
    @include('layouts.partials.footer')

    {{-- Global Reading Progress Script --}}
    <script>
        (function() {
            const bar = document.getElementById('readingProgressBar');
            if (!bar) return;
            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY || document.documentElement.scrollTop;
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const pct = docHeight > 0 ? Math.min(100, Math.max(0, (scrollTop / docHeight) * 100)) : 0;
                bar.style.width = pct.toFixed(2) + '%';
            }, { passive: true });
        })();
    </script>

    @stack('scripts')
</body>
</html>
