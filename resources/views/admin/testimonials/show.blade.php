@extends('layouts.admin')

@section('page-title', 'Testimonial Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.testimonials.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Testimonial Details</h2>

        <p class="admin-page-subtitle">
            Client review details shown on frontend.
        </p>
    </div>

    <div class="show-actions">
        @can('testimonial_edit')
            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit Testimonial
            </a>
        @endcan

        @can('testimonial_delete')
            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
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
                    {{ strtoupper(substr($testimonial->client_name ?? 'R', 0, 1)) }}
                </div>

                <p class="profile-title">{{ $testimonial->client_name }}</p>

                <p class="profile-subtitle">
                    {{ $testimonial->client_designation ?: 'Verified Feedback' }}
                </p>

                @if($testimonial->status)
                    <span class="status-pill success">
                        <i class="fas fa-check-circle"></i>
                        Active
                    </span>
                @else
                    <span class="status-pill warning">
                        <i class="fas fa-clock"></i>
                        Inactive
                    </span>
                @endif
            </div>

            <div class="detail-section-pad-sm">
                <div class="d-grid gap-2" style="grid-template-columns: 1fr 1fr;">
                    <div class="stat-mini">
                        <p class="stat-mini-label">Review ID</p>
                        <p class="stat-mini-value">#{{ $testimonial->id }}</p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">Rating</p>
                        <p class="stat-mini-value">{{ str_repeat('★', (int) $testimonial->rating) }}</p>
                    </div>

                    <div class="stat-mini" style="grid-column: span 2;">
                        <p class="stat-mini-label">Created On</p>
                        <p class="stat-mini-value-sm">
                            {{ optional($testimonial->created_at)->format('d M Y') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-card detail-card-pad">
            <p class="quick-title">Quick Actions</p>

            <div class="quick-list">
                @can('testimonial_edit')
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="quick-link primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit Testimonial
                    </a>
                @endcan

                <a href="{{ route('admin.testimonials.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Testimonials
                </a>

                @can('testimonial_create')
                    <a href="{{ route('admin.testimonials.create') }}" class="quick-link">
                        <i class="fas fa-plus"></i>
                        Add New Testimonial
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-star"></i>
                </div>

                <p class="detail-section-title">Review Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $testimonial->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Client Name</span>
                    <span class="detail-value">{{ $testimonial->client_name ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Client Label</span>
                    <span class="detail-value">{{ $testimonial->client_designation ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Rating</span>
                    <span class="role-tag">{{ str_repeat('★', (int) $testimonial->rating) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Sort Order</span>
                    <span class="detail-value">{{ $testimonial->sort_order ?? 0 }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>

                    @if($testimonial->status)
                        <span class="status-pill success">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </span>
                    @else
                        <span class="status-pill warning">
                            <i class="fas fa-clock"></i>
                            Inactive
                        </span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Created At</span>
                    <span class="detail-value">
                        {{ optional($testimonial->created_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Updated At</span>
                    <span class="detail-value">
                        {{ optional($testimonial->updated_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>

                <p class="detail-section-title">Review Message</p>
            </div>

            <div class="detail-section-pad-sm">
                <div class="detail-value" style="display:block; line-height:1.8;">
                    {!! nl2br(e($testimonial->review ?? '-')) !!}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection