@extends('layouts.admin')

@section('title', 'Thêm Deal mới')
@section('header_title', 'Thêm Deal mới')

@section('header_actions')
<a href="{{ route('admin.deals.index') }}"
   class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl transition shadow-xs hover:bg-gray-50">
    Quay lại danh sách
</a>
@endsection

@section('content')
<form action="{{ route('admin.deals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl text-sm">
            <p class="font-semibold mb-1">Vui lòng kiểm tra lại thông tin:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- CỘT TRÁI (2/3): Thông tin chính của Deal --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-200/90 shadow-xs space-y-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-3">
                    Nội Dung Thẻ Deal
                </h3>

                {{-- Tiêu đề Deal --}}
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                        Tiêu Đề Ưu Đãi (Title) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                           placeholder="Ví dụ: 60%OFF at Cursor Pro AI hoặc 50%OFF ChatGPT Plus..."
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                </div>

                {{-- Mô tả ngắn --}}
                <div>
                    <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                        Mô Tả Ngắn (Subtitle / Description)
                    </label>
                    <textarea name="description" id="description" rows="3"
                              placeholder="Ví dụ: Best-selling AI coding assistant 60% off for annual plans..."
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent leading-relaxed">{{ old('description') }}</textarea>
                </div>

                {{-- Đường dẫn Link Ref / Affiliate & Mã Coupon --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label for="affiliate_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Đường Dẫn Affiliate / Link Ref <span class="text-red-500">*</span>
                        </label>
                        <input type="url" name="affiliate_url" id="affiliate_url" required value="{{ old('affiliate_url') }}"
                               placeholder="https://..."
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-mono text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    </div>

                    <div>
                        <label for="coupon_code" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                            Mã Giảm Giá (Tùy chọn)
                        </label>
                        <input type="text" name="coupon_code" id="coupon_code" value="{{ old('coupon_code') }}"
                               placeholder="VD: CURSOR50"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-mono uppercase text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    </div>
                </div>

                {{-- Tùy chỉnh nhãn thẻ (Mặc định giống HakoReview) --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 border-t border-gray-100">
                    <div>
                        <label for="badge_text" class="block text-xs font-medium text-gray-600 mb-1.5">Nhãn Đỏ (Badge)</label>
                        <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text', 'Deal') }}"
                               class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="sub_badge_text" class="block text-xs font-medium text-gray-600 mb-1.5">Dòng Phụ (Sub-badge)</label>
                        <input type="text" name="sub_badge_text" id="sub_badge_text" value="{{ old('sub_badge_text', 'DISCOUNT DEAL') }}"
                               class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>

                    <div>
                        <label for="button_text" class="block text-xs font-medium text-gray-600 mb-1.5">Chữ Trên Nút Bấm</label>
                        <input type="text" name="button_text" id="button_text" value="{{ old('button_text', 'Shop Now') }}"
                               class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                </div>
            </div>
        </div>

        {{-- CỘT PHẢI (1/3): Ảnh Logo, Trạng thái & Xem trước thẻ --}}
        <div class="space-y-6">
            {{-- Box Xuất bản --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-4">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-2.5">
                    Cấu Hình Hiển Thị
                </h3>

                <div>
                    <label for="order" class="block text-xs font-medium text-gray-600 mb-1.5">Thứ Tự Ưu Tiên (Số nhỏ xếp trước)</label>
                    <input type="number" name="order" id="order" min="0" value="{{ old('order', 0) }}"
                           class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>

                <div class="pt-2 border-t border-gray-100 space-y-2.5">
                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <span class="text-sm font-medium text-gray-800">Hiển thị ngay trên trang Deals</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <span class="text-sm font-medium text-gray-800">Ghim nổi bật (Trang chủ & Sidebar)</span>
                    </label>
                </div>

                <div class="pt-3 border-t border-gray-100 flex flex-col gap-2">
                    <button type="submit"
                            class="w-full py-2.5 px-4 bg-gray-950 hover:bg-gray-800 text-white rounded-xl text-sm font-semibold transition shadow-xs text-center cursor-pointer">
                        Lưu & Đăng Deal
                    </button>
                    <a href="{{ route('admin.deals.index') }}"
                       class="w-full py-2 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-medium transition text-center">
                        Hủy Bỏ
                    </a>
                </div>
            </div>

            {{-- Box Ảnh Logo / Thumbnail vuông --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-2.5">
                    Ảnh / Logo Thương Hiệu
                </h3>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition cursor-pointer">
                <p class="text-xs text-gray-400">Khuyên dùng ảnh vuông (tỉ lệ 1:1), định dạng JPG, PNG, WEBP, SVG tối đa 5MB.</p>
            </div>
        </div>
    </div>
</form>
@endsection
