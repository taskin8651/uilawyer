@extends('layouts.admin')

@section('page-title', 'Articles')

@section('content')

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Articles</h2>
        <p class="admin-page-subtitle">
            Manage legal articles, publications, images and latest updates.
        </p>
    </div>

    @can('article_create')
        <a href="{{ route('admin.articles.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Add Article
        </a>
    @endcan
</div>

@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="stats-grid">
    <div class="stat-card">
        <p class="stat-label">Total Articles</p>
        <p class="stat-value">{{ $articles->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Active</p>
        <p class="stat-value">{{ $articles->where('status', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Latest</p>
        <p class="stat-value">{{ $articles->where('is_latest', 1)->count() }}</p>
    </div>

    <div class="stat-card">
        <p class="stat-label">Inactive</p>
        <p class="stat-value">{{ $articles->where('status', 0)->count() }}</p>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Articles</p>

        <span class="page-card-note">
            <i class="fas fa-info-circle"></i>
            Articles show on frontend listing page
        </span>
    </div>

    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Article">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Article</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Latest</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                    <tr data-entry-id="{{ $article->id }}">
                        <td></td>

                        <td>
                            <span class="id-text">#{{ $article->id }}</span>
                        </td>

                        <td>
                            <div class="inline-flex-center">
                                @if($article->image)
                                    <img src="{{ $article->image }}"
                                         alt="{{ $article->title }}"
                                         class="avatar-circle"
                                         style="object-fit:cover;">
                                @else
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($article->title ?? 'A', 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <p class="table-main-text">{{ $article->title ?? '-' }}</p>
                                    <p class="table-sub-text">
                                        {{ $article->slug ?? '-' }}
                                        @if($article->is_public_submission)
                                            | Public Submission
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($article->category)
                                <span class="role-tag">{{ $article->category->name }}</span>
                            @else
                                <span style="font-size:12px; color:#94A3B8;">—</span>
                            @endif
                        </td>

                        <td style="color:#475569;">
                            {{ $article->author_name ?? 'Legal Desk' }}
                        </td>

                        <td>
                            <span class="id-text">
                                {{ optional($article->published_date)->format('d M Y') ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @if($article->is_latest)
                                <span class="status-pill success">Yes</span>
                            @else
                                <span class="status-pill warning">No</span>
                            @endif
                        </td>

                        <td>
                            @if($article->status)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-success"></span>
                                    <span style="font-size:12.5px; color:#166534;">Active</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-dot status-warning"></span>
                                    <span style="font-size:12.5px; color:#92400E;">Pending / Inactive</span>
                                </div>
                            @endif
                        </td>

                        <td>
                            <div class="action-row">
                                @can('article_show')
                                    <a href="{{ route('admin.articles.show', $article->id) }}" class="btn-outline">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                @endcan

                                @can('article_edit')
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-outline btn-outline-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                @endcan

                                @can('article_delete')
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}"
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
    initAdminDataTable('.datatable-Article', {
        canDelete: @can('article_delete') true @else false @endcan,
        massDeleteUrl: "{{ route('admin.articles.massDestroy') }}",
        deleteText: "{{ trans('global.datatables.delete') }}",
        zeroSelectedText: "{{ trans('global.datatables.zero_selected') }}",
        confirmText: "{{ trans('global.areYouSure') }}",
        searchPlaceholder: 'Search articles...',
        infoText: 'Showing _START_–_END_ of _TOTAL_ articles'
    });
});
</script>
@endsection
