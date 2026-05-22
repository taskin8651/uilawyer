@extends('layouts.admin')

@section('page-title', 'Add Practice Area Service')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-area-services.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Practice Area Service
        </h2>

        <p class="admin-page-subtitle">
            Create a dynamic service card and frontend detail page.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-area-services.store') }}">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <div>
                    <p class="form-card-title">Service Information</p>
                    <p class="form-card-subtitle">Parent practice area, title, slug and icon</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="practice_area_id">
                        Practice Area <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-scale-balanced icon"></i>

                        <select name="practice_area_id"
                                id="practice_area_id"
                                required
                                class="field-input {{ $errors->has('practice_area_id') ? 'error' : '' }}">
                            <option value="">Select Practice Area</option>

                            @foreach($practiceAreas as $id => $title)
                                <option value="{{ $id }}" {{ old('practice_area_id') == $id ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($errors->has('practice_area_id'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('practice_area_id') }}
                        </p>
                    @endif
                </div>

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
                               placeholder="Divorce Lawyer"
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
                               value="{{ old('slug') }}"
                               placeholder="divorce-lawyer"
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
                               value="{{ old('icon_class', 'bi bi-grid-3x3-gap-fill') }}"
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

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-cog"></i>
                </div>

                <div>
                    <p class="form-card-title">Publish Settings</p>
                    <p class="form-card-subtitle">Button, URL, sort order and status</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="button_text">
                        Button Text
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-arrow-right icon"></i>

                        <input type="text"
                               name="button_text"
                               id="button_text"
                               value="{{ old('button_text', 'View Details') }}"
                               placeholder="View Details"
                               class="field-input {{ $errors->has('button_text') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('button_text'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('button_text') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="url">
                        Detail URL
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>

                        <input type="text"
                               name="url"
                               id="url"
                               value="{{ old('url') }}"
                               placeholder="Blank rakhne par dynamic detail URL auto set hoga"
                               class="field-input {{ $errors->has('url') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('url'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('url') }}
                        </p>
                    @else
                        <p class="field-hint">
                            External ya custom URL dena ho to yaha add karo.
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="sort_order">
                        Sort Order
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-sort-numeric-down icon"></i>

                        <input type="number"
                               name="sort_order"
                               id="sort_order"
                               value="{{ old('sort_order', 0) }}"
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

                    <label class="role-checkbox-item checked" style="margin-top:8px;">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="role-checkbox"
                               checked>

                        <div class="check-icon"></div>

                        <span class="checkbox-text">Active</span>
                    </label>
                </div>

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Active services will appear inside selected practice area on frontend.
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
                <p class="form-card-title">Service Content</p>
                <p class="form-card-subtitle">Card description and full detail page content</p>
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
                          placeholder="Enter short service card description"
                          class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description') }}</textarea>

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
                          placeholder="Enter full service detail page content"
                          class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}">{{ old('description') }}</textarea>

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
                <p class="form-card-subtitle">Optional meta fields for service detail page</p>
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
                           value="{{ old('meta_title') }}"
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
                          class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description') }}</textarea>

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
                           value="{{ old('meta_keywords') }}"
                           placeholder="divorce lawyer, family law, legal consultation"
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

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i>
            Save Service
        </button>

        <a href="{{ route('admin.practice-area-services.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>

@endsection