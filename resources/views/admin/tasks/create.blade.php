@extends('layouts.admin')
@section('page-title', 'Create Task')
@section('content')
<form method="POST" action="{{ route('admin.tasks.store') }}">@csrf @include('admin.tasks.form')</form>
@endsection
