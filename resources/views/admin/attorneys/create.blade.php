@extends('layouts.admin')

@section('page-title', 'Add Attorney')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.attorneys.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Attorney
        </h2>

        <p class="admin-page-subtitle">
            Fill in the details to create a new attorney profile
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.attorneys.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>

                <div>
                    <p class="form-card-title">Attorney Information</p>
                    <p class="form-card-subtitle">Basic attorney profile details</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="name">
                        Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-user icon"></i>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Enter attorney name"
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
                    <label class="field-label" for="designation">
                        Designation
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-briefcase icon"></i>

                        <input type="text"
                               name="designation"
                               id="designation"
                               value="{{ old('designation') }}"
                               placeholder="CEO & Founder / Advocate"
                               class="field-input {{ $errors->has('designation') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('designation'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('designation') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="badge">
                        Badge
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-certificate icon"></i>

                        <input type="text"
                               name="badge"
                               id="badge"
                               value="{{ old('badge') }}"
                               placeholder="Founder / Advocate"
                               class="field-input {{ $errors->has('badge') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('badge'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('badge') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="attorney_image">
                        Attorney Image
                    </label>

                    <input type="file"
                           name="attorney_image"
                           id="attorney_image"
                           class="field-input {{ $errors->has('attorney_image') ? 'error' : '' }}">

                    @if($errors->has('attorney_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('attorney_image') }}
                        </p>
                    @else
                        <p class="field-hint">
                            Upload JPG, PNG or WEBP image.
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
                                   value="{{ old('sort_order', 0) }}"
                                   class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                        </div>
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
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-link"></i>
                </div>

                <div>
                    <p class="form-card-title">Buttons</p>
                    <p class="form-card-subtitle">Frontend card action buttons</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Profile Button Text</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-eye icon"></i>

                        <input type="text"
                               name="profile_button_text"
                               value="{{ old('profile_button_text', 'View Profile') }}"
                               placeholder="View Profile"
                               class="field-input {{ $errors->has('profile_button_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Profile Button URL</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>

                        <input type="text"
                               name="profile_button_url"
                               value="{{ old('profile_button_url', 'profile.html') }}"
                               placeholder="profile.html"
                               class="field-input {{ $errors->has('profile_button_url') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Consult Button Text</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-comments icon"></i>

                        <input type="text"
                               name="consult_button_text"
                               value="{{ old('consult_button_text', 'Consult Now') }}"
                               placeholder="Consult Now"
                               class="field-input {{ $errors->has('consult_button_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Consult Button URL</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="consult_button_url"
                               value="{{ old('consult_button_url', 'index.html#consultation') }}"
                               placeholder="index.html#consultation"
                               class="field-input {{ $errors->has('consult_button_url') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="form-info-box">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        These buttons will appear on the frontend attorney card.
                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-list"></i>
            </div>

            <div>
                <p class="form-card-title">Meta Items</p>
                <p class="form-card-subtitle">Location, experience and practice details</p>
            </div>
        </div>

        <div class="form-card-body">
            @for($i = 0; $i < 4; $i++)
                <div class="admin-form-grid" style="margin-bottom:14px;">
                    <div class="field-group">
                        <label class="field-label">Meta Icon {{ $i + 1 }}</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-icons icon"></i>

                            <input type="text"
                                   name="meta_icons[]"
                                   value="{{ old('meta_icons.' . $i) }}"
                                   placeholder="bi bi-geo-alt-fill"
                                   class="field-input">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Meta Text {{ $i + 1 }}</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-pen icon"></i>

                            <input type="text"
                                   name="meta_texts[]"
                                   value="{{ old('meta_texts.' . $i) }}"
                                   placeholder="Patna, Bihar"
                                   class="field-input">
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-tags"></i>
            </div>

            <div>
                <p class="form-card-title">Practice Tags</p>
                <p class="form-card-subtitle">Frontend small tags under profile card</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="admin-form-grid">
                @for($i = 0; $i < 6; $i++)
                    <div class="field-group">
                        <label class="field-label">Tag {{ $i + 1 }}</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-tag icon"></i>

                            <input type="text"
                                   name="tags[]"
                                   value="{{ old('tags.' . $i) }}"
                                   placeholder="Family Law"
                                   class="field-input">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Attorney
        </button>

        <a href="{{ route('admin.attorneys.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>

@endsection