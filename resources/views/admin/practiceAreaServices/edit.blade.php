@extends('layouts.admin')

@section('page-title', 'Edit Practice Area Service')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-area-services.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Edit Practice Area Service
        </h2>

        <p class="admin-page-subtitle">
            Update service card, frontend detail page and SEO content.
        </p>
    </div>

    <div class="identity-card">
        <div class="identity-avatar">
            {{ strtoupper(substr($practiceAreaService->title ?? 'S', 0, 1)) }}
        </div>

        <div>
            <p class="identity-title">{{ $practiceAreaService->title }}</p>
            <p class="identity-subtitle">ID #{{ $practiceAreaService->id }}</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-area-services.update', $practiceAreaService->id) }}">
    @method('PUT')
    @csrf

    @include('admin.practiceAreaServices.form', ['practiceAreaService' => $practiceAreaService])
</form>

@can('practice_area_service_delete')
    <form id="delete-practice-area-service-form"
          action="{{ route('admin.practice-area-services.destroy', $practiceAreaService->id) }}"
          method="POST"
          onsubmit="return confirm('{{ trans('global.areYouSure') }}')"
          style="display:none;">
        @method('DELETE')
        @csrf
    </form>
@endcan

@endsection
