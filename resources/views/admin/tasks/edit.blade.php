@extends('layouts.admin')
@section('page-title', 'Edit Task')
@section('content')
<form method="POST" action="{{ route('admin.tasks.update', $task) }}">@csrf @method('PUT') @include('admin.tasks.form')</form>
@endsection
