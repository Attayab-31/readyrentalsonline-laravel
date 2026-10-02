@extends('email_templates.layouts.email')

@section('email_title', 'Reset your password')

@section('content')
    <h1 style="margin:0 0 18px; color:#20364d; font-size:24px; line-height:1.3;">Reset your password</h1>
    <p style="margin:0 0 16px;">Hello {{ trim($user->first_name . ' ' . $user->last_name) ?: 'there' }},</p>
    <p style="margin:0 0 22px;">We received a request to reset the password for your Ready Rentals account. Use the secure button below to choose a new password.</p>
    <p style="margin:0 0 24px; text-align:center;">
        <a href="{{ $resetUrl }}" style="display:inline-block; padding:13px 24px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none;">Reset password</a>
    </p>
    <p style="margin:0 0 10px; color:#667587; font-size:13px;">If the button does not work, copy and paste this link into your browser:</p>
    <p style="margin:0; overflow-wrap:anywhere; color:#20364d; font-size:13px; line-height:1.6;">{{ $resetUrl }}</p>
    <p style="margin:24px 0 0; color:#667587; font-size:13px;">If you did not request a password reset, no action is needed. Your password will remain unchanged.</p>
@endsection
