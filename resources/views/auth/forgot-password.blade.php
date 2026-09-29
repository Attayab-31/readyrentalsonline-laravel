@extends('layouts.auth')

@section('title', 'Reset password · '.config('app.name'))

@section('content')
    <h1>Reset your password</h1>
    <p>Enter your account email and we’ll send a password reset link.</p>
    @if (session('status'))<p class="status">{{ session('status') }}</p>@endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <button type="submit">Send reset link</button>
    </form>
    <p><a href="{{ route('login') }}">Return to sign in</a></p>
@endsection
