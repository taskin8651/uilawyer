@extends('layouts.admin')
@section('page-title', 'Create Meta Tag')
@section('content')<form method="POST" action="{{ route('admin.meta-tags.store') }}">@csrf @include('admin.metaTags.form')</form>@endsection
