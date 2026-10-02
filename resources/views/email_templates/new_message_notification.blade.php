@extends('email_templates.layouts.email')

@section('email_title', 'New message from ' . $senderName)

@section('content')
    <h1 style="margin:0 0 18px; color:#20364d; font-size:24px; line-height:1.3;">You have a new message</h1>
    <p style="margin:0 0 16px;">Hello {{ $receiverName }},</p>
    <p style="margin:0 0 18px;">{{ $senderName }} sent you a message through your Ready Rentals account.</p>
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; margin:22px 0; background-color:#f5f8fb; border-left:4px solid #d78a20;">
        <tr>
            <td style="padding:16px 18px; color:#344255; font-size:15px; line-height:1.65; overflow-wrap:anywhere;">
                {{ $messageContent }}
            </td>
        </tr>
    </table>
    <p style="margin:0 0 24px;">Sign in to your account to view the full conversation and reply.</p>
    <p style="margin:0 0 24px; text-align:center;">
        <a href="{{ $loginUrl }}" style="display:inline-block; padding:13px 24px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none;">View conversation</a>
    </p>
    <p style="margin:0; color:#667587; font-size:14px;">If you have questions, contact our support team at <a href="mailto:info@readyrentalsonline.com" style="color:#20364d;">info@readyrentalsonline.com</a>.</p>
@endsection
