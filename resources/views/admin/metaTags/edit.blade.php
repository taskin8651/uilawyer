@extends('layouts.admin')
@section('page-title', 'Edit Meta Tag')
@section('content')<form method="POST" action="{{ route('admin.meta-tags.update', $metaTag) }}">@csrf @method('PUT') @include('admin.metaTags.form')</form>@endsection
