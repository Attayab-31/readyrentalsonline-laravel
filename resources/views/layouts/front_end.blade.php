<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $page_title ?? '' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#10253a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <script>document.documentElement.classList.add('rr-js');</script>
    @include('partials.page-preloader-handoff')

    <!-- Favicon and Brand Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ filemtime(public_path('favicon-32x32.png')) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}?v={{ filemtime(public_path('logo/apple-touch-icon.png')) }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v={{ filemtime(public_path('manifest.webmanifest')) }}">
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/responsive.css?v={{ filemtime(public_path('resources/front-end-assets/css/responsive.css')) }}">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/application_steps.css?v={{ filemtime(public_path('resources/front-end-assets/css/application_steps.css')) }}">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/upload-application.css?v={{ filemtime(public_path('resources/front-end-assets/css/upload-application.css')) }}">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/print-application.css?v={{ filemtime(public_path('resources/front-end-assets/css/print-application.css')) }}">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/property-ui.css">
    <link rel="stylesheet" href="{{asset('resources/front-end-assets')}}/css/modern-theme.css">
    <link rel="stylesheet" href="{{ asset('resources/front-end-assets/css/loading-states.css') }}?v={{ filemtime(public_path('resources/front-end-assets/css/loading-states.css')) }}">

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
    @include('partials.page-preloader')
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">

    <!-- HEADER AREA START (header-5) -->
    <header class="ltn__header-area ltn__header-5 ltn__header-transparent--- gradient-color-4---">
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area rr-utility-bar">
            @php
                $utilityPhone = $AppSetting?->as_phone ?: '1-267-549-9625';
                $utilityEmail = $AppSetting?->as_email ?: 'info@readyrentalsonline.com';
            @endphp
            <div class="container">
                <div class="rr-utility-inner">
                    <div class="rr-utility-message" role="note">
                        <span class="rr-utility-mark" aria-hidden="true"><i class="fas fa-home"></i></span>
                        <span>Family-owned rentals <span class="rr-utility-message-separator">·</span> 30+ years serving South Jersey</span>
                    </div>

                    <div class="rr-utility-actions">
                        @if($utilityPhone)
                            <a class="rr-utility-link" href="tel:{{ $utilityPhone }}">
                                <span class="rr-utility-icon" aria-hidden="true"><i class="icon-call"></i></span>
                                <span class="rr-utility-copy"><span>Call our team</span><strong>{{ $utilityPhone }}</strong></span>
                            </a>
                        @endif

                        @if($utilityEmail)
                            <a class="rr-utility-link rr-utility-email" href="mailto:{{ $utilityEmail }}" aria-label="Email {{ $utilityEmail }}" title="{{ $utilityEmail }}">
                                <span class="rr-utility-icon" aria-hidden="true"><i class="icon-mail"></i></span>
                                <span class="rr-utility-copy"><span>Email our team</span><strong>{{ $utilityEmail }}</strong></span>
                            </a>
                        @endif

                        @if($AppSetting)
                            <div class="rr-utility-social" role="group" aria-label="Social media">
                                @if($AppSetting->as_facebook_profile)
                                    <a href="{{ $AppSetting->as_facebook_profile }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                @endif
                                @if($AppSetting->as_linkedin_profile)
                                    <a href="{{ $AppSetting->as_linkedin_profile }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" title="LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                @endif
                                @if($AppSetting->as_twitter_profile)
                                    <a href="{{ $AppSetting->as_twitter_profile }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter" title="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                @endif
                                @if($AppSetting->as_instagram_profile)
                                    <a href="{{ $AppSetting->as_instagram_profile }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                @endif
                                @if($AppSetting->as_tiktok_profile)
                                    <a href="{{ $AppSetting->as_tiktok_profile }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" title="TikTok"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
                                @endif
                                @if($AppSetting->as_youtube_profile)
                                    <a href="{{ $AppSetting->as_youtube_profile }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube" title="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                                @endif
                            </div>
                        @endif
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
                                <a href="{{url('/')}}" class="rr-brand-logo-wrap" title="{{config('app.name')}}">
                                    <img src="{{asset('logo/ready_rentals_light.svg')}}" alt="{{config('app.name')}}" class="rr-brand-logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col header-menu-column">
                        <div class="header-menu d-none d-xl-block">
                            <nav aria-label="Primary navigation">
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li><a href="{{url('/')}}">Home</a></li>
                                        <li><a href="{{url('/about-us')}}">About Us</a></li>
                                        <li><a href="{{url('/our-properties')}}">Our Properties</a></li>
                                        <li class="menu-icon"><a href="#">Apply Now</a>
                                            <ul>
                                                <li><a href="{{url('online-application')}}"><i class="fas fa-laptop me-2"></i> Submit Online Application</a></li>
                                                <li><a href="{{url('applications/submit-application-form')}}"><i class="fas fa-file-pdf me-2"></i> Print Application</a></li>
                                                <li><a href="{{url('applications/upload-application-form')}}"><i class="fas fa-upload me-2"></i> Upload Application</a></li>
                                            </ul>
                                        </li>                                        
                                        <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col ltn__header-options ltn__header-options-2 mb-sm-20 d-flex align-items-center justify-content-end gap-3">
                        @if(Auth::check())
                            <div class="ltn__drop-menu user-menu">
                                <ul>
                                    <li>
                                        <button type="button" class="rr-nav-login-link rr-account-menu-trigger" aria-expanded="false" aria-controls="rr-account-menu">
                                            <i class="icon-user" aria-hidden="true"></i>
                                            <span>My Account</span>
                                            <i class="fas fa-chevron-down rr-account-menu-caret" aria-hidden="true"></i>
                                        </button>
                                        <ul id="rr-account-menu" class="rr-account-menu" aria-label="Account navigation">
                                            <li><a href="{{ route('AccountController.index') }}"><i class="fas fa-tachometer-alt me-2" aria-hidden="true"></i> Dashboard</a></li>
                                            <li><a href="{{ route('chat.index') }}"><i class="fas fa-envelope me-2" aria-hidden="true"></i> Messages</a></li>
                                            <li>
                                                <a href="{{ route('logout') }}" data-rr-page-preloader-trigger data-rr-page-preloader-home-handoff data-rr-page-preloader-submit-form="logout-form" data-rr-preloader-message="Signing you out securely…"><i class="fas fa-sign-out-alt me-2" aria-hidden="true"></i> Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" data-rr-page-preloader data-rr-preloader-message="Signing you out securely…">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @else 
                            <a href="{{url('/login')}}" class="rr-nav-login-link" data-rr-page-preloader-trigger data-rr-preloader-message="Opening your secure sign-in…"><i class="far fa-user me-1"></i> Login</a>
                        @endif
 
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle" aria-label="Open menu" aria-controls="ltn__utilize-mobile-menu" aria-expanded="false">
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
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu" role="navigation" aria-label="Mobile primary navigation" aria-hidden="true" inert>
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="{{url('/')}}" class="rr-brand-logo-wrap" title="{{config('app.name')}}">
                        <img src="{{asset('logo/ready_rentals_light.svg')}}" alt="{{config('app.name')}}" class="rr-brand-logo">
                    </a>
                </div>
                <button type="button" class="ltn__utilize-close" aria-label="Close navigation menu">×</button>
            </div>
{{--             <div class="ltn__utilize-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div> --}}
            <nav class="ltn__utilize-menu" aria-label="Mobile site links">
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About Us</a></li>
                    <li><a href="{{url('/our-properties')}}">Our Properties</a></li>
                    <li><a href="#" aria-expanded="false" aria-controls="rr-mobile-apply-menu">Apply Now</a>
                        <ul id="rr-mobile-apply-menu" class="sub-menu" aria-hidden="true">
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
            </nav>
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
     <!-- FOOTER AREA START -->
    <footer class="ltn__footer-area rr-footer">
        <div class="footer-top-area section-bg-2 plr--5">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-widget footer-about-widget">
                            <div class="footer-logo mb-25 rr-footer-brand-logo">
                                <a href="{{url('/')}}">
                                    <img src="{{asset('logo/ready_rentals_dark.svg')}}" alt="{{config('app.name')}}" class="rr-footer-logo">
                                </a>
                            </div>
                            <p class="mb-20 rr-footer-about-copy">With over 30 years of experience, our family-owned business provides quality rental homes throughout South Jersey and beyond—dedicated to making you feel truly at home.</p>

                            @if($AppSetting)
                            <div class="ltn__social-media mt-20">
                                <ul>
                                    @if($AppSetting->as_facebook_profile)
                                        <li><a href="{{$AppSetting->as_facebook_profile}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif
                                    @if($AppSetting->as_linkedin_profile)
                                        <li><a href="{{$AppSetting->as_linkedin_profile}}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a></li>
                                    @endif
                                    @if($AppSetting->as_twitter_profile)
                                        <li><a href="{{$AppSetting->as_twitter_profile}}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if($AppSetting->as_instagram_profile)
                                        <li><a href="{{$AppSetting->as_instagram_profile}}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if($AppSetting->as_tiktok_profile)
                                        <li><a href="{{$AppSetting->as_tiktok_profile}}" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a></li>
                                    @endif
                                    @if($AppSetting->as_youtube_profile)
                                        <li><a href="{{$AppSetting->as_youtube_profile}}" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title rr-footer-title">Navigation</h4>
                            <div class="footer-menu">
                                <ul class="rr-footer-links">
                                    <li><a href="{{url('/')}}"><i class="fas fa-angle-right me-1"></i> Home</a></li>
                                    <li><a href="{{url('about-us')}}"><i class="fas fa-angle-right me-1"></i> About Us</a></li>
                                    <li><a href="{{url('our-properties')}}"><i class="fas fa-angle-right me-1"></i> Our Properties</a></li>
                                    <li><a href="{{url('contact-us')}}"><i class="fas fa-angle-right me-1"></i> Contact Us</a></li>
                                    <li><a href="{{url('terms-and-conditions-for-applications')}}"><i class="fas fa-angle-right me-1"></i> Terms & Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title rr-footer-title">Apply & Services</h4>
                            <div class="footer-menu">
                                <ul class="rr-footer-links">
                                    <li><a href="{{url('online-application')}}"><i class="fas fa-laptop me-1"></i> Submit Online Application</a></li>
                                    <li><a href="{{url('applications/submit-application-form')}}"><i class="fas fa-file-pdf me-1"></i> Print / Download Form</a></li>
                                    <li><a href="{{url('applications/upload-application-form')}}"><i class="fas fa-upload me-1"></i> Upload Completed Form</a></li>
                                    <li><a href="{{url('contact-us')}}"><i class="fas fa-hand-holding-usd me-1"></i> Sell Your Home for Cash</a></li>
                                    <li><a href="{{url('login')}}"><i class="fas fa-user-lock me-1"></i> Tenant Portal Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="footer-widget footer-address-widget clearfix">
                            <h4 class="footer-title rr-footer-title">Direct Office</h4>
                            <ul class="rr-footer-contact-list">
                                @if($AppSetting && $AppSetting->as_address)
                                <li>
                                    <i class="icon-placeholder"></i>
                                    <span>{{$AppSetting->as_address}}</span>
                                </li>
                                @else
                                <li>
                                    <i class="icon-placeholder"></i>
                                    <span>1742 Delsea Drive, Deptford NJ 08096</span>
                                </li>
                                @endif

                                @if($AppSetting && $AppSetting->as_phone)
                                <li>
                                    <i class="icon-call"></i>
                                    <span><a href="tel:{{$AppSetting->as_phone}}">{{$AppSetting->as_phone}}</a></span>
                                </li>
                                @else
                                <li>
                                    <i class="icon-call"></i>
                                    <span><a href="tel:1-267-549-9625">1-267-549-9625</a></span>
                                </li>
                                @endif

                                @if($AppSetting && $AppSetting->as_email)
                                <li>
                                    <i class="icon-mail"></i>
                                    <span><a href="mailto:{{$AppSetting->as_email}}">{{$AppSetting->as_email}}</a></span>
                                </li>
                                @else
                                <li>
                                    <i class="icon-mail"></i>
                                    <span><a href="mailto:info@readyrentalsonline.com">info@readyrentalsonline.com</a></span>
                                </li>
                                @endif

                                @if($AppSetting && $AppSetting->as_fax)
                                <li>
                                    <i class="fa fa-fax"></i>
                                    <span>Fax: {{$AppSetting->as_fax}}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ltn__copyright-area ltn__copyright-2 section-bg-7 rr-footer-bottom plr--5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-12">
                        <div class="ltn__copyright-design">
                            <p>&copy; {{ date('Y') }} <strong>Ready Rentals Online</strong>. All Rights Reserved. Equal Housing Opportunity.</p>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 text-md-end mt-2 mt-md-0">
                        <div class="footer-extra-links" style="font-size: 13px; color: rgba(255,255,255,0.6);">
                            <a href="{{url('terms-and-conditions-for-applications')}}" class="text-white-50 me-3">Terms & Conditions</a>
                            <a href="{{url('contact-us')}}" class="text-white-50 me-3">Contact</a>
                            <a href="{{url('login')}}" class="text-white-50">Portal Login</a>
                        </div>
                    </div>
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
                <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--rr-line);">
                    <div class="modal-header" style="padding: 18px 30px !important; background-color: var(--rr-navy-700); border-bottom: none;">
                        <h5 class="modal-title" style="color: white !important; font-weight: 700;"><i class="fas fa-share-alt me-2"></i> Share Property with Friends</h5>
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close" style="top: 18px !important; right: 24px; color: white !important; opacity: 0.9; background: transparent; border: none; font-size: 24px;">
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
                                                <label for="share_sender_name">Your Name *</label>
                                                <input type="text" id="share_sender_name" name="sender_name" class="input_field" autocomplete="name" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_sender_email">Your Email *</label>
                                                <input type="email" id="share_sender_email" name="sender_email" class="input_field" autocomplete="email" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_message">Personal Message (Optional)</label>
                                                <textarea id="share_message" name="message" class="input_field" rows="3" placeholder="Check out this property I found..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="modal-product-info">
                                            <h6>Friend's Email Addresses</h6>
                                            <div class="mb-0">
                                                <label for="share_email_1">Friend 1 Email *</label>
                                                <input type="email" id="share_email_1" name="email_1" class="input_field" placeholder="name@example.com" required>
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_email_2">Friend 2 Email (Optional)</label>
                                                <input type="email" id="share_email_2" name="email_2" class="input_field" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_email_3">Friend 3 Email (Optional)</label>
                                                <input type="email" id="share_email_3" name="email_3" class="input_field" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_email_4">Friend 4 Email (Optional)</label>
                                                <input type="email" id="share_email_4" name="email_4" class="input_field" placeholder="name@example.com">
                                            </div>
                                            <div class="mb-0">
                                                <label for="share_email_5">Friend 5 Email (Optional)</label>
                                                <input type="email" id="share_email_5" name="email_5" class="input_field" placeholder="name@example.com">
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
    <script src="{{asset('resources/front-end-assets')}}/js/main.js?v={{ filemtime(public_path('resources/front-end-assets/js/main.js')) }}"></script>
    <script src="{{ asset('resources/front-end-assets/js/loading-states.js') }}?v={{ filemtime(public_path('resources/front-end-assets/js/loading-states.js')) }}"></script>
    <script src="{{asset('resources/front-end-assets')}}/js/contact.js?v={{ filemtime(public_path('resources/front-end-assets/js/contact.js')) }}"></script>
    <script src="{{asset('resources/front-end-assets')}}/js/application_steps.js?v={{ filemtime(public_path('resources/front-end-assets/js/application_steps.js')) }}"></script>

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
                        if (response && response.res_code === 200) {
                            $('#form_res').html(response.res_msg_markup).show();
                            $('#prop_inqury_form')[0].reset();
                        } else if (response && response.res_msg_markup) {
                            $('#form_res').html(response.res_msg_markup).show();
                        } else {
                            alert('Your inquiry could not be submitted. Please try again.');
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
        
        const submitBtn = document.getElementById('shareSubmitBtn');
        RRButtonLoading.start(submitBtn, 'Sending…');
        
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
            RRButtonLoading.stop(submitBtn);
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
        RRButtonLoading.stop(document.getElementById('shareSubmitBtn'));
    });
    
    
    function showAlert(message, type = 'success') {
            console.log(type + ': ' + message);
            // Or completely remove notifications if not needed
        }

});
</script>

@auth
<script>
document.addEventListener('DOMContentLoaded', function () {
    const accountMenu = document.querySelector('.user-menu');
    const accountTrigger = accountMenu?.querySelector('.rr-account-menu-trigger');

    if (!accountMenu || !accountTrigger) return;

    function closeAccountMenu() {
        accountMenu.classList.remove('is-open');
        accountTrigger.setAttribute('aria-expanded', 'false');
    }

    accountTrigger.addEventListener('click', function () {
        const isOpen = accountMenu.classList.toggle('is-open');
        accountTrigger.setAttribute('aria-expanded', String(isOpen));
    });

    document.addEventListener('click', function (event) {
        if (!accountMenu.contains(event.target)) closeAccountMenu();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAccountMenu();
            accountTrigger.focus();
        }
    });
});
</script>
@endauth







</body>


</html>
