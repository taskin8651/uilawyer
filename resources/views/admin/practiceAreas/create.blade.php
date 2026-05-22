@extends('layouts.admin')

@section('page-title', 'Add Practice Area')

@section('content')
<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">← Back to list</a>
        <h2 class="admin-page-title">Add Practice Area</h2>
        <p class="admin-page-subtitle">Create a dynamic practice area and frontend detail page.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-areas.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.practiceAreas.form', ['practiceArea' => null])
</form>
@endsection
