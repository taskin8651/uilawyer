@extends('layouts.admin')

@section('page-title', 'Edit Attorney')

@section('content')

@php
    $colors = ['#4F46E5','#0EA5E9','#10B981','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'];
@endphp

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.attorneys.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Attorney
        </h2>

        <p class="admin-page-subtitle">
            Update attorney profile, image, tags and frontend card information
        </p>
    </div>

    <div class="identity-card">
        @if($attorney->image)
            <img src="{{ $attorney->image }}"
                 alt="{{ $attorney->name }}"
                 class="identity-avatar"
                 style="object-fit:cover;">
        @else
            <div class="identity-avatar" style="background: {{ $colors[$attorney->id % count($colors)] }};">
                {{ strtoupper(substr($attorney->name ?? 'A', 0, 1)) }}
            </div>
        @endif

        <div>
            <p class="identity-title">{{ $attorney->name }}</p>
            <p class="identity-subtitle">ID #{{ $attorney->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.attorneys.update', $attorney->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-edit"></i>
                </div>

                <div>
                    <p class="form-card-title">Attorney Information</p>
                    <p class="form-card-subtitle">Update basic attorney details</p>
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
                               value="{{ old('name', $attorney->name) }}"
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
                    <label class="field-label" for="designation">
                        Designation
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-briefcase icon"></i>

                        <input type="text"
                               name="designation"
                               id="designation"
                               value="{{ old('designation', $attorney->designation) }}"
                               class="field-input {{ $errors->has('designation') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="place_of_practice">Place Of Practice</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-map-marker-alt icon"></i>
                            <input type="text" name="place_of_practice" id="place_of_practice"
                                   value="{{ old('place_of_practice', $attorney->place_of_practice) }}"
                                   class="field-input {{ $errors->has('place_of_practice') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="experience">Experience</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-calendar-check icon"></i>
                            <input type="text" name="experience" id="experience"
                                   value="{{ old('experience', $attorney->experience) }}"
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
                                   value="{{ old('phone', $attorney->phone) }}"
                                   class="field-input {{ $errors->has('phone') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="email">Email</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $attorney->email) }}"
                                   class="field-input {{ $errors->has('email') ? 'error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="address">Address</label>
                    <textarea name="address" id="address" rows="3"
                              class="field-input {{ $errors->has('address') ? 'error' : '' }}">{{ old('address', $attorney->address) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="about_team">About Team Member</label>
                    <textarea name="about_team" id="about_team" rows="4"
                              class="field-input {{ $errors->has('about_team') ? 'error' : '' }}">{{ old('about_team', $attorney->about_team) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="profile_summary">Profile Summary</label>
                    <textarea name="profile_summary" id="profile_summary" rows="3"
                              class="field-input {{ $errors->has('profile_summary') ? 'error' : '' }}">{{ old('profile_summary', $attorney->profile_summary) }}</textarea>
                </div>

                <div class="field-group">
                    <label class="field-label" for="biography">Detailed Biography</label>
                    <textarea name="biography" id="biography" rows="6"
                              class="field-input {{ $errors->has('biography') ? 'error' : '' }}">{{ old('biography', $attorney->biography) }}</textarea>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="qualifications">Qualifications</label>
                        <textarea name="qualifications" id="qualifications" rows="3" class="field-input">{{ old('qualifications', $attorney->qualifications) }}</textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="practice_areas_text">Key Practice Areas</label>
                        <textarea name="practice_areas_text" id="practice_areas_text" rows="3" class="field-input">{{ old('practice_areas_text', $attorney->practice_areas_text) }}</textarea>
                    </div>
                </div>

                <div class="admin-form-grid">
                    <div class="field-group">
                        <label class="field-label" for="courts_represented">Courts Represented Before</label>
                        <textarea name="courts_represented" id="courts_represented" rows="3" class="field-input">{{ old('courts_represented', $attorney->courts_represented) }}</textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="languages_spoken">Languages Spoken</label>
                        <textarea name="languages_spoken" id="languages_spoken" rows="3" class="field-input">{{ old('languages_spoken', $attorney->languages_spoken) }}</textarea>
                    </div>
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
                               value="{{ old('badge', $attorney->badge) }}"
                               class="field-input {{ $errors->has('badge') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="attorney_image">
                        Attorney Image
                    </label>

                    <input type="file"
                           name="attorney_image"
                           id="attorney_image"
                           class="field-input {{ $errors->has('attorney_image') ? 'error' : '' }}">

                    @if($attorney->image)
                        <div style="margin-top:14px;">
                            <img src="{{ $attorney->image }}"
                                 alt="{{ $attorney->name }}"
                                 style="width:130px;height:130px;object-fit:cover;border-radius:22px;border:1px solid #e5e7eb;">
                        </div>
                    @endif

                    @if($errors->has('attorney_image'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('attorney_image') }}
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
                                   value="{{ old('sort_order', $attorney->sort_order) }}"
                                   class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            Status
                        </label>

                        <label class="role-checkbox-item {{ old('status', $attorney->status) ? 'checked' : '' }}" style="margin-top:8px;">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="role-checkbox"
                                   {{ old('status', $attorney->status) ? 'checked' : '' }}>

                            <div class="check-icon"></div>

                            <span class="checkbox-text">Active</span>
                        </label>
                    </div>
                </div>

                <div class="form-info-box">
                    <p class="meta-label">Profile Info</p>

                    <div class="meta-grid-2">
                        <div>
                            <p class="meta-small-label">Created</p>
                            <p class="meta-value-strong">
                                {{ optional($attorney->created_at)->format('d M Y') ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="meta-small-label">Current Status</p>

                            @if($attorney->status)
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
                <i class="fas fa-list"></i>
            </div>

            <div>
                <p class="form-card-title">Meta Items</p>
                <p class="form-card-subtitle">Update location, experience and practice details</p>
            </div>
        </div>

        <div class="form-card-body">
            @php
                $metaItems = old('meta_items', $attorney->meta_items ?? []);
            @endphp

            @for($i = 0; $i < 4; $i++)
                <div class="admin-form-grid" style="margin-bottom:14px;">
                    <div class="field-group">
                        <label class="field-label">Meta Icon {{ $i + 1 }}</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-icons icon"></i>

                            <input type="text"
                                   name="meta_icons[]"
                                   value="{{ old('meta_icons.' . $i, $metaItems[$i]['icon'] ?? '') }}"
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
                                   value="{{ old('meta_texts.' . $i, $metaItems[$i]['text'] ?? '') }}"
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
                <p class="form-card-subtitle">Update frontend card tags</p>
            </div>
        </div>

        <div class="form-card-body">
            @php
                $tags = old('tags', $attorney->tags ?? []);
            @endphp

            <div class="admin-form-grid">
                @for($i = 0; $i < 6; $i++)
                    <div class="field-group">
                        <label class="field-label">Tag {{ $i + 1 }}</label>

                        <div class="input-icon-wrap">
                            <i class="fas fa-tag icon"></i>

                            <input type="text"
                                   name="tags[]"
                                   value="{{ $tags[$i] ?? '' }}"
                                   placeholder="Family Law"
                                   class="field-input">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="form-actions-between">
        <div class="form-actions-left">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                {{ trans('global.save') }}
            </button>

            <a href="{{ route('admin.attorneys.index') }}" class="btn-ghost">
                {{ trans('global.cancel') }}
            </a>
        </div>

        @can('attorney_delete')
            <button type="submit"
                    form="delete-attorney-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Attorney
            </button>
        @endcan
    </div>
</form>

@can('attorney_delete')
    <form id="delete-attorney-form"
          action="{{ route('admin.attorneys.destroy', $attorney->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection

