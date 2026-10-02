@extends('email_templates.layouts.email')

@section('email_title', 'Verify your email address')

@section('content')
    <h1 style="margin:0 0 18px; color:#20364d; font-size:24px; line-height:1.3;">Please verify your email address</h1>
    <p style="margin:0 0 16px;">Hello {{ trim($db_data['User']->first_name . ' ' . $db_data['User']->last_name) }},</p>
    <p style="margin:0 0 22px;">Please confirm this email address to finish setting up your Ready Rentals account. This helps us keep your account information secure.</p>
    <p style="margin:0 0 24px; text-align:center;">
        <a href="{{ $db_data['verificationLink'] }}" style="display:inline-block; padding:13px 24px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none;">Verify email address</a>
    </p>
    <p style="margin:0 0 10px; color:#667587; font-size:13px;">If the button does not work, copy and paste this link into your browser:</p>
    <p style="margin:0; overflow-wrap:anywhere; color:#20364d; font-size:13px; line-height:1.6;">{{ $db_data['verificationLink'] }}</p>
    <p style="margin:24px 0 0; color:#667587; font-size:13px;">If you did not expect this email, you can safely ignore it.</p>
@endsection
