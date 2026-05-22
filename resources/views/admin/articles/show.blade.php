@extends('layouts.admin')

@section('page-title', 'Article Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.articles.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Article Details</h2>

        <p class="admin-page-subtitle">
            Full article information and publish status.
        </p>
    </div>

    <div class="show-actions">
        @can('article_edit')
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit Article
            </a>
        @endcan

        @can('article_delete')
            <form action="{{ route('admin.articles.destroy', $article->id) }}"
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
                @if($article->image)
                    <img src="{{ $article->image }}"
                         alt="{{ $article->title }}"
                         class="profile-avatar-lg"
                         style="object-fit:cover;">
                @else
                    <div class="profile-avatar-lg">
                        {{ strtoupper(substr($article->title ?? 'A', 0, 1)) }}
                    </div>
                @endif

                <p class="profile-title">{{ $article->title }}</p>
                <p class="profile-subtitle">
                    {{ optional($article->category)->name ?? 'No Category' }}
                </p>

                @if($article->status)
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
                @can('article_edit')
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="quick-link primary">
                        <i class="fas fa-pencil-alt"></i>
                        Edit Article
                    </a>
                @endcan

                <a href="{{ route('admin.articles.index') }}" class="quick-link">
                    <i class="fas fa-list"></i>
                    All Articles
                </a>

                @can('article_create')
                    <a href="{{ route('admin.articles.create') }}" class="quick-link">
                        <i class="fas fa-plus"></i>
                        Add Article
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div>
        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <p class="detail-section-title">Article Information</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">ID</span>
                    <span class="detail-value code-pill">#{{ $article->id }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Title</span>
                    <span class="detail-value">{{ $article->title ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Slug</span>
                    <span class="detail-value code-pill">{{ $article->slug ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Category</span>
                    @if($article->category)
                        <span class="role-tag">{{ $article->category->name }}</span>
                    @else
                        <span class="detail-value">-</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Author</span>
                    <span class="detail-value">{{ $article->author_name ?? 'Legal Desk' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Published Date</span>
                    <span class="detail-value">
                        {{ optional($article->published_date)->format('d M Y') ?? '-' }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Latest Update</span>
                    @if($article->is_latest)
                        <span class="status-pill success">Yes</span>
                    @else
                        <span class="status-pill warning">No</span>
                    @endif
                </div>

                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    @if($article->status)
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
                        {{ optional($article->created_at)->format('d M Y, H:i') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card mb-3">
            <div class="detail-section-head">
                <div class="detail-section-icon">
                    <i class="fas fa-align-left"></i>
                </div>

                <p class="detail-section-title">Article Content</p>
            </div>

            <div class="detail-section-pad-sm">
                <p class="meta-small-label">Short Description</p>
                <p class="detail-value" style="display:block; margin-bottom:18px;">
                    {{ $article->short_description ?? '-' }}
                </p>

                <p class="meta-small-label">Full Description</p>
                <div class="detail-value" style="display:block; line-height:1.8;">
                    @if($article->description)
                        @if($article->description !== strip_tags($article->description))
                            {!! $article->description !!}
                        @else
                            {!! nl2br(e($article->description)) !!}
                        @endif
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

                <p class="detail-section-title">SEO & Button Details</p>
            </div>

            <div class="detail-section-body">
                <div class="detail-row">
                    <span class="detail-label">Read More Text</span>
                    <span class="detail-value">{{ $article->read_more_text ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Read More URL</span>
                    <span class="detail-value">{{ $article->read_more_url ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meta Title</span>
                    <span class="detail-value">{{ $article->meta_title ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meta Keywords</span>
                    <span class="detail-value">{{ $article->meta_keywords ?? '-' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Meta Description</span>
                    <span class="detail-value">{{ $article->meta_description ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
