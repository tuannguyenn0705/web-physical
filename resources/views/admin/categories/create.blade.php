@extends('layouts.admin')

@section('title', 'Thêm danh mục mới')
@section('header_title', 'Thêm danh mục mới')

@section('header_actions')
<a href="{{ route('admin.categories.index') }}" 
   class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl transition shadow-xs hover:bg-gray-50">
    Quay lại danh sách
</a>
@endsection

@section('content')
<div class="max-w-2xl bg-white p-6 rounded-2xl border border-gray-200/80 shadow-xs">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Tên Danh Mục <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                   placeholder="Ví dụ: AI Tools, ChatGPT..."
                   class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
        </div>

        <div>
            <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Mô Tả Ngắn</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="parent_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Danh Mục Cha</label>
                <select name="parent_id" id="parent_id" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <option value="">-- Không có (Danh mục gốc) --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="order" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Thứ Tự Sắp Xếp</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                       class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
        </div>

        <div>
            <label class="flex items-center gap-2 cursor-pointer pt-2 select-none">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-gray-950 focus:ring-gray-900 border-gray-300 rounded">
                <span class="text-xs font-medium text-gray-700">Kích hoạt danh mục</span>
            </label>
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center gap-2">
            <button type="submit" class="py-2.5 px-4 bg-gray-950 hover:bg-gray-800 text-white rounded-xl text-xs font-semibold transition cursor-pointer">
                Lưu Danh Mục
            </button>
            <a href="{{ route('admin.categories.index') }}" class="py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-medium transition">
                Hủy
            </a>
        </div>
    </form>
</div>
@endsection
