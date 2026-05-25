@extends('layouts.admin')

@section('page-title', 'Verdict & Judgment Details')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.verdict-judgments.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">{{ $verdictJudgment->title }}</h2>
        <p class="admin-page-subtitle">
            {{ $verdictJudgment->court_name ?: 'Court details not added' }}
        </p>
    </div>

    <div class="action-row">
        @can('verdict_judgment_edit')
            <a href="{{ route('admin.verdict-judgments.edit', $verdictJudgment->id) }}" class="btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Edit
            </a>
        @endcan
    </div>
</div>

<div class="admin-form-grid">
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-scale-balanced"></i>
            </div>

            <div>
                <p class="form-card-title">Case Information</p>
                <p class="form-card-subtitle">Judgment metadata</p>
            </div>
        </div>

        <div class="form-card-body">
            <p><strong>Slug:</strong> {{ $verdictJudgment->slug }}</p>
            <p><strong>Court:</strong> {{ $verdictJudgment->court_name ?: '-' }}</p>
            <p><strong>Case Number:</strong> {{ $verdictJudgment->case_number ?: '-' }}</p>
            <p><strong>Citation:</strong> {{ $verdictJudgment->citation ?: '-' }}</p>
            <p><strong>Author:</strong> {{ $verdictJudgment->author_name ?: 'Legal Desk' }}</p>
            <p><strong>Judgment Date:</strong> {{ optional($verdictJudgment->judgment_date)->format('d M Y') ?: '-' }}</p>
            <p><strong>Featured:</strong> {{ $verdictJudgment->is_featured ? 'Yes' : 'No' }}</p>
            <p><strong>Status:</strong> {{ $verdictJudgment->status ? 'Active' : 'Inactive' }}</p>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fas fa-file-download"></i>
            </div>

            <div>
                <p class="form-card-title">Media</p>
                <p class="form-card-subtitle">Uploaded image and judgment document</p>
            </div>
        </div>

        <div class="form-card-body">
            @if($verdictJudgment->image)
                <img src="{{ $verdictJudgment->image }}" alt="{{ $verdictJudgment->title }}" style="width:100%; max-height:260px; object-fit:cover; border-radius:12px; margin-bottom:14px;">
            @endif

            @if($verdictJudgment->document)
                <a href="{{ $verdictJudgment->document }}" target="_blank" class="quick-link primary">
                    <i class="fas fa-file-download"></i>
                    Download Judgment Document
                </a>
            @else
                <p class="field-hint">Document upload nahi hai.</p>
            @endif
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
            <p class="form-card-subtitle">Description and result summary</p>
        </div>
    </div>

    <div class="form-card-body">
        @if($verdictJudgment->short_description)
            <p>{{ $verdictJudgment->short_description }}</p>
        @endif

        @if($verdictJudgment->description)
            <div>{!! $verdictJudgment->description !!}</div>
        @endif

        @if($verdictJudgment->result_summary)
            <hr>
            <h4>Result Summary</h4>
            <div>{!! $verdictJudgment->result_summary !!}</div>
        @endif
    </div>
</div>

@endsection
