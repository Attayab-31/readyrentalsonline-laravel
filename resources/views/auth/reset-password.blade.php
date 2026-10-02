@extends('layouts.auth')

@section('title', 'Set New Password · '.config('app.name', 'Ready Rentals Online'))

@section('content')

    <div class="auth-header">
        <span class="auth-portal-badge">
            <i class="ri-lock-unlock-line"></i> Security
        </span>
        <h1 class="auth-title">Choose New Password</h1>
        <p class="auth-subtitle">Please create a strong, secure password for your Ready Rentals account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Field -->
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-wrap">
                <i class="ri-mail-line input-icon"></i>
                <input 
                    type="email" 
                    class="form-input" 
                    name="email" 
                    id="email" 
                    value="{{ old('email', $request->email) }}" 
                    required 
                    autocomplete="email"
                >
            </div>
            @if ($errors->has('email'))
                <span class="form-error">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <div class="input-wrap">
                <i class="ri-lock-line input-icon"></i>
                <input 
                    type="password" 
                    class="form-input" 
                    name="password" 
                    id="password" 
                    placeholder="Enter new password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="password" aria-label="Toggle password visibility">
                    <i class="ri-eye-fill"></i>
                </button>
            </div>
            @if ($errors->has('password'))
                <span class="form-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <div class="input-wrap">
                <i class="ri-shield-keyhole-line input-icon"></i>
                <input 
                    type="password" 
                    class="form-input" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    placeholder="Repeat new password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="password_confirmation" aria-label="Toggle password visibility">
                    <i class="ri-eye-fill"></i>
                </button>
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="form-error">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" style="margin-top: 10px;">
            <span>Reset Password & Sign In</span>
            <i class="ri-check-line"></i>
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 13.5px;">
        <a href="{{ route('login') }}" class="auth-link" data-rr-page-preloader-trigger data-rr-preloader-message="Opening your secure sign-in…" style="display: inline-flex; align-items: center; gap: 4px;">
            <i class="ri-arrow-left-line"></i> Back to sign in
        </a>
    </div>

@endsection
