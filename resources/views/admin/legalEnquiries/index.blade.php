@extends('layouts.admin')

@section('page-title', 'Legal Enquiries')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Legal Enquiries</h2>
        <p class="admin-page-subtitle">
            Manage consultation and contact form enquiries submitted from frontend.
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
        <p class="stat-label">Total Enquiries</p>
        <p class="stat-value">{{ $legalEnquiries->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">New</p>
        <p class="stat-value">{{ $legalEnquiries->where('status', 'new')->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Contacted</p>
        <p class="stat-value">{{ $legalEnquiries->where('status', 'contacted')->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Closed</p>
        <p class="stat-value">{{ $legalEnquiries->where('status', 'closed')->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Legal Enquiries</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Latest enquiry appears first
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-LegalEnquiry">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Mobile</th>
                    <th>Category</th>
                    <th>Form</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($legalEnquiries as $enquiry)
                    <tr data-entry-id="{{ $enquiry->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $enquiry->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($enquiry->full_name ?? 'E', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="table-main-text">{{ $enquiry->full_name ?? '-' }}</p>
                                    <p class="table-sub-text">{{ $enquiry->email ?? 'No email' }}</p>
                                </div>
                            </div>
                        </td>

                        <td style="color:#475569;">
                            {{ $enquiry->mobile ?? '-' }}
                        </td>

                        <td>
                            <span class="role-tag">{{ $enquiry->case_category ?? '-' }}</span>
                        </td>

                        <td>
                            @if($enquiry->form_type == 'consultation')
                                <span class="status-pill success">Consultation</span>
                            @else
                                <span class="status-pill warning">Contact</span>
                            @endif
                        </td>

                        <td>
                            <span class="id-text">
                                {{ optional($enquiry->created_at)->format('d M Y') }}
                            </span>
                        </td>

                        <td>
                            @if($enquiry->status == 'new')
                                <span class="status-pill warning">New</span>
                            @elseif($enquiry->status == 'contacted')
                                <span class="status-pill success">Contacted</span>
                            @else
                                <span class="status-pill">Closed</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">
                                @can('legal_enquiry_show')
                                    <a href="{{ route('admin.legal-enquiries.show', $enquiry->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('legal_enquiry_delete')
                                    <form action="{{ route('admin.legal-enquiries.destroy', $enquiry->id) }}"
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
    initAdminDataTable('.datatable-LegalEnquiry', {
        canDelete: @can('legal_enquiry_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.legal-enquiries.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search enquiries...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ enquiries'
    });
});
</script>
@endsection