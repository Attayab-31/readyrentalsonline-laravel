<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $title ?? 'Payment Notification' }} - {{ env('APP_NAME') }}</title>
    <style type="text/css">
        img {
            max-width: 100%;
        }
        body {
            -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
        }
        body {
            background-color: #f6f6f6;
        }
        .btn-primary {
            background-color: #EF8354;
            border-color: #EF8354;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
        }
        .btn-receipt {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .invoice-table th, .invoice-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9e9e9;
        }
        .invoice-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #f8f8f8;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-paid {
            background-color: #e6f7e6;
            color: #4CAF50;
        }
        .status-pending {
            background-color: #fff8e6;
            color: #FF9800;
        }
        .status-overdue {
            background-color: #ffebee;
            color: #F44336;
        }
        .status-failed {
            background-color: #ffebee;
            color: #F44336;
        }
        .status-verification {
            background-color: #e3f2fd;
            color: #1976D2;
        }
        @media only screen and (max-width: 700px) {
            body {
                padding: 0 !important;
            }
            h1 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h2 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h3 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h4 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h1 {
                font-size: 22px !important;
            }
            h2 {
                font-size: 18px !important;
            }
            h3 {
                font-size: 16px !important;
            }
            .container {
                padding: 0 !important; width: 100% !important;
            }
            .content {
                padding: 0 !important;
            }
            .content-wrap {
                padding: 10px !important;
            }
            .invoice {
                width: 100% !important;
            }
            .invoice-table th, .invoice-table td {
                padding: 8px 5px;
                font-size: 12px;
            }
            .header-table {
                display: block !important;
                width: 100% !important;
            }
            .header-table tr {
                display: block !important;
                width: 100% !important;
                margin-bottom: 15px !important;
            }
            .header-table td {
                display: block !important;
                width: 100% !important;
                text-align: left !important;
                padding: 5px 0 !important;
            }
            .header-table td:last-child {
                border-top: 1px solid #eee;
                padding-top: 15px !important;
            }
        }
    </style>
</head>

<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
    <table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
            <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
            <td class="container" width="700" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 700px !important; clear: both !important; margin: 0 auto;" valign="top">
                <div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 700px; display: block; margin: 0 auto; padding: 20px;">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 30px;" valign="top">
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <tr>
                                        <td style="text-align: center; padding-bottom: 20px;">
                                            <h1>Ready Rentals Online</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 30px;">
                                            <h1 style="margin: 0 0 10px 0; font-size: 24px; color: #333;">{{ $heading }}</h1>
                                            <span class="status-badge status-{{ $status }}" style="margin-bottom: 15px; display: inline-block;">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 25px;">
                                            {!! $content !!}
                                        </td>
                                    </tr>
                                    @if(isset($actionUrl))
                                    <tr>
                                        <td style="padding-top: 20px; text-align: center;">
                                            <a href="{{ $actionUrl }}" class="btn-primary" style="{{ $actionStyle ?? '' }}">
                                                {{ $actionText }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 20px 0 0; color: #999; text-align: center;">
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="aligncenter content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <p>© {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
                                <p>
                                    <a href="{{ url('/privacy-policy') }}" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0 5px;">Privacy Policy</a>
                                    <span style="margin: 0 5px;">|</span>
                                    <a href="{{ url('/terms-and-conditions') }}" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0 5px;">Terms of Service</a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
        </tr>
    </table>
</body>
</html>