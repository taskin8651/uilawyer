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

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-link"></i>
                </div>

                <div>
                    <p class="form-card-title">Buttons</p>
                    <p class="form-card-subtitle">Update frontend action buttons</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Profile Button Text</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-eye icon"></i>

                        <input type="text"
                               name="profile_button_text"
                               value="{{ old('profile_button_text', $attorney->profile_button_text) }}"
                               class="field-input {{ $errors->has('profile_button_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Profile Button URL</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-external-link-alt icon"></i>

                        <input type="text"
                               name="profile_button_url"
                               value="{{ old('profile_button_url', $attorney->profile_button_url) }}"
                               class="field-input {{ $errors->has('profile_button_url') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Consult Button Text</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-comments icon"></i>

                        <input type="text"
                               name="consult_button_text"
                               value="{{ old('consult_button_text', $attorney->consult_button_text) }}"
                               class="field-input {{ $errors->has('consult_button_text') ? 'error' : '' }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Consult Button URL</label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-link icon"></i>

                        <input type="text"
                               name="consult_button_url"
                               value="{{ old('consult_button_url', $attorney->consult_button_url) }}"
                               class="field-input {{ $errors->has('consult_button_url') ? 'error' : '' }}">
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