@extends('layouts.admin')

@section('page-title', 'My Profile')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">My Profile</h2>
        <p class="admin-page-subtitle">Manage your account information and password.</p>
    </div>

    <div class="identity-card">
        @if($user->profile_image)
            <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="identity-avatar profile-image-cover">
        @else
            <div class="identity-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <div>
            <p class="identity-title">{{ $user->name }}</p>
            <p class="identity-subtitle">{{ $user->email }}</p>
        </div>
    </div>
</div>

<div class="admin-form-grid">
    <form method="POST" action="{{ route('profile.password.updateProfile') }}" class="form-card" enctype="multipart/form-data">
        @csrf
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-user-edit"></i></div>
            <div>
                <p class="form-card-title">Profile Information</p>
                <p class="form-card-subtitle">Update your name and email address.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="name">Name <span class="req">*</span></label>
                <div class="input-icon-wrap">
                    <i class="fas fa-user icon"></i>
                    <input class="field-input {{ $errors->has('name') ? 'error' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                </div>
                @error('name')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="email">Email <span class="req">*</span></label>
                <div class="input-icon-wrap">
                    <i class="fas fa-envelope icon"></i>
                    <input class="field-input {{ $errors->has('email') ? 'error' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                </div>
                @error('email')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="profile_image">Profile Image</label>
                <input class="field-input {{ $errors->has('profile_image') ? 'error' : '' }}" type="file" name="profile_image" id="profile_image" accept="image/jpeg,image/png,image/webp">
                @if($user->profile_image)<img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="profile-image-preview">@endif
                @error('profile_image')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@else<p class="field-hint">JPG, PNG or WEBP. Minimum 120×120px, maximum 4 MB.</p>@enderror
            </div>

            <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save Profile</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.password.update') }}" class="form-card">
        @csrf
        <div class="form-card-header">
            <div class="form-card-icon"><i class="fas fa-lock"></i></div>
            <div>
                <p class="form-card-title">Change Password</p>
                <p class="form-card-subtitle">Confirm your current password before setting a new one.</p>
            </div>
        </div>

        <div class="form-card-body">
            <div class="field-group">
                <label class="field-label" for="current_password">Current Password <span class="req">*</span></label>
                <div class="input-icon-wrap has-eye">
                    <i class="fas fa-key icon"></i>
                    <input class="field-input {{ $errors->has('current_password') ? 'error' : '' }}" type="password" name="current_password" id="current_password" required autocomplete="current-password">
                    <button type="button" class="eye-toggle" onclick="togglePass('current_password', this)"><i class="fas fa-eye"></i></button>
                </div>
                @error('current_password')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="password">New Password <span class="req">*</span></label>
                <div class="input-icon-wrap has-eye">
                    <i class="fas fa-lock icon"></i>
                    <input class="field-input {{ $errors->has('password') ? 'error' : '' }}" type="password" name="password" id="password" required autocomplete="new-password">
                    <button type="button" class="eye-toggle" onclick="togglePass('password', this)"><i class="fas fa-eye"></i></button>
                </div>
                @error('password')<p class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                <div class="password-strength">
                    <div class="strength-bars"><span class="strength-bar"></span><span class="strength-bar"></span><span class="strength-bar"></span><span class="strength-bar"></span></div>
                    <p id="strength-text" class="strength-text"></p>
                </div>
            </div>

            <div class="field-group">
                <label class="field-label" for="password_confirmation">Confirm New Password <span class="req">*</span></label>
                <div class="input-icon-wrap has-eye">
                    <i class="fas fa-shield-alt icon"></i>
                    <input class="field-input" type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                    <button type="button" class="eye-toggle" onclick="togglePass('password_confirmation', this)"><i class="fas fa-eye"></i></button>
                </div>
            </div>

            <button class="btn-primary" type="submit"><i class="fas fa-key"></i> Update Password</button>
        </div>
    </form>
</div>

<div class="detail-card profile-account-card">
    <div class="detail-section-head">
        <div class="detail-section-icon"><i class="fas fa-id-badge"></i></div>
        <p class="detail-section-title">Account Summary</p>
    </div>
    <div class="detail-section-pad">
        <div class="profile-summary-grid">
            <div><span class="detail-label-sm">Account ID</span><p class="detail-value">#{{ $user->id }}</p></div>
            <div><span class="detail-label-sm">Roles</span><p class="detail-value">{{ $user->roles->pluck('title')->join(', ') ?: 'No role assigned' }}</p></div>
            <div><span class="detail-label-sm">Joined</span><p class="detail-value">{{ optional($user->created_at)->format('d M Y') ?: '-' }}</p></div>
        </div>

        @unless($user->is_admin)
            <form method="POST" action="{{ route('profile.password.destroyProfile') }}" class="profile-delete-form" onsubmit="return prompt('{{ __('global.delete_account_warning') }}') === '{{ $user->email }}'">
                @csrf
                <button class="btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Delete My Account</button>
            </form>
        @endunless
    </div>
</div>
@endsection

@section('styles')
<style>
    .identity-avatar { background: var(--accent); }
    .profile-account-card { margin-top: 20px; }
    .profile-summary-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
    .profile-summary-grid > div { padding: 14px; border: 1px solid var(--border); border-radius: 10px; background: var(--surface-soft); }
    .profile-summary-grid p { margin: 5px 0 0; }
    .profile-delete-form { margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border); }
    @media (max-width: 760px) { .profile-summary-grid { grid-template-columns: 1fr; } }
</style>
@endsection
