@extends('layouts.admin')

@section('page-title', 'Article Categories')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Article Categories</h2>
        <p class="admin-page-subtitle">
            Manage article categories used in frontend filter and sidebar.
        </p>
    </div>

    @can('article_category_create')
        <a href="{{ route('admin.article-categories.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Category
        </a>
    @endcan
</div>

@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <p class="stat-label">Total Categories</p>
        <p class="stat-value">{{ $articleCategories->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active</p>
        <p class="stat-value">{{ $articleCategories->where('status', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive</p>
        <p class="stat-value">{{ $articleCategories->where('status', 0)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Articles</p>
        <p class="stat-value">{{ $articleCategories->sum('articles_count') }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Categories</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Categories control article filter buttons
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-ArticleCategory">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Articles</th>
                    <th>Sort</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articleCategories as $category)
                    <tr data-entry-id="{{ $category->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $category->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($category->name ?? 'C', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="table-main-text">{{ $category->name ?? '-' }}</p>
                                    <p class="table-sub-text">Article Category</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="code-pill">{{ $category->slug ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="role-tag">{{ $category->articles_count ?? 0 }}</span>
                        </td>

                        <td>
                            <span class="id-text">{{ $category->sort_order }}</span>
                        </td>

                        <td>
                            @if($category->status)
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
                                @can('article_category_show')
                                    <a href="{{ route('admin.article-categories.show', $category->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('article_category_edit')
                                    <a href="{{ route('admin.article-categories.edit', $category->id) }}" class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('article_category_delete')
                                    <form action="{{ route('admin.article-categories.destroy', $category->id) }}"
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
    initAdminDataTable('.datatable-ArticleCategory', {
        canDelete: @can('article_category_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.article-categories.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search categories...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ categories'
    });
});
</script>
@endsection