<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'AI Hub Insider - Latest AI News, In-Depth Tool Reviews, Tutorials & Exclusive Deals')">
    <title>@yield('title', 'AI Hub Insider') - {{ config('app.name', 'AI Hub Insider') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon.png?v=2') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">


    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    {{-- Header / Navigation --}}
    @include('layouts.partials.header')

    {{-- Main Content --}}
    <main class="min-h-screen {{ !request()->routeIs('home') ? 'pt-24 sm:pt-28' : '' }}">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 {{ request()->routeIs('home') ? 'pt-24' : '' }} mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 {{ request()->routeIs('home') ? 'pt-24' : '' }} mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    @stack('scripts')
</body>
</html>
