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

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="place_of_practice">Place Of Practice</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-map-marker-alt icon"></i>
                            <input type="text" name="place_of_practice" id="place_of_practice"
                                   value="{{ old('place_of_practice') }}"
                                   placeholder="Patna High Court / District Court"
                                   class="field-input {{ $errors->has('place_of_practice') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="experience">Experience</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-calendar-check icon"></i>
                            <input type="text" name="experience" id="experience"
                                   value="{{ old('experience') }}"
                                   placeholder="5+ Years"
                                   class="field-input {{ $errors->has('experience') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="phone">Phone</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-phone icon"></i>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+91 XXXXX XXXXX"
                                   class="field-input {{ $errors->has('phone') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="email">Email</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email') }}"
                                   placeholder="name@example.com"
                                   class="field-input {{ $errors->has('email') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="address">Address</label>
                    <textarea name="address" id="address" rows="3"
                              placeholder="Full address"
                              class="field-input {{ $errors->has('address') ? 'error' : '' }}">{{ old('address') }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="about_team">About Team Member</label>
                    <textarea name="about_team" id="about_team" rows="4"
                              placeholder="Short professional introduction"
                              class="field-input {{ $errors->has('about_team') ? 'error' : '' }}">{{ old('about_team') }}</textarea>
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
