@extends('layouts.admin')

@section('page-title', 'Add Article')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.articles.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Add Article</h2>

        <p class="admin-page-subtitle">
            Create a new legal article for frontend listing.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>

                <div>
                    <p class="form-card-title">Article Information</p>
                    <p class="form-card-subtitle">Title, category, author and date</p>
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
                               value="{{ old('title') }}"
                               required
                               placeholder="What To Know Before Filing A Bail Application"
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
                               value="{{ old('slug') }}"
                               placeholder="what-to-know-before-filing-a-bail-application"
                               class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('slug'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @else
                        <p class="field-hint">Blank rakhne par slug automatically generate hoga.</p>
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
                                <option value="{{ $id }}" {{ old('article_category_id') == $id ? 'selected' : '' }}>
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
                                   value="{{ old('author_name', 'Legal Desk') }}"
                                   placeholder="Legal Desk"
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
                                   value="{{ old('published_date') }}"
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

                    @if($errors->has('article_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('article_image') }}
                        </p>
                    @else
                        <p class="field-hint">Upload JPG, PNG or WEBP image.</p>
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
                    <p class="form-card-subtitle">Frontend visibility and buttons</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="read_more_text">Read More Text</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-arrow-right icon"></i>

                        <input type="text"
                               name="read_more_text"
                               id="read_more_text"
                               value="{{ old('read_more_text', 'Read More') }}"
                               placeholder="Read More"
                               class="field-input {{ $errors->has('read_more_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="read_more_url">Read More URL</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="read_more_url"
                               id="read_more_url"
                               value="{{ old('read_more_url', '#') }}"
                               placeholder="article-details.html"
                               class="field-input {{ $errors->has('read_more_url') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="sort_order">Sort Order</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', 0) }}"
                               class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Article Options</label>

                    <label class="role-checkbox-item checked" style="margin-top:8px;">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="role-checkbox"
                               checked>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Active</span>
                    </label>

                    <label class="role-checkbox-item checked" style="margin-top:8px;">
                        <input type="checkbox"
                               name="is_latest"
                               value="1"
                               class="role-checkbox"
                               checked>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Show In Latest Updates</span>
                    </label>
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
                <p class="form-card-subtitle">Short card text and full article detail text</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="short_description">Short Description</label>

                <textarea name="short_description"
                          id="short_description"
                          rows="4"
                          placeholder="Enter short article card description"
                          class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>

                @if($errors->has('short_description'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('short_description') }}
                    </p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="description">Full Description</label>

                <textarea name="description"
                          id="description"
                          rows="8"
                          placeholder="Enter full article detail content"
                          class="field-input {{ $errors->has('description') ? 'error' : '' }}">{{ old('description') }}</textarea>

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
                <p class="form-card-subtitle">Optional meta fields for article details page</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label">Meta Title</label>
                <input type="text"
                       name="meta_title"
                       value="{{ old('meta_title') }}"
                       class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label">Meta Description</label>
                <textarea name="meta_description"
                          rows="3"
                          class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description') }}</textarea>
            </div>

            <div class="field-group">
                <label class="field-label">Meta Keywords</label>
                <input type="text"
                       name="meta_keywords"
                       value="{{ old('meta_keywords') }}"
                       class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Article
        </button>

        <a href="{{ route('admin.articles.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>

@endsection