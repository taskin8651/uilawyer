@extends('layouts.admin')

@section('page-title', 'Career Applications')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Career Applications</h2>

        <p class="admin-page-subtitle">
            Manage internship and career applications submitted from frontend.
        </p>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <p class="stat-label">Total Applications</p>
        <p class="stat-value">{{ $careerApplications->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">New</p>
        <p class="stat-value">{{ $careerApplications->where('status', 'new')->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Reviewed</p>
        <p class="stat-value">{{ $careerApplications->where('status', 'reviewed')->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Shortlisted</p>
        <p class="stat-value">{{ $careerApplications->where('status', 'shortlisted')->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Career Applications</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Latest application appears first
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-CareerApplication">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Applicant</th>
                    <th>Phone</th>
                    <th>Internship Type</th>
                    <th>Interest</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($careerApplications as $application)
                    <tr data-entry-id="{{ $application->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $application->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($application->full_name ?? 'A', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="table-main-text">{{ $application->full_name ?? '-' }}</p>
                                    <p class="table-sub-text">{{ $application->email ?? 'No email' }}</p>
                                </div>
                            </div>
                        </td>

                        <td style="color:#475569;">
                            {{ $application->phone ?? '-' }}
                        </td>

                        <td>
                            <span class="role-tag">{{ $application->internship_type ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="code-pill">{{ $application->practice_area_interest ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="id-text">
                                {{ optional($application->created_at)->format('d M Y') }}
                            </span>
                        </td>

                        <td>
                            @if($application->status == 'new')
                                <span class="status-pill warning">New</span>
                            @elseif($application->status == 'reviewed')
                                <span class="status-pill success">Reviewed</span>
                            @elseif($application->status == 'shortlisted')
                                <span class="status-pill success">Shortlisted</span>
                            @else
                                <span class="status-pill warning">Rejected</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">
                                @can('career_application_show')
                                    <a href="{{ route('admin.career-applications.show', $application->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('career_application_delete')
                                    <form action="{{ route('admin.career-applications.destroy', $application->id) }}"
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
    initAdminDataTable('.datatable-CareerApplication', {
        canDelete: @can('career_application_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.career-applications.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search applications...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ applications'
    });
});
</script>
@endsection