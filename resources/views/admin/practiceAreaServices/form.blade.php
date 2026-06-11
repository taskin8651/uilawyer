@php
    $isEdit = filled($practiceAreaService);
@endphp

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-briefcase"></i></div>
            <div>
                <p class="form-card-title">Service Information</p>
                <p class="form-card-subtitle">Parent category, title, slug and icon</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="practice_area_id">Practice Area <span class="req">*</span></label>
                <select name="practice_area_id" id="practice_area_id"
                        class="field-input {{ $errors->has('practice_area_id') ? 'error' : '' }}">
                    <option value="">Select Practice Area</option>
                    @foreach($practiceAreas as $id => $title)
                        <option value="{{ $id }}" {{ old('practice_area_id', $practiceAreaService->practice_area_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <input type="text" name="title" id="title" required
                       value="{{ old('title', $practiceAreaService->title ?? '') }}"
                       class="field-input {{ $errors->has('title') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label" for="slug">Slug</label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $practiceAreaService->slug ?? '') }}"
                       placeholder="divorce-lawyer"
                       class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                <p class="field-hint">Blank rakhne par slug title se auto generate hoga.</p>
            </div>

            <div class="field-group">
                <label class="field-label" for="icon_class">Icon Class</label>
                <input type="text" name="icon_class" id="icon_class"
                       value="{{ old('icon_class', $practiceAreaService->icon_class ?? 'bi bi-grid-3x3-gap-fill') }}"
                       placeholder="bi bi-heartbreak"
                       class="field-input {{ $errors->has('icon_class') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label" for="button_text">Button Text</label>
                <input type="text" name="button_text" id="button_text"
                       value="{{ old('button_text', $practiceAreaService->button_text ?? '') }}"
                       placeholder="View Details"
                       class="field-input {{ $errors->has('button_text') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label" for="url">Custom URL</label>
                <input type="text" name="url" id="url"
                       value="{{ old('url', $practiceAreaService->url ?? '') }}"
                       placeholder="https://example.com/service"
                       class="field-input {{ $errors->has('url') ? 'error' : '' }}">
                <p class="field-hint">Optional external or custom service URL.</p>
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-cog"></i></div>
            <div>
                <p class="form-card-title">Publish Settings</p>
                <p class="form-card-subtitle">sort order and status</p>
            </div>
        </div>

        <div class="form-card-body"><div class="field-group">
                <label class="field-label" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order"
                       value="{{ old('sort_order', $practiceAreaService->sort_order ?? 0) }}"
                       class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="role-checkbox-item {{ old('status', $practiceAreaService->status ?? 1) ? 'checked' : '' }}">
                    <input type="checkbox" name="status" value="1" class="role-checkbox"
                           {{ old('status', $practiceAreaService->status ?? 1) ? 'checked' : '' }}>
                    <div class="check-icon"></div>
                    <span class="checkbox-text">Active</span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-card" style="margin-top:22px;">
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-align-left"></i></div>
        <div>
            <p class="form-card-title">Service Content</p>
            <p class="form-card-subtitle">Card description and full detail page content</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="short_description">Short Description</label>
            <textarea name="short_description" id="short_description" rows="4"
                      class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $practiceAreaService->short_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="description">Full Description</label>
            <textarea name="description" id="description" rows="8"
                      class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $practiceAreaService->description ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="form-card" style="margin-top:22px;">
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-search"></i></div>
        <div>
            <p class="form-card-title">SEO Meta</p>
            <p class="form-card-subtitle">Optional meta fields for service detail page</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title"
                   value="{{ old('meta_title', $practiceAreaService->meta_title ?? '') }}"
                   class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
        </div>

        <div class="field-group">
            <label class="field-label" for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="3"
                      class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description', $practiceAreaService->meta_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="meta_keywords">Meta Keywords</label>
            <input type="text" name="meta_keywords" id="meta_keywords"
                   value="{{ old('meta_keywords', $practiceAreaService->meta_keywords ?? '') }}"
                   class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i>
        Save Service
    </button>
    <a href="{{ route('admin.practice-area-services.index') }}" class="btn-ghost">Cancel</a>

    @if($isEdit)
        @can('practice_area_service_delete')
            <button type="submit"
                    form="delete-practice-area-service-form"
                    class="btn-danger">
                <i class="fas fa-trash-alt"></i>
                Delete Service
            </button>
        @endcan
    @endif
</div>

