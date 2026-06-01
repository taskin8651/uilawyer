@extends('layouts.admin')
@section('page-title', 'Video Details')
@section('content')<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $awarenessVideo->title }}</h2><p>{{ $awarenessVideo->short_description }}</p><p><a href="{{ $awarenessVideo->video_url }}" target="_blank">{{ $awarenessVideo->video_url }}</a></p><a href="{{ route('admin.awareness-videos.index') }}" class="btn-primary">Back</a></div>@endsection
