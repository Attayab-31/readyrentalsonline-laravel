<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Ready Rentals Online">
  <meta name="theme-color" content="#10253a">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="description" content="View and securely pay your Ready Rentals Online invoice.">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ filemtime(public_path('favicon-32x32.png')) }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}?v={{ filemtime(public_path('logo/apple-touch-icon.png')) }}">
  <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v={{ filemtime(public_path('manifest.webmanifest')) }}">
  <!-- Site Title -->
  <title>{{$page_title}}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('invoice') }}/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  {{-- Custom Styles --}}
    <style>
        .custom-border
        {
          border: 2px dotted #e5e5e5;
          min-height: 100%;
          padding: 10px;
          border-radius: 5px;
        }
 
        .tm_scrollable_container {
          max-height: 200px; /* Adjust the desired maximum height here */
          overflow-y: auto;
        }
        @media print {
          .tm_scrollable_container {
            overflow-y: unset !important;
            -ms-overflow-style: none !important; /* IE and Edge */
            scrollbar-width: none !important; /* Firefox */
          }
          
          .tm_scrollable_container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, and Opera */
          }
        }
        @media only screen and (min-width: 200px)
        {
        .paypal-button-row.paypal-button-layout-vertical {
            margin-bottom: 11px;
            padding: 0px 10px;
          }
        }

      #payment-processing-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(255,255,255,0.8);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
          display: none;
      }

    </style>

  <link rel="stylesheet" href="{{ asset('invoice') }}/css/ready-rentals-invoice.css">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">

      <div class="tm_invoice tm_style2 tm_type1 tm_accent_border" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb20 tm_mb10_md">
            <div class="tm_invoice_left">
              <a class="tm_logo" href="{{ url('/') }}" aria-label="Ready Rentals Online home">
                <img src="{{ asset('logo/ready_rentals_light.svg') }}" alt="Ready Rentals Online">
              </a>
            </div>
            <div class="tm_invoice_right">
              <div class="tm_grid_row tm_col_3">
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M424 80H88a56.06 56.06 0 00-56 56v240a56.06 56.06 0 0056 56h336a56.06 56.06 0 0056-56V136a56.06 56.06 0 00-56-56zm-14.18 92.63l-144 112a16 16 0 01-19.64 0l-144-112a16 16 0 1119.64-25.26L256 251.73l134.18-104.36a16 16 0 0119.64 25.26z"/></svg>
                  </p>
                  <a href="mailto:info@readyrentalsonline.com">info@readyrentalsonline.com</a>
                  
                </div>
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M391 480c-19.52 0-46.94-7.06-88-30-49.93-28-88.55-53.85-138.21-103.38C116.91 298.77 93.61 267.79 61 208.45c-36.84-67-30.56-102.12-23.54-117.13C45.82 73.38 58.16 62.65 74.11 52a176.3 176.3 0 0128.64-15.2c1-.43 1.93-.84 2.76-1.21 4.95-2.23 12.45-5.6 21.95-2 6.34 2.38 12 7.25 20.86 16 18.17 17.92 43 57.83 52.16 77.43 6.15 13.21 10.22 21.93 10.23 31.71 0 11.45-5.76 20.28-12.75 29.81-1.31 1.79-2.61 3.5-3.87 5.16-7.61 10-9.28 12.89-8.18 18.05 2.23 10.37 18.86 41.24 46.19 68.51s57.31 42.85 67.72 45.07c5.38 1.15 8.33-.59 18.65-8.47 1.48-1.13 3-2.3 4.59-3.47 10.66-7.93 19.08-13.54 30.26-13.54h.06c9.73 0 18.06 4.22 31.86 11.18 18 9.08 59.11 33.59 77.14 51.78 8.77 8.84 13.66 14.48 16.05 20.81 3.6 9.53.21 17-2 22-.37.83-.78 1.74-1.21 2.75a176.49 176.49 0 01-15.29 28.58c-10.63 15.9-21.4 28.21-39.38 36.58A67.42 67.42 0 01391 480z"/></svg>
                  </p>
                  <a href="tel:+12675499625">1-267-549-9625</a>
                  
                </div>
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><circle cx="256" cy="192" r="32"/><path d="M256 32c-88.22 0-160 68.65-160 153 0 40.17 18.31 93.59 54.42 158.78 29 52.34 62.55 99.67 80 123.22a31.75 31.75 0 0051.22 0c17.42-23.55 51-70.88 80-123.22C397.69 278.61 416 225.19 416 185c0-84.35-71.78-153-160-153zm0 224a64 64 0 1164-64 64.07 64.07 0 01-64 64z"/></svg>
                  </p>
                  <span>1742 Delsea Drive,<br>Deptford, NJ 08096</span>
                </div>
              </div>
            </div>
            <div class="tm_shape_bg tm_accent_bg"></div>
          </div>
  
          <div class="tm_invoice_info tm_mb10">
            
            <div class="tm_invoice_info_left">
              <p class="tm_mb2"><b>Invoice To:</b></p>
              <p>
                
                @if($invoice->tenant)
                  @if($invoice->tenant->first_name == "")
                    <b class="tm_f16 tm_primary_color">Name Unavailable</b><br>
                  @else
                    <b class="tm_f16 tm_primary_color">{{$invoice->tenant->first_name.' '.$invoice->tenant->last_name }}</b><br>
                  @endif
                  <span>{{$invoice->tenant->email ?? "Email Unavailable"}} </span><br>
                @else
                  <b class="tm_f16 tm_primary_color">Invoice recipient unavailable</b>
                @endif
              </p>
            </div>
            
            <div class="tm_invoice_info_right">
              @php
                $invoiceStatus = strtolower((string) $invoice->i_status);
                $invoiceStatusLabel = match ($invoiceStatus) {
                    'paid' => 'Paid',
                    'cancelled' => 'Cancelled',
                    'unpaid' => 'Payment due',
                    default => \Illuminate\Support\Str::headline($invoiceStatus),
                };
                $invoiceStatusTone = match ($invoiceStatus) {
                    'paid' => 'paid',
                    'cancelled' => 'cancelled',
                    default => 'due',
                };
              @endphp
              <div class="rr-invoice-status">
                <span class="rr-invoice-status-label">Invoice status</span>
                <span class="rr-invoice-status-badge rr-invoice-status-badge--{{ $invoiceStatusTone }}">
                  <span class="rr-invoice-status-dot" aria-hidden="true"></span>
                  {{ $invoiceStatusLabel }}
                </span>
              </div>
              <div class="tm_grid_row tm_col_3 tm_invoice_info_in tm_round_border tm_gray_bg">
                <div>
                    <span>Tracking ID :</span> <br>
                    <b class="tm_f18 tm_accent_color">#{{$invoice->i_invoice_number}}</b>
                </div>                
                <div>
                  <span>Issued By:</span> <br>
                  <b class="tm_f18 tm_accent_color">John Coppola</b>
                </div>
                <div>
                  <span>Issue Date:</span> <br>
                  <b class="tm_f18 tm_accent_color">{{ $invoice->i_issue_date ? \Carbon\Carbon::parse($invoice->i_issue_date)->format('M j, Y') : '—' }}</b>
                </div>  

                <div>
                    <span>Due Date:</span> <br>
                    <b class="tm_f18 tm_accent_color">{{ $invoice->i_due_date ? \Carbon\Carbon::parse($invoice->i_due_date)->format('M j, Y') : '—' }}</b>
                </div>  

                <div>
                  <span>Paid Date:</span> <br>
                  @if($invoice->i_payment_date !="" && $invoice->i_payment_date!=null)
                    <b class="tm_f18 tm_accent_color">{{\Carbon\Carbon::parse($invoice->i_payment_date)->format('M j, Y')}}</b>
                  @else
                    -
                    <!--<b class="tm_f18 tm_accent_color">{{$invoice->i_status}}</b>-->
                  @endif
                </div>  

                @if($invoice->i_status =="paid")
                  <div>
                    <span>Payment Method:</span> <br>
                    <b class="tm_f18 tm_accent_color">{{$invoice->i_client_payment_method}}</b>
                  </div>
                @endif
              </div>
            </div>

          </div>
          <div class="tm_table tm_style1">
            <div class="tm_round_border">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr>
                      <th class="tm_width_7 tm_semi_bold tm_primary_color">Item</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_text_right">Total</th>
                    </tr> 
                  </thead>
                  <tbody>
                      <tr>
                        <td class="tm_width_7">{{$invoice->i_notes}}</td>
                        <td class="tm_width_2 tm_text_right">${{number_format((float) $invoice->i_subtotal, 2)}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
                <div class="tm_mb10 tm_m0_md"></div>
                <div class="custom-border">
                  <p class="tm_primary_color tm_f12 tm_m0 tm_bold">Landlord notes</p>
                  <p class="tm_m0 tm_f12">{{$invoice->i_notes}}</p>
                </div>
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtotal</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
                        ${{number_format((float) $invoice->i_subtotal, 2)}}
                        </td>
                    </tr>

                    <tr>
                        <td class="tm_width_3 tm_danger_color tm_border_none tm_pt0">Fee</td>
                        <td class="tm_width_3 tm_danger_color tm_text_right tm_border_none tm_pt0">
                          ${{number_format((float) $invoice->i_fee, 2)}}
                        </td>
                    </tr>
                    <tr>
                        <td class="tm_width_3 tm_danger_color tm_border_none tm_pt0">Tax</td>
                        <td class="tm_width_3 tm_danger_color tm_text_right tm_border_none tm_pt0">
                          ${{number_format((float) $invoice->i_tax, 2)}}
                        </td>
                    </tr>
                    <tr>
                        <td class="tm_width_3 tm_success_color tm_border_none tm_pt0">Discount</td>
                        <td class="tm_width_3 tm_success_color tm_text_right tm_border_none tm_pt0">
                          ${{number_format((float) $invoice->i_discount, 2)}}
                        </td>   
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f18 tm_white_color tm_accent_bg tm_radius_6_0_0_6">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f18 tm_primary_color tm_text_right tm_white_color tm_accent_bg tm_radius_0_6_6_0">${{number_format((float) $invoice->i_total, 2)}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  
          {{-- <div class="tm_bottom_invoice">
            <div class="tm_bottom_invoice_left">
              <p class="tm_m0 tm_f18 tm_accent_color tm_mb5">Thank you for your business</p>
              <p class="tm_primary_color tm_f12 tm_m0 tm_bold">Our Terms and Conditions:</p>
              <p class="tm_m0 tm_f12">asdasdad</p>
            </div>
          </div> --}}

          {{-- <div class="tm_bottom_invoice" style="background: #01012F;">
            <div class="tm_bottom_invoice_left">
              <a href="" target="_blank" class="tm_invoice_btn   tm_white_color  ">Our Privacy Policy</a>
              |
              <a href="" target="_blank" class="tm_invoice_btn   tm_white_color ">Our Refund Policy</a>
            </div>
          </div> --}}

        </div>
      </div>

<div class="tm_invoice_btns tm_hide_print">
  <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
    <span class="tm_btn_icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg> 
    </span>
    Print Invoice
  </a>
  
  <button id="tm_download_btn" class="tm_invoice_btn tm_color2" data-download-name="Ready-Rentals-Invoice-{{ $invoice->i_invoice_number }}.pdf">
    <span class="tm_btn_icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
    </span>
    Download Invoice
  </button>

  @if($invoice->i_status == "unpaid")
      @if($invoice->i_payment_status == 'pending' || $invoice->i_payment_status == 'processing' || $invoice->i_payment_status == 'requires_verification' || $invoice->i_payment_status == 'requires_confirmation' || $invoice->i_payment_status == 'requires_action' || $invoice->i_payment_status == 'succeeded')
          <div class="alert alert-warning mt-3">
              <strong>{{ $invoice->i_payment_status == 'succeeded' ? 'Payment received' : 'Payment pending' }}</strong><br>
              {{ $invoice->i_payment_status == 'succeeded' ? 'Stripe is confirming the payment. This invoice will update shortly.' : 'A payment is already in progress for this invoice. Please wait for Stripe to update its status.' }}
          </div>
      @else
      <button id="stripe_payment_btn" type="button" class="tm_invoice_btn tm_color3">
          <span class="tm_btn_icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                      <line x1="1" y1="10" x2="23" y2="10"></line>
                  </svg>
              </span>
          <span class="tm_pay_invoice_label">
              Pay Invoice: ${{ number_format((float) $invoice->i_total, 2) }}
          </span>
      </button>
      @endif
  @else
    <div class="card card-congratulations">
      <div class="card-body text-center">
        <div class="text-center">
          <h3 class="mb-1 text-white">Thank You!</h3>
          <p class="card-text m-auto w-75">
            <b>${{number_format((float) $invoice->i_total, 2)}}</b> is paid successfully.
          </p>
        </div>
      </div>
    </div>
  @endif
</div>

<!-- [Rest of the code remains exactly the same] -->

      
    </div>
  </div>



    <!-- Stripe Payment -->
    <!--<div class="modal fade text-start" id="stripe_payment_form_modal" tabindex="-1" aria-labelledby="stripe_payment_form_modal_title" aria-hidden="true" data-bs-backdrop="true">-->
    <!--    <div class="modal-dialog modal-dialog-centered modal-lg">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--                <h4 class="modal-title" id="stripe_payment_form_modal_title">Make Payment - ${{$invoice->i_total}}</h4>-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--            </div>-->
    <!--            <div id="payment-status-alert" class="alert alert-info" style="display: none; margin: 0 1rem;">-->
    <!--                <div class="d-flex align-items-center">-->
    <!--                    <div class="spinner-border spinner-border-sm me-2" role="status" id="status-spinner" style="display: none;">-->
    <!--                        <span class="visually-hidden">Loading...</span>-->
    <!--                    </div>-->
    <!--                    <span id="status-message"></span>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
                    <!-- Payment Method Tabs -->
    <!--                <ul class="nav nav-tabs" id="paymentMethodTabs" role="tablist">-->
    <!--                    <li class="nav-item" role="presentation">-->
    <!--                        <button class="nav-link active" id="ach-tab" data-bs-toggle="tab" data-bs-target="#ach-tab-pane" type="button" role="tab" aria-controls="ach-tab-pane" aria-selected="true">Bank Transfer (ACH)</button>-->
    <!--                    </li>-->
    <!--                    <li class="nav-item" role="presentation">-->
    <!--                        <button class="nav-link" id="card-tab" data-bs-toggle="tab" data-bs-target="#card-tab-pane" type="button" role="tab" aria-controls="card-tab-pane" aria-selected="false">Credit/Debit Card</button>-->
    <!--                    </li>-->
    <!--                </ul>-->
                    
                    <!-- Tab Contents -->
    <!--                <div class="tab-content p-3 border border-top-0 rounded-bottom" id="paymentMethodTabsContent">-->
                        <!-- ACH Payment Tab -->
    <!--                    <div class="tab-pane fade show active" id="ach-tab-pane" role="tabpanel" aria-labelledby="ach-tab" tabindex="0">-->
    <!--                        {{-- <div class="alert alert-info">-->
    <!--                            You'll receive two small deposits in 1-2 business days to verify your account.-->
    <!--                        </div> --}}-->
                            
    <!--                        <form id="ach_payment_form">-->

    <!--                            <div id="error-message"></div>-->
    <!--                            <div id="success-message"></div>-->

    <!--                            <input type="hidden" name="invoice_number" value="{{ $invoice->i_invoice_number }}">-->
    <!--                            <input type="hidden" name="amount" value="{{ $invoice->i_total }}">-->
                                
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Account Holder Name</label>-->
    <!--                                <input type="text" name="name" id="name" class="form-control" value="{{ $invoice->tenant ? $invoice->tenant->first_name.' '.$invoice->tenant->last_name : '' }}" required>-->
    <!--                            </div>-->
                                
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Email</label>-->
    <!--                                <input type="email" name="email" id="email" class="form-control" value="{{ $invoice->tenant->email ?? '' }}" required>-->
    <!--                            </div>-->

    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label" for="routing-number">Routing Number</label>-->
    <!--                                <input type="text" name="routing-number" id="routing-number" class="form-control" value="110000000" required>-->
    <!--                            </div>-->

    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label" for="account-number">Account Number</label>-->
    <!--                                <input type="text" name="account-number" id="account-number" class="form-control" value="000123456789" required>-->
    <!--                            </div>-->
                                
    <!--                            <div class="mb-3">-->
    <!--                                <label for="account-type">Account Type</label>-->
    <!--                                <select id="account-type" required>-->
    <!--                                    <option value="checking">Checking</option>-->
    <!--                                    <option value="savings">Savings</option>-->
    <!--                                </select>-->
    <!--                            </div>                               -->
 
                                
    <!--                            <div id="ach_error_messages" class="alert alert-danger mt-3" style="display: none;"></div>-->
                                
    <!--                            <button type="submit" id="ach_submit_btn" class="btn btn-primary mt-3">-->
    <!--                                <span id="ach_submit_text">Submit Payment</span>-->
    <!--                                <span id="ach_loading_spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>-->
    <!--                            </button>-->
    <!--                        </form>-->


    <!--                        <div id="verification-section" style="display: none;" class="mt-3 p-3 border rounded">-->
    <!--                            <h5 class="mb-3">Verify Microdeposits (Test Mode Only)</h5>-->
    <!--                            <form id="verify-form">-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label class="form-label">First Microdeposit Amount ($)</label>-->
    <!--                                    <input type="number" step="0.01" id="deposit1" class="form-control" value="0.32" required>-->
    <!--                                </div>-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label class="form-label">Second Microdeposit Amount ($)</label>-->
    <!--                                    <input type="number" step="0.01" id="deposit2" class="form-control" value="0.45" required>-->
    <!--                                </div>-->
    <!--                                <input type="hidden" id="paymentIntentIdField">-->
    <!--                                <button type="submit" class="btn btn-primary">-->
    <!--                                    <span id="verify-submit-text">Verify Deposits</span>-->
    <!--                                    <span id="verify-loading-spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>-->
    <!--                                </button>-->
    <!--                            </form>-->
    <!--                        </div> -->

                            
    <!--                        <div id="ach_success_message" class="alert alert-success mt-3" style="display: none;">-->
    <!--                            Payment initiated! Check your email for microdeposit verification instructions.-->
    <!--                        </div>-->
    <!--                    </div>-->
 
                        <!-- Card Payment Tab -->
    <!--                    <div class="tab-pane fade" id="card-tab-pane" role="tabpanel" aria-labelledby="card-tab" tabindex="0">-->
    <!--                        <form id="card_payment_form">-->
    <!--                            <div class="alert alert-danger payment-errors" role="alert" style="font-weight: bold; display: none;"></div>-->
                                
    <!--                            <input type="hidden" id="amount" value="{{$invoice->i_total}}">-->
    <!--                            <input type="hidden" id="invoice_number" value="{{ $invoice->i_invoice_number }}">-->
                                
                                <!-- Cardholder Name -->
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Cardholder Name</label>-->
    <!--                                <input type="text" id="cardholder-name" class="form-control" placeholder="Name on card" required>-->
    <!--                            </div>-->
                                
                                <!-- Card Number -->
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Card Number</label>-->
    <!--                                <div id="card-number" class="form-control p-2" style="height: 40px;"></div>-->
    <!--                            </div>-->
                                
    <!--                            <div class="row">-->
                                    <!-- Expiry Date -->
    <!--                                <div class="col-md-6 mb-3">-->
    <!--                                    <label class="form-label">Expiry Date</label>-->
    <!--                                    <div id="card-expiry" class="form-control p-2" style="height: 40px;"></div>-->
    <!--                                </div>-->
                                    
                                    <!-- CVC -->
    <!--                                <div class="col-md-6 mb-3">-->
    <!--                                    <label class="form-label">CVC</label>-->
    <!--                                    <div id="card-cvc" class="form-control p-2" style="height: 40px;"></div>-->
    <!--                                </div>-->
    <!--                            </div>-->
                                
                                <!-- Billing Address -->
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Billing Address</label>-->
    <!--                                <input type="text" id="billing-address-line1" class="form-control mb-2" placeholder="Street address">-->
    <!--                                <input type="text" id="billing-address-line2" class="form-control mb-2" placeholder="Apt, suite, etc. (optional)">-->
    <!--                                <div class="row">-->
    <!--                                    <div class="col-md-6">-->
    <!--                                        <input type="text" id="billing-address-city" class="form-control mb-2" placeholder="City">-->
    <!--                                    </div>-->
    <!--                                    <div class="col-md-3">-->
    <!--                                        <input type="text" id="billing-address-state" class="form-control mb-2" placeholder="State">-->
    <!--                                    </div>-->
    <!--                                    <div class="col-md-3">-->
    <!--                                        <input type="text" id="billing-address-zip" class="form-control mb-2" placeholder="ZIP">-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
                                
                                <!-- Email -->
    <!--                            <div class="mb-3">-->
    <!--                                <label class="form-label">Email for Receipt</label>-->
    <!--                                <input type="email" id="card-email" class="form-control" value="{{ $invoice->tenant->email ?? '' }}" required>-->
    <!--                            </div>-->
                                
    <!--                            <button type="submit" id="card_submit_btn" class="btn btn-primary mt-3">-->
    <!--                                <span id="card_submit_text">Pay ${{$invoice->i_total}} Now</span>-->
    <!--                                <span id="card_loading_spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
        
    <!-- Stripe Payment Modal -->
    <div class="modal fade text-start" id="stripe_payment_form_modal" tabindex="-1" aria-labelledby="stripe_payment_form_modal_title" aria-hidden="true" data-bs-backdrop="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="stripe_payment_form_modal_title">
                        <i class="fas fa-credit-card me-2"></i> Make Payment - ${{number_format((float) $invoice->i_total, 2)}}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div id="payment-status-alert" class="alert alert-info" style="display: none; margin: 0 1rem;">
                    <div class="d-flex align-items-center">
                        <div class="spinner-border spinner-border-sm me-2" role="status" id="status-spinner" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span id="status-message"></span>
                    </div>
                </div>
                
                <div class="modal-body">
                    <!-- Payment Method Tabs -->
<!-- Payment Method Tabs -->
<ul class="nav nav-tabs nav-justified" id="paymentMethodTabs" role="tablist" style="font-size: 1.1rem;">
    <li class="nav-item" role="presentation">
        <button class="nav-link active py-3" id="ach-tab" data-bs-toggle="tab" data-bs-target="#ach-tab-pane" type="button" role="tab" aria-controls="ach-tab-pane" aria-selected="true" style="
            background-color: #f8f9fa;
            border-color: #dee2e6 #dee2e6 transparent;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            transition: all 0.3s ease;
            color: #495057;
        ">
            <i class="fas fa-university me-2"></i> Bank Transfer (ACH)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link py-3" id="card-tab" data-bs-toggle="tab" data-bs-target="#card-tab-pane" type="button" role="tab" aria-controls="card-tab-pane" aria-selected="false" style="
            background-color: #f8f9fa;
            border-color: #dee2e6 #dee2e6 transparent;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            transition: all 0.3s ease;
            color: #495057;
        ">
            <i class="far fa-credit-card me-2"></i> Credit/Debit Card
        </button>
    </li>
</ul>

                    
                    <!-- Tab Contents -->
                    <div class="tab-content p-4 border border-top-0 rounded-bottom" id="paymentMethodTabsContent">
                        <!-- ACH Payment Tab -->
                        <div class="tab-pane fade show active" id="ach-tab-pane" role="tabpanel" aria-labelledby="ach-tab" tabindex="0">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> You'll receive two small deposits in 1-2 business days to verify your account.
                            </div>
                            
                            <form id="ach_payment_form">
                                <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                <div id="success-message" class="alert alert-success" style="display: none;"></div>
    
                                <input type="hidden" name="invoice_number" value="{{ $invoice->i_invoice_number }}">
                                <input type="hidden" name="amount" value="{{ $invoice->i_total }}">
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2"></i> Account Holder Name
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $invoice->tenant ? $invoice->tenant->first_name.' '.$invoice->tenant->last_name : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-2"></i> Email
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $invoice->tenant->email ?? '' }}" required>
                                </div>
    
                                <div class="mb-3">
                                    <label class="form-label" for="routing-number">
                                        <i class="fas fa-route me-2"></i> Routing Number
                                    </label>
                                    <input type="text" name="routing-number" id="routing-number" class="form-control" placeholder="9-digit number" required>
                                </div>
    
                                <div class="mb-3">
                                    <label class="form-label" for="account-number">
                                        <i class="fas fa-wallet me-2"></i> Account Number
                                    </label>
                                    <input type="text" name="account-number" id="account-number" class="form-control" placeholder="Your account number" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="account-type">
                                        <i class="fas fa-piggy-bank me-2"></i> Account Type
                                    </label>
                                    <select id="account-type" class="form-select" required>
                                        <option value="checking">Checking Account</option>
                                        <option value="savings">Savings Account</option>
                                    </select>
                                </div>
                                
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" id="ach_submit_btn" class="btn btn-primary btn-lg">
                                        <span id="ach_submit_text">
                                            <i class="fas fa-paper-plane me-2"></i> Submit Payment
                                        </span>
                                        <span id="ach_loading_spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>
                                    </button>
                                </div>
                            </form>
    
                            <div id="verification-section" style="display: none;" class="mt-4 p-3 border rounded bg-light">
                                <h5 class="mb-3"><i class="fas fa-shield-alt me-2"></i> Verify Microdeposits</h5>
                                <form id="verify-form">
                                    <div class="mb-3">
                                        <label class="form-label">First Microdeposit Amount ($)</label>
                                        <input type="number" step="0.01" id="deposit1" class="form-control" placeholder="0.32" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Second Microdeposit Amount ($)</label>
                                        <input type="number" step="0.01" id="deposit2" class="form-control" placeholder="0.45" required>
                                    </div>
                                    <input type="hidden" id="paymentIntentIdField">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-success">
                                            <span id="verify-submit-text">
                                                <i class="fas fa-check-circle me-2"></i> Verify Deposits
                                            </span>
                                            <span id="verify-loading-spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Card Payment Tab -->
                        <div class="tab-pane fade" id="card-tab-pane" role="tabpanel" aria-labelledby="card-tab" tabindex="0">
                            <form id="card_payment_form">
                                <div class="alert alert-danger payment-errors" role="alert" style="display: none;">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <span class="error-message"></span>
                                </div>
                                
                                <input type="hidden" id="amount" value="{{$invoice->i_total}}">
                                <input type="hidden" id="invoice_number" value="{{ $invoice->i_invoice_number }}">
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2"></i> Cardholder Name
                                    </label>
                                    <input type="text" id="cardholder-name" class="form-control" placeholder="Name as it appears on card" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="far fa-credit-card me-2"></i> Card Number
                                    </label>
                                    <div id="card-number" class="form-control p-2" style="height: 45px;"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="far fa-calendar-alt me-2"></i> Expiry Date
                                        </label>
                                        <div id="card-expiry" class="form-control p-2" style="height: 45px;"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-lock me-2"></i> Security Code (CVC)
                                        </label>
                                        <div id="card-cvc" class="form-control p-2" style="height: 45px;"></div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-home me-2"></i> Billing Address
                                    </label>
                                    <input type="text" id="billing-address-line1" class="form-control mb-2" placeholder="Street address" required>
                                    <input type="text" id="billing-address-line2" class="form-control mb-2" placeholder="Apt, suite, etc. (optional)">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" id="billing-address-city" class="form-control mb-2" placeholder="City" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="billing-address-state" class="form-control mb-2" placeholder="State" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="billing-address-zip" class="form-control mb-2" placeholder="ZIP" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-2"></i> Email for Receipt
                                    </label>
                                    <input type="email" id="card-email" class="form-control" value="{{ $invoice->tenant->email ?? '' }}" required>
                                </div>
                                
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" id="card_submit_btn" class="btn btn-primary btn-lg">
                                        <span id="card_submit_text">
                                            <i class="fas fa-lock me-2"></i> Pay ${{number_format((float) $invoice->i_total, 2)}} Now
                                        </span>
                                        <span id="card_loading_spinner" class="spinner-border spinner-border-sm" style="display: none;"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
            
        
  <script src="{{ asset('invoice') }}/js/jquery.min.js"></script>
  <script src="{{ asset('invoice') }}/js/jspdf.min.js"></script>
  <script src="{{ asset('invoice') }}/js/html2canvas.min.js"></script>
  <script src="{{ asset('invoice') }}/js/main.js"></script>

  <!--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>-->
  {{-- <script type="text/javascript" src="{{ asset('invoice/js/stripe_token.js?v=2') }}"></script>  --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
 

    $('body').on('click', '#stripe_payment_btn', function()
    {
        $('#add_new_dilatory_transection_form').trigger("reset");
        $("#success_res").css("display", "none");
        $("#failure_res").css("display", "none");
        $('.field-error').text('');

        $('#stripe_payment_form_modal').modal('show');
    });


        // Stripe configuration
        const STRIPE_PUBLIC_KEY = @json(config('services.stripe.key'));
        const LIVE_MODE = @json(config('services.stripe.mode', 'test') === 'live');
        const stripe = Stripe(STRIPE_PUBLIC_KEY);
    
      // Store paymentIntentId globally
      let paymentIntentId = null;

      document.getElementById('ach_payment_form').addEventListener('submit', async (e) => {
          e.preventDefault();
          
          const submitBtn = document.getElementById('ach_submit_btn');
          submitBtn.disabled = true;
          document.getElementById('ach_loading_spinner').style.display = 'inline-block';
          document.getElementById('ach_submit_text').textContent = 'Processing...';
          
          showStatus('Initiating bank transfer...', 'info', true);

          try {
              const response = await fetch('/create-intent-for-ach-payment', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: JSON.stringify({
                      invoice_number: document.querySelector('input[name="invoice_number"]').value,
                      name: document.getElementById('name').value,
                      email: document.getElementById('email').value,
                      accountType: document.getElementById('account-type').value,
                      accountHolderType: 'individual',
                      payment_request_id: crypto.randomUUID()
                  })
              });
              
              const data = await response.json();
              
              if (data.error) {
                  throw new Error(data.error);
              }
              
              paymentIntentId = data.paymentIntentId;
              document.getElementById('paymentIntentIdField').value = paymentIntentId;
              
              showStatus('Verifying bank account details...', 'info', true);

              const {error, paymentIntent} = await stripe.confirmUsBankAccountPayment(
                  data.clientSecret, {
                      payment_method: {
                          us_bank_account: {
                              routing_number: document.getElementById('routing-number').value,
                              account_number: document.getElementById('account-number').value,
                              account_type: document.getElementById('account-type').value,
                              account_holder_type: 'individual'
                          },
                          billing_details: {
                              name: document.getElementById('name').value,
                              email: document.getElementById('email').value
                          }
                      }
                  }
              );
              
              if (error) {
                  throw error;
              }
              
              if (LIVE_MODE) {
                  // In live mode, we'll rely on webhooks to update status
                  showStatus('Bank transfer initiated! It may take 1-3 business days to complete.', 'success');
                  document.getElementById('ach_payment_form').style.display = 'none';
                  
                  // Show a temporary success message before reload
                  setTimeout(() => {
                      window.location.reload();
                  }, 3000);
              } else {
                  // Test mode - show verification form
                  showStatus('Micro-deposits sent to your account. Please verify amounts.', 'info');
                  document.getElementById('ach_payment_form').style.display = 'none';
                  document.getElementById('verification-section').style.display = 'block';
              }
              
          } catch (error) {
              showStatus(error.message, 'danger');
              console.error('Payment error:', error);
          } finally {
              submitBtn.disabled = false;
              document.getElementById('ach_loading_spinner').style.display = 'none';
              document.getElementById('ach_submit_text').textContent = 'Submit Payment';
          }
      });
 
      // Handle verification form submission
      document.getElementById('verify-form').addEventListener('submit', async (e) => {
          e.preventDefault();
          
          const submitBtn = e.target.querySelector('button[type="submit"]');
          const submitText = document.getElementById('verify-submit-text');
          const spinner = document.getElementById('verify-loading-spinner');
          
          submitBtn.disabled = true;
          submitText.textContent = 'Verifying...';
          spinner.style.display = 'inline-block';
          
          showStatus('Verifying micro-deposits...', 'info', true);

          try {
              const deposit1 = parseFloat(document.getElementById('deposit1').value) * 100;
              const deposit2 = parseFloat(document.getElementById('deposit2').value) * 100;
              const paymentIntentId = document.getElementById('paymentIntentIdField').value;
              
              if (!paymentIntentId) {
                  throw new Error('Payment session expired. Please start over.');
              }
              
              const response = await fetch('/verify-microdeposits-for-ACH', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: JSON.stringify({
                      paymentIntentId: paymentIntentId,
                      invoice_number: document.querySelector('input[name="invoice_number"]').value,
                      amounts: [deposit1, deposit2]
                  })
              });
              
              const result = await response.json();
              
              if (result.success) {
                  showStatus('Verification successful! Payment will be processed shortly.', 'success');
                  setTimeout(() => {
                      window.location.reload();
                  }, 2000);
              } else {
                  throw new Error(result.error || 'Verification failed. Please check the amounts and try again.');
              }
          } catch (error) {
              showStatus(error.message, 'danger');
              console.error('Verification error:', error);
          } finally {
              submitBtn.disabled = false;
              submitText.textContent = 'Verify Deposits';
              spinner.style.display = 'none';
          }
      });
  


      // Initialize Stripe Elements for card payments
      const elements = stripe.elements();
      const cardNumber = elements.create('cardNumber', {
          style: {
              base: {
                  fontSize: '16px',
                  color: '#10253a',
                  fontFamily: 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
              }
          }
      });
      cardNumber.mount('#card-number');

      const cardExpiry = elements.create('cardExpiry', {
          style: {
              base: {
                  fontSize: '16px',
                  color: '#10253a',
                  fontFamily: 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
              }
          }
      });
      cardExpiry.mount('#card-expiry');

      const cardCvc = elements.create('cardCvc', {
          style: {
              base: {
                  fontSize: '16px',
                  color: '#10253a',
                  fontFamily: 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
              }
          }
      });
      cardCvc.mount('#card-cvc');
 

      // Handle card form submission
      document.getElementById('card_payment_form').addEventListener('submit', async (e) => {
          e.preventDefault();
          
          const submitBtn = document.getElementById('card_submit_btn');
          submitBtn.disabled = true;
          document.getElementById('card_loading_spinner').style.display = 'inline-block';
          document.getElementById('card_submit_text').textContent = 'Processing...';
          
          showStatus('Processing payment...', 'info', true);

          try {
              const { paymentMethod, error } = await stripe.createPaymentMethod({
                  type: 'card',
                  card: cardNumber,
                  billing_details: {
                      name: document.getElementById('cardholder-name').value,
                      email: document.getElementById('card-email').value,
                      address: {
                          line1: document.getElementById('billing-address-line1').value,
                          line2: document.getElementById('billing-address-line2').value,
                          city: document.getElementById('billing-address-city').value,
                          state: document.getElementById('billing-address-state').value,
                          postal_code: document.getElementById('billing-address-zip').value,
                      }
                  }
              });
              
              if (error) {
                  throw error;
              }
              
              showStatus('Verifying payment details...', 'info', true);

              const response = await fetch('/process-card-payment', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: JSON.stringify({
                      payment_method_id: paymentMethod.id,
                      invoice_number: document.getElementById('invoice_number').value,
                      email: document.getElementById('card-email').value,
                      name: document.getElementById('cardholder-name').value,
                      payment_request_id: crypto.randomUUID()
                  })
              });
              
              const data = await response.json();
              
              if (data.error) {
                  throw new Error(data.error);
              }
              
              if (data.requiresConfirmation) {
                  showStatus('Confirming payment securely with Stripe...', 'info', true);

                  const { error: confirmError, paymentIntent } = await stripe.confirmCardPayment(
                      data.clientSecret,
                      {
                          payment_method: paymentMethod.id,
                          receipt_email: document.getElementById('card-email').value,
                          return_url: window.location.href
                      }
                  );

                  if (confirmError) {
                      throw confirmError;
                  }

                  if (paymentIntent.status === 'succeeded') {
                      handlePaymentSuccess();
                  } else if (paymentIntent.status === 'processing') {
                      showStatus('Payment is processing. The invoice will update after Stripe confirms it.', 'info', true);
                      setTimeout(() => window.location.reload(), 5000);
                  } else {
                      throw new Error('Payment processing did not complete. Status: ' + paymentIntent.status);
                  }
              } else if (data.success) {
                  handlePaymentSuccess();
              } else if (data.status === 'processing') {
                  showStatus('Payment is processing. The invoice will update after Stripe confirms it.', 'info', true);
                  setTimeout(() => window.location.reload(), 5000);
              } else {
                  throw new Error('Payment processing failed. Please try again.');
              }
              
          } catch (error) {
              showStatus(error.message, 'danger');
              console.error('Payment error:', error);
          } finally {
              submitBtn.disabled = false;
              document.getElementById('card_loading_spinner').style.display = 'none';
              document.getElementById('card_submit_text').textContent = `Pay $${document.getElementById('amount').value} Now`;
          }
      });
 



      // Status message management
      function showStatus(message, type = 'info', showSpinner = false) {
          const alert = document.getElementById('payment-status-alert');
          const messageEl = document.getElementById('status-message');
          const spinner = document.getElementById('status-spinner');
          
          alert.style.display = 'block';
          alert.className = `alert alert-${type}`;
          messageEl.textContent = message;
          spinner.style.display = showSpinner ? 'inline-block' : 'none';
      }

      function hideStatus() {
          document.getElementById('payment-status-alert').style.display = 'none';
      }

      function handlePaymentSuccess() {
          showStatus('Payment successful! Updating invoice...', 'success');
          setTimeout(() => {
              window.location.reload();
          }, 1500);
      }



      $('#stripe_payment_form_modal').on('shown.bs.modal', function() {
          const activeTab = document.querySelector('.nav-link.active').id;
          if (activeTab === 'ach-tab') {
              document.getElementById('name').focus();
          } else {
              document.getElementById('cardholder-name').focus();
          }
      });



      document.querySelectorAll('.nav-link').forEach(tab => {
          tab.addEventListener('click', function() {
              document.querySelectorAll('.payment-errors').forEach(el => el.style.display = 'none');
              hideStatus();
          });
      });

  </script>


  <div id="payment-processing-overlay">
      <div class="text-center">
          <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
          <p class="mt-3">Processing payment...</p>
      </div>
  </div>

</body>
</html>
