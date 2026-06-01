@extends('layouts.admin')
@section('page-title', 'Edit Video')
@section('content')<form method="POST" action="{{ route('admin.awareness-videos.update', $awarenessVideo) }}">@csrf @method('PUT') @include('admin.awarenessVideos.form')</form>@endsection
