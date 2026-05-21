@extends('layouts.admin')

@section('page-title', 'Edit Article Category')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.article-categories.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Edit Article Category</h2>

        <p class="admin-page-subtitle">
            Update category name, slug, order and status.
        </p>
    </div>

    <div class="identity-card">
        <div class="identity-avatar">
            {{ strtoupper(substr($articleCategory->name ?? 'C', 0, 1)) }}
        </div>

        <div>
            <p class="identity-title">{{ $articleCategory->name }}</p>
            <p class="identity-subtitle">ID #{{ $articleCategory->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.article-categories.update', $articleCategory->id) }}">
    @method('PUT')
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>

                <div>
                    <p class="form-card-title">Category Information</p>
                    <p class="form-card-subtitle">Update category details</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="name">
                        Category Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-folder icon"></i>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $articleCategory->name) }}"
                               required
                               class="field-input {{ $errors->has('name') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('name'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="slug">
                        Slug
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $articleCategory->slug) }}"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('slug'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="sort_order">
                            Sort Order
                        </label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-sort-numeric-down icon"></i>

                            <input type="number"
                                   name="sort_order"
                                   id="sort_order"
                                   value="{{ old('sort_order', $articleCategory->sort_order) }}"
                                   class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Status</label>

                        <label class="role-checkbox-item {{ old('status', $articleCategory->status) ? 'checked' : '' }}" style="margin-top:8px;">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="role-checkbox"
                                   {{ old('status', $articleCategory->status) ? 'checked' : '' }}>

                            <div class="check-icon"></div>

                            <span class="checkbox-text">Active</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>

                <div>
                    <p class="form-card-title">Category Meta</p>
                    <p class="form-card-subtitle">Current category information</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="form-info-box">
                    <p class="meta-label">Category ID</p>
                    <p class="meta-value-strong">#{{ $articleCategory->id }}</p>
                </div>

                <div class="form-info-box">
                    <p class="meta-label">Created</p>
                    <p class="meta-value-strong">
                        {{ optional($articleCategory->created_at)->format('d M Y') ?? '-' }}
                    </p>
                </div>

                <div class="form-info-box">
                    <p class="meta-label">Status</p>

                    @if($articleCategory->status)
                        <p class="meta-value-strong meta-value-success">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </p>
                    @else
                        <p class="meta-value-strong meta-value-warning">
                            <i class="fas fa-clock"></i>
                            Inactive
                        </p>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="form-actions-between">
        <div class="form-actions-left">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                {{ trans('global.save') }}
            </button>

            <a href="{{ route('admin.article-categories.index') }}" class="btn-ghost">
                {{ trans('global.cancel') }}
            </a>
        </div>

        @can('article_category_delete')
            <button type="submit"
                    form="delete-category-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Category
            </button>
        @endcan
    </div>
</form>

@can('article_category_delete')
    <form id="delete-category-form"
          action="{{ route('admin.article-categories.destroy', $articleCategory->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection