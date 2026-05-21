@extends('layouts.admin')

@section('page-title', 'Article Category Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.article-categories.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Article Category Details</h2>

        <p class="admin-page-subtitle">
            Full category information and frontend status.
        </p>
    </div>

    <div class="show-actions">
        @can('article_category_edit')
            <a href="{{ route('admin.article-categories.edit', $articleCategory->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit Category
            </a>
        @endcan
    </div>
</div>

<div class="show-grid">

    <div>
        <div class="detail-card mb-3">
            <div class="profile-hero">
                <div class="profile-avatar-lg">
                    {{ strtoupper(substr($articleCategory->name ?? 'C', 0, 1)) }}
                </div>

                <p class="profile-title">{{ $articleCategory->name }}</p>
                <p class="profile-subtitle">{{ $articleCategory->slug }}</p>

                @if($articleCategory->status)
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
        </div>

        <div class="detail-card detail-card-pad">
            <p class="quick-title">Quick Actions</p>

            <div class="quick-list">
                @can('article_category_edit')
                    <a href="{{ route('admin.article-categories.edit', $articleCategory->id) }}" class="quick-link primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit Category
                    </a>
                @endcan

                <a href="{{ route('admin.article-categories.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Categories
                </a>

                @can('article_category_create')
                    <a href="{{ route('admin.article-categories.create') }}" class="quick-link">
                        <i class="fas fa-plus"></i>
                        Add Category
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-folder"></i>
                </div>

                <p class="detail-section-title">Category Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $articleCategory->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Name</span>
                    <span class="detail-value">{{ $articleCategory->name ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Slug</span>
                    <span class="detail-value code-pill">{{ $articleCategory->slug ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Sort Order</span>
                    <span class="detail-value">{{ $articleCategory->sort_order }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>

                    @if($articleCategory->status)
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
                        {{ optional($articleCategory->created_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Updated At</span>
                    <span class="detail-value">
                        {{ optional($articleCategory->updated_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection