@extends('layouts.admin')
@section('page-title', 'Tasks')
@section('content')
<div class="admin-page-head">
    <div><h2 class="admin-page-title">Task Management</h2><p class="admin-page-subtitle">Create, assign and track internal work.</p></div>
    @can('task_create')<a href="{{ route('admin.tasks.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Add Task</a>@endcan
</div>
<div class="page-card"><div class="page-card-table"><table class="min-w-full datatable datatable-Task">
    <thead><tr><th></th><th>ID</th><th>Title</th><th>Priority</th><th>Status</th><th>Due Date</th><th>Assigned To</th><th style="text-align:right;">Actions</th></tr></thead>
    <tbody>@foreach($tasks as $task)<tr data-entry-id="{{ $task->id }}"><td></td><td>#{{ $task->id }}</td><td>{{ $task->title }}</td><td><span class="role-tag">{{ ucfirst($task->priority) }}</span></td><td>{{ ucwords(str_replace('_', ' ', $task->status)) }}</td><td>{{ optional($task->due_date)->format('d M Y') ?: '-' }}</td><td>{{ $task->assignee->name ?? '-' }}</td><td><div class="action-row">
        @can('task_show')<a class="btn-outline" href="{{ route('admin.tasks.show', $task) }}"><i class="fas fa-eye"></i> View</a>@endcan
        @can('task_edit')<a class="btn-outline btn-outline-edit" href="{{ route('admin.tasks.edit', $task) }}"><i class="fas fa-pencil-alt"></i> Edit</a>@endcan
        @can('task_delete')<form method="POST" action="{{ route('admin.tasks.destroy', $task) }}" onsubmit="return confirm('{{ trans('global.areYouSure') }}')" style="display:inline">@csrf @method('DELETE')<button class="btn-outline btn-outline-danger"><i class="fas fa-trash"></i> Delete</button></form>@endcan
    </div></td></tr>@endforeach</tbody>
</table></div></div>
@endsection
@section('scripts')@parent<script>$(function(){initAdminDataTable('.datatable-Task',{canDelete:@can('task_delete') true @else false @endcan,massDeleteUrl:"{{ route('admin.tasks.massDestroy') }}",searchPlaceholder:'Search tasks...'});});</script>@endsection
