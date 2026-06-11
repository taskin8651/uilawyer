@extends('layouts.admin')

@section('page-title', 'Add Practice Area Service')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-area-services.index') }}" class="admin-back-link">
            &larr; {{ trans('global.back_to_list') }}
        </a>

        <h2 class="admin-page-title">
            Add Practice Area Service
        </h2>

        <p class="admin-page-subtitle">
            Create a dynamic service card and frontend detail page.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-area-services.store') }}">
    @csrf

    @include('admin.practiceAreaServices.form', ['practiceAreaService' => null])
</form>

@endsection
