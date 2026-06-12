@extends('layouts.admin')

@section('page-title', 'Confirm Password')

@section('content')
<div class="admin-page-head">
    <div><h2 class="admin-page-title">Confirm Password</h2><p class="admin-page-subtitle">This is a secure area. Confirm your password to continue.</p></div>
</div>

<form method="POST" action="{{ route('password.confirm') }}" class="form-card confirm-password-card">
    @csrf
    <div class="form-card-header">
        <div class="form-card-icon"><i class="fas fa-shield-alt"></i></div>
        <div><p class="form-card-title">Security Check</p><p class="form-card-subtitle">Enter your current account password.</p></div>
    </div>
    <div class="form-card-body">
        <div class="field-group">
            <label class="field-label" for="password">Password <span class="req">*</span></label>
            <div class="input-icon-wrap has-eye">
                <i class="fas fa-lock icon"></i>
                <input id="password" type="password" class="field-input {{ $errors->has('password') ? 'error' : '' }}" name="password" required autocomplete="current-password" autofocus>
                <button type="button" class="eye-toggle" onclick="togglePass('password', this)"><i class="fas fa-eye"></i></button>
            </div>
            @error('password')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
        </div>
        <div class="form-actions-left">
            <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Confirm Password</button>
            @if(Route::has('password.request'))<a class="btn-ghost" href="{{ route('password.request') }}">Forgot Password?</a>@endif
        </div>
    </div>
</form>
@endsection

@section('styles')
<style>.confirm-password-card { max-width: 640px; }</style>
@endsection
