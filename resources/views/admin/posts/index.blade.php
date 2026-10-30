@extends('layouts.admin')

@section('title', 'Quản lý bài viết')
@section('header_title', 'Quản lý bài viết')

@section('header_actions')
<a href="{{ route('admin.posts.create') }}" 
   class="inline-flex items-center bg-gray-950 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs hover:shadow-sm">
    Viết bài mới
</a>
@endsection

@section('content')
<div class="space-y-6">

    {{-- 1. TYPE TABS: Phân loại theo 3 nhóm nội dung (Không icon, chữ to rõ) --}}
    <div class="bg-white p-2 rounded-2xl border border-gray-200/90 shadow-xs flex flex-wrap gap-1.5">
        @php
            $types = [
                ['key' => null, 'label' => 'Tất cả bài viết', 'count' => $typeCounts['all'] ?? 0],
                ['key' => 'news', 'label' => 'Tin tức AI', 'count' => $typeCounts['news'] ?? 0],
                ['key' => 'review', 'label' => 'Đánh giá (Review)', 'count' => $typeCounts['review'] ?? 0],
                ['key' => 'tutorial', 'label' => 'Hướng dẫn (Tutorial)', 'count' => $typeCounts['tutorial'] ?? 0],
            ];
            $currentType = request('type');
        @endphp

        @foreach($types as $t)
            @php
                $isActive = ($t['key'] === null && !$currentType) || ($t['key'] === $currentType);
            @endphp
            <a href="{{ route('admin.posts.index', array_merge(request()->except(['page']), ['type' => $t['key']])) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-all {{ $isActive ? 'bg-gray-950 text-white font-semibold shadow-xs' : 'text-gray-600 hover:text-gray-950 hover:bg-gray-100' }}">
                <span>{{ $t['label'] }}</span>
                <span class="px-2 py-0.5 rounded-full text-xs {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-600' }}">
                    {{ $t['count'] }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- 2. BỘ LỌC & TÌM KIẾM --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs">
        <form method="GET" action="{{ route('admin.posts.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3.5 items-center">
            @if(request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
            @endif

            {{-- Ô tìm kiếm --}}
            <div class="lg:col-span-5">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nhập tiêu đề hoặc mô tả cần tìm..."
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            </div>

            {{-- Lọc trạng thái --}}
            <div class="lg:col-span-3">
                <select name="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <option value="">Tất cả trạng thái</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Đã xuất bản (Public)</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Bản nháp (Draft)</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Lưu trữ (Archived)</option>
                </select>
            </div>

            {{-- Lọc chuyên mục --}}
            <div class="lg:col-span-3">
                <select name="category_id" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <option value="">Tất cả chuyên mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nút bấm Lọc & Reset --}}
            <div class="lg:col-span-1 flex items-center gap-2">
                <button type="submit" 
                        class="w-full py-2.5 px-4 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-sm font-semibold transition text-center cursor-pointer">
                    Lọc
                </button>
                @if(request('search') || request('status') || request('category_id'))
                    <a href="{{ route('admin.posts.index', ['type' => request('type')]) }}"
                       class="py-2.5 px-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-medium transition text-center whitespace-nowrap">
                        Bỏ lọc
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- 3. BẢNG DỮ LIỆU BÀI VIẾT --}}
    <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="py-4 px-6">Bài Viết</th>
                        <th class="py-4 px-4">Chuyên Mục</th>
                        <th class="py-4 px-4">Phân Loại</th>
                        <th class="py-4 px-4">Trạng Thái</th>
                        <th class="py-4 px-4 text-center">Lượt Xem</th>
                        <th class="py-4 px-4">Thời Gian</th>
                        <th class="py-4 px-6 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50/70 transition">
                            {{-- Cột Bài viết --}}
                            <td class="py-4 px-6 max-w-sm">
                                <div class="flex items-center gap-3.5">
                                    @if($post->featured_image)
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if($post->is_featured)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-100 text-amber-900">
                                                    Nổi bật
                                                </span>
                                            @endif
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="font-semibold text-gray-900 hover:text-orange-600 transition truncate block text-sm">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                        <p class="text-xs text-gray-400 font-mono truncate mt-0.5">/posts/{{ $post->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Cột Chuyên mục --}}
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg bg-gray-100 text-gray-800 text-xs font-medium border border-gray-200/70">
                                    {{ $post->category->name ?? 'Chưa gán' }}
                                </span>
                            </td>

                            {{-- Cột Phân loại --}}
                            <td class="py-4 px-4 whitespace-nowrap">
                                @switch($post->type)
                                    @case('news')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-800 border border-blue-200/60">
                                            Tin tức
                                        </span>
                                        @break
                                    @case('review')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200/60">
                                            Review
                                        </span>
                                        @break
                                    @case('tutorial')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-800 border border-purple-200/60">
                                            Hướng dẫn
                                        </span>
                                        @break
                                @endswitch
                            </td>

                            {{-- Cột Trạng thái --}}
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($post->status === 'published')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100/80 text-emerald-800">
                                        Đã xuất bản
                                    </span>
                                @elseif($post->status === 'draft')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100/80 text-amber-800">
                                        Bản nháp
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        Lưu trữ
                                    </span>
                                @endif
                            </td>

                            {{-- Cột Lượt xem --}}
                            <td class="py-4 px-4 whitespace-nowrap text-center font-mono text-gray-700 text-xs">
                                {{ number_format($post->views_count) }}
                            </td>

                            {{-- Cột Thời gian --}}
                            <td class="py-4 px-4 whitespace-nowrap text-gray-500 text-xs">
                                <div>{{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : 'Chưa xuất bản' }}</div>
                                <div class="text-[11px] text-gray-400">{{ $post->author->name ?? 'Admin' }}</div>
                            </td>

                            {{-- Cột Thao tác: Dùng chữ rõ ràng thay vì icon nhỏ --}}
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2 text-xs">
                                    <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                       class="px-2.5 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                                        Xem
                                    </a>

                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                       class="px-2.5 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium transition">
                                        Sửa
                                    </a>

                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-2.5 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-medium transition cursor-pointer">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400 text-sm">
                                <p>Không tìm thấy bài viết nào phù hợp.</p>
                                <a href="{{ route('admin.posts.create') }}" class="inline-block mt-3 text-sm text-orange-600 hover:underline font-semibold">
                                    Tạo bài viết mới ngay
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Phân trang --}}
        @if($posts->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
