@extends('layouts.auth')

@section('title', 'Choose a new password · '.config('app.name'))

@section('content')
    <h1>Choose a new password</h1>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autocomplete="email">
        @error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="password">New password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password_confirmation">Confirm new password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        <button type="submit">Reset password</button>
    </form>
@endsection
