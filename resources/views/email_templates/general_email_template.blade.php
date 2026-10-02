@extends('email_templates.layouts.email')

@section('email_title', $db_data['email_subject'] ?? config('app.name'))

@section('content')
    <div style="color:#344255; font-size:15px; line-height:1.7;">
        {!! $db_data['body'] ?? '' !!}
    </div>
    <p style="margin:26px 0 0; color:#344255; font-size:15px; line-height:1.6;">
        Thank you,<br>
        <strong>{{ config('app.name') }} Team</strong>
    </p>
@endsection
