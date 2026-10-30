@extends('errors.layout')

@section('title', '500 - Server Error')
@section('code', '500')
@section('badge', 'Error 500 • System Error')
@section('badge_style', 'bg-slate-100 text-slate-700 border-slate-300')
@section('headline', 'Technical Issue Encountered')

@section('message')
Our server encountered a temporary issue while processing your request. All technical details have been securely logged for our engineering team. Please try again in a few minutes.
@endsection
