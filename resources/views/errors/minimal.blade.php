@extends('errors.layout')

@section('title', ($exception?->getStatusCode() ?? 'Lỗi') . ' - Thông báo sự cố')
@section('code', $exception?->getStatusCode() ?? 'Error')
@section('badge', 'Mã trạng thái: ' . ($exception?->getStatusCode() ?? 'Lỗi'))
@section('badge_style', 'bg-gray-100 text-gray-700 border-gray-200')
@section('headline', 'Yêu cầu không thể hoàn tất')

@section('message')
Hệ thống không thể hoàn tất yêu cầu của bạn. Sự cố đã được xử lý và ghi nhận nhật ký an toàn. Vui lòng quay trở lại trang chủ hoặc kiểm tra lại đường dẫn thao tác.
@endsection
