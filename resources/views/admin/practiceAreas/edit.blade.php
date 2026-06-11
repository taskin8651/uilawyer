@extends('layouts.admin')

@section('page-title', 'Edit Practice Area')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Practice Area
        </h2>

        <p class="admin-page-subtitle">
            Update dynamic practice area, frontend card and detail page content.
        </p>
    </div>

    <div class="identity-card">
        @if($practiceArea->image)
            <img src="{{ $practiceArea->image }}"
                 alt="{{ $practiceArea->title }}"
                 class="identity-avatar"
                 style="object-fit:cover;">
        @else
            <div class="identity-avatar">
                {{ strtoupper(substr($practiceArea->title ?? 'P', 0, 1)) }}
            </div>
        @endif

        <div>
            <p class="identity-title">{{ $practiceArea->title }}</p>
            <p class="identity-subtitle">ID #{{ $practiceArea->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-areas.update', $practiceArea->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    @include('admin.practiceAreas.form', ['practiceArea' => $practiceArea])
</form>

@can('practice_area_delete')
    <form id="delete-practice-area-form"
          action="{{ route('admin.practice-areas.destroy', $practiceArea->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection
