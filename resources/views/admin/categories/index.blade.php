@extends('layouts.admin')

@section('title', 'Quản lý danh mục')
@section('header_title', 'Danh mục bài viết')

@section('header_actions')
<a href="{{ route('admin.categories.create') }}" 
   class="inline-flex items-center bg-gray-950 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs hover:shadow-sm">
    Thêm danh mục mới
</a>
@endsection

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="py-4 px-6">Tên Danh Mục</th>
                        <th class="py-4 px-4">Đường Dẫn (Slug)</th>
                        <th class="py-4 px-4 text-center">Số Bài Viết</th>
                        <th class="py-4 px-4">Thứ Tự</th>
                        <th class="py-4 px-4">Trạng Thái</th>
                        <th class="py-4 px-6 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                <div>{{ $category->name }}</div>
                                @if($category->description)
                                    <p class="text-xs text-gray-500 font-normal mt-0.5">{{ Str::limit($category->description, 60) }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-4 font-mono text-gray-500 text-xs">
                                /categories/{{ $category->slug }}
                            </td>
                            <td class="py-4 px-4 text-center font-mono font-medium text-xs">
                                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-700">
                                    {{ $category->posts_count ?? 0 }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-gray-600 font-mono text-xs">
                                {{ $category->order ?? 0 }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($category->is_active)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Hoạt động
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Ẩn
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2 text-xs">
                                    <a href="{{ route('categories.show', $category->slug) }}" target="_blank"
                                       class="px-2.5 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                                        Xem
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="px-2.5 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium transition">
                                        Sửa
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');"
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
                            <td colspan="6" class="py-10 text-center text-gray-400 text-sm">
                                Chưa có danh mục nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
