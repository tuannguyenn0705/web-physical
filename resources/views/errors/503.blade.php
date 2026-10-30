@extends('errors.layout')

@section('title', '503 - Scheduled Maintenance')
@section('code', '503')
@section('badge', 'Maintenance • System Upgrade')
@section('badge_style', 'bg-blue-50 text-blue-700 border-blue-200/80')
@section('headline', 'Scheduled System Maintenance')

@section('message')
AI Hub 2026 is currently performing a database upgrade and performance optimization to deliver a faster, safer experience. We will be back online shortly.
@endsection
