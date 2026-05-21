@extends('layouts.admin')

@section('page-title', 'Attorney Profile')

@section('content')

@php
    $colors = ['#4F46E5','#0EA5E9','#10B981','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'];
    $color = $colors[$attorney->id % count($colors)];
@endphp

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.attorneys.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Attorney Profile</h2>

        <p class="admin-page-subtitle">
            Full details for this attorney profile
        </p>
    </div>

    <div class="show-actions">
        @can('attorney_edit')
            <a href="{{ route('admin.attorneys.edit', $attorney->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit Attorney
            </a>
        @endcan

        @can('attorney_delete')
            <form action="{{ route('admin.attorneys.destroy', $attorney->id) }}"
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

<div class="show-grid">

    <div>
        <div class="detail-card mb-3">
            <div class="profile-hero">
                @if($attorney->image)
                    <img src="{{ $attorney->image }}"
                         alt="{{ $attorney->name }}"
                         class="profile-avatar-lg"
                         style="object-fit:cover;">
                @else
                    <div class="profile-avatar-lg" style="background: {{ $color }};">
                        {{ strtoupper(substr($attorney->name ?? 'A', 0, 1)) }}
                    </div>
                @endif

                <p class="profile-title">{{ $attorney->name }}</p>
                <p class="profile-subtitle">{{ $attorney->designation ?? 'Attorney Profile' }}</p>

                @if($attorney->status)
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
                        <p class="stat-mini-label">Attorney ID</p>
                        <p class="stat-mini-value">#{{ $attorney->id }}</p>
                    </div>

                    <div class="stat-mini">
                        <p class="stat-mini-label">Sort Order</p>
                        <p class="stat-mini-value">{{ $attorney->sort_order }}</p>
                    </div>

                    <div class="stat-mini" style="grid-column: span 2;">
                        <p class="stat-mini-label">Added On</p>
                        <p class="stat-mini-value-sm">
                            {{ optional($attorney->created_at)->format('d M Y') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-card detail-card-pad">
            <p class="quick-title">Quick Actions</p>

            <div class="quick-list">
                @can('attorney_edit')
                    <a href="{{ route('admin.attorneys.edit', $attorney->id) }}" class="quick-link primary">
                        <i class="fas fa-user-edit"></i>
                        Edit Profile
                    </a>
                @endcan

                <a href="{{ route('admin.attorneys.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Attorneys
                </a>

                @can('attorney_create')
                    <a href="{{ route('admin.attorneys.create') }}" class="quick-link">
                        <i class="fas fa-user-plus"></i>
                        Add New Attorney
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>

                <p class="detail-section-title">Profile Details</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $attorney->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Name</span>
                    <span class="detail-value">{{ $attorney->name ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Designation</span>
                    <span class="detail-value">{{ $attorney->designation ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Badge</span>

                    @if($attorney->badge)
                        <span class="role-tag">{{ $attorney->badge }}</span>
                    @else
                        <span class="detail-value">-</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>

                    @if($attorney->status)
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success"></i>
                            <span class="detail-value">Active</span>
                        </div>
                    @else
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-exclamation-circle text-warning"></i>
                            <span class="detail-value" style="color:#92400E;">Inactive</span>
                        </div>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Created At</span>
                    <span class="detail-value">
                        {{ optional($attorney->created_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Updated At</span>
                    <span class="detail-value">
                        {{ optional($attorney->updated_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head between">
                <div class="d-flex align-items-center gap-2">
                    <div class="detail-section-icon">
                        <i class="fas fa-list"></i>
                    </div>

                    <p class="detail-section-title">Meta Items</p>
                </div>

                <span class="status-pill success">
                    {{ count($attorney->meta_items ?? []) }} items
                </span>
            </div>

            <div class="detail-section-pad-sm">
                @if(!empty($attorney->meta_items))
                    <div class="quick-list">
                        @foreach($attorney->meta_items as $meta)
                            <div class="quick-link">
                                <i class="{{ $meta['icon'] ?? 'fas fa-check-circle' }}"></i>
                                {{ $meta['text'] ?? '-' }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="assign-empty">
                        <div class="assign-empty-icon">
                            <i class="fas fa-list"></i>
                        </div>

                        <p class="assign-empty-title">No meta items</p>
                        <p class="assign-empty-text">No location, experience or practice details added yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head between">
                <div class="d-flex align-items-center gap-2">
                    <div class="detail-section-icon">
                        <i class="fas fa-tags"></i>
                    </div>

                    <p class="detail-section-title">Practice Tags</p>
                </div>

                <span class="status-pill success">
                    {{ count($attorney->tags ?? []) }} tags
                </span>
            </div>

            <div class="detail-section-pad-sm">
                @if(!empty($attorney->tags))
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($attorney->tags as $tag)
                            <span class="role-tag">
                                <i class="fas fa-circle" style="font-size:6px; margin-right:5px;"></i>
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <span class="detail-value">No tags added.</span>
                @endif
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-link"></i>
                </div>

                <p class="detail-section-title">Button Details</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">Profile Button</span>
                    <span class="detail-value">
                        {{ $attorney->profile_button_text ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Profile URL</span>
                    <span class="detail-value">
                        {{ $attorney->profile_button_url ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Consult Button</span>
                    <span class="detail-value">
                        {{ $attorney->consult_button_text ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Consult URL</span>
                    <span class="detail-value">
                        {{ $attorney->consult_button_url ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection