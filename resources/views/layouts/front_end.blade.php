<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $page_title ?? '' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{asset(env("APP_FAVICON"))}}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/responsive.css">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/application_steps.css">

    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
    
</head>

<style type="text/css">
    .ltn__breadcrumb-area 
    {
        padding-top: 50px;
        padding-bottom: 50px;
    }

 
    .share-property-btn i {
        margin-right: 5px;
    }
    #shareSubmitSpinner {
        margin-left: 5px;
    }
 
        /* Add these styles to restrict the size of property images */
        .ltn__product-item .product-img a img {
            max-width: 100%; /* Ensure the image does not exceed its container */
            height: auto; /* Maintain the aspect ratio of the image */
            display: block; /* Remove any extra spacing below the image */
            margin: 0 auto; /* Center the image horizontally */
        }
        
        /* Optional: Add a maximum height to the image container */
        .ltn__product-item .product-img {
            max-height: 300px; /* Adjust the value as needed */
            overflow: hidden; /* Hide any overflow beyond the maximum height */
        }
        
        /* Optional: Add some styling to the product-info container for better aesthetics */
        .ltn__product-item .product-info {
            padding: 15px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        
        /* Optional: Add styling to the product-title for better readability */
        .ltn__product-item .product-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

    </style>





<?php 
    $AppSetting =  App\Models\AppSetting::find(1);
?>




<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">

    <!-- HEADER AREA START (header-5) -->
    <header class="ltn__header-area ltn__header-5 ltn__header-transparent--- gradient-color-4---">
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area section-bg-6 top-area-color-white---">
            <div class="container">
                <div class="row">

 
                    @if($AppSetting)
                    <div class="col-md-8">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                @if($AppSetting->as_email)
                                <li><a href="mailto:{{$AppSetting->as_email}}"><i class="icon-mail"></i> {{$AppSetting->as_email}}</a></li>
                                @endif

                                @if($AppSetting->as_phone)
                                <li><a href="tel:{{$AppSetting->as_phone}}"><i class="icon-call"></i> {{$AppSetting->as_phone}}</a></li>
                                @endif

                                @if($AppSetting->as_address)
                                <li><a href="#0"><i class="icon-placeholder"></i> {{$AppSetting->as_address}}</a></li>
                                @endif  

                                @if($AppSetting->as_fax)
                                <li><a href="#0"><i class="fa fa-fax"></i> {{$AppSetting->as_fax}}</a></li>
                                @endif  

                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <div class="top-bar-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li class="d-none">
                                        <!-- ltn__language-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                            <ul>
                                                <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                    <ul>
                                                        <li><a href="#">Arabic</a></li>
                                                        <li><a href="#">Bengali</a></li>
                                                        <li><a href="#">Chinese</a></li>
                                                        <li><a href="#">English</a></li>
                                                        <li><a href="#">French</a></li>
                                                        <li><a href="#">Hindi</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    @if($AppSetting)
                                    <li>
                                        <!-- ltn__social-media -->
                                        <div class="ltn__social-media">
                                            <ul>
                                        @if($AppSetting->as_facebook_profile != "" && $AppSetting->as_facebook_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_facebook_profile}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                            @endif

                                            @if($AppSetting->as_linkedin_profile != "" && $AppSetting->as_linkedin_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_linkedin_profile}}" target="_blank" title="Facebook"><i class="fab fa-linkedin"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_twitter_profile != "" && $AppSetting->as_twitter_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_twitter_profile}}" target="_blank" title="Facebook"><i class="fab fa-twitter"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_instagram_profile != "" && $AppSetting->as_instagram_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_instagram_profile}}" target="_blank" title="Facebook"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_tiktok_profile != "" && $AppSetting->as_tiktok_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_tiktok_profile}}" target="_blank" title="Facebook"><i class="fab fa-tiktok"></i></a>
                                                </li>
                                            @endif  
                                            


                                            @if($AppSetting->as_youtube_profile != "" && $AppSetting->as_youtube_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_youtube_profile}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
                                                </li>
                                            @endif 
                                            </ul>
                                        </div>
                                    </li>

                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-top-area end -->
        
        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo-wrap">
                            <div class="site-logo">
                                <!--<a href="{{url('/')}}"><img src="{{asset(env("APP_LOGO"))}}" alt="{{env("APP_NAME")}} Logo"></a>-->
                                <h2>Ready Rentals Online</h2>
                            </div>
                            <div class="get-support clearfix d-none">
                                <div class="get-support-icon">
                                    <i class="icon-call"></i>
                                </div>
                                <div class="get-support-info">
                                    <h6>Get Support</h6>
                                    <h4><a href="tel:+123456789">123-456-789-10</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col header-menu-column">
                        <div class="header-menu d-none d-xl-block">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li><a href="{{url('/')}}">Home</a></li>
                                        <li><a href="{{url('/about-us')}}">About Us</a></li>
                                        <li><a href="{{url('/our-properties')}}">Our Properties</a></li>
                                        <li class="menu-icon"><a href="#">Apply Now</a>
                                            <ul>
                                                <li><a href="{{url('online-application')}}">Submit Online application</a></li>
                                                <!--<li><a href="{{url('applications/apply-online')}}">Submit Online Application</a></li>-->
                                                <li><a href="{{url('applications/submit-application-form')}}">Print Application</a></li>
                                                <li><a href="{{url('applications/upload-application-form')}}">Upload Application</a></li>
                                            </ul>
                                        </li>                                        
                                        <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col ltn__header-options ltn__header-options-2 mb-sm-20">
                        @if(Auth::check())
                            <div class="ltn__drop-menu user-menu">
                                <ul>
                                    <li>
                                        <a href="#"><i class="icon-user"></i></a>
                                        <ul>
                                            <li><a href="{{url('accounts')}}">Dashboard</a></li>
                                            <li><a href="{{url('accounts/messages')}}">Messages</a></li>
                                            <li><a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>                                            
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @else 
                            <li><a href="{{url('/login')}}">Login</a></li>
                        @endif
 
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-middle-area end -->
    </header>
    <!-- HEADER AREA END -->
 

    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="{{url('/')}}"><img src="{{asset(env("APP_LOGO"))}}" alt="{{env("APP_NAME")}} Logo"></a>
                </div>
                <button class="ltn__utilize-close">×</button>
            </div>
{{--             <div class="ltn__utilize-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div> --}}
            <div class="ltn__utilize-menu">
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About Us</a></li>
                    <li><a href="{{url('/our-properties')}}">Our Properties</a></li>
                    <li><a href="#">Apply Now</a>
                        <ul class="sub-menu">
                            <!--<li><a href="{{url('applications/apply-online')}}">Submit Online Application</a></li>-->
                            <!--<li><a href="{{url('applications/submit-application-form')}}">Submit Offline Application</a></li>-->
                            
                            <li><a href="{{url('online-application')}}">Submit Online application</a></li>
                            <!--<li><a href="{{url('applications/apply-online')}}">Submit Online Application</a></li>-->
                            <li><a href="{{url('applications/submit-application-form')}}">Print Application</a></li>
                            <li><a href="{{url('applications/upload-application-form')}}">Upload Application</a></li>
                                                
                        </ul>
                    </li>                    
                    <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                </ul>
            </div>
 {{--            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>
                    <li>
                        <a href="account.html" title="My Account">
                            <span class="utilize-btn-icon">
                                <i class="far fa-user"></i>
                            </span>
                            My Account
                        </a>
                    </li>
                    <li>
                        <a href="wishlist.html" title="Wishlist">
                            <span class="utilize-btn-icon">
                                <i class="far fa-heart"></i>
                                <sup>3</sup>
                            </span>
                            Wishlist
                        </a>
                    </li>
                    <li>
                        <a href="cart.html" title="Shoping Cart">
                            <span class="utilize-btn-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <sup>5</sup>
                            </span>
                            Shoping Cart
                        </a>
                    </li>
                </ul>
            </div> --}}
            <div class="ltn__social-media-2">
                @if($AppSetting)
                         <ul>
                    @if($AppSetting->as_facebook_profile != "" && $AppSetting->as_facebook_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_facebook_profile}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        @endif

                        @if($AppSetting->as_linkedin_profile != "" && $AppSetting->as_linkedin_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_linkedin_profile}}" target="_blank" title="Facebook"><i class="fab fa-linkedin"></i></a>
                            </li>
                        @endif


                        @if($AppSetting->as_twitter_profile != "" && $AppSetting->as_twitter_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_twitter_profile}}" target="_blank" title="Facebook"><i class="fab fa-twitter"></i></a>
                            </li>
                        @endif


                        @if($AppSetting->as_instagram_profile != "" && $AppSetting->as_instagram_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_instagram_profile}}" target="_blank" title="Facebook"><i class="fab fa-instagram"></i></a>
                            </li>
                        @endif


                        @if($AppSetting->as_tiktok_profile != "" && $AppSetting->as_tiktok_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_tiktok_profile}}" target="_blank" title="Facebook"><i class="fab fa-tiktok"></i></a>
                            </li>
                        @endif  
                        


                        @if($AppSetting->as_youtube_profile != "" && $AppSetting->as_youtube_profile != null)
                            <li>
                                <a href="{{$AppSetting->as_youtube_profile}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
                            </li>
                        @endif 
                        </ul>
                @endif
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->


    @yield('page_content')

     <!-- FOOTER AREA START -->
    <footer class="ltn__footer-area  ">
        <div class="footer-top-area  section-bg-2 plr--5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-about-widget">
{{--                             <div class="footer-logo">
                                <div class="site-logo">
                                    <img src="{{asset(env("APP_LOGO"))}}" alt="{{env("APP_NAME")}} Logo">
                                </div>
                            </div> --}}
                            <h2 style="margin-bottom: 0px;">Ready Rentals</h2>
                            <h5 style="text-align: center;">online.com </h5>

                            <p>With over 30 years of experiance our family owned business is here not only to provide you with housing but make you feel that you are home.</p>
                            @if($AppSetting)

                            <div class="footer-address">
                                <ul>
                                    @if($AppSetting->as_address)
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p>{{$AppSetting->as_address}}</p>
                                        </div>
                                    </li>
                                    @endif

                                    @if($AppSetting->as_phone)
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="tel:{{$AppSetting->as_phone}}">{{$AppSetting->as_phone}}</a></p>
                                        </div>
                                    </li>   
                                    @endif

                                    @if($AppSetting->as_email)
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-mail"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="mailto:{{$AppSetting->as_email}}">{{$AppSetting->as_email}}</a></p>
                                        </div>
                                    </li>
                                    @endif


                                    @if($AppSetting->as_fax)
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="fa fa-fax"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p>{{$AppSetting->as_fax}}</p>
                                        </div>
                                    </li>
                                    @endif


                                </ul>
                            </div>

                            @endif

                            <div class="ltn__social-media mt-20">

                                @if($AppSetting)
                                    <ul>
                                        @if($AppSetting->as_facebook_profile != "" && $AppSetting->as_facebook_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_facebook_profile}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                            @endif

                                            @if($AppSetting->as_linkedin_profile != "" && $AppSetting->as_linkedin_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_linkedin_profile}}" target="_blank" title="Facebook"><i class="fab fa-linkedin"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_twitter_profile != "" && $AppSetting->as_twitter_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_twitter_profile}}" target="_blank" title="Facebook"><i class="fab fa-twitter"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_instagram_profile != "" && $AppSetting->as_instagram_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_instagram_profile}}" target="_blank" title="Facebook"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            @endif


                                            @if($AppSetting->as_tiktok_profile != "" && $AppSetting->as_tiktok_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_tiktok_profile}}" target="_blank" title="Facebook"><i class="fab fa-tiktok"></i></a>
                                                </li>
                                            @endif  
                                            


                                            @if($AppSetting->as_youtube_profile != "" && $AppSetting->as_youtube_profile != null)
                                                <li>
                                                    <a href="{{$AppSetting->as_youtube_profile}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
                                                </li>
                                            @endif 
                                    
                                        </ul>
                                    @endif
 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Company</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{url('about-us')}}">About</a></li>
                                    <li><a href="{{url('our-properties')}}">Our Properties</a></li>
                                    <li><a href="{{url('contact-us')}}">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
  {{--                   <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Services</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="order-tracking.html">Order tracking</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="account.html">My account</a></li>
                                    <li><a href="about.html">Terms & Conditions</a></li>
                                    <li><a href="about.html">Promotional Offers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Customer Care</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="account.html">My account</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="order-tracking.html">Order tracking</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                        <div class="footer-widget footer-newsletter-widget">
                            <h4 class="footer-title">Newsletter</h4>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <div class="footer-newsletter">
                                <form action="#">
                                    <input type="email" name="email" placeholder="Email*">
                                    <div class="btn-wrapper">
                                        <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                    </div>
                                </form>
                            </div>
                            <h5 class="mt-30">We Accept</h5>
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/payment-4.png" alt="Payment Image">
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
            <div class="container-fluid ltn__border-top-2">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="ltn__copyright-design clearfix">
                            <p>All Rights Reserved @ {{env('APP_NAME')}} <span class="current-year"></span></p>
                        </div>
                    </div>
{{--                     <div class="col-md-6 col-12 align-self-center">
                        <div class="ltn__copyright-menu text-end">
                            <ul>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Claim</a></li>
                                <li><a href="#">Privacy & Policy</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

</div>
<!-- Body main wrapper end -->



    <!-- Share Property Modal -->
    <!-- MODAL AREA START (Share Property Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="share_property_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding:17px 62px 4px 38px !important;background-color: #FF5A3C;">
                        <h5 class="modal-title" style="color:white !important;">Share Property with Friends</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="top:5px !important;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 5px !important">
                        <div class="ltn__quick-view-modal-inner">
                            <form id="sharePropertyForm">
                                <input type="hidden" name="property_slug" id="property_slug">
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="modal-product-info">
                                            <div class="mb-0">
                                                <label>Your Name</label>
                                                <input type="text" name="sender_name" class="input_field" required>
                                            </div>
                                            <div class="mb-0">
                                                <label>Your Email</label>
                                                <input type="email" name="sender_email" class="input_field" required>
                                            </div>
                                            <div class="mb-0">
                                                <label>Personal Message (Optional)</label>
                                                <textarea name="message" class="input_field" rows="3" placeholder="Check out this property I found..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="modal-product-info">
                                            <h6>Friend's Email Addresses</h6>
                                            <div class="mb-0">
                                                <input type="email" name="email_1" class="input_field" placeholder="Friend 1 Email" required>
                                            </div>
                                            <div class="mb-0">
                                                <input type="email" name="email_2" class="input_field" placeholder="Friend 2 Email (Optional)">
                                            </div>
                                            <div class="mb-0">
                                                <input type="email" name="email_3" class="input_field" placeholder="Friend 3 Email (Optional)">
                                            </div>
                                            <div class="mb-0">
                                                <input type="email" name="email_4" class="input_field" placeholder="Friend 4 Email (Optional)">
                                            </div>
                                            <div class="mb-0">
                                                <input type="email" name="email_5" class="input_field" placeholder="Friend 5 Email (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="shareSubmitBtn">
                                        <span id="shareSubmitText">Send</span>
                                        <span id="shareSubmitSpinner" class="spinner-border spinner-border-sm d-none"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

 

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="{{asset('resources/front-end-assets')}}/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="{{asset('resources/front-end-assets')}}/js/main.js"></script>
    <script src="{{asset('resources/front-end-assets')}}/js/contact.js"></script>
    <script src="{{asset('resources/front-end-assets')}}/js/application_steps.js"></script>

    @yield('page_level_scripts')


    <script>
        $(document).ready(function() {
            // Bind the submit event of the form
            $('#prop_inqury_form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Clear any previous error messages
                $('.form-text.text-danger').html('');

                // Collect form data
                var formData = new FormData(this);

                // Disable the submit button and change its text
                var submitButton = $('#form-sbm-btn');
                submitButton.prop('disabled', true).text('Submitting...');

                // Perform the AJAX request
                $.ajax({
                    url: $(this).attr('action'),  // Form action
                    type: 'POST',                 // Method type
                    data: formData,               // Form data
                    contentType: false,           // Don't set content type
                    processData: false,           // Don't process the data (important for file uploads)
                    success: function(response) {
                        // Assuming the server returns a JSON response
                        if (response.success) {
                            alert('Your inquiry has been submitted successfully!');
                            // Optionally, clear form fields after success
                            $('#prop_inqury_form')[0].reset();
                        } else {
                            // Show validation errors
                            alert('Somethign went Wrong. Please try again');
                            
                        }

                        // Re-enable the button and reset its text
                        submitButton.prop('disabled', false).text('Send Message');
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Validation error
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                // Display each error in its corresponding span
                                let errorSpan = $('#' + field + '_error');
                                if (errorSpan.length) {
                                    errorSpan.text(errors[field][0]); // Show the first error message
                                }
                            }
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                        // Re-enable the button and reset its text
                        submitButton.prop('disabled', false).text('Send Message');
                    }
                });
            });


        });

    </script>


<script>
$(document).ready(function() {
    // Simple notification fallback
    function showAlert(message, type = 'success') {
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
        } else {
            alert(type.toUpperCase() + ': ' + message);
        }
    }

    // Handle share button click
    $('.share-property-btn').click(function() {
        const propertySlug = $(this).data('property-slug');
        const propertyTitle = $(this).data('property-title');
        
        $('#property_slug').val(propertySlug);
        $('#share_property_modal .modal-title').text(`Share: ${propertyTitle}`);
        $('#share_property_modal').modal('show');
    });

    // Handle form submission
    $('#sharePropertyForm').submit(function(e) {
        e.preventDefault();
        
        const submitBtn = $('#shareSubmitBtn');
        const submitText = $('#shareSubmitText');
        const spinner = $('#shareSubmitSpinner');
        
        // Show loading state
        submitBtn.prop('disabled', true);
        submitText.text('Sending...');
        spinner.removeClass('d-none');
        
        // Collect all email fields
        const emails = [];
        for (let i = 1; i <= 5; i++) {
            const email = $(`input[name="email_${i}"]`).val().trim();
            if (email && validateEmail(email)) {
                emails.push(email);
            }
        }
        
        // Validate at least one email
        if (emails.length === 0) {
            showAlert('Please enter at least one valid email address', 'error');
            resetButtonState();
            return;
        }
        
        // Prepare form data
        const formData = {
            sender_name: $('input[name="sender_name"]').val(),
            sender_email: $('input[name="sender_email"]').val(),
            recipient_emails: emails,
            message: $('textarea[name="message"]').val(),
            property_slug: $('input[name="property_slug"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        // Send AJAX request
        $.ajax({
            url: '{{ route("share.property") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.res_code === 200) {
                    showAlert('Property shared successfully!');
                    setTimeout(() => {
                        $('#share_property_modal').modal('hide');
                    }, 1500);
                } else {
                    showAlert(response.message || 'Failed to share property', 'error');
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'An error occurred';
                showAlert(errorMsg, 'error');
            },
            complete: function() {
                resetButtonState();
            }
        });

        // Helper function to reset button state
        function resetButtonState() {
            submitBtn.prop('disabled', false);
            submitText.text('Send');
            spinner.addClass('d-none');
        }
    });

    // Email validation helper
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Reset form when modal closes
    $('#share_property_modal').on('hidden.bs.modal', function() {
        $('#sharePropertyForm')[0].reset();
        $('#shareSubmitBtn').prop('disabled', false);
        $('#shareSubmitText').text('Send');
        $('#shareSubmitSpinner').addClass('d-none');
    });
    
    
    function showAlert(message, type = 'success') {
            console.log(type + ': ' + message);
            // Or completely remove notifications if not needed
        }

});
</script>







</body>


</html>

