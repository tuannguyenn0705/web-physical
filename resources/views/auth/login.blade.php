<!DOCTYPE html>
<html lang="vi" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị • VerdictTC.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon.png?v=3') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=3') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=3') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900 bg-[#F8FAFC] selection:bg-slate-900 selection:text-white flex flex-col justify-center items-center min-h-screen px-4 py-12 relative">

    {{-- Nền tối giản sạch sẽ --}}
    <div class="w-full max-w-md mx-auto">
        <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-[0_15px_45px_rgba(0,0,0,0.05)] border border-slate-200/80 relative overflow-hidden">
            {{-- Dải màu nhận diện thương hiệu trên cùng --}}
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-500 via-emerald-500 to-amber-600"></div>

            <div class="text-center mb-8 pt-2">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gray-950 text-white shadow-md border border-gray-800 mb-4 transition-transform hover:scale-105">
                    <svg class="w-8 h-8" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                        <path d="M15 23L28 45L49 17" stroke="#F59E0B" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="48" cy="44" r="5" fill="#10B981"/>
                    </svg>
                </div>
                
                <div class="flex items-center justify-center gap-1.5 mb-2.5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-emerald-50 text-emerald-800 border border-emerald-200/70">
                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd" />
                        </svg>
                        Cổng Quản Trị Bảo Mật
                    </span>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight font-sans">Đăng Nhập Quản Trị Viên</h1>
                <p class="mt-1.5 text-xs text-slate-500 leading-relaxed">Hệ thống kiểm định sản phẩm vật lý &amp; quản lý affiliate VerdictTC.com</p>
            </div>

            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div class="font-medium leading-relaxed">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form class="space-y-4" action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Honeypot chống Bot tự động dò quét --}}
                <input type="text" name="website_url_hp" style="display:none !important; position:absolute !important; left:-9999px !important;" tabindex="-1" autocomplete="off">

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Quản Trị Viên</label>
                    <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                           placeholder="example@test.com"
                           autocomplete="email"
                           class="appearance-none block w-full px-4 py-2.5 border border-slate-200 rounded-xl shadow-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-transparent text-sm transition">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">Mật Khẩu Quản Trị</label>
                    </div>
                    <input id="password" name="password" type="password" required
                           placeholder="••••••••"
                           autocomplete="current-password"
                           class="appearance-none block w-full px-4 py-2.5 border border-slate-200 rounded-xl shadow-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-transparent text-sm transition">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-slate-950 focus:ring-slate-900 border-slate-300 rounded cursor-pointer">
                        <span class="text-xs text-slate-600 font-medium">Duy trì đăng nhập trên thiết bị này</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" style="background-color: #0f172a; color: #ffffff;" class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl shadow-md text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition duration-150 cursor-pointer">
                        <span>Đăng Nhập Hệ Thống</span>
                        <span aria-hidden="true">→</span>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 space-y-1.5 text-center">
                <div class="flex items-center justify-center gap-1.5 text-[11px] text-slate-500 font-medium">
                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Chỉ tài khoản quản trị duy nhất được phép truy cập</span>
                </div>
                <p class="text-[10px] text-slate-400">
                    Tự động kích hoạt tường lửa ngăn chặn &amp; ghi nhận IP khi phát hiện dò quét mật khẩu (Brute-force).
                </p>
            </div>
        </div>

        {{-- Nút quay lại trang chủ --}}
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-slate-700 transition inline-flex items-center gap-1.5 font-medium">
                <span aria-hidden="true">←</span>
                <span>Quay về trang chủ VerdictTC.com</span>
            </a>
        </div>
    </div>

</body>
</html>
