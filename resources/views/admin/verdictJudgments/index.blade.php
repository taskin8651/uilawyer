@extends('layouts.admin')

@section('page-title', 'Verdicts & Judgments')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Verdicts & Judgments</h2>
        <p class="admin-page-subtitle">
            Manage important court judgments, case notes, documents and frontend visibility.
        </p>
    </div>

    @can('verdict_judgment_create')
        <a href="{{ route('admin.verdict-judgments.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Judgment
        </a>
    @endcan
</div>

@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <p class="stat-label">Total Judgments</p>
        <p class="stat-value">{{ $verdictJudgments->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active</p>
        <p class="stat-value">{{ $verdictJudgments->where('status', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Featured</p>
        <p class="stat-value">{{ $verdictJudgments->where('is_featured', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive</p>
        <p class="stat-value">{{ $verdictJudgments->where('status', 0)->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Verdicts & Judgments</p>
        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Active records show on frontend
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-VerdictJudgment">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Judgment</th>
                    <th>Court</th>
                    <th>Case No.</th>
                    <th>Date</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($verdictJudgments as $verdictJudgment)
                    <tr data-entry-id="{{ $verdictJudgment->id }}">
                        <td></td>
                        <td><span class="id-text">#{{ $verdictJudgment->id }}</span></td>

                        <td>
                            <div class="inline-flex-center">
                                @if($verdictJudgment->image)
                                    <img src="{{ $verdictJudgment->image }}" alt="{{ $verdictJudgment->title }}" class="avatar-circle" style="object-fit:cover;">
                                @else
                                    <div class="avatar-circle">{{ strtoupper(substr($verdictJudgment->title ?? 'V', 0, 1)) }}</div>
                                @endif

                                <div>
                                    <p class="table-main-text">{{ $verdictJudgment->title ?? '-' }}</p>
                                    <p class="table-sub-text">{{ $verdictJudgment->slug ?? '-' }}</p>
                                </div>
                            </div>
                        </td>

                        <td style="color:#475569;">{{ $verdictJudgment->court_name ?? '-' }}</td>
                        <td><span class="id-text">{{ $verdictJudgment->case_number ?? '-' }}</span></td>
                        <td><span class="id-text">{{ optional($verdictJudgment->judgment_date)->format('d M Y') ?? '-' }}</span></td>

                        <td>
                            @if($verdictJudgment->is_featured)
                                <span class="status-pill success">Yes</span>
                            @else
                                <span class="status-pill warning">No</span>
                            @endif
                        </td>

                        <td>
                            @if($verdictJudgment->status)
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
                                @can('verdict_judgment_show')
                                    <a href="{{ route('admin.verdict-judgments.show', $verdictJudgment->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('verdict_judgment_edit')
                                    <a href="{{ route('admin.verdict-judgments.edit', $verdictJudgment->id) }}" class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('verdict_judgment_delete')
                                    <form action="{{ route('admin.verdict-judgments.destroy', $verdictJudgment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ trans('global.areYouSure') }}')">
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
    initAdminDataTable('.datatable-VerdictJudgment', {
        canDelete: @can('verdict_judgment_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.verdict-judgments.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search judgments...',
        infoText: 'Showing _START_-_END_ of _TOTAL_ judgments'
    });
});
</script>
@endsection
