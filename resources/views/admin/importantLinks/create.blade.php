@extends('layouts.admin')
@section('page-title', 'Create Link')
@section('content')<form method="POST" action="{{ route('admin.important-links.store') }}">@csrf @include('admin.importantLinks.form')</form>@endsection
