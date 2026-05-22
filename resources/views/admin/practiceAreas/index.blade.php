@extends('layouts.admin')

@section('page-title', 'Practice Areas')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Practice Areas</h2>
        <p class="admin-page-subtitle">Manage dynamic frontend practice areas and detail pages.</p>
    </div>

    @can('practice_area_create')
        <a href="{{ route('admin.practice-areas.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Practice Area
        </a>
    @endcan
</div>

<div class="admin-table-card">
    <table class="admin-table datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Sort</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($practiceAreas as $practiceArea)
                <tr>
                    <td>#{{ $practiceArea->id }}</td>
                    <td>{{ $practiceArea->title }}</td>
                    <td>{{ $practiceArea->slug }}</td>
                    <td>{{ $practiceArea->sort_order }}</td>
                    <td>
                        <span class="status-pill {{ $practiceArea->status ? 'active' : 'inactive' }}">
                            {{ $practiceArea->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            @can('practice_area_show')
                                <a href="{{ route('admin.practice-areas.show', $practiceArea->id) }}" class="btn-outline">View</a>
                            @endcan
                            @can('practice_area_edit')
                                <a href="{{ route('admin.practice-areas.edit', $practiceArea->id) }}" class="btn-outline">Edit</a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
