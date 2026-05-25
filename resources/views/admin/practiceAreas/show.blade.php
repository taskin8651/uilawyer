@extends('layouts.admin')

@section('page-title', 'Practice Area Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Practice Area Details
        </h2>

        <p class="admin-page-subtitle">
            Frontend detail page, service card and menu content for this practice area.
        </p>
    </div>

    <div class="show-actions">
        @can('practice_area_edit')
            <a href="{{ route('admin.practice-areas.edit', $practiceArea->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit Practice Area
            </a>
        @endcan

        @can('practice_area_delete')
            <form action="{{ route('admin.practice-areas.destroy', $practiceArea->id) }}"
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
                @if($practiceArea->image)
                    <img src="{{ $practiceArea->image }}"
                         alt="{{ $practiceArea->title }}"
                         class="profile-avatar-lg"
                         style="object-fit:cover;">
                @else
                    <div class="profile-avatar-lg">
                        {{ strtoupper(substr($practiceArea->title ?? 'P', 0, 1)) }}
                    </div>
                @endif

                <p class="profile-title">
                    {{ $practiceArea->title }}
                </p>

                <p class="profile-subtitle">
                    {{ $practiceArea->slug ?? 'practice-area' }}
                </p>

                @if($practiceArea->status)
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
                        <p class="stat-mini-label">Practice ID</p>
                        <p class="stat-mini-value">#{{ $practiceArea->id }}</p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">Sort Order</p>
                        <p class="stat-mini-value">{{ $practiceArea->sort_order ?? 0 }}</p>
                    </div>

                    <div class="stat-mini" style="grid-column: span 2;">
                        <p class="stat-mini-label">Created On</p>
                        <p class="stat-mini-value-sm">
                            {{ optional($practiceArea->created_at)->format('d M Y') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-card detail-card-pad">
            <p class="quick-title">Quick Actions</p>

            <div class="quick-list">
                @can('practice_area_edit')
                    <a href="{{ route('admin.practice-areas.edit', $practiceArea->id) }}" class="quick-link primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit Practice Area
                    </a>
                @endcan

                <a href="{{ route('admin.practice-areas.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Practice Areas
                </a>

                @can('practice_area_create')
                    <a href="{{ route('admin.practice-areas.create') }}" class="quick-link">
                        <i class="fas fa-plus"></i>
                        Add New Practice Area
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-scale-balanced"></i>
                </div>

                <p class="detail-section-title">Practice Area Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $practiceArea->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Title</span>
                    <span class="detail-value">{{ $practiceArea->title ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Slug</span>
                    <span class="detail-value code-pill">{{ $practiceArea->slug ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Icon Class</span>

                    @if($practiceArea->icon_class)
                        <span class="role-tag">
                            <i class="{{ $practiceArea->icon_class }}"></i>
                            {{ $practiceArea->icon_class }}
                        </span>
                    @else
                        <span class="detail-value">-</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Sort Order</span>
                    <span class="detail-value">{{ $practiceArea->sort_order ?? 0 }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>

                    @if($practiceArea->status)
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
                        {{ optional($practiceArea->created_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Updated At</span>
                    <span class="detail-value">
                        {{ optional($practiceArea->updated_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-align-left"></i>
                </div>

                <p class="detail-section-title">Frontend Content</p>
            </div>

            <div class="detail-section-pad-sm">
                <p class="meta-small-label">Short Description</p>

                <p class="detail-value" style="display:block; margin-bottom:18px; line-height:1.8;">
                    {{ $practiceArea->short_description ?: '-' }}
                </p>

                <p class="meta-small-label">Full Description</p>

                <div class="detail-value" style="display:block; line-height:1.8;">
                    @if($practiceArea->description)
                        {!! $practiceArea->description !!}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-search"></i>
                </div>

                <p class="detail-section-title">SEO Meta Details</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">Meta Title</span>
                    <span class="detail-value">{{ $practiceArea->meta_title ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meta Keywords</span>
                    <span class="detail-value">{{ $practiceArea->meta_keywords ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meta Description</span>
                    <span class="detail-value">
                        {{ $practiceArea->meta_description ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
