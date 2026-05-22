@extends('layouts.admin')

@section('page-title', 'Practice Area Services')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">
            Practice Area Services
        </h2>

        <p class="admin-page-subtitle">
            Manage service cards shown inside each practice area category and frontend detail sections.
        </p>
    </div>

    @can('practice_area_service_create')
        <a href="{{ route('admin.practice-area-services.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Service
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
        <p class="stat-label">Total Services</p>
        <p class="stat-value">{{ $practiceAreaServices->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active</p>
        <p class="stat-value">{{ $practiceAreaServices->where('status', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive</p>
        <p class="stat-value">{{ $practiceAreaServices->where('status', 0)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Added Today</p>
        <p class="stat-value">
            {{ $practiceAreaServices->where('created_at', '>=', now()->startOfDay())->count() }}
        </p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Practice Area Services</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Services will appear under selected practice area on frontend
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-PracticeAreaService">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Practice Area</th>
                    <th>Slug</th>
                    <th>Sort</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($practiceAreaServices as $service)
                    <tr data-entry-id="{{ $service->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $service->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                @if(!empty($service->image))
                                    <img src="{{ $service->image }}"
                                         alt="{{ $service->title }}"
                                         class="avatar-circle"
                                         style="object-fit:cover;">
                                @else
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($service->title ?? 'S', 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">
                                        {{ $service->title ?? '-' }}
                                    </p>

                                    <p class="table-sub-text">
                                        {{ \Illuminate\Support\Str::limit($service->short_description ?? 'Practice Area Service', 55) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($service->practiceArea)
                                <span class="role-tag">
                                    {{ $service->practiceArea->title }}
                                </span>
                            @else
                                <span style="font-size:12px; color:#94A3B8;">—</span>
                            @endif
                        </td>

                        <td>
                            <span class="code-pill">
                                {{ $service->slug ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="id-text">
                                {{ $service->sort_order ?? 0 }}
                            </span>
                        </td>

                        <td>
                            @if($service->status)
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
                                @can('practice_area_service_show')
                                    <a href="{{ route('admin.practice-area-services.show', $service->id) }}"
                                       class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('practice_area_service_edit')
                                    <a href="{{ route('admin.practice-area-services.edit', $service->id) }}"
                                       class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('practice_area_service_delete')
                                    <form action="{{ route('admin.practice-area-services.destroy', $service->id) }}"
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
    initAdminDataTable('.datatable-PracticeAreaService', {
        canDelete: @can('practice_area_service_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.practice-area-services.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search services...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ services'
    });
});
</script>
@endsection