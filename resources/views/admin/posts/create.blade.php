@extends('layouts.admin')

@section('title', 'Tạo bài viết mới')
@section('header_title', 'Tạo bài viết mới')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    /* Thanh công cụ thiết kế hiện đại, gọn gàng trên 1 hàng */
    .ql-toolbar.ql-snow {
        position: sticky;
        top: 0;
        z-index: 30;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        border-top-left-radius: 0.875rem;
        border-top-right-radius: 0.875rem;
        border: 1px solid #e2e8f0;
        background: rgba(248, 250, 252, 0.96);
        backdrop-filter: blur(8px);
        padding: 8px 12px;
        box-shadow: 0 4px 12px -2px rgba(15, 23, 42, 0.05);
    }

    /* Các nhóm công cụ ngăn cách bằng đường kẻ dọc tinh tế */
    .ql-toolbar.ql-snow .ql-formats {
        display: inline-flex !important;
        align-items: center;
        gap: 3px;
        margin-right: 0 !important;
        padding-right: 7px;
        border-right: 1px solid #e2e8f0;
    }
    .ql-toolbar.ql-snow .ql-formats:last-child {
        border-right: none;
        padding-right: 0;
    }

    /* Nút bấm icon trên thanh công cụ */
    .ql-toolbar.ql-snow button,
    .ql-toolbar.ql-snow .ql-picker:not(.ql-header):not(.ql-size) {
        width: 30px !important;
        height: 30px !important;
        padding: 5px !important;
        border-radius: 7px;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        float: none !important;
    }
    .ql-toolbar.ql-snow .ql-picker:not(.ql-header):not(.ql-size) .ql-picker-label {
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border-radius: 7px;
        border: 1px solid transparent !important;
    }
    .ql-toolbar.ql-snow button:hover,
    .ql-toolbar.ql-snow .ql-picker:not(.ql-header):not(.ql-size):hover {
        background-color: #e2e8f0 !important;
    }
    .ql-toolbar.ql-snow button.ql-active,
    .ql-toolbar.ql-snow .ql-picker-label.ql-active {
        background-color: #fff7ed !important;
        color: #ea580c !important;
    }
    .ql-toolbar.ql-snow button.ql-active .ql-stroke,
    .ql-toolbar.ql-snow .ql-picker-label.ql-active .ql-stroke {
        stroke: #ea580c !important;
    }
    .ql-toolbar.ql-snow button.ql-active .ql-fill,
    .ql-toolbar.ql-snow .ql-picker-label.ql-active .ql-fill {
        fill: #ea580c !important;
    }

    /* Hộp chọn kí hiệu Kiểu tiêu đề (¶ / H1-H4) & Cỡ chữ (Aa / A- / A+) */
    .ql-snow .ql-picker.ql-header,
    .ql-snow .ql-picker.ql-size {
        width: 54px !important;
        height: 30px !important;
        float: none !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label,
    .ql-snow .ql-picker.ql-size .ql-picker-label {
        display: inline-flex !important;
        align-items: center;
        justify-content: flex-start;
        padding: 0 18px 0 8px !important;
        height: 100%;
        width: 100%;
        border-radius: 7px;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff;
        font-family: 'Inter', sans-serif;
        font-size: 12.5px;
        font-weight: 700;
        color: #0f172a !important;
        transition: all 0.15s ease;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label:hover,
    .ql-snow .ql-picker.ql-size .ql-picker-label:hover {
        border-color: #94a3b8 !important;
        background-color: #f8fafc;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label svg,
    .ql-snow .ql-picker.ql-size .ql-picker-label svg {
        right: 3px !important;
        width: 14px !important;
    }

    /* Kí hiệu ngắn gọn cho Kiểu tiêu đề */
    .ql-snow .ql-picker.ql-header .ql-picker-label::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item::before {
        content: '¶' !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="1"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="1"]::before {
        content: 'H1' !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="2"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="2"]::before {
        content: 'H2' !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="3"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="3"]::before {
        content: 'H3' !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-label[data-value="4"]::before,
    .ql-snow .ql-picker.ql-header .ql-picker-item[data-value="4"]::before {
        content: 'H4' !important;
    }

    /* Kí hiệu ngắn gọn cho Cỡ chữ */
    .ql-snow .ql-picker.ql-size .ql-picker-label::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item::before {
        content: 'Aa' !important;
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="small"]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="small"]::before {
        content: 'A⁻' !important;
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="large"]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="large"]::before {
        content: 'A⁺' !important;
    }
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value="huge"]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="huge"]::before {
        content: 'A⁺⁺' !important;
    }

    /* Menu xổ xuống gọn đẹp */
    .ql-snow .ql-picker-options {
        border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.14) !important;
        padding: 5px !important;
        margin-top: 6px !important;
        background-color: #ffffff !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-options,
    .ql-snow .ql-picker.ql-size .ql-picker-options {
        min-width: 64px !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-item,
    .ql-snow .ql-picker.ql-size .ql-picker-item {
        border-radius: 6px;
        padding: 4px 8px !important;
        font-family: 'Inter', sans-serif;
        font-size: 12.5px !important;
        font-weight: 700;
        color: #334155;
        text-align: center;
        transition: all 0.12s ease;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-item::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item::before {
        font-size: 12.5px !important;
        line-height: 1.4 !important;
    }
    .ql-snow .ql-picker.ql-header .ql-picker-item:hover,
    .ql-snow .ql-picker.ql-size .ql-picker-item:hover,
    .ql-snow .ql-picker.ql-header .ql-picker-item.ql-selected,
    .ql-snow .ql-picker.ql-size .ql-picker-item.ql-selected {
        background-color: #fff7ed;
        color: #ea580c !important;
    }

    /* Khung soạn thảo văn bản */
    .ql-container.ql-snow {
        border-bottom-left-radius: 0.875rem;
        border-bottom-right-radius: 0.875rem;
        border-color: #e2e8f0;
        font-family: inherit;
        font-size: 0.95rem;
        background-color: #ffffff;
    }
    .ql-editor {
        min-height: 440px;
        line-height: 1.75;
        color: #1e293b;
    }
    .ql-editor.ql-blank::before {
        color: #94a3b8;
        font-style: normal;
    }

    /* Chú thích (Tooltip) hiển thị tức thì khi hover vào các nút công cụ */
    .ql-toolbar button[data-tooltip],
    .ql-toolbar .ql-picker[data-tooltip] {
        position: relative;
    }
    .ql-toolbar button[data-tooltip]:hover::after,
    .ql-toolbar .ql-picker[data-tooltip]:not(.ql-expanded):hover::after {
        content: attr(data-tooltip);
        position: absolute;
        top: calc(100% + 8px);
        left: 50%;
        transform: translateX(-50%);
        background-color: #0f172a;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        font-size: 11.5px;
        font-weight: 500;
        line-height: 1.3;
        padding: 5px 10px;
        border-radius: 6px;
        white-space: nowrap;
        z-index: 60;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.18);
    }
    .ql-toolbar button[data-tooltip]:hover::before,
    .ql-toolbar .ql-picker[data-tooltip]:not(.ql-expanded):hover::before {
        content: "";
        position: absolute;
        top: calc(100% + 3px);
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 5px 5px 5px;
        border-style: solid;
        border-color: transparent transparent #0f172a transparent;
        z-index: 60;
        pointer-events: none;
    }
</style>
@endpush

@section('header_actions')
<a href="{{ route('admin.posts.index') }}" 
   class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl transition shadow-xs hover:bg-gray-50">
    Quay lại danh sách
</a>
@endsection

@section('content')
<form id="postForm" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
        {{-- CỘT TRÁI (2/3): Tiêu đề, Tóm tắt, Trình soạn thảo Word/Excel WYSIWYG --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Tiêu đề & Tóm tắt --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200/90 shadow-xs space-y-5">
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                        Tiêu Đề Bài Viết <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                           placeholder="Nhập tiêu đề bài viết..."
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                </div>

                {{-- Tóm tắt ngắn (Excerpt) --}}
                <div>
                    <label for="excerpt" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                        Tóm Tắt Ngắn (Excerpt / Sapo)
                    </label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                              placeholder="Mô tả tóm tắt ngắn để hiển thị ngoài danh sách bài viết và phần mở đầu..."
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent leading-relaxed">{{ old('excerpt') }}</textarea>
                </div>
            </div>

            {{-- Trình soạn thảo Nội dung bài viết WYSIWYG (Đầy đủ chức năng như Word / Excel) --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200/90 shadow-xs space-y-3">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Nội Dung Chi Tiết Bài Viết <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Hỗ trợ định dạng văn bản giống Word/Excel: Cỡ chữ, Tô đậm, In nghiêng, Gạch chân, Gạch ngang, Chọn màu chữ, Căn lề, Chèn ảnh (Click chọn ảnh hoặc Paste trực tiếp Ctrl+V).
                        </p>
                    </div>
                    <span id="uploadStatusBadge" class="hidden text-xs font-medium text-orange-600 bg-orange-50 px-2.5 py-1 rounded-lg border border-orange-200 animate-pulse">
                        Đang tải ảnh lên máy chủ...
                    </span>
                </div>

                {{-- Container trình soạn thảo Quill --}}
                <div class="space-y-0">
                    <div id="quillEditorContainer"></div>
                </div>

                {{-- Input ẩn để chứa HTML đồng bộ lên Laravel request --}}
                <input type="hidden" name="content" id="content_input" value="{{ old('content') }}">
            </div>
        </div>

        {{-- CỘT PHẢI (1/3): Cấu hình xuất bản, phân loại, ảnh đại diện --}}
        <div class="space-y-6">
            {{-- Box Xuất bản --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-4">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-2.5">
                    Xuất Bản Bài Viết
                </h3>

                {{-- Trạng thái --}}
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-600 mb-1.5">Trạng Thái Đăng</label>
                    <select name="status" id="status" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>
                            Xuất bản ngay (Hiển thị Client)
                        </option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>
                            Lưu bản nháp (Draft)
                        </option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>
                            Lưu trữ (Archived)
                        </option>
                    </select>
                </div>

                {{-- Bài viết nổi bật --}}
                <div class="pt-2 border-t border-gray-100">
                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <span class="text-sm font-medium text-gray-800">Đặt làm bài viết nổi bật</span>
                    </label>
                    <p class="text-xs text-gray-400 mt-1 pl-6">Ưu tiên hiển thị ở vị trí nổi bật trang chủ</p>
                </div>

                {{-- Nút Lưu / Hủy --}}
                <div class="pt-3 border-t border-gray-100 flex flex-col gap-2">
                    <button type="submit" 
                            class="w-full py-2.5 px-4 bg-gray-950 hover:bg-gray-800 text-white rounded-xl text-sm font-semibold transition shadow-xs text-center cursor-pointer">
                        Đăng Bài Lên Client
                    </button>
                    <a href="{{ route('admin.posts.index') }}" 
                       class="w-full py-2 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-medium transition text-center">
                        Hủy Bỏ
                    </a>
                </div>
            </div>

            {{-- Box Phân loại & Chuyên mục --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-4">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-2.5">
                    Phân Loại Bài Viết
                </h3>

                {{-- Loại bài viết (3 nhóm chức năng) --}}
                <div>
                    <label for="type" class="block text-xs font-medium text-gray-600 mb-1.5">
                        Loại Nội Dung <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="news" {{ old('type') === 'news' ? 'selected' : '' }}>Tin tức AI</option>
                        <option value="review" {{ old('type') === 'review' ? 'selected' : '' }}>Đánh giá (Review)</option>
                        <option value="tutorial" {{ old('type') === 'tutorial' ? 'selected' : '' }}>Hướng dẫn (Tutorial)</option>
                    </select>
                </div>

                {{-- Chuyên mục --}}
                <div>
                    <label for="category_id" class="block text-xs font-medium text-gray-600 mb-1.5">
                        Chuyên Mục <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id" required class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Box Ảnh đại diện --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-700 border-b border-gray-100 pb-2.5">
                    Ảnh Đại Diện (Thumbnail)
                </h3>
                <input type="file" name="featured_image" id="featured_image" accept="image/*"
                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition cursor-pointer">
                <p class="text-xs text-gray-400">Định dạng JPG, PNG, WEBP tối đa 5MB</p>
            </div>

            {{-- Box Thẻ Tags --}}
            @include('admin.posts._tags_box', ['tags' => $tags, 'selectedTagIds' => []])
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
@include('admin.posts._quill_table_helper')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Cấu hình thanh công cụ trực quan, chia nhóm gọn đẹp trên 1 hàng
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, false] }, { 'size': ['small', false, 'large', 'huge'] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }, { 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],
        ['link', 'image', 'table', 'blockquote', 'code-block'],
        ['clean']
    ];

    // Khởi tạo Quill Editor
    const quill = new Quill('#quillEditorContainer', {
        theme: 'snow',
        placeholder: 'Nhập nội dung bài viết vào đây (có thể dán ảnh/bảng Ctrl+V hoặc bấm icon trên thanh công cụ)...',
        modules: {
            table: true,
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: handleImageUploadTrigger,
                    table: function() {}
                }
            }
        }
    });

    // Gắn chú thích (Tooltip) trực quan khi di chuột vào từng thành phần trên thanh công cụ
    const toolbarEl = quill.getModule('toolbar').container;
    const tooltipMap = [
        { selector: '.ql-header', text: 'Kiểu văn bản (¶ Đoạn văn, H1 - H4 Tiêu đề)' },
        { selector: '.ql-size', text: 'Cỡ chữ (A⁻ Nhỏ, Aa Vừa, A⁺ Lớn, A⁺⁺ Rất lớn)' },
        { selector: 'button.ql-bold', text: 'In đậm (Ctrl + B)' },
        { selector: 'button.ql-italic', text: 'In nghiêng (Ctrl + I)' },
        { selector: 'button.ql-underline', text: 'Gạch chân (Ctrl + U)' },
        { selector: 'button.ql-strike', text: 'Gạch ngang chữ' },
        { selector: '.ql-color', text: 'Chọn màu chữ' },
        { selector: '.ql-background', text: 'Màu nền chữ (Tô sáng / Highlight)' },
        { selector: '.ql-align', text: 'Căn lề văn bản (Trái, Giữa, Phải, Đều 2 bên)' },
        { selector: 'button.ql-list[value="ordered"]', text: 'Danh sách đánh số (1, 2, 3...)' },
        { selector: 'button.ql-list[value="bullet"]', text: 'Danh sách dấu chấm tròn (•)' },
        { selector: 'button.ql-indent[value="-1"]', text: 'Giảm thụt lề dòng (Shift + Tab)' },
        { selector: 'button.ql-indent[value="+1"]', text: 'Tăng thụt lề dòng (Tab)' },
        { selector: 'button.ql-link', text: 'Chèn liên kết (Link URL)' },
        { selector: 'button.ql-image', text: 'Chèn hình ảnh từ máy tính' },
        { selector: 'button.ql-table', text: 'Chèn bảng so sánh (Table)' },
        { selector: 'button.ql-blockquote', text: 'Khối trích dẫn (Blockquote)' },
        { selector: 'button.ql-code-block', text: 'Khối mã nguồn (Code block)' },
        { selector: 'button.ql-clean', text: 'Xóa định dạng vùng đang chọn' }
    ];

    tooltipMap.forEach(item => {
        const el = toolbarEl.querySelector(item.selector);
        if (el) {
            el.setAttribute('data-tooltip', item.text);
        }
    });

    const contentInput = document.getElementById('content_input');
    const statusBadge = document.getElementById('uploadStatusBadge');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Khởi tạo hỗ trợ Tạo bảng, Chỉnh sửa bảng và Copy-Paste bảng
    initQuillTableSupport(quill, contentInput);

    // Nạp nội dung cũ nếu có (sau khi validate lỗi hoặc đã nhập)
    if (contentInput.value) {
        quill.clipboard.dangerouslyPasteHTML(contentInput.value, 'silent');
    }

    // Đồng bộ nội dung vào hidden input khi người dùng gõ
    quill.on('text-change', function() {
        contentInput.value = quill.root.innerHTML;
    });

    // Hàm xử lý upload ảnh lên máy chủ
    async function uploadAndInsertFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('Vui lòng chỉ chọn tệp hình ảnh!');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Dung lượng hình ảnh vượt quá 5MB. Vui lòng chọn ảnh nhỏ hơn!');
            return;
        }

        statusBadge.classList.remove('hidden');

        const formData = new FormData();
        formData.append('image', file);

        try {
            const response = await fetch("{{ route('admin.posts.upload-image', [], false) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();
            statusBadge.classList.add('hidden');

            if (data.success && data.url) {
                const range = quill.getSelection(true) || { index: quill.getLength() };
                quill.insertEmbed(range.index, 'image', data.url);
                quill.setSelection(range.index + 1);
                contentInput.value = quill.root.innerHTML;
            } else {
                alert('Tải ảnh thất bại: ' + (data.message || 'Không thể lưu ảnh.'));
            }
        } catch (error) {
            statusBadge.classList.add('hidden');
            console.error('Lỗi tải ảnh:', error);
            alert('Có lỗi mạng hoặc máy chủ khi tải ảnh lên.');
        }
    }

    // Khi người dùng bấm nút chèn ảnh trên thanh công cụ
    function handleImageUploadTrigger() {
        const fileInput = document.createElement('input');
        fileInput.setAttribute('type', 'file');
        fileInput.setAttribute('accept', 'image/jpeg,image/png,image/jpg,image/webp,image/gif');
        fileInput.click();

        fileInput.onchange = () => {
            const file = fileInput.files[0];
            if (file) {
                uploadAndInsertFile(file);
            }
        };
    }

    // Hỗ trợ dán ảnh trực tiếp từ Clipboard (Ctrl + V)
    quill.root.addEventListener('paste', function (e) {
        const clipboardData = e.clipboardData || window.clipboardData;
        if (clipboardData && clipboardData.files && clipboardData.files.length > 0) {
            const file = clipboardData.files[0];
            if (file.type.startsWith('image/')) {
                e.preventDefault();
                uploadAndInsertFile(file);
            }
        }
    });

    // Khi gửi biểu mẫu form: kiểm tra và gán nội dung
    const postForm = document.getElementById('postForm');
    postForm.addEventListener('submit', function (e) {
        const rawText = quill.getText().trim();
        const hasImages = quill.root.querySelector('img') !== null;
        
        if (!rawText && !hasImages) {
            contentInput.value = '';
            alert('Vui lòng nhập nội dung bài viết trước khi xuất bản!');
            e.preventDefault();
            return false;
        }

        contentInput.value = quill.root.innerHTML;
    });
});
</script>
@endpush
