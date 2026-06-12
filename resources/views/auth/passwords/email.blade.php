@extends('frontend.master')
@section('content')
@include('auth.passwords.guest-styles')
<section class="password-auth-section">
  <div class="password-auth-card">
    <div class="password-auth-brand"><i class="bi bi-envelope-lock-fill"></i><h1>Forgot Password</h1><p>Enter your registered email address and we will send you a secure reset link.</p></div>
    @if(session('status'))<div class="password-alert">{{ session('status') }}</div>@endif
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="password-field"><label for="email">Email Address</label><input id="email" class="password-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>@error('email')<p class="password-error">{{ $message }}</p>@enderror</div>
      <button class="password-btn" type="submit">Send Password Reset Link</button>
      <div class="password-links"><a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Back to login</a></div>
    </form>
  </div>
</section>
@endsection
