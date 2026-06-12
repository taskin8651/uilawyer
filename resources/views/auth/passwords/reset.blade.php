@extends('frontend.master')
@section('content')
@include('auth.passwords.guest-styles')
<section class="password-auth-section">
  <div class="password-auth-card">
    <div class="password-auth-brand"><i class="bi bi-shield-lock-fill"></i><h1>Reset Password</h1><p>Create a strong new password for your account.</p></div>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input name="token" value="{{ $token }}" type="hidden">
      <div class="password-field"><label for="email">Email Address</label><input id="email" class="password-input" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">@error('email')<p class="password-error">{{ $message }}</p>@enderror</div>
      <div class="password-field"><label for="password">New Password</label><input id="password" class="password-input" type="password" name="password" required autocomplete="new-password">@error('password')<p class="password-error">{{ $message }}</p>@enderror</div>
      <div class="password-field"><label for="password-confirm">Confirm New Password</label><input id="password-confirm" class="password-input" type="password" name="password_confirmation" required autocomplete="new-password"></div>
      <button class="password-btn" type="submit">Reset Password</button>
    </form>
  </div>
</section>
@endsection
