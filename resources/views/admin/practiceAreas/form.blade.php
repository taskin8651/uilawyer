@php
    $isEdit = filled($practiceArea);
@endphp

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-scale-balanced"></i></div>
            <div>
                <p class="form-card-title">Practice Area Information</p>
                <p class="form-card-subtitle">Title, slug, icon, image and frontend visibility</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <input type="text" name="title" id="title" required
                       value="{{ old('title', $practiceArea->title ?? '') }}"
                       class="field-input {{ $errors->has('title') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label" for="slug">Slug</label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $practiceArea->slug ?? '') }}"
                       placeholder="family-law"
                       class="field-input {{ $errors->has('slug') ? 'error' : '' }}">
                <p class="field-hint">Blank rakhne par slug title se auto generate hoga.</p>
            </div>

            <div class="field-group">
                <label class="field-label" for="icon_class">Icon Class</label>
                <input type="text" name="icon_class" id="icon_class"
                       value="{{ old('icon_class', $practiceArea->icon_class ?? 'bi bi-grid-3x3-gap-fill') }}"
                       placeholder="bi bi-heartbreak"
                       class="field-input {{ $errors->has('icon_class') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="field-label" for="practice_area_image">Image</label>
                <input type="file" name="practice_area_image" id="practice_area_image"
                       class="field-input {{ $errors->has('practice_area_image') ? 'error' : '' }}">
                @if($isEdit && $practiceArea->image)
                    <img src="{{ $practiceArea->image }}" alt="{{ $practiceArea->title }}"
                         style="width:180px;height:115px;object-fit:cover;border-radius:12px;margin-top:12px;">
                @endif
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-cog"></i></div>
            <div>
                <p class="form-card-title">Publish Settings</p>
                <p class="form-card-subtitle">Menu order, status</p>
            </div>
        </div>

        <div class="form-card-body"><div class="field-group">
                <label class="field-label" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order"
                       value="{{ old('sort_order', $practiceArea->sort_order ?? 0) }}"
                       class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="role-checkbox-item {{ old('status', $practiceArea->status ?? 1) ? 'checked' : '' }}">
                    <input type="checkbox" name="status" value="1" class="role-checkbox"
                           {{ old('status', $practiceArea->status ?? 1) ? 'checked' : '' }}>
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
            <p class="form-card-title">Frontend Content</p>
            <p class="form-card-subtitle">Short menu text and full detail page content</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="short_description">Short Description</label>
            <textarea name="short_description" id="short_description" rows="4"
                      class="field-input {{ $errors->has('short_description') ? 'error' : '' }}">{{ old('short_description', $practiceArea->short_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="description">Full Description</label>
            <textarea name="description" id="description" rows="8"
                      class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}">{{ old('description', $practiceArea->description ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="form-card" style="margin-top:22px;">
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-book-open"></i></div>
        <div>
            <p class="form-card-title">Knowledge Resource Content</p>
            <p class="form-card-subtitle">Optional educational sections shown on the practice detail page</p>
        </div>
    </div>

    <div class="form-card-body">
        @foreach([
            'issue_overview' => ['What is the legal issue?', 'Explain the issue in simple client-friendly language.'],
            'legal_position' => ['Legal position', 'How the law generally regulates this issue.'],
            'remedies' => ['Available remedies', 'List practical legal remedies and reliefs.'],
            'documents_required' => ['Documents usually required', 'Mention common documents clients should keep ready.'],
            'process_overview' => ['General process', 'Explain the broad legal process without promising outcomes.'],
            'when_to_consult_lawyer' => ['When to consult a lawyer', 'Explain warning signs or urgency points.'],
        ] as $field => $meta)
            <div class="field-group">
                <label class="field-label" for="{{ $field }}">{{ $meta[0] }}</label>
                <textarea name="{{ $field }}" id="{{ $field }}" rows="4"
                          placeholder="{{ $meta[1] }}"
                          class="field-input {{ $errors->has($field) ? 'error' : '' }}">{{ old($field, $practiceArea->{$field} ?? '') }}</textarea>
            </div>
        @endforeach
    </div>
</div>

<div class="form-card" style="margin-top:22px;">
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-question-circle"></i></div>
        <div>
            <p class="form-card-title">Practice FAQs</p>
            <p class="form-card-subtitle">Optional questions and answers for SEO and visitor clarity</p>
        </div>
    </div>

    <div class="form-card-body">
        @php
            $faqItems = old('faq_items', $practiceArea->faq_items ?? []);
        @endphp

        @for($i = 0; $i < 5; $i++)
            <div class="admin-form-grid" style="margin-bottom:14px;">
                <div class="field-group">
                    <label class="field-label">Question {{ $i + 1 }}</label>
                    <input type="text" name="faq_questions[]"
                           value="{{ old('faq_questions.' . $i, $faqItems[$i]['question'] ?? '') }}"
                           placeholder="What documents are required?"
                           class="field-input">
                </div>

                <div class="field-group">
                    <label class="field-label">Answer {{ $i + 1 }}</label>
                    <textarea name="faq_answers[]" rows="3"
                              placeholder="Write a short helpful answer."
                              class="field-input">{{ old('faq_answers.' . $i, $faqItems[$i]['answer'] ?? '') }}</textarea>
                </div>
            </div>
        @endfor
    </div>
</div>

<div class="form-card" style="margin-top:22px;">
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-search"></i></div>
        <div>
            <p class="form-card-title">SEO Meta</p>
            <p class="form-card-subtitle">Optional meta fields for practice detail page</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title"
                   value="{{ old('meta_title', $practiceArea->meta_title ?? '') }}"
                   class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
        </div>

        <div class="field-group">
            <label class="field-label" for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="3"
                      class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description', $practiceArea->meta_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="meta_keywords">Meta Keywords</label>
            <input type="text" name="meta_keywords" id="meta_keywords"
                   value="{{ old('meta_keywords', $practiceArea->meta_keywords ?? '') }}"
                   class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i>
        Save Practice Area
    </button>
    <a href="{{ route('admin.practice-areas.index') }}" class="btn-ghost">Cancel</a>
</div>

