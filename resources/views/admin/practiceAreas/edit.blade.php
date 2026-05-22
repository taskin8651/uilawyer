@extends('layouts.admin')

@section('page-title', 'Edit Practice Area')

@section('content')
<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.practice-areas.index') }}" class="admin-back-link">← Back to list</a>
        <h2 class="admin-page-title">Edit Practice Area</h2>
        <p class="admin-page-subtitle">Update practice area content and detail page data.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.practice-areas.update', $practiceArea->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    @include('admin.practiceAreas.form', ['practiceArea' => $practiceArea])
</form>
@endsection
