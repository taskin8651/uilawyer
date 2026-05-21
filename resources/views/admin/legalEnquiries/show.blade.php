@extends('layouts.admin')

@section('page-title', 'Legal Enquiry Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.legal-enquiries.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Legal Enquiry Details</h2>

        <p class="admin-page-subtitle">
            Full client enquiry details, message and uploaded document.
        </p>
    </div>

    <div class="show-actions">
        @can('legal_enquiry_delete')
            <form action="{{ route('admin.legal-enquiries.destroy', $legalEnquiry->id) }}"
                  method="POST"
                  onsubmit="return confirm('{{ trans('global.areYouSure') }}')">
                @method('DELETE')
                @csrf

                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-alt"></i>
                    Delete
                </button>
            </form>
        @endcan
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="show-grid">

    <div>
        <div class="detail-card mb-3">
            <div class="profile-hero">
                <div class="profile-avatar-lg">
                    {{ strtoupper(substr($legalEnquiry->full_name ?? 'E', 0, 1)) }}
                </div>

                <p class="profile-title">{{ $legalEnquiry->full_name }}</p>
                <p class="profile-subtitle">{{ $legalEnquiry->case_category }}</p>

                @if($legalEnquiry->status == 'new')
                    <span class="status-pill warning">New</span>
                @elseif($legalEnquiry->status == 'contacted')
                    <span class="status-pill success">Contacted</span>
                @else
                    <span class="status-pill">Closed</span>
                @endif
            </div>
        </div>

        @can('legal_enquiry_edit')
            <div class="detail-card detail-card-pad mb-3">
                <p class="quick-title">Update Status</p>

                <form method="POST" action="{{ route('admin.legal-enquiries.updateStatus', $legalEnquiry->id) }}">
                    @csrf

                    <div class="field-group">
                        <select name="status" class="field-input">
                            <option value="new" {{ $legalEnquiry->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="contacted" {{ $legalEnquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="closed" {{ $legalEnquiry->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%;">
                        <i class="fas fa-save"></i>
                        Update Status
                    </button>
                </form>
            </div>
        @endcan

        <div class="detail-card detail-card-pad">
            <p class="quick-title">Quick Actions</p>

            <div class="quick-list">
                <a href="{{ route('admin.legal-enquiries.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Enquiries
                </a>

                @if($legalEnquiry->mobile)
                    <a href="tel:{{ $legalEnquiry->mobile }}" class="quick-link primary">
                        <i class="fas fa-phone"></i>
                        Call Client
                    </a>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $legalEnquiry->mobile) }}" target="_blank" class="quick-link">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp Client
                    </a>
                @endif

                @if($legalEnquiry->email)
                    <a href="mailto:{{ $legalEnquiry->email }}" class="quick-link">
                        <i class="fas fa-envelope"></i>
                        Email Client
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-user"></i>
                </div>

                <p class="detail-section-title">Client Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $legalEnquiry->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Form Type</span>
                    <span class="detail-value">{{ ucfirst($legalEnquiry->form_type) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value">{{ $legalEnquiry->full_name ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Mobile</span>
                    <span class="detail-value">{{ $legalEnquiry->mobile ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $legalEnquiry->email ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">City / State</span>
                    <span class="detail-value">{{ $legalEnquiry->city_state ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Case Category</span>
                    <span class="role-tag">{{ $legalEnquiry->case_category ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Consent</span>

                    @if($legalEnquiry->consent)
                        <span class="status-pill success">Yes</span>
                    @else
                        <span class="status-pill warning">No</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Submitted At</span>
                    <span class="detail-value">
                        {{ optional($legalEnquiry->created_at)->format('d M Y, h:i A') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <p class="detail-section-title">Consultation Preference</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">Preferred Mode</span>
                    <span class="detail-value">{{ $legalEnquiry->preferred_contact_mode ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Preferred Date</span>
                    <span class="detail-value">
                        {{ optional($legalEnquiry->preferred_date)->format('d M Y') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Preferred Time</span>
                    <span class="detail-value">{{ $legalEnquiry->preferred_time ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-comment-alt"></i>
                </div>

                <p class="detail-section-title">Case Message</p>
            </div>

            <div class="detail-section-pad-sm">
                <div class="detail-value" style="display:block; line-height:1.8;">
                    {!! nl2br(e($legalEnquiry->case_message ?? '-')) !!}
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-file-upload"></i>
                </div>

                <p class="detail-section-title">Uploaded Document</p>
            </div>

            <div class="detail-section-pad-sm">
                @if($legalEnquiry->document)
                    <a href="{{ $legalEnquiry->document }}" target="_blank" class="quick-link primary">
                        <i class="fas fa-download"></i>
                        View / Download Document
                    </a>
                @else
                    <div class="assign-empty">
                        <div class="assign-empty-icon">
                            <i class="fas fa-file"></i>
                        </div>

                        <p class="assign-empty-title">No document uploaded</p>
                        <p class="assign-empty-text">Client did not upload any case document.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection