<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>New Invoice Notification</title>
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

    /* Invoice Table ------------------------------ */
    .invoice-table {
      width: 100%;
      margin: 20px 0;
      border-collapse: collapse;
      font-size: 15px;
    }
    .invoice-table th {
      text-align: left;
      padding: 12px 15px;
      background-color: #edf2f7;
      border: 1px solid #e2e8f0;
      color: #2d3748;
    }
    .invoice-table td {
      padding: 12px 15px;
      border: 1px solid #e2e8f0;
      word-break: break-word;
    }
    .invoice-table .total-row {
      font-weight: bold;
      background-color: #ebf8ff;
    }
    .text-right {
      text-align: right;
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

    /* Notes Box ------------------------------ */
    .notes-box {
      background-color: #f8fafc;
      padding: 15px;
      border-radius: 4px;
      margin: 20px 0;
      border-left: 4px solid #4299e1;
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
      .invoice-table {
        font-size: 14px;
      }
      .invoice-table th,
      .invoice-table td {
        padding: 8px 10px;
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
      .invoice-table {
        font-size: 13px;
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
                    <h1>{{ $heading }}</h1>
                    <p>Dear {{ $invoice->tenant->first_name.' '.$invoice->tenant->last_name }},</p>
                    <p>A new invoice has been generated for your account. Below are the details:</p>

                    <!-- Invoice Table -->
                    <table class="invoice-table" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                      <tr>
                        <th colspan="2" style="background-color: #ebf8ff;color: #2b6cb0;">Invoice Summary</th>
                      </tr>
                      <tr>
                        <td width="50%">Invoice #</td>
                        <td width="50%" class="text-right">{{ $invoice->i_invoice_number }}</td>
                      </tr>
                      <tr>
                        <td>Issue Date</td>
                        <td class="text-right">{{ date('F j, Y', strtotime($invoice->i_issue_date)) }}</td>
                      </tr>
                      <tr>
                        <td>Due Date</td>
                        <td class="text-right">{{ date('F j, Y', strtotime($invoice->i_due_date)) }}</td>
                      </tr>
                      <tr>
                        <td>Subtotal</td>
                        <td class="text-right">${{ number_format($invoice->i_subtotal, 2) }}</td>
                      </tr>
                      @if($invoice->i_tax)
                      <tr>
                        <td>Tax</td>
                        <td class="text-right">${{ number_format($invoice->i_tax, 2) }}</td>
                      </tr>
                      @endif
                      @if($invoice->i_discount)
                      <tr>
                        <td>Discount</td>
                        <td class="text-right">-${{ number_format($invoice->i_discount, 2) }}</td>
                      </tr>
                      @endif
                      @if($invoice->i_fee)
                      <tr>
                        <td>Fee</td>
                        <td class="text-right">${{ number_format($invoice->i_fee, 2) }}</td>
                      </tr>
                      @endif
                      <tr class="total-row" style="background-color: #ebf8ff;">
                        <td><strong>Total Amount Due</strong></td>
                        <td class="text-right"><strong>${{ number_format($invoice->i_total, 2) }}</strong></td>
                      </tr>
                    </table>

                    @if($invoice->i_notes)
                    <div class="notes-box">
                      <h3 style="margin-bottom: 10px; color: #2b6cb0;">Notes:</h3>
                      <p style="margin: 0;">{{ $invoice->i_notes }}</p>
                    </div>
                    @endif

                    <p style="font-size: 15px;">Please make the payment by the due date to avoid any late fees or service interruptions.</p>

                    <!-- Payment Button - Now more prominent and guaranteed to show -->
                    <div class="button-container">
                      <a href="{{ url('invoices/pay/' . $invoice->i_invoice_number) }}" class="button" style="color: #ffffff !important;">
                        Pay Your Invoice Now
                      </a>
                    </div>

                    <p style="font-size: 15px;">If you have any questions about this invoice, please contact our support team.</p>
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