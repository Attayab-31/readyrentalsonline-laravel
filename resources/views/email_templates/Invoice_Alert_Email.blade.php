@extends('email_templates.layouts.email')

@section('email_title', $title ?? ($heading ?? 'Payment notification'))

@section('content')
    <h1 style="margin:0 0 14px; color:#20364d; font-size:24px; line-height:1.3;">{{ $heading }}</h1>
    <p style="margin:0 0 20px;">
        <span style="display:inline-block; padding:5px 11px; border-radius:20px; background-color:#eef3f7; color:#344255; font-size:13px; font-weight:bold;">
            {{ $statusText }}
        </span>
    </p>
    <div style="color:#344255; font-size:15px; line-height:1.7;">
        {!! $content !!}
    </div>
    @if(isset($actionUrl))
        <p style="margin:26px 0 8px; text-align:center;">
            <a href="{{ $actionUrl }}" style="display:inline-block; padding:13px 24px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none; {{ $actionStyle ?? '' }}">{{ $actionText ?? 'View details' }}</a>
        </p>
    @endif
    <p style="margin:26px 0 0; color:#667587; font-size:14px;">If you have questions about this payment, contact <a href="mailto:info@readyrentalsonline.com" style="color:#20364d;">info@readyrentalsonline.com</a>.</p>
@endsection
