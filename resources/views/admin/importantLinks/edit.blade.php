@extends('layouts.admin')
@section('page-title', 'Edit Link')
@section('content')<form method="POST" action="{{ route('admin.important-links.update', $importantLink) }}">@csrf @method('PUT') @include('admin.importantLinks.form')</form>@endsection
