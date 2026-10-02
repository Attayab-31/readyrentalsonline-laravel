<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('email_title', config('app.name'))</title>
    <style>
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-collapse: collapse;
        }
        img {
            border: 0;
            display: block;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        @media only screen and (max-width: 620px) {
            .email-shell {
                width: 100% !important;
            }
            .email-content {
                padding: 24px 20px !important;
            }
            .email-brand {
                padding: 20px !important;
            }
            .email-logo {
                width: 132px !important;
            }
            .email-footer {
                padding-right: 20px !important;
                padding-left: 20px !important;
            }
        }
    </style>
</head>
<body style="width:100%; margin:0; padding:0; background-color:#f2f5f8; color:#263445; font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="width:100%; background-color:#f2f5f8;">
        <tr>
            <td align="center" style="padding:28px 12px;">
                <table class="email-shell" role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background-color:#ffffff; border:1px solid #e2e8ef; border-radius:10px; overflow:hidden;">
                    <tr>
                        <td class="email-brand" align="center" style="padding:18px 28px; background-color:#ffffff; border-top:5px solid #d78a20; border-bottom:1px solid #e8edf2;">
                            <a href="{{ url('/') }}" style="display:inline-block; text-decoration:none;">
                                <img class="email-logo" src="{{ url('/logo/ready_rentals_light.svg') }}" width="150" alt="{{ config('app.name') }}" style="width:150px; max-width:100%; height:auto; margin:0 auto;">
                            </a>
                            <div style="padding-top:5px; color:#607184; font-size:12px; letter-spacing:1.5px; line-height:18px; text-transform:uppercase;">A place to feel at home</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-content" style="padding:36px 42px; background-color:#ffffff; color:#344255; font-size:15px; line-height:1.65;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td class="email-footer" align="center" style="padding:22px 32px; background-color:#f7f9fb; border-top:1px solid #e8edf2; color:#667587; font-size:12px; line-height:1.6;">
                            <strong style="color:#344255;">{{ config('app.name') }}</strong><br>
                            1742 Delsea Drive, Deptford, NJ 08096
                            <br>
                            <a href="tel:12675499625" style="color:#344255; text-decoration:none;">1-267-549-9625</a>
                            &nbsp;|&nbsp;
                            <a href="mailto:info@readyrentalsonline.com" style="color:#344255; text-decoration:none;">info@readyrentalsonline.com</a>
                            <br>
                            <span style="color:#8491a0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
