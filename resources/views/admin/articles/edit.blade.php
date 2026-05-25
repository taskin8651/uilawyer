@extends('layouts.admin')

@section('page-title', 'Edit Article')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.articles.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Edit Article</h2>

        <p class="admin-page-subtitle">
            Update article content, image, category and publish settings.
        </p>
    </div>

    <div class="identity-card">
        @if($article->image)
            <img src="{{ $article->image }}"
                 alt="{{ $article->title }}"
                 class="identity-avatar"
                 style="object-fit:cover;">
        @else
            <div class="identity-avatar">
                {{ strtoupper(substr($article->title ?? 'A', 0, 1)) }}
            </div>
        @endif

        <div>
            <p class="identity-title">{{ $article->title }}</p>
            <p class="identity-subtitle">ID #{{ $article->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">Article Information</p>
                    <p class="form-card-subtitle">Update title, category, author and date</p>
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
                               value="{{ old('title', $article->title) }}"
                               required
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
                    <label class="field-label" for="slug">Slug</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $article->slug) }}"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('slug'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="article_category_id">Category</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-folder icon"></i>

                        <select name="article_category_id"
                                id="article_category_id"
                                class="field-input {{ $errors->has('article_category_id') ? 'error' : '' }}">
                            <option value="">Select Category</option>

                            @foreach($categories as $id => $category)
                                <option value="{{ $id }}" {{ old('article_category_id', $article->article_category_id) == $id ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($errors->has('article_category_id'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('article_category_id') }}
                        </p>
                    @endif
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="author_name">Author Name</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-user icon"></i>

                            <input type="text"
                                   name="author_name"
                                   id="author_name"
                                   value="{{ old('author_name', $article->author_name) }}"
                                   class="field-input {{ $errors->has('author_name') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="published_date">Published Date</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-calendar-alt icon"></i>

                            <input type="date"
                                   name="published_date"
                                   id="published_date"
                                   value="{{ old('published_date', optional($article->published_date)->format('Y-m-d')) }}"
                                   class="field-input {{ $errors->has('published_date') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="article_image">Article Image</label>

                    <input type="file"
                           name="article_image"
                           id="article_image"
                           class="field-input {{ $errors->has('article_image') ? 'error' : '' }}">

                    @if($article->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $article->image }}"
                                 alt="{{ $article->title }}"
                                 style="width:180px;height:115px;object-fit:cover;border-radius:18px;border:1px solid #e5e7eb;">
                        </div>
                    @endif

                    @if($errors->has('article_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('article_image') }}
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
                    <p class="form-card-subtitle">Update visibility and ordering</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="sort_order">Sort Order</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', $article->sort_order) }}"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Article Options</label>

                    <label class="role-checkbox-item {{ old('status', $article->status) ? 'checked' : '' }}" style="margin-top:8px;">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="role-checkbox"
                               {{ old('status', $article->status) ? 'checked' : '' }}>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Active</span>
                    </label>

                    <label class="role-checkbox-item {{ old('is_latest', $article->is_latest) ? 'checked' : '' }}" style="margin-top:8px;">
                        <input type="checkbox"
                               name="is_latest"
                               value="1"
                               class="role-checkbox"
                               {{ old('is_latest', $article->is_latest) ? 'checked' : '' }}>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Show In Latest Updates</span>
                    </label>
                </div>

                <div class="form-info-box">
                    <p class="meta-label">Created</p>
                    <p class="meta-value-strong">
                        {{ optional($article->created_at)->format('d M Y') ?? '-' }}
                    </p>
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
                <p class="form-card-title">Article Content</p>
                <p class="form-card-subtitle">Update short and full article text</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="short_description">Short Description</label>

                <textarea name="short_description"
                          id="short_description"
                          rows="4"
                          class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $article->short_description) }}</textarea>
            </div>

            <div class="field-group">
                <label class="field-label" for="description">Full Description</label>

                <textarea name="description"
                          id="description"
                          rows="8"
                          class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $article->description) }}</textarea>
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
                <p class="form-card-subtitle">Update article SEO fields</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       value="{{ old('meta_title', $article->meta_title) }}"
                       class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label">Meta Description</label>
                <textarea name="meta_description"
                          rows="3"
                          class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description', $article->meta_description) }}</textarea>
            </div>

            <div class="field-group">
                <label class="field-label">Meta Keywords</label>
                <input type="text"
                       name="meta_keywords"
                       value="{{ old('meta_keywords', $article->meta_keywords) }}"
                       class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
            </div>
        </div>
    </div>

    <div class="form-actions-between">
        <div class="form-actions-left">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                {{ trans('global.save') }}
            </button>

            <a href="{{ route('admin.articles.index') }}" class="btn-ghost">
                {{ trans('global.cancel') }}
            </a>
        </div>

        @can('article_delete')
            <button type="submit"
                    form="delete-article-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Article
            </button>
        @endcan
    </div>

</form>

@can('article_delete')
    <form id="delete-article-form"
          action="{{ route('admin.articles.destroy', $article->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection
