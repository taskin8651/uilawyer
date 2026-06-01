@extends('layouts.admin')
@section('page-title', 'Internship Details')
@section('content')
<div class="page-card" style="padding:20px;"><h2 class="admin-page-title">{{ $internship->full_name }}</h2>
@can('internship_edit')<form method="POST" action="{{ route('admin.internships.updateStatus', $internship) }}" style="margin:16px 0;">@csrf <select name="status" class="field-input" style="max-width:220px;display:inline-block;">@foreach(['new'=>'New','reviewed'=>'Reviewed','approved'=>'Approved','rejected'=>'Rejected'] as $value=>$label)<option value="{{ $value }}" {{ $internship->status === $value ? 'selected' : '' }}>{{ $label }}</option>@endforeach</select> <button class="btn-primary">Update Status</button></form>@endcan
<div class="admin-form-grid"><div><p><strong>Mobile:</strong> {{ $internship->mobile }}</p><p><strong>Email:</strong> {{ $internship->email }}</p><p><strong>City/State:</strong> {{ $internship->city_state }}</p><p><strong>College:</strong> {{ $internship->college_university }}</p><p><strong>Course/Year:</strong> {{ $internship->course_year }}</p></div><div><p><strong>Type:</strong> {{ $internship->internship_type }}</p><p><strong>Practice Area:</strong> {{ $internship->practice_area_interest }}</p><p><strong>Start:</strong> {{ optional($internship->preferred_start_date)->format('d M Y') }}</p><p><strong>Duration:</strong> {{ $internship->preferred_duration }}</p><p><strong>Consent:</strong> {{ $internship->consent ? 'Yes' : 'No' }}</p></div></div>
<p><strong>Message:</strong><br>{{ $internship->message }}</p>
<p><strong>Files:</strong>
@foreach(['resume'=>'Resume','aadhar_card'=>'Aadhar Card','photograph'=>'Photograph','payment_screenshot'=>'Payment Screenshot'] as $attr=>$label)
    @if($internship->{$attr}) <a class="btn-outline" target="_blank" href="{{ $internship->{$attr} }}">{{ $label }}</a> @endif
@endforeach
</p><a href="{{ route('admin.internships.index') }}" class="btn-primary">Back</a></div>
@endsection
