<!DOCTYPE html>
<html lang="vi" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Trị') - {{ config('app.name', 'AI Hub Insider') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon.png?v=2') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-slate-900 bg-slate-100 selection:bg-slate-900 selection:text-white overflow-hidden">

    <div class="h-full flex overflow-hidden">
        {{-- ========================================================= --}}
        {{-- SIDEBAR: CỐ ĐỊNH HOÀN TOÀN, KHÔNG BỊ TRÔI KHI CUỘN TRANG --}}
        {{-- ========================================================= --}}
        <aside class="w-72 sm:w-80 h-full bg-[#F8FAFC] text-slate-700 flex flex-col justify-between flex-shrink-0 border-r border-slate-200 shadow-[4px_0_16px_-4px_rgba(0,0,0,0.06)] z-30 select-none">
            
            {{-- Nhóm phần trên (Logo + Danh sách menu cuộn độc lập) --}}
            <div class="flex flex-col flex-1 min-h-0">
                {{-- Header Sidebar: Cố định ở góc trên bên trái, cao h-16 khớp header chính --}}
                <div class="h-16 px-6 flex items-center border-b border-slate-200 bg-white flex-shrink-0">
                    <a href="{{ route('admin.dashboard') }}" class="block">
                        <span class="text-base font-bold text-slate-900 tracking-tight block">AI Hub Admin</span>
                        <span class="text-xs text-slate-500 font-medium block">Hệ thống quản trị nội dung</span>
                    </a>
                </div>

                {{-- Menu điều hướng: Cuộn độc lập bên trong nếu màn hình quá ngắn, không bao giờ che phần Profile --}}
                <nav class="flex-1 overflow-y-auto p-5 space-y-7">
                    {{-- Mục 1: Bảng điều khiển --}}
                    <div>
                        <div class="px-3 mb-2.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Tổng Quan
                        </div>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center px-4 py-2.5 text-sm rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-slate-900 font-semibold shadow-xs border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60 font-medium' }}">
                            Bảng điều khiển
                        </a>
                    </div>

                    {{-- Mục 2: Quản lý bài đăng & các nhóm bài --}}
                    <div>
                        <div class="px-3 mb-2.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Quản Lý Bài Đăng
                        </div>

                        <div class="space-y-1">
                            <a href="{{ route('admin.posts.index') }}"
                               class="flex items-center justify-between px-4 py-2.5 text-sm rounded-xl transition {{ request()->routeIs('admin.posts.*') && !request('type') ? 'bg-white text-slate-900 font-semibold shadow-xs border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60 font-medium' }}">
                                <span>Tất cả bài viết</span>
                            </a>

                            {{-- 3 Nhóm bài viết con --}}
                            <div class="pl-3.5 pt-1 pb-1 space-y-1 border-l-2 border-slate-300 ml-4 my-1.5">
                                <a href="{{ route('admin.posts.index', ['type' => 'news']) }}"
                                   class="flex items-center justify-between px-3 py-2 text-xs rounded-lg transition {{ request('type') === 'news' ? 'bg-white text-blue-700 font-semibold shadow-xs border border-blue-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 font-medium' }}">
                                    <span>Tin tức AI</span>
                                </a>
                                <a href="{{ route('admin.posts.index', ['type' => 'review']) }}"
                                   class="flex items-center justify-between px-3 py-2 text-xs rounded-lg transition {{ request('type') === 'review' ? 'bg-white text-amber-700 font-semibold shadow-xs border border-amber-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 font-medium' }}">
                                    <span>Đánh giá (Review)</span>
                                </a>
                                <a href="{{ route('admin.posts.index', ['type' => 'tutorial']) }}"
                                   class="flex items-center justify-between px-3 py-2 text-xs rounded-lg transition {{ request('type') === 'tutorial' ? 'bg-white text-purple-700 font-semibold shadow-xs border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/50 font-medium' }}">
                                    <span>Hướng dẫn (Tutorial)</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Mục 3: Quản lý Deals (Affiliate) --}}
                    <div>
                        <div class="px-3 mb-2.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Quản Lý Deals
                        </div>

                        <div class="space-y-1.5">
                            <a href="{{ route('admin.deals.index') }}"
                               class="flex items-center justify-between px-4 py-2.5 text-sm rounded-xl transition {{ request()->routeIs('admin.deals.*') ? 'bg-white text-slate-900 font-semibold shadow-xs border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60 font-medium' }}">
                                <span>Danh sách Deals</span>
                            </a>
                        </div>
                    </div>

                    {{-- Mục 4: Quản lý danh mục --}}
                    <div>
                        <div class="px-3 mb-2.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Cấu Trúc
                        </div>
                        <a href="{{ route('admin.categories.index') }}"
                           class="flex items-center px-4 py-2.5 text-sm rounded-xl transition {{ request()->routeIs('admin.categories.*') ? 'bg-white text-slate-900 font-semibold shadow-xs border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60 font-medium' }}">
                            Danh mục bài viết
                        </a>
                    </div>
                </nav>
            </div>

            {{-- Chân Sidebar: LUÔN CỐ ĐỊNH Ở ĐÁY MÀN HÌNH, KHÔNG BỊ KHUẤT --}}
            <div class="p-5 border-t border-slate-200 bg-slate-100/70 flex-shrink-0">
                <div class="px-1 mb-3.5">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name ?? 'Admin AI Hub' }}</p>
                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ auth()->user()->email ?? 'adminaihub@gmail.com' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-2 text-xs font-medium">
                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center justify-center py-2 px-3 rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 shadow-2xs transition text-center">
                        Xem Web
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center justify-center py-2 px-3 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 transition text-center cursor-pointer font-medium">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ========================================================= --}}
        {{-- KHU VỰC NỘI DUNG CHÍNH (HEADER CỐ ĐỊNH, CHỈ CUỘN NỘI DUNG) --}}
        {{-- ========================================================= --}}
        <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden bg-slate-100/70">
            {{-- Thanh tiêu đề trang: CỐ ĐỊNH Ở ĐỈNH, KHÔNG BỊ TRÔI KHI CUỘN CHUỘT --}}
            <header class="h-16 bg-white border-b border-slate-200 px-6 sm:px-8 flex items-center justify-between flex-shrink-0 z-20 shadow-2xs">
                <div>
                    <h1 class="text-lg font-bold text-slate-900 font-sans">
                        @yield('header_title', View::getSection('title', 'Bảng Điều Khiển'))
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    @yield('header_actions')
                </div>
            </header>

            {{-- Nội dung trang: CHỈ DUY NHẤT KHU VỰC NÀY CUỘN CHUỘT --}}
            <main class="flex-1 overflow-y-auto">
                <div class="max-w-7xl w-full mx-auto p-6 sm:p-8">
                    {{-- Thông báo Flash message sạch sẽ --}}
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium shadow-xs">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm font-medium shadow-xs">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
