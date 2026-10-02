@extends('email_templates.layouts.email')

@section('email_title', 'New contact inquiry')

@section('content')
    <h1 style="margin:0 0 18px; color:#20364d; font-size:24px; line-height:1.3;">New contact inquiry</h1>
    <p style="margin:0 0 20px; color:#667587;">A visitor submitted a message through the Ready Rentals website.</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #e2e8ef; font-size:14px;">
        <tr>
            <td width="32%" style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#667587; font-weight:bold;">Name</td>
            <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#263445;">{{ $inquiry['full_name'] }}</td>
        </tr>
        <tr>
            <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#667587; font-weight:bold;">Email</td>
            <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#263445;"><a href="mailto:{{ $inquiry['email'] }}" style="color:#20364d;">{{ $inquiry['email'] }}</a></td>
        </tr>
        <tr>
            <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#667587; font-weight:bold;">Service</td>
            <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#263445;">{{ $inquiry['service_type'] }}</td>
        </tr>
        @if(!empty($inquiry['phone_number']))
            <tr>
                <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#667587; font-weight:bold;">Phone</td>
                <td style="padding:11px 13px; border-bottom:1px solid #e8edf2; color:#263445;">{{ $inquiry['phone_number'] }}</td>
            </tr>
        @endif
        <tr>
            <td colspan="2" style="padding:14px 13px 6px; color:#667587; font-weight:bold;">Message</td>
        </tr>
        <tr>
            <td colspan="2" style="padding:4px 13px 14px; color:#263445; line-height:1.65;">{!! nl2br(e($inquiry['message'])) !!}</td>
        </tr>
    </table>

    <p style="margin:20px 0 0; color:#667587; font-size:13px;">Reply directly to this email to respond to the sender.</p>
@endsection
