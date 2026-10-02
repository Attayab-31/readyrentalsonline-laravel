@extends('layouts.auth')

@section('title', 'Forgot Password · '.config('app.name', 'Ready Rentals Online'))

@section('content')

    <div class="auth-header">
        <span class="auth-portal-badge">
            <i class="ri-key-2-line"></i> Password Recovery
        </span>
        <h1 class="auth-title">Reset Password</h1>
        <p class="auth-subtitle">Forgot your password? Enter your verified email address and we'll send a secure password reset link.</p>
    </div>

    @if (session('status'))
        <div class="status-alert alert-success">
            <i class="ri-checkbox-circle-fill"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

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
                    value="{{ old('email') }}" 
                    placeholder="you@example.com" 
                    required 
                    autocomplete="email"
                    autofocus
                >
            </div>
            @if ($errors->has('email'))
                <span class="form-error">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" style="margin-top: 10px;">
            <span>Email Password Reset Link</span>
            <i class="ri-send-plane-line"></i>
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center; font-size: 13.5px;">
        <a href="{{ route('login') }}" class="auth-link" data-rr-page-preloader-trigger data-rr-preloader-message="Opening your secure sign-in…" style="display: inline-flex; align-items: center; gap: 4px;">
            <i class="ri-arrow-left-line"></i> Return to sign in
        </a>
    </div>

@endsection
