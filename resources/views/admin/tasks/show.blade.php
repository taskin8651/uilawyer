@extends('layouts.admin')
@section('page-title', 'Task Details')
@section('content')
<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $task->title }}</h2><p class="admin-page-subtitle">{{ $task->description }}</p><p><strong>Status:</strong> {{ ucwords(str_replace('_',' ',$task->status)) }}</p><p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p><p><strong>Due date:</strong> {{ optional($task->due_date)->format('d M Y') ?: '-' }}</p><p><strong>Created by:</strong> {{ $task->creator->name ?? '-' }}</p><p><strong>Assigned to:</strong> {{ $task->assignee->name ?? '-' }}</p><a href="{{ route('admin.tasks.index') }}" class="btn-primary">Back</a></div>
@endsection
