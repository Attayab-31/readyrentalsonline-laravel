@extends('layouts.auth')

@section('title', 'Confirm password · '.config('app.name'))

@section('content')
    <h1>Confirm your password</h1>
    <p>Please confirm your password to continue.</p>
    <form method="POST" action="{{ url('/confirm-password') }}">
        @csrf
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')<p class="error">{{ $message }}</p>@enderror
        <button type="submit">Confirm</button>
    </form>
@endsection
