@extends('layouts.admin')
@section('page-title', 'Meta Tag Details')
@section('content')<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $metaTag->page_name }}</h2><p><strong>Key:</strong> {{ $metaTag->page_key }}</p><p><strong>Title:</strong> {{ $metaTag->meta_title }}</p><p><strong>Description:</strong> {{ $metaTag->meta_description }}</p><p><strong>Keywords:</strong> {{ $metaTag->meta_keywords }}</p><a href="{{ route('admin.meta-tags.index') }}" class="btn-primary">Back</a></div>@endsection
