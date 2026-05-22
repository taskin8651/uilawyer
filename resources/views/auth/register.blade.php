@extends('frontend.master')

@section('content')
<style>
  .auth-section {
    position: relative;
    overflow: hidden;
    min-height: 820px;
    display: grid;
    place-items: center;
    padding: 100px 18px;
    background:
      radial-gradient(circle at 78% 12%, rgba(209, 169, 61, .22), transparent 30%),
      linear-gradient(135deg, #050914 0%, #0b1024 58%, #151b2e 100%);
  }
  .auth-card {
    width: min(100%, 500px);
    padding: 34px;
    border-radius: 10px;
    background: rgba(255, 255, 255, .96);
    box-shadow: 0 28px 70px rgba(0, 0, 0, .3);
    border: 1px solid rgba(255, 255, 255, .24);
  }
  .auth-brand { text-align: center; margin-bottom: 26px; }
  .auth-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 13px;
    border-radius: 999px;
    background: #fff7dc;
    color: #9a6b12;
    font-size: 12px;
    font-weight: 900;
    margin-bottom: 14px;
  }
  .auth-brand h1 {
    margin: 0;
    color: #0f172a;
    font-family: "Marcellus", serif;
    font-size: 34px;
  }
  .auth-brand p { margin: 8px 0 0; color: #64748b; font-size: 14px; }
  .auth-field { margin-bottom: 15px; }
  .auth-field label { display: block; margin-bottom: 7px; color: #334155; font-size: 13px; font-weight: 900; }
  .auth-input {
    width: 100%;
    min-height: 48px;
    padding: 0 14px;
    border-radius: 8px;
    border: 1px solid #dbe3ef;
    outline: none;
    font: inherit;
    color: #0f172a;
    background: #f8fafc;
  }
  .auth-input:focus { border-color: #d1a93d; background: #fff; box-shadow: 0 0 0 4px rgba(209, 169, 61, .15); }
  .auth-error { margin: 6px 0 0; color: #dc2626; font-size: 12px; font-weight: 700; }
  .auth-btn {
    width: 100%;
    min-height: 50px;
    border: 0;
    border-radius: 8px;
    background: linear-gradient(135deg, #d1a93d, #b48621);
    color: #111827;
    font-weight: 900;
    cursor: pointer;
    margin-top: 6px;
  }
  .auth-link { color: #9a6b12; font-size: 13px; font-weight: 900; text-decoration: none; }
  .auth-bottom { margin-top: 18px; text-align: center; color: #64748b; font-size: 14px; }
</style>

<section class="auth-section">
  <div class="auth-card">
    <div class="auth-brand">
      <span class="auth-badge"><i class="bi bi-person-plus-fill"></i> Create Admin Account</span>
      <h1>{{ trans('panel.site_title') }}</h1>
      <p>Register to access the legal services dashboard.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="auth-field">
        <label>{{ trans('global.user_name') }}</label>
        <input class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @if($errors->has('name'))<p class="auth-error">{{ $errors->first('name') }}</p>@endif
      </div>

      <div class="auth-field">
        <label>{{ trans('global.login_email') }}</label>
        <input class="auth-input" type="email" name="email" value="{{ old('email') }}" required>
        @if($errors->has('email'))<p class="auth-error">{{ $errors->first('email') }}</p>@endif
      </div>

      <div class="auth-field">
        <label>{{ trans('global.login_password') }}</label>
        <input class="auth-input" type="password" name="password" required>
        @if($errors->has('password'))<p class="auth-error">{{ $errors->first('password') }}</p>@endif
      </div>

      <div class="auth-field">
        <label>{{ trans('global.login_password_confirmation') }}</label>
        <input class="auth-input" type="password" name="password_confirmation" required>
      </div>

      <button class="auth-btn" type="submit">{{ trans('global.register') }}</button>

      <p class="auth-bottom">Already registered? <a class="auth-link" href="{{ route('login') }}">Login</a></p>
    </form>
  </div>
</section>
@endsection
