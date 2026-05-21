@extends('layouts.admin')

@section('page-title', 'Attorneys')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Attorneys</h2>
        <p class="admin-page-subtitle">
            Manage attorney profiles, designations, tags and frontend team cards
        </p>
    </div>

    @can('attorney_create')
        <a href="{{ route('admin.attorneys.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Attorney
        </a>
    @endcan
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <p class="stat-label">Total Attorneys</p>
        <p class="stat-value">{{ $attorneys->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active</p>
        <p class="stat-value">{{ $attorneys->where('status', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive</p>
        <p class="stat-value">{{ $attorneys->where('status', 0)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Added Today</p>
        <p class="stat-value">{{ $attorneys->where('created_at', '>=', now()->startOfDay())->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Attorneys</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Select rows to use bulk actions
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Attorney">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Attorney</th>
                    <th>Designation</th>
                    <th>Badge</th>
                    <th>Tags</th>
                    <th>Sort</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($attorneys as $attorney)
                    <tr data-entry-id="{{ $attorney->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $attorney->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                @if($attorney->image)
                                    <img src="{{ $attorney->image }}"
                                         alt="{{ $attorney->name }}"
                                         class="avatar-circle"
                                         style="object-fit:cover;">
                                @else
                                    @php
                                        $colors = ['#4F46E5','#0EA5E9','#10B981','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'];
                                        $color  = $colors[$attorney->id % count($colors)];
                                    @endphp

                                    <div class="avatar-circle" style="background: {{ $color }};">
                                        {{ strtoupper(substr($attorney->name ?? 'A', 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">{{ $attorney->name ?? '-' }}</p>
                                    <p class="table-sub-text">Attorney Profile</p>
                                </div>
                            </div>
                        </td>

                        <td style="color:#475569;">
                            {{ $attorney->designation ?? '-' }}
                        </td>

                        <td>
                            @if($attorney->badge)
                                <span class="role-tag">{{ $attorney->badge }}</span>
                            @else
                                <span style="font-size:12px; color:#94A3B8;">—</span>
                            @endif
                        </td>

                        <td>
                            <div class="tag-wrap">
                                @forelse($attorney->tags ?? [] as $tag)
                                    <span class="role-tag">{{ $tag }}</span>
                                @empty
                                    <span style="font-size:12px; color:#94A3B8;">—</span>
                                @endforelse
                            </div>
                        </td>

                        <td>
                            <span class="id-text">{{ $attorney->sort_order }}</span>
                        </td>

                        <td>
                            @if($attorney->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>
                                    <span style="font-size:12.5px; color:#166534;">Active</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>
                                    <span style="font-size:12.5px; color:#92400E;">Inactive</span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">
                                @can('attorney_show')
                                    <a href="{{ route('admin.attorneys.show', $attorney->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('attorney_edit')
                                    <a href="{{ route('admin.attorneys.edit', $attorney->id) }}" class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('attorney_delete')
                                    <form action="{{ route('admin.attorneys.destroy', $attorney->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}')">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="btn-outline btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {
    initAdminDataTable('.datatable-Attorney', {
        canDelete: @can('attorney_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.attorneys.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search attorneys...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ attorneys'
    });
});
</script>
@endsection