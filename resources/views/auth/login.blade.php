@extends('layouts.auth')

@section('title', 'Sign In · '.config('app.name', 'Ready Rentals Online'))

@section('content')

    <div class="auth-header">
        <span class="auth-portal-badge">
            <i class="ri-shield-user-line"></i> Client & Admin Portal
        </span>
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Sign in to manage your rentals, view invoices, and communicate with property management.</p>
    </div>

    @if (session('status'))
        <div class="status-alert alert-success">
            <i class="ri-checkbox-circle-fill"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="status-alert alert-danger">
            <i class="ri-error-warning-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" data-rr-page-preloader data-rr-preloader-message="Signing you in securely…">
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

        <!-- Password Field -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="input-wrap">
                <i class="ri-lock-line input-icon"></i>
                <input 
                    type="password" 
                    class="form-input" 
                    name="password" 
                    id="password" 
                    placeholder="Enter your password" 
                    required 
                    autocomplete="current-password"
                >
                <button type="button" class="password-toggle-btn" data-target="password" aria-label="Toggle password visibility">
                    <i class="ri-eye-fill"></i>
                </button>
            </div>
            @if ($errors->has('password'))
                <span class="form-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Options: Remember & Forgot -->
        <div class="auth-options">
            <label class="remember-label" for="remember">
                <input 
                    type="checkbox" 
                    class="remember-checkbox" 
                    name="remember" 
                    id="remember" 
                    value="remember" 
                    {{ old('remember') ? 'checked' : '' }}
                >
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit">
            <span>Sign In to Portal</span>
            <i class="ri-arrow-right-line"></i>
        </button>
    </form>

@endsection
