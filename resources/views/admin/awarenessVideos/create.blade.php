@extends('layouts.admin')
@section('page-title', 'Create Video')
@section('content')<form method="POST" action="{{ route('admin.awareness-videos.store') }}">@csrf @include('admin.awarenessVideos.form')</form>@endsection
