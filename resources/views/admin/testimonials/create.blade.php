@extends('layouts.admin')

@section('page-title', 'Add Testimonial')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.testimonials.index') }}" class="admin-back-link">
            ← {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Add Testimonial</h2>

        <p class="admin-page-subtitle">
            Add a new client review for frontend testimonial section.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.testimonials.store') }}">
    @csrf

    <div class="admin-form-grid">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon">
                    <i class="fas fa-user-check"></i>
                </div>

                <div>
                    <p class="form-card-title">Client Information</p>
                    <p class="form-card-subtitle">Name and feedback label</p>
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
                               value="{{ old('client_name') }}"
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
                               value="{{ old('client_designation', 'Verified Feedback') }}"
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
                    <p class="form-card-subtitle">Rating, order and frontend visibility</p>
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
                            <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Star</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Star</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Star</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Star</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
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
                    <label class="field-label" for="approval_status">Approval Status</label>
                    <select name="approval_status" id="approval_status" class="field-input">
                        <option value="new" {{ old('approval_status', 'new') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="approved" {{ old('approval_status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('approval_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
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

    <div class="form-card" style="margin-top:22px;">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-comment-dots"></i>
            </div>

            <div>
                <p class="form-card-title">Review Content</p>
                <p class="form-card-subtitle">Client review text shown inside frontend card</p>
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
                          class="field-input {{ $errors->has('review') ? 'error' : '' }}">{{ old('review') }}</textarea>

                @if($errors->has('review'))
                    <p class="field-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('review') }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i>
            Save Testimonial
        </button>

        <a href="{{ route('admin.testimonials.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>

</form>

@endsection
