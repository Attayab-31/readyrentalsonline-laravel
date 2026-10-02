@extends('email_templates.layouts.email')

@section('email_title', 'A property shared with you')

@section('content')
    <h1 style="margin:0 0 16px; color:#20364d; font-size:24px; line-height:1.3;">A home worth a look</h1>
    <p style="margin:0 0 20px;">{{ $sender_name }} shared this Ready Rentals property with you.</p>

    @if(!empty($property_image))
        <img src="{{ $property_image }}" alt="{{ $property_title }}" width="516" style="width:100%; max-width:516px; height:auto; margin:0 0 20px; border-radius:6px;">
    @endif

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; border:1px solid #e2e8ef; border-radius:6px;">
        <tr>
            <td style="padding:20px;">
                <h2 style="margin:0 0 8px; color:#20364d; font-size:20px; line-height:1.35;">{{ $property_title }}</h2>
                @if(!empty($property_address))
                    <p style="margin:0 0 10px; color:#667587; font-size:14px;">{{ $property_address }}</p>
                @endif
                @if(is_numeric($property_price ?? null))
                    <p style="margin:0 0 18px; color:#20364d; font-size:18px; font-weight:bold;">${{ number_format((float) $property_price, 2) }}</p>
                @endif

                @if(!empty($message))
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; margin:0 0 20px; background-color:#f5f8fb; border-left:4px solid #d78a20;">
                        <tr>
                            <td style="padding:14px 16px; color:#344255; font-size:14px; line-height:1.6; overflow-wrap:anywhere;">
                                <strong style="display:block; margin-bottom:5px;">A note from {{ $sender_name }}</strong>
                                {{ $message }}
                            </td>
                        </tr>
                    </table>
                @endif

                <a href="{{ $property_url }}" style="display:inline-block; padding:13px 22px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none;">View property</a>
            </td>
        </tr>
    </table>
    <p style="margin:20px 0 0; color:#667587; font-size:13px;">Shared with you by {{ $sender_name }} through Ready Rentals Online.</p>
@endsection
