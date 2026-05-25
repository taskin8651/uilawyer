@extends('layouts.admin')

@section('page-title', 'Edit Verdict & Judgment')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.verdict-judgments.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">Edit Verdict & Judgment</h2>
        <p class="admin-page-subtitle">
            Update case details, content, media and frontend visibility.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.verdict-judgments.update', $verdictJudgment->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    @include('admin.verdictJudgments.form', ['verdictJudgment' => $verdictJudgment])

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Judgment
        </button>

        <a href="{{ route('admin.verdict-judgments.index') }}" class="btn-ghost">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>

@endsection
