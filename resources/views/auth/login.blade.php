@extends('layouts.app')

@section('title', 'Đăng nhập Admin')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-3xl shadow-[0_10px_35px_rgba(0,0,0,0.05)] border border-gray-100">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gray-900 text-white text-2xl mb-4 shadow-sm">
                🤖
            </div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight font-sans">Quản trị hệ thống</h2>
            <p class="mt-1.5 text-xs text-gray-500">Đăng nhập tài khoản quản trị AI Hub Insider</p>
        </div>

        <form class="space-y-5" action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Honeypot chống spam bot tự động --}}
            <input type="text" name="website_url_hp" style="display:none !important; position:absolute !important; left:-9999px !important;" tabindex="-1" autocomplete="off">

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs flex items-start gap-2">
                    <span class="text-red-500 font-bold">⚠️</span>
                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">Email Quản Trị</label>
                <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                       placeholder="admin@example.com"
                       autocomplete="email"
                       class="appearance-none block w-full px-4 py-2.5 border border-gray-200 rounded-xl shadow-xs placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm transition">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">Mật Khẩu</label>
                <input id="password" name="password" type="password" required
                       placeholder="••••••••"
                       autocomplete="current-password"
                       class="appearance-none block w-full px-4 py-2.5 border border-gray-200 rounded-xl shadow-xs placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm transition">
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-gray-950 focus:ring-gray-900 border-gray-300 rounded">
                    <span class="text-xs text-gray-600 font-medium">Ghi nhớ đăng nhập</span>
                </label>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-xs text-sm font-semibold text-white bg-gray-950 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-200 hover:shadow-md cursor-pointer">
                    <span>Đăng Nhập Quản Trị</span>
                    <span aria-hidden="true">→</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
