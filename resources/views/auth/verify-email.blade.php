@extends('layouts.auth')

@section('title', 'Verify Email · '.config('app.name', 'Ready Rentals Online'))

@section('content')

    <div class="auth-header">
        <span class="auth-portal-badge">
            <i class="ri-mail-check-line"></i> Email Verification
        </span>
        <h1 class="auth-title">Verify Your Email</h1>
        <p class="auth-subtitle">Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.</p>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="status-alert alert-success">
            <i class="ri-checkbox-circle-fill"></i>
            <span>A new verification link has been sent to the email address you provided.</span>
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-submit">
            <span>Resend Verification Email</span>
            <i class="ri-send-plane-line"></i>
        </button>
    </form>

    <div style="margin-top: 20px; text-align: center;">
        <form method="POST" action="{{ route('logout') }}" style="display: inline;" data-rr-page-preloader data-rr-preloader-message="Signing you out securely…">
            @csrf
            <button type="submit" class="auth-link" style="background: none; border: none; cursor: pointer; font-size: 13.5px;">
                <i class="ri-logout-box-r-line"></i> Sign out of account
            </button>
        </form>
    </div>

@endsection
