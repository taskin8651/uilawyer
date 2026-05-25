@extends('layouts.admin')

@section('page-title', 'Add Verdict & Judgment')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.verdict-judgments.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Add Verdict & Judgment</h2>
        <p class="admin-page-subtitle">
            Create a court judgment note with image and document upload.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.verdict-judgments.store') }}" enctype="multipart/form-data">
    @csrf

    @include('admin.verdictJudgments.form')

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Judgment
        </button>

        <a href="{{ route('admin.verdict-judgments.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>

@endsection
