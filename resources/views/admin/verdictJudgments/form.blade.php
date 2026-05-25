@php
    $verdictJudgment = $verdictJudgment ?? null;
@endphp

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-gavel"></i>
            </div>

            <div>
                <p class="form-card-title">Judgment Information</p>
                <p class="form-card-subtitle">Title, court, case details and judgment date</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="title">Title <span class="req">*</span></label>
                <div class="input-icon-wrap">
                    <i class="fas fa-heading icon"></i>
                    <input type="text" name="title" id="title" value="{{ old('title', $verdictJudgment->title ?? '') }}" required class="field-input {{ $errors->has('title') ? 'error' : '' }}" placeholder="Important bail judgment by High Court">
                </div>
                @if($errors->has('title'))
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('title') }}</p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="slug">Slug</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-link icon"></i>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $verdictJudgment->slug ?? '') }}" class="field-input {{ $errors->has('slug') ? 'error' : '' }}" placeholder="important-bail-judgment">
                </div>
                @if($errors->has('slug'))
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('slug') }}</p>
                @else
                    <p class="field-hint">Blank rakhne par slug automatically generate hoga.</p>
                @endif
            </div>

            <div class="admin-form-grid">
                <div class="field-group">
                    <label class="field-label" for="court_name">Court Name</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-landmark icon"></i>
                        <input type="text" name="court_name" id="court_name" value="{{ old('court_name', $verdictJudgment->court_name ?? '') }}" class="field-input {{ $errors->has('court_name') ? 'error' : '' }}" placeholder="Delhi High Court">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="judgment_date">Judgment Date</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar-alt icon"></i>
                        <input type="date" name="judgment_date" id="judgment_date" value="{{ old('judgment_date', optional($verdictJudgment->judgment_date ?? null)->format('Y-m-d')) }}" class="field-input {{ $errors->has('judgment_date') ? 'error' : '' }}">
                    </div>
                </div>
            </div>

            <div class="admin-form-grid">
                <div class="field-group">
                    <label class="field-label" for="case_number">Case Number</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-hashtag icon"></i>
                        <input type="text" name="case_number" id="case_number" value="{{ old('case_number', $verdictJudgment->case_number ?? '') }}" class="field-input {{ $errors->has('case_number') ? 'error' : '' }}" placeholder="W.P.(C) 1234/2026">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="citation">Citation</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-quote-right icon"></i>
                        <input type="text" name="citation" id="citation" value="{{ old('citation', $verdictJudgment->citation ?? '') }}" class="field-input {{ $errors->has('citation') ? 'error' : '' }}" placeholder="2026 SCC OnLine Del 100">
                    </div>
                </div>
            </div>

            <div class="field-group">
                <label class="field-label" for="author_name">Author Name</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $verdictJudgment->author_name ?? 'Legal Desk') }}" class="field-input {{ $errors->has('author_name') ? 'error' : '' }}" placeholder="Legal Desk">
                </div>
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
                <p class="form-card-subtitle">Frontend visibility and ordering</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="verdict_image">Judgment Image</label>
                <input type="file" name="verdict_image" id="verdict_image" class="field-input {{ $errors->has('verdict_image') ? 'error' : '' }}">
                @if($errors->has('verdict_image'))
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('verdict_image') }}</p>
                @else
                    <p class="field-hint">JPG, PNG or WEBP image. Minimum 10KB.</p>
                @endif
                @if($verdictJudgment && $verdictJudgment->image)
                    <p class="field-hint"><a href="{{ $verdictJudgment->image }}" target="_blank">Current image dekhein</a></p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="verdict_document">Judgment Document</label>
                <input type="file" name="verdict_document" id="verdict_document" class="field-input {{ $errors->has('verdict_document') ? 'error' : '' }}">
                @if($errors->has('verdict_document'))
                    <p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('verdict_document') }}</p>
                @else
                    <p class="field-hint">PDF, DOC or DOCX. Minimum 10KB.</p>
                @endif
                @if($verdictJudgment && $verdictJudgment->document)
                    <p class="field-hint"><a href="{{ $verdictJudgment->document }}" target="_blank">Current document download karein</a></p>
                @endif
            </div>

            <div class="field-group">
                <label class="field-label" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $verdictJudgment->sort_order ?? 0) }}" class="field-input {{ $errors->has('sort_order') ? 'error' : '' }}">
            </div>

            <div class="field-group">
                <label class="switch-row">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $verdictJudgment->is_featured ?? false) ? 'checked' : '' }}>
                    <span>Featured judgment</span>
                </label>
            </div>

            <div class="field-group">
                <label class="switch-row">
                    <input type="checkbox" name="status" value="1" {{ old('status', $verdictJudgment->status ?? true) ? 'checked' : '' }}>
                    <span>Active on frontend</span>
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
            <p class="form-card-title">Content</p>
            <p class="form-card-subtitle">Short summary, full judgment note and result summary</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="short_description">Short Description</label>
            <textarea name="short_description" id="short_description" rows="4" class="field-input {{ $errors->has('short_description') ? 'error' : '' }}" placeholder="Short card summary">{{ old('short_description', $verdictJudgment->short_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="description">Full Description</label>
            <textarea name="description" id="description" rows="8" class="field-input js-ckeditor {{ $errors->has('description') ? 'error' : '' }}" placeholder="Detailed judgment content">{{ old('description', $verdictJudgment->description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label" for="result_summary">Result Summary</label>
            <textarea name="result_summary" id="result_summary" rows="5" class="field-input js-ckeditor {{ $errors->has('result_summary') ? 'error' : '' }}" placeholder="Final result or key holding">{{ old('result_summary', $verdictJudgment->result_summary ?? '') }}</textarea>
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
            <p class="form-card-subtitle">Optional meta fields for judgment details page</p>
        </div>
    </div>

    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $verdictJudgment->meta_title ?? '') }}" class="field-input {{ $errors->has('meta_title') ? 'error' : '' }}">
        </div>

        <div class="field-group">
            <label class="field-label">Meta Description</label>
            <textarea name="meta_description" rows="3" class="field-input {{ $errors->has('meta_description') ? 'error' : '' }}">{{ old('meta_description', $verdictJudgment->meta_description ?? '') }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $verdictJudgment->meta_keywords ?? '') }}" class="field-input {{ $errors->has('meta_keywords') ? 'error' : '' }}">
        </div>
    </div>
</div>
