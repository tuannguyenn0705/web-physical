@extends('errors.layout')

@section('title', '429 - Too Many Requests')
@section('code', '429')
@section('badge', 'Error 429 • Rate Limit Exceeded')
@section('badge_style', 'bg-rose-50 text-rose-700 border-rose-200/80')
@section('headline', 'Too Many Requests')

@section('message')
Our security system detected unusually rapid requests from your IP address. Please wait a moment before trying again.
@endsection
