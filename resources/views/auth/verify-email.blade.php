@extends('layouts.auth')

@section('title', 'Verify email · '.config('app.name'))

@section('content')
    <h1>Verify your email</h1>
    <p>Please use the verification link sent to your email address to finish setting up your account.</p>
    @if (session('status') === 'verification-link-sent')
        <p class="status">A new verification link has been sent to your email address.</p>
    @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend verification email</button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Sign out</button>
    </form>
@endsection
