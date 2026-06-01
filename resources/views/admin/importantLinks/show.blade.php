@extends('layouts.admin')
@section('page-title', 'Link Details')
@section('content')<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $importantLink->title }}</h2><p><a href="{{ $importantLink->url }}" target="_blank">{{ $importantLink->url }}</a></p><p>Status: {{ $importantLink->status ? 'Active' : 'Inactive' }}</p><a href="{{ route('admin.important-links.index') }}" class="btn-primary">Back</a></div>@endsection
