@extends('errors.layout')

@section('title', '419 - Session Expired')
@section('code', '419')
@section('badge', 'Error 419 • Session Expired')
@section('badge_style', 'bg-amber-50 text-amber-700 border-amber-200/80')
@section('headline', 'Your Session Has Expired')

@section('message')
The page has been inactive for too long or your security token (CSRF) was refreshed to protect your account. Please reload the page and try again.
@endsection
