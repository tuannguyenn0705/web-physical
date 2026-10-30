@extends('layouts.app')

@section('title', $title ?? 'System Notice')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 flex items-center justify-center min-h-[70vh]">
    <div class="w-full bg-white rounded-3xl border border-gray-200/90 shadow-sm p-8 sm:p-14 text-center relative overflow-hidden">
        
        {{-- Subtle background error code --}}
        <div class="font-mono text-8xl sm:text-9xl font-black text-gray-100 select-none tracking-tight leading-none mb-3">
            @yield('code', 'Error')
        </div>

        {{-- Error status badge --}}
        <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider mb-4 border @yield('badge_style', 'bg-orange-50 text-orange-700 border-orange-200/80')">
            @yield('badge', 'System Notice')
        </div>

        {{-- Clear, polite error headline --}}
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-950 font-sans tracking-tight mb-4">
            @yield('headline', 'Something went wrong')
        </h1>

        {{-- Friendly, secure error message without leaking backend details --}}
        <p class="text-gray-600 text-sm sm:text-base max-w-lg mx-auto leading-relaxed mb-8">
            @yield('message', 'We could not complete your request at this time.')
        </p>

        {{-- Quick navigation buttons --}}
        <div class="flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-950 hover:bg-gray-800 text-white rounded-xl text-xs sm:text-sm font-semibold transition shadow-xs cursor-pointer">
                <span>←</span>
                <span>Back to Homepage</span>
            </a>

            <a href="{{ route('posts.index', ['type' => 'news']) }}" 
               class="inline-flex items-center px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 rounded-xl text-xs sm:text-sm font-medium transition shadow-2xs">
                Latest AI News
            </a>

            <a href="javascript:history.back()" 
               class="inline-flex items-center px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs sm:text-sm font-medium transition">
                Go Back
            </a>
        </div>

        {{-- Security footer note --}}
        <div class="mt-10 pt-6 border-t border-gray-100 text-xs text-gray-400">
            <span>AI Hub 2026 Security Shield • All requests are safely monitored</span>
        </div>
    </div>
</div>
@endsection
