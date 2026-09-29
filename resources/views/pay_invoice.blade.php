<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Site Title -->
  <title>{{$page_title}}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('invoice') }}/css/style.css">

  {{-- Custom Styles --}}
    <style>
        .tm_invoice.tm_style2 .tm_logo img {
            max-height: 50px;
        }
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

        .btn
        {
          width: 100%;
          margin: 8px 0px;
          height: 36px;
        }


        .card-congratulations {
            background: -webkit-linear-gradient(332deg,#7367F0,rgba(115,103,240,.7));
            background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
            color: #FFF;
        }

        @media (max-width: 999px)
        {
          .tm_invoice_btns {
              display: block;
         }
        }



        @media (min-width: 1000px) {
        .tm_invoice_btns {
            width: 15rem !important;
          }
        }



        @media (max-width: 767px) {
        .tm_invoice_btns {
          order: -1; /* Move before invoice content */
          margin-bottom: 20px;
          width: 100% !important;
        }
        
        .tm_invoice_wrap {
          display: flex;
          flex-direction: column;
        }
      }

    </style>

</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">

      <div class="tm_invoice tm_style2 tm_type1 tm_accent_border" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb20 tm_mb10_md">
            <div class="tm_invoice_left">
              <div class="tm_logo" style="color: white !important;font-size:2rem !important">Ready Rentals Online</div>
            </div>
            <div class="tm_invoice_right">
              <div class="tm_grid_row tm_col_3">
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M424 80H88a56.06 56.06 0 00-56 56v240a56.06 56.06 0 0056 56h336a56.06 56.06 0 0056-56V136a56.06 56.06 0 00-56-56zm-14.18 92.63l-144 112a16 16 0 01-19.64 0l-144-112a16 16 0 1119.64-25.26L256 251.73l134.18-104.36a16 16 0 0119.64 25.26z"/></svg>
                  </p>
                  info@readyrentalsonline.com <br>
                  
                </div>
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><path d="M391 480c-19.52 0-46.94-7.06-88-30-49.93-28-88.55-53.85-138.21-103.38C116.91 298.77 93.61 267.79 61 208.45c-36.84-67-30.56-102.12-23.54-117.13C45.82 73.38 58.16 62.65 74.11 52a176.3 176.3 0 0128.64-15.2c1-.43 1.93-.84 2.76-1.21 4.95-2.23 12.45-5.6 21.95-2 6.34 2.38 12 7.25 20.86 16 18.17 17.92 43 57.83 52.16 77.43 6.15 13.21 10.22 21.93 10.23 31.71 0 11.45-5.76 20.28-12.75 29.81-1.31 1.79-2.61 3.5-3.87 5.16-7.61 10-9.28 12.89-8.18 18.05 2.23 10.37 18.86 41.24 46.19 68.51s57.31 42.85 67.72 45.07c5.38 1.15 8.33-.59 18.65-8.47 1.48-1.13 3-2.3 4.59-3.47 10.66-7.93 19.08-13.54 30.26-13.54h.06c9.73 0 18.06 4.22 31.86 11.18 18 9.08 59.11 33.59 77.14 51.78 8.77 8.84 13.66 14.48 16.05 20.81 3.6 9.53.21 17-2 22-.37.83-.78 1.74-1.21 2.75a176.49 176.49 0 01-15.29 28.58c-10.63 15.9-21.4 28.21-39.38 36.58A67.42 67.42 0 01391 480z"/></svg>
                  </p>
                  1-267-549-9625 <br>
                  
                </div>
                <div class="tm_text_center">
                  <p class="tm_accent_color tm_mb0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="currentColor"><circle cx="256" cy="192" r="32"/><path d="M256 32c-88.22 0-160 68.65-160 153 0 40.17 18.31 93.59 54.42 158.78 29 52.34 62.55 99.67 80 123.22a31.75 31.75 0 0051.22 0c17.42-23.55 51-70.88 80-123.22C397.69 278.61 416 225.19 416 185c0-84.35-71.78-153-160-153zm0 224a64 64 0 1164-64 64.07 64.07 0 01-64 64z"/></svg>
                  </p>
                  1742 Delsea Drive,
                  Deptford NJ 08096
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
                @endif
              </p>
            </div>
            
            <div class="tm_invoice_info_right">
              <div class="tm_f50 tm_text_uppercase tm_text_center tm_invoice_title tm_mb15 tm_ternary_color tm_mobile_hide">
                  @if($invoice->i_status == "paid")
                    <span style="color:green">Paid</span>
                  @elseif($invoice->i_status == "cancelled")
                    <span style="color:red">Cancelled</span>
                  @elseif($invoice->i_status == "unpaid")
                    <span style="color:red">Payment Due</span>
                  @else
                    <span style="color:red">{{$invoice->i_status}}</span>
                  @endif
              </div>
              <div class="tm_grid_row tm_col_3 tm_invoice_info_in tm_round_border tm_gray_bg">
                <div>
                    <span>Tracking ID :</span> <br>
                    <b class="tm_f18 tm_accent_color">#{{$invoice->i_invoice_number}}</b>
                </div>                
                <div>
                  <span>Issued By:</span> <br>
                  <b class="tm_f18 tm_accent_color">John Coppola </b>
                </div>
                <div>
                  <span>Issue Date:</span> <br>
                  <b class="tm_f18 tm_accent_color">{{\Carbon\Carbon::parse($invoice->i_issue_date)->format('Y-m-d')}}</b>
                </div>  

                <div>
                    <span>Due Date:</span> <br>
                    <b class="tm_f18 tm_accent_color">{{\Carbon\Carbon::parse($invoice->i_due_date)->format('Y-m-d')}}</b>
                </div>  

                <div>
                  <span>Paid Date:</span> <br>
                  @if($invoice->i_payment_date !="" && $invoice->i_payment_date!=null)
                    <b class="tm_f18 tm_accent_color">{{Carbon\Carbon::parse($invoice->i_payment_date)->format('j-M-y')}}</b>
                  @else
                    -
                    <!--<b class="tm_f18 tm_accent_color">{{$invoice->i_status}}</b>-->
                  @endif
                </div>  

                <div>
                  @if($invoice->i_status =="paid")
                    <span>Payment Method:</span> <br>
                    <b class="tm_f18 tm_accent_color">{{$invoice->i_client_payment_method}}</b>
                  @else
                    @if($invoice->i_status =="cancelled")
                      <span>Status:</span> <br>
                      <b class="tm_f18 tm_accent_color">{{$invoice->i_status}}</b>
                    @else
                      <span>Status:</span> <br>
                      <b class="tm_f18 tm_accent_color" style="color:red">Payment Due</b>
                    @endif
                  @endif
                </div>                  
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
                        <td class="tm_width_2 tm_text_right">${{$invoice->i_subtotal}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
                <div class="tm_mb10 tm_m0_md"></div>
                <div class="custom-border">
                  <p class="tm_primary_color tm_f12 tm_m0 tm_bold">LandLord Notes:</p>
                  <p class="tm_m0 tm_f12">{{$invoice->i_notes}}</p>
                </div>
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtotal</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
                        ${{$invoice->i_subtotal}}
                        </td>
                    </tr>

                    <tr>
                        <td class="tm_width_3 tm_danger_color tm_border_none tm_pt0">Fee</td>
                        <td class="tm_width_3 tm_danger_color tm_text_right tm_border_none tm_pt0">
                          ${{$invoice->i_fee}}
                        </td>
                    </tr>
                    <tr>
                        <td class="tm_width_3 tm_danger_color tm_border_none tm_pt0">Tax</td>
                        <td class="tm_width_3 tm_danger_color tm_text_right tm_border_none tm_pt0">
                          ${{$invoice->i_tax}}
                        </td>
                    </tr>
                    <tr>
                        <td class="tm_width_3 tm_success_color tm_border_none tm_pt0">Discount</td>
                        <td class="tm_width_3 tm_success_color tm_text_right tm_border_none tm_pt0">
                          ${{$invoice->i_discount}}
                        </td>   
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f18 tm_white_color tm_accent_bg tm_radius_6_0_0_6">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f18 tm_primary_color tm_text_right tm_white_color tm_accent_bg tm_radius_0_6_6_0">${{$invoice->i_total}}</td>
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

<!-- [Previous code remains exactly the same until the payment button section] -->

<div class="tm_invoice_btns tm_hide_print">
  <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
    <span class="tm_btn_icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg> 
    </span>
    Print Invoice
  </a>
  
  <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
    <span class="tm_btn_icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
    </span>
    Download Invoice
  </button>

  @if($invoice->i_status == "unpaid")
    <a id="stripe_payment_btn" href="#0" class="tm_invoice_btn tm_color3" style="background-color: #28a745; border-color: #28a745;width: 100%;    padding: 15px;text-align:center;margin-top:5px">
      <span class="tm_btn_icon" style="color:white;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
          <line x1="1" y1="10" x2="23" y2="10"></line>
        </svg>
      </span>
      <span style="font-size: 1.1rem; font-weight: bold;color:white;">Pay ${{$invoice->i_total}} with Credit/Debit Card</span>
    </a>
  @else
    <div class="card card-congratulations">
      <div class="card-body text-center">
        <img src="https://pay.erainventions.com/app_assets/front-end/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left">
        <img src="https://pay.erainventions.com/app_assets/front-end/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right">
        <div class="text-center">
          <h3 class="mb-1 text-white">Thank You!</h3>
          <p class="card-text m-auto w-75">
            <b>${{$invoice->i_total}}</b> is paid successfully.
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
            <div
            class="modal fade text-start"
            id="stripe_payment_form_modal"
            tabindex="-1"
            aria-labelledby="stripe_payment_form_modal_title"
            aria-hidden="true"
            data-bs-backdrop="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="stripe_payment_form_modal_title">Make Payment</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ url('invoices/process-invoice-payment/'.$invoice->i_invoice_number) }}" id="payment_form">
                        @csrf
                        <div class="modal-body">

                            <div class="alert alert-danger payment-errors" role="alert" style="font-weight: bold; display: none;width: 100%;padding: 10px;">
                            </div>
      
                               

                            <!--begin::Input group-->
                            <div class="row mb-1 ">
                    
                                <input type="hidden" id="amount" value="{{$invoice->i_total}}">
                                <div id="card-element"><!-- Stripe will inject the card fields here --></div>
                                <!--<div id="card-errors" class="payment-errors" role="alert"></div>-->
                                <input type="hidden" id="invoice_number" value="{{ $invoice->i_invoice_number }}">
    
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="payment-sub-btn" data-original_markup='<i class="fa fa-lock"></i> Pay ${{$invoice->i_total}} Now'>Pay ${{$invoice->i_total}} Now</button>
                        </div>
                    </form>
                  </div>
            </div>
        </div>
        
  <script src="{{ asset('invoice') }}/js/jquery.min.js"></script>
  <script src="{{ asset('invoice') }}/js/jspdf.min.js"></script>
  <script src="{{ asset('invoice') }}/js/html2canvas.min.js"></script>
  <script src="{{ asset('invoice') }}/js/main.js"></script>

  <!--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>-->
  <script type="text/javascript" src="{{ asset('invoice/js/stripe_token.js?v=2') }}"></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
    var base_url =  window.location.origin;

    $('body').on('click', '#stripe_payment_btn', function()
    {
      $('#add_new_dilatory_transection_form').trigger("reset");
      $("#success_res").css("display", "none");
      $("#failure_res").css("display", "none");
      $('.field-error').text('');

      $('#stripe_payment_form_modal').modal('show');
    });
  </script>
</body>
</html>