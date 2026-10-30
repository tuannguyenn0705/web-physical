@extends('errors.layout')

@section('title', '403 - Access Denied')
@section('code', '403')
@section('badge', 'Error 403 • Restricted Access')
@section('badge_style', 'bg-red-50 text-red-700 border-red-200/80')
@section('headline', 'Access Denied')

@section('message')
This area requires administrator privileges or your account does not have permission to view this resource. If you are an administrator, please sign in with an authorized account to continue.
@endsection
