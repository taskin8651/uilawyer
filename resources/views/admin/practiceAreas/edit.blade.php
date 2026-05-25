@extends('layouts.admin')

@section('page-title', 'Edit Practice Area')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Practice Area
        </h2>

        <p class="admin-page-subtitle">
            Update dynamic practice area, frontend card and detail page content.
        </p>
    </div>

    <div class="identity-card">
        @if($practiceArea->image)
            <img src="{{ $practiceArea->image }}"
                 alt="{{ $practiceArea->title }}"
                 class="identity-avatar"
                 style="object-fit:cover;">
        @else
            <div class="identity-avatar">
                {{ strtoupper(substr($practiceArea->title ?? 'P', 0, 1)) }}
            </div>
        @endif

        <div>
            <p class="identity-title">{{ $practiceArea->title }}</p>
            <p class="identity-subtitle">ID #{{ $practiceArea->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-areas.update', $practiceArea->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-scale-balanced"></i>
                </div>

                <div>
                    <p class="form-card-title">Practice Area Information</p>
                    <p class="form-card-subtitle">Update title, slug, icon and image</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="title">
                        Title <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-heading icon"></i>

                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $practiceArea->title) }}"
                               required
                               placeholder="Family Law"
                               class="field-input {{ $errors->has('title') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('title'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('title') }}
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
                               value="{{ old('slug', $practiceArea->slug) }}"
                               placeholder="family-law"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('slug'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @else
                        <p class="field-hint">
                            Blank rakhne par slug title se automatically generate hoga.
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="icon_class">
                        Icon Class
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-icons icon"></i>

                        <input type="text"
                               name="icon_class"
                               id="icon_class"
                               value="{{ old('icon_class', $practiceArea->icon_class) }}"
                               placeholder="bi bi-heartbreak"
                               class="field-input {{ $errors->has('icon_class') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('icon_class'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('icon_class') }}
                        </p>
                    @else
                        <p class="field-hint">
                            Example: bi bi-bank2, bi bi-shield-lock, bi bi-heartbreak
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="practice_area_image">
                        Practice Area Image
                    </label>

                    <input type="file"
                           name="practice_area_image"
                           id="practice_area_image"
                           class="field-input {{ $errors->has('practice_area_image') ? 'error' : '' }}">

                    @if($practiceArea->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $practiceArea->image }}"
                                 alt="{{ $practiceArea->title }}"
                                 style="width:180px;height:115px;object-fit:cover;border-radius:18px;border:1px solid #e5e7eb;">
                        </div>
                    @endif

                    @if($errors->has('practice_area_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('practice_area_image') }}
                        </p>
                    @else
                        <p class="field-hint">
                            New image upload karne par old image replace ho jayegi.
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-cog"></i>
                </div>

                <div>
                    <p class="form-card-title">Publish Settings</p>
                    <p class="form-card-subtitle">Update order and frontend visibility</p>
                </div>
            </div>

            <div class="form-card-body"></div>

                <div class="field-group">
                    <label class="field-label" for="sort_order">
                        Sort Order
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', $practiceArea->sort_order) }}"
                               placeholder="0"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('sort_order'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('sort_order') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label">
                        Status
                    </label>

                    <label class="role-checkbox-item {{ old('status', $practiceArea->status) ? 'checked' : '' }}" style="margin-top:8px;">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="role-checkbox"
                               {{ old('status', $practiceArea->status) ? 'checked' : '' }}>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Active</span>
                    </label>
                </div>

                <div class="form-info-box">
                    <p class="meta-label">Current Info</p>

                    <div class="meta-grid-2">
                        <div>
                            <p class="meta-small-label">Created</p>
                            <p class="meta-value-strong">
                                {{ optional($practiceArea->created_at)->format('d M Y') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="meta-small-label">Status</p>

                            @if($practiceArea->status)
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
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-align-left"></i>
            </div>

            <div>
                <p class="form-card-title">Frontend Content</p>
                <p class="form-card-subtitle">Update short card text and full detail page content</p>
            </div>
        </div>

        <div class="form-card-body">

            <div class="field-group">
                <label class="field-label" for="short_description">
                    Short Description
                </label>

                <textarea name="short_description"
                          id="short_description"
                          rows="4"
                          placeholder="Enter short description for frontend card"
                          class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $practiceArea->short_description) }}</textarea>

                @if($errors->has('short_description'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('short_description') }}
                    </p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="description">
                    Full Description
                </label>

                <textarea name="description"
                          id="description"
                          rows="8"
                          placeholder="Enter full detail page content"
                          class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $practiceArea->description) }}</textarea>

                @if($errors->has('description'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>

        </div>
    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-search"></i>
            </div>

            <div>
                <p class="form-card-title">SEO Meta</p>
                <p class="form-card-subtitle">Update SEO fields for practice detail page</p>
            </div>
        </div>

        <div class="form-card-body">

            <div class="field-group">
                <label class="field-label" for="meta_title">
                    Meta Title
                </label>

                <div class="input-icon-wrap">
                    <i class="fas fa-heading icon"></i>

                    <input type="text"
                           name="meta_title"
                           id="meta_title"
                           value="{{ old('meta_title', $practiceArea->meta_title) }}"
                           placeholder="Enter meta title"
                           class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
                </div>

                @if($errors->has('meta_title'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('meta_title') }}
                    </p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="meta_description">
                    Meta Description
                </label>

                <textarea name="meta_description"
                          id="meta_description"
                          rows="3"
                          placeholder="Enter meta description"
                          class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description', $practiceArea->meta_description) }}</textarea>

                @if($errors->has('meta_description'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('meta_description') }}
                    </p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="meta_keywords">
                    Meta Keywords
                </label>

                <div class="input-icon-wrap">
                    <i class="fas fa-tags icon"></i>

                    <input type="text"
                           name="meta_keywords"
                           id="meta_keywords"
                           value="{{ old('meta_keywords', $practiceArea->meta_keywords) }}"
                           placeholder="family law, divorce lawyer, legal consultation"
                           class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
                </div>

                @if($errors->has('meta_keywords'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('meta_keywords') }}
                    </p>
                @endif
            </div>

        </div>
    </div>

    <div class="form-actions-between">
        <div class="form-actions-left">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                {{ trans('global.save') }}
            </button>

            <a href="{{ route('admin.practice-areas.index') }}" class="btn-ghost">
                {{ trans('global.cancel') }}
            </a>
        </div>

        @can('practice_area_delete')
            <button type="submit"
                    form="delete-practice-area-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Practice Area
            </button>
        @endcan
    </div>

</form>

@can('practice_area_delete')
    <form id="delete-practice-area-form"
          action="{{ route('admin.practice-areas.destroy', $practiceArea->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection
