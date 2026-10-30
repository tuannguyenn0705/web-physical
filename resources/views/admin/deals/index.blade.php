@extends('layouts.admin')

@section('title', 'Quản lý Deals')
@section('header_title', 'Quản lý Deals (Affiliate)')

@section('header_actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('deals.index') }}" target="_blank"
       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 bg-white border border-gray-200 px-3.5 py-2.5 rounded-xl transition shadow-2xs hover:bg-gray-50">
        Xem trang Deals
    </a>
    <a href="{{ route('admin.deals.create') }}"
       class="inline-flex items-center bg-gray-950 hover:bg-gray-800 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-xs hover:shadow-sm">
        + Thêm Deal mới
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    {{-- 1. TABS TRẠNG THÁI --}}
    <div class="bg-white p-2 rounded-2xl border border-gray-200/90 shadow-xs flex flex-wrap gap-1.5">
        @php
            $tabs = [
                ['key' => null, 'label' => 'Tất cả Deals', 'count' => $counts['all'] ?? 0],
                ['key' => 'active', 'label' => 'Đang hiển thị', 'count' => $counts['active'] ?? 0],
                ['key' => 'inactive', 'label' => 'Đang ẩn', 'count' => $counts['inactive'] ?? 0],
            ];
            $currentStatus = request('status');
        @endphp

        @foreach($tabs as $tab)
            @php
                $isActive = ($tab['key'] === null && !$currentStatus) || ($tab['key'] === $currentStatus);
            @endphp
            <a href="{{ route('admin.deals.index', array_merge(request()->except(['page']), ['status' => $tab['key']])) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-medium transition-all {{ $isActive ? 'bg-gray-950 text-white font-semibold shadow-xs' : 'text-gray-600 hover:text-gray-950 hover:bg-gray-100' }}">
                <span>{{ $tab['label'] }}</span>
                <span class="px-2 py-0.5 rounded-full text-xs {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-600' }}">
                    {{ $tab['count'] }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- 2. THANH TÌM KIẾM --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-200/90 shadow-xs">
        <form method="GET" action="{{ route('admin.deals.index') }}" class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 items-center">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div class="lg:col-span-10">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Tìm kiếm theo tiêu đề deal, mô tả hoặc link ref..."
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            </div>

            <div class="lg:col-span-2 flex items-center gap-2">
                <button type="submit"
                        class="w-full py-2.5 px-4 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-sm font-semibold transition text-center cursor-pointer">
                    Tìm kiếm
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.deals.index', ['status' => request('status')]) }}"
                       class="py-2.5 px-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-medium transition text-center whitespace-nowrap">
                        Bỏ lọc
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- 3. BẢNG DANH SÁCH DEALS --}}
    <div class="bg-white rounded-2xl border border-gray-200/90 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="py-4 px-6">Thông Tin Deal</th>
                        <th class="py-4 px-4">Nhãn & Mã Code</th>
                        <th class="py-4 px-4">Link Affiliate (Ref)</th>
                        <th class="py-4 px-4 text-center">Lượt Click</th>
                        <th class="py-4 px-4 text-center">Thứ Tự</th>
                        <th class="py-4 px-4">Trạng Thái</th>
                        <th class="py-4 px-6 text-right">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                    @forelse($deals as $deal)
                        <tr class="hover:bg-gray-50/70 transition">
                            {{-- Thông tin Deal --}}
                            <td class="py-4 px-6 max-w-md">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-lg bg-stone-100 border border-gray-200 overflow-hidden shrink-0 flex items-center justify-center">
                                        @if($deal->image_url)
                                            <img src="{{ $deal->image_url }}" alt="{{ $deal->title }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-[11px] font-bold text-gray-500 uppercase">DEAL</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.deals.edit', $deal) }}" class="font-semibold text-gray-900 hover:text-orange-600 transition truncate block text-sm">
                                                {{ $deal->title }}
                                            </a>
                                            @if($deal->is_featured)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 shrink-0">Nổi bật</span>
                                            @endif
                                        </div>
                                        @if($deal->description)
                                            <p class="text-xs text-gray-500 truncate mt-0.5">{{ $deal->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Nhãn hiển thị & Mã giảm giá --}}
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="flex flex-col items-start gap-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-[#E11D48] text-white">
                                            {{ $deal->badge_text ?: 'Deal' }}
                                        </span>
                                        @if($deal->coupon_code)
                                            <span class="px-2 py-0.5 bg-gray-100 border border-dashed border-gray-300 rounded text-xs font-mono font-bold text-gray-800">
                                                {{ $deal->coupon_code }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">
                                        {{ $deal->sub_badge_text ?: 'DISCOUNT DEAL' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Link Ref --}}
                            <td class="py-4 px-4 max-w-xs">
                                <a href="{{ $deal->affiliate_url }}" target="_blank" rel="noopener noreferrer"
                                   class="text-xs font-mono text-blue-600 hover:underline truncate block">
                                    {{ $deal->affiliate_url }}
                                </a>
                                <span class="text-[11px] text-gray-400">Nút: {{ $deal->button_text ?: 'Shop Now' }}</span>
                            </td>

                            {{-- Lượt Click --}}
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 font-mono text-xs font-bold">
                                    {{ number_format($deal->clicks_count ?? 0) }}
                                </span>
                            </td>

                            {{-- Thứ tự --}}
                            <td class="py-4 px-4 text-center font-mono text-xs text-gray-600">
                                {{ $deal->order }}
                            </td>

                            {{-- Trạng thái --}}
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($deal->is_active)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100/80 text-emerald-800">
                                        Hiển thị
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Đang ẩn
                                    </span>
                                @endif
                            </td>

                            {{-- Thao tác --}}
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2 text-xs">
                                    <a href="{{ $deal->affiliate_url }}" target="_blank" rel="noopener noreferrer"
                                       class="px-2.5 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                                        Mở Link
                                    </a>

                                    <a href="{{ route('admin.deals.edit', $deal) }}"
                                       class="px-2.5 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium transition">
                                        Sửa
                                    </a>

                                    <form method="POST" action="{{ route('admin.deals.destroy', $deal) }}"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa Deal này?');"
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
                                <p>Chưa có Deal nào trong danh sách.</p>
                                <a href="{{ route('admin.deals.create') }}" class="inline-block mt-3 text-sm text-orange-600 hover:underline font-semibold">
                                    + Thêm Deal đầu tiên ngay
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($deals->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $deals->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
