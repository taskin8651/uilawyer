@extends('layouts.admin')
@section('page-title', 'Q&A Details')
@section('content')<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">Legal Question</h2><p>{{ $legalQa->question }}</p><h3 class="page-card-title">Answer</h3><p>{{ $legalQa->answer }}</p><a href="{{ route('admin.legal-qas.index') }}" class="btn-primary">Back</a></div>@endsection
