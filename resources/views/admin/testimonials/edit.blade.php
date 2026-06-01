@extends('layouts.admin')

@section('page-title', 'Edit Testimonial')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.testimonials.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Edit Testimonial</h2>

        <p class="admin-page-subtitle">
            Update client review, rating and frontend visibility.
        </p>
    </div>

    <div class="identity-card">
        <div class="identity-avatar">
            {{ strtoupper(substr($testimonial->client_name ?? 'R', 0, 1)) }}
        </div>

        <div>
            <p class="identity-title">{{ $testimonial->client_name }}</p>
            <p class="identity-subtitle">ID #{{ $testimonial->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}">
    @method('PUT')
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-check"></i>
                </div>

                <div>
                    <p class="form-card-title">Client Information</p>
                    <p class="form-card-subtitle">Update name and feedback label</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="client_name">
                        Client Name <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-user icon"></i>

                        <input type="text"
                               name="client_name"
                               id="client_name"
                               value="{{ old('client_name', $testimonial->client_name) }}"
                               required
                               placeholder="Rajpati Client"
                               class="field-input {{ $errors->has('client_name') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('client_name'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('client_name') }}
                        </p>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="client_designation">
                        Client Label
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-badge-check icon"></i>

                        <input type="text"
                               name="client_designation"
                               id="client_designation"
                               value="{{ old('client_designation', $testimonial->client_designation) }}"
                               placeholder="Verified Feedback"
                               class="field-input {{ $errors->has('client_designation') ? 'error' : '' }}">
                    </div>

                    @if($errors->has('client_designation'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('client_designation') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-star"></i>
                </div>

                <div>
                    <p class="form-card-title">Review Settings</p>
                    <p class="form-card-subtitle">Update rating, order and status</p>
                </div>
            </div>

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="rating">
                        Rating <span class="req">*</span>
                    </label>

                    <div class="input-icon-wrap">
                        <i class="fas fa-star icon"></i>

                        <select name="rating"
                                id="rating"
                                required
                                class="field-input {{ $errors->has('rating') ? 'error' : '' }}">
                            <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Star</option>
                            <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Star</option>
                            <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Star</option>
                            <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Star</option>
                            <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>

                    @if($errors->has('rating'))
                        <p class="field-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('rating') }}
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
                               value="{{ old('sort_order', $testimonial->sort_order) }}"
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
                    <label class="field-label" for="approval_status">Approval Status</label>
                    <select name="approval_status" id="approval_status" class="field-input">
                        @foreach(['new' => 'New', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                            <option value="{{ $value }}" {{ old('approval_status', $testimonial->approval_status ?? 'new') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">
                        Status
                    </label>

                    <label class="role-checkbox-item {{ old('status', $testimonial->status) ? 'checked' : '' }}" style="margin-top:8px;">
                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="role-checkbox"
                               {{ old('status', $testimonial->status) ? 'checked' : '' }}>

                        <div class="check-icon"></div>
                        <span class="checkbox-text">Active</span>
                    </label>
                </div>

            </div>
        </div>

    </div>

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-comment-dots"></i>
            </div>

            <div>
                <p class="form-card-title">Review Content</p>
                <p class="form-card-subtitle">Update client review text</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="review">
                    Review <span class="req">*</span>
                </label>

                <textarea name="review"
                          id="review"
                          rows="6"
                          required
                          placeholder="Write client review..."
                          class="field-input {{ $errors->has('review') ? 'error' : '' }}">{{ old('review', $testimonial->review) }}</textarea>

                @if($errors->has('review'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('review') }}
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

            <a href="{{ route('admin.testimonials.index') }}" class="btn-ghost">
                {{ trans('global.cancel') }}
            </a>
        </div>

        @can('testimonial_delete')
            <button type="submit"
                    form="delete-testimonial-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Testimonial
            </button>
        @endcan
    </div>

</form>

@can('testimonial_delete')
    <form id="delete-testimonial-form"
          action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection
