@extends('layouts.admin')
@section('page-title', 'Notification')
@section('content')<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $notification->title }}</h2><p>{{ $notification->message }}</p>@if($notification->url)<p><a href="{{ $notification->url }}" target="_blank">{{ $notification->url }}</a></p>@endif<p>Status: {{ $notification->read_at ? 'Read' : 'Unread' }}</p><a href="{{ route('admin.notifications.index') }}" class="btn-primary">Back</a></div>@endsection
