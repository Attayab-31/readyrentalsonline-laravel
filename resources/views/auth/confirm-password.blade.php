@extends('layouts.auth')

@section('title', 'Confirm Password · '.config('app.name', 'Ready Rentals Online'))

@section('content')

    <div class="auth-header">
        <span class="auth-portal-badge">
            <i class="ri-shield-check-line"></i> Verification
        </span>
        <h1 class="auth-title">Confirm Password</h1>
        <p class="auth-subtitle">This is a secure area of the Ready Rentals application. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ url('/confirm-password') }}">
        @csrf

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
                    placeholder="Enter your current password" 
                    required 
                    autocomplete="current-password"
                    autofocus
                >
                <button type="button" class="password-toggle-btn" data-target="password" aria-label="Toggle password visibility">
                    <i class="ri-eye-fill"></i>
                </button>
            </div>
            @if ($errors->has('password'))
                <span class="form-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" style="margin-top: 10px;">
            <span>Confirm & Continue</span>
            <i class="ri-arrow-right-line"></i>
        </button>
    </form>

@endsection
