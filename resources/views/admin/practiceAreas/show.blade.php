@extends('layouts.admin')

@section('page-title', 'Practice Area Details')

@section('content')
<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">← Back to list</a>
        <h2 class="admin-page-title">Practice Area Details</h2>
        <p class="admin-page-subtitle">Frontend detail and menu content for this practice area.</p>
    </div>

    @can('practice_area_edit')
        <a href="{{ route('admin.practice-areas.edit', $practiceArea->id) }}" class="btn-primary">
            <i class="fas fa-edit"></i>
            Edit
        </a>
    @endcan
</div>

<div class="detail-card detail-card-pad">
    <div class="detail-row">
        <span class="detail-label">Title</span>
        <span class="detail-value">{{ $practiceArea->title }}</span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Slug</span>
        <span class="detail-value">{{ $practiceArea->slug }}</span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Icon</span>
        <span class="detail-value">{{ $practiceArea->icon_class ?: '-' }}</span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Status</span>
        <span class="detail-value">{{ $practiceArea->status ? 'Active' : 'Inactive' }}</span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Short Description</span>
        <span class="detail-value">{{ $practiceArea->short_description ?: '-' }}</span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Full Description</span>
        <span class="detail-value" style="display:block;">
            @if($practiceArea->description)
                {!! $practiceArea->description !!}
            @else
                -
            @endif
        </span>
    </div>
</div>
@endsection
