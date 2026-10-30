@extends('errors.layout')

@section('title', '404 - Page Not Found')
@section('code', '404')
@section('badge', 'Error 404 • Page Not Found')
@section('badge_style', 'bg-orange-50 text-orange-700 border-orange-200/80')
@section('headline', 'Page Not Found')

@section('message')
The link you followed may be broken, moved, or no longer exists on AI Hub. Please check the URL or use the search bar to find what you are looking for.
@endsection
