@extends('layouts.admin')

@section('page-title', 'Career Application Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.career-applications.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Career Application Details</h2>

        <p class="admin-page-subtitle">
            Applicant details, resume, internship preference and message.
        </p>
    </div>

    <div class="show-actions">
        @can('career_application_delete')
            <form action="{{ route('admin.career-applications.destroy', $careerApplication->id) }}"
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
                    {{ strtoupper(substr($careerApplication->full_name ?? 'A', 0, 1)) }}
                </div>

                <p class="profile-title">{{ $careerApplication->full_name }}</p>
                <p class="profile-subtitle">{{ $careerApplication->internship_type }}</p>

                @if($careerApplication->status == 'new')
                    <span class="status-pill warning">New</span>
                @elseif($careerApplication->status == 'reviewed')
                    <span class="status-pill success">Reviewed</span>
                @elseif($careerApplication->status == 'shortlisted')
                    <span class="status-pill success">Shortlisted</span>
                @else
                    <span class="status-pill warning">Rejected</span>
                @endif
            </div>
        </div>

        @can('career_application_edit')
            <div class="detail-card detail-card-pad mb-3">
                <p class="quick-title">Update Status</p>

                <form method="POST" action="{{ route('admin.career-applications.updateStatus', $careerApplication->id) }}">
                    @csrf

                    <div class="field-group">
                        <select name="status" class="field-input">
                            <option value="new" {{ $careerApplication->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="reviewed" {{ $careerApplication->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ $careerApplication->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="rejected" {{ $careerApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
                <a href="{{ route('admin.career-applications.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Applications
                </a>

                @if($careerApplication->phone)
                    <a href="tel:{{ $careerApplication->phone }}" class="quick-link primary">
                        <i class="fas fa-phone"></i>
                        Call Applicant
                    </a>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $careerApplication->phone) }}" target="_blank" class="quick-link">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp Applicant
                    </a>
                @endif

                @if($careerApplication->email)
                    <a href="mailto:{{ $careerApplication->email }}" class="quick-link">
                        <i class="fas fa-envelope"></i>
                        Email Applicant
                    </a>
                @endif

                @if($careerApplication->resume)
                    <a href="{{ $careerApplication->resume }}" target="_blank" class="quick-link">
                        <i class="fas fa-file-download"></i>
                        Download Resume
                    </a>
                @endif

                @if($careerApplication->id_proof)
                    <a href="{{ $careerApplication->id_proof }}" target="_blank" class="quick-link">
                        <i class="fas fa-id-card"></i>
                        View ID Proof
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <p class="detail-section-title">Applicant Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $careerApplication->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value">{{ $careerApplication->full_name ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Phone</span>
                    <span class="detail-value">{{ $careerApplication->phone ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $careerApplication->email ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">City / State</span>
                    <span class="detail-value">{{ $careerApplication->city_state ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">College / University</span>
                    <span class="detail-value">{{ $careerApplication->college_university ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Course / Year</span>
                    <span class="detail-value">{{ $careerApplication->course_year ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Consent</span>

                    @if($careerApplication->consent)
                        <span class="status-pill success">Yes</span>
                    @else
                        <span class="status-pill warning">No</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Submitted At</span>
                    <span class="detail-value">
                        {{ optional($careerApplication->created_at)->format('d M Y, h:i A') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <p class="detail-section-title">Internship / Career Preference</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">Internship Type</span>
                    <span class="role-tag">{{ $careerApplication->internship_type ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Practice Interest</span>
                    <span class="detail-value">{{ $careerApplication->practice_area_interest ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Preferred Start Date</span>
                    <span class="detail-value">
                        {{ optional($careerApplication->preferred_start_date)->format('d M Y') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Preferred Duration</span>
                    <span class="detail-value">{{ $careerApplication->preferred_duration ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-comment-alt"></i>
                </div>

                <p class="detail-section-title">Statement Of Interest</p>
            </div>

            <div class="detail-section-pad-sm">
                <div class="detail-value" style="display:block; line-height:1.8;">
                    {!! nl2br(e($careerApplication->message ?? '-')) !!}
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-file-upload"></i>
                </div>

                <p class="detail-section-title">Uploaded Documents</p>
            </div>

            <div class="detail-section-pad-sm">
                @if($careerApplication->resume)
                    <a href="{{ $careerApplication->resume }}" target="_blank" class="quick-link primary">
                        <i class="fas fa-download"></i>
                        View / Download Resume
                    </a>
                @else
                    <div class="assign-empty">
                        <div class="assign-empty-icon">
                            <i class="fas fa-file"></i>
                        </div>

                        <p class="assign-empty-title">No resume uploaded</p>
                        <p class="assign-empty-text">Applicant did not upload resume.</p>
                    </div>
                @endif

                @if($careerApplication->id_proof)
                    <a href="{{ $careerApplication->id_proof }}" target="_blank" class="quick-link primary" style="margin-top:10px;">
                        <i class="fas fa-id-card"></i>
                        View / Download ID Proof
                    </a>
                @else
                    <div class="assign-empty" style="margin-top:12px;">
                        <div class="assign-empty-icon">
                            <i class="fas fa-id-card"></i>
                        </div>

                        <p class="assign-empty-title">No ID proof uploaded</p>
                        <p class="assign-empty-text">Applicant did not upload ID proof.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
