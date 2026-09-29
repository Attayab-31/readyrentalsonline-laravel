<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>New Message Notification</title>
  <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    * {
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
    }
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      line-height: 1.6;
      background-color: #f8fafc;
      color: #4a5568;
    }
    /* Prevent WebKit and Windows mobile changing default text sizes */
    body,
    table,
    td,
    a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }
    a {
      color: #4299e1;
      text-decoration: none;
    }

    /* Layout ------------------------------ */
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      background-color: #f8fafc;
    }
    .email-content {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      padding: 0;
    }

    /* Masthead ----------------------- */
    .email-masthead {
      padding: 25px 0;
      text-align: center;
      background-color: #2d3748;
    }
    .email-masthead_name {
      font-size: 24px;
      font-weight: bold;
      color: #ffffff;
      text-decoration: none;
      display: block;
    }

    /* Body ------------------------------ */
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      border-top: 1px solid #e2e8f0;
      border-bottom: 1px solid #e2e8f0;
      background-color: #ffffff;
    }
    .email-body_inner {
      width: 100%;
      max-width: 570px;
      margin: 0 auto;
      padding: 0;
    }
    .email-footer {
      width: 100%;
      max-width: 570px;
      margin: 0 auto;
      padding: 0;
      text-align: center;
    }
    .email-footer p {
      color: #718096;
    }
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      text-align: center;
    }
    .content-cell {
      padding: 32px;
    }

    /* Type ------------------------------ */
    h1 {
      margin-top: 0;
      color: #2b6cb0;
      font-size: 22px;
      font-weight: bold;
      text-align: left;
      margin-bottom: 20px;
    }
    h2 {
      margin-top: 0;
      color: #2d3748;
      font-size: 18px;
      font-weight: bold;
      text-align: left;
    }
    h3 {
      margin-top: 0;
      color: #2d3748;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    p {
      margin-top: 0;
      color: #4a5568;
      font-size: 16px;
      line-height: 1.6em;
      text-align: left;
      margin-bottom: 15px;
    }
    p.sub {
      font-size: 12px;
    }
    p.center {
      text-align: center;
    }

    /* Message Box ------------------------------ */
    .message-box {
      background-color: #f8fafc;
      padding: 15px;
      border-radius: 4px;
      margin: 20px 0;
      border-left: 4px solid #4299e1;
    }

    /* Buttons ------------------------------ */
    .button-container {
      width: 100%;
      margin: 25px 0;
      text-align: center;
    }
    .button {
      display: inline-block;
      min-width: 200px;
      width: auto;
      background-color: #4299e1;
      border-radius: 4px;
      color: #ffffff !important;
      font-size: 16px;
      font-weight: bold;
      line-height: 50px;
      padding: 0 25px;
      text-align: center;
      text-decoration: none;
      -webkit-text-size-adjust: none;
      mso-hide: all;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .button:hover {
      background-color: #3182ce;
    }

    /* Responsive Styles ------------------------------ */
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
      .content-cell {
        padding: 20px !important;
      }
      h1 {
        font-size: 20px;
      }
      p {
        font-size: 15px;
      }
    }

    @media only screen and (max-width: 400px) {
      .button {
        width: 100% !important;
        display: block;
      }
      .email-masthead_name {
        font-size: 20px;
      }
    }
  </style>
</head>
<body style="width:100% !important; margin:0; padding:0;">
  <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center">
        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <!-- Logo -->
          <tr>
            <td class="email-masthead">
              <a class="email-masthead_name" style="color: #ffffff; text-decoration: none;">
                ReadyRentalsOnline.com
              </a>
            </td>
          </tr>

          <!-- Email Body -->
          <tr>
            <td class="email-body" width="100%">
              <table class="email-body_inner" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td class="content-cell">
                    <h1>New Message from {{ $senderName }}</h1>
                    <p>Dear {{ $receiverName }},</p>
                    <p>You have received a new message on ReadyRentalsOnline.com:</p>

                    <!-- Message Box -->
                    <div class="message-box">
                      <p style="margin: 0; font-style: italic;">"{{ $messageContent }}"</p>
                    </div>

                    <p style="font-size: 15px;">You can view and respond to this message by logging into your account.</p>

                    <!-- Button -->
                    <div class="button-container">
                      <a href="{{ $loginUrl }}" class="button" style="color: #ffffff !important;">
                        View Message
                      </a>
                    </div>

                    <p style="font-size: 15px;">If you have any questions or need assistance, please contact our support team.</p>
                    <p>Thanks,<br>The ReadyRentalsOnline.com Team</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td>
              <table class="email-footer" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td class="content-cell" style="padding: 20px; text-align: center;">
                    <p class="sub center" style="font-size: 13px; color: #718096; margin: 0;">
                      ReadyRentalsOnline.com<br>
                      © {{ date('Y') }} All rights reserved.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>