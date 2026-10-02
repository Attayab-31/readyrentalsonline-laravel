@extends('email_templates.layouts.email')

@section('email_title', $heading ?? 'New invoice')

@section('content')
    <h1 style="margin:0 0 18px; color:#20364d; font-size:24px; line-height:1.3;">{{ $heading ?? 'A new invoice is ready' }}</h1>
    <p style="margin:0 0 18px;">Hello {{ trim($invoice->tenant->first_name . ' ' . $invoice->tenant->last_name) }},</p>
    <p style="margin:0 0 22px;">A new invoice has been added to your account. Please review the details below and submit payment by the due date.</p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; margin:0 0 22px; border:1px solid #e2e8ef; font-size:14px;">
        <tr>
            <th colspan="2" align="left" style="padding:13px 15px; background-color:#f3f6f9; color:#20364d; font-size:15px;">Invoice summary</th>
        </tr>
        <tr>
            <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Invoice number</td>
            <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445; font-weight:bold;">{{ $invoice->i_invoice_number }}</td>
        </tr>
        <tr>
            <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Issue date</td>
            <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">{{ date('F j, Y', strtotime($invoice->i_issue_date)) }}</td>
        </tr>
        <tr>
            <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Due date</td>
            <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">{{ date('F j, Y', strtotime($invoice->i_due_date)) }}</td>
        </tr>
        <tr>
            <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Subtotal</td>
            <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">${{ number_format((float) $invoice->i_subtotal, 2) }}</td>
        </tr>
        @if($invoice->i_tax)
            <tr>
                <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Tax</td>
                <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">${{ number_format((float) $invoice->i_tax, 2) }}</td>
            </tr>
        @endif
        @if($invoice->i_discount)
            <tr>
                <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Discount</td>
                <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">-${{ number_format((float) $invoice->i_discount, 2) }}</td>
            </tr>
        @endif
        @if($invoice->i_fee)
            <tr>
                <td style="padding:11px 15px; border-top:1px solid #e8edf2; color:#667587;">Fee</td>
                <td align="right" style="padding:11px 15px; border-top:1px solid #e8edf2; color:#263445;">${{ number_format((float) $invoice->i_fee, 2) }}</td>
            </tr>
        @endif
        <tr>
            <td style="padding:14px 15px; border-top:2px solid #d9e1e9; background-color:#f8fafc; color:#20364d; font-weight:bold;">Total due</td>
            <td align="right" style="padding:14px 15px; border-top:2px solid #d9e1e9; background-color:#f8fafc; color:#20364d; font-size:18px; font-weight:bold;">${{ number_format((float) $invoice->i_total, 2) }}</td>
        </tr>
    </table>

    @if($invoice->i_notes)
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; margin:0 0 22px; background-color:#f5f8fb; border-left:4px solid #d78a20;">
            <tr>
                <td style="padding:14px 16px;">
                    <strong style="display:block; margin-bottom:5px; color:#20364d;">Invoice notes</strong>
                    <span style="color:#344255;">{{ $invoice->i_notes }}</span>
                </td>
            </tr>
        </table>
    @endif

    <p style="margin:0 0 22px;">Please make your payment by the due date. If you have questions about this invoice, contact our team at <a href="mailto:info@readyrentalsonline.com" style="color:#20364d;">info@readyrentalsonline.com</a>.</p>
    <p style="margin:0 0 24px; text-align:center;">
        <a href="{{ url('invoices/pay/' . $invoice->i_invoice_number) }}" style="display:inline-block; padding:14px 24px; border-radius:5px; background-color:#20364d; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none;">Pay invoice securely</a>
    </p>
@endsection
