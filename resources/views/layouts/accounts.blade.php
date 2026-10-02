<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar-size="lg" data-sidebar="dark" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>{{$page_title ?? "Admin"}} · {{ config('app.name', 'Ready Rentals Online') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Ready Rentals Online - Client & Admin Portal" name="description" />
    <meta content="Ready Rentals Online" name="author" />
    <meta name="theme-color" content="#10253a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <script>document.documentElement.classList.add('rr-js');</script>
    <script>
        (function () {
            var savedTheme = localStorage.getItem('rr-account-theme');
            var preferredTheme = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme || preferredTheme);
        })();
    </script>

    <!-- Favicon and Brand Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ filemtime(public_path('favicon-32x32.png')) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}?v={{ filemtime(public_path('logo/apple-touch-icon.png')) }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v={{ filemtime(public_path('manifest.webmanifest')) }}">

    @if(request()->is('accounts/users*', 'accounts/invoices*'))
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endif
    <link href="{{asset('controlPanel')}}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('controlPanel')}}/js/layout.js"></script>
    <script>document.documentElement.setAttribute('data-sidebar-size', 'lg');</script>
    <link href="{{asset('controlPanel')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('controlPanel/css/responsive-overrides.css') }}?v={{ filemtime(public_path('controlPanel/css/responsive-overrides.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('controlPanel/css/portal-modern-theme.css') }}?v={{ filemtime(public_path('controlPanel/css/portal-modern-theme.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/front-end-assets/css/loading-states.css') }}?v={{ filemtime(public_path('resources/front-end-assets/css/loading-states.css')) }}" rel="stylesheet" type="text/css" />

    @yield('styles')


    {{-- Custom Styles --}}
    <style>
        .navbar-menu .navbar-nav .nav-link i {
            display: inline-block;
            min-width: 1.4rem;
            font-size: 18px;
            line-height: inherit;
        }

        .form-label {
            margin-bottom: .2rem !important;
        }


    </style>

</head>

<body>
    @include('partials.page-preloader')

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle rr-admin-menu-toggle" id="admin-menu-toggle" aria-label="Open navigation menu" aria-controls="admin-sidebar" aria-expanded="false" title="Open navigation menu">
                        <i class="bx bx-menu fs-22" aria-hidden="true"></i>
                    </button>
                    <div class="rr-admin-header-datetime" aria-label="Current date and time">
                        <span id="current-date-time"></span>
                    </div>
                    <div class="d-flex align-items-center">

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="admin-fullscreen-toggle" data-toggle="fullscreen" aria-label="Enter full screen" title="Enter full screen" aria-pressed="false">
                                <i class="bx bx-fullscreen fs-22" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode" aria-label="Toggle dark mode" title="Toggle dark mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
 
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->getProfilePicture(Auth::user()->profile_picture)}}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow-sm">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome {{Auth::user()->first_name}}!</h6>
                                <a class="dropdown-item" href="{{url('accounts/edit-profile')}}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">My Profile</span></a>
                                <a class="dropdown-item" href="{{url('/')}}" target="_blank"><i class="mdi mdi-web text-muted fs-16 align-middle me-1"></i> <span class="align-middle">View Public Website</span></a>
                                <div class="dropdown-divider"></div>
                                @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                                <form method="post" action="{{url('accounts/caches/clear-app-cache')}}">@csrf<button class="dropdown-item" type="submit"><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Clear App Cache</span></button></form>
                                <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item text-danger" href="#0" data-rr-page-preloader-trigger data-rr-page-preloader-home-handoff data-rr-page-preloader-submit-form="logout-form" data-rr-preloader-message="Signing you out securely…"><i class="mdi mdi-logout text-danger fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

 
        <!-- ========== App Menu ========== -->
        @php
            $isDashboardPage = request()->is('accounts');
            $isUsersPage = request()->is('accounts/users*');
            $isPropertiesPage = request()->is('accounts/properties*');
            $isInvoicesPage = request()->is('accounts/invoices*');
            $isMessagesPage = request()->is('accounts/chat*');
            $isErrorsPage = request()->is('accounts/log-viewer*');
        @endphp
        <div class="app-menu navbar-menu" id="admin-sidebar">
            <div class="rr-sidebar-brand">
                <a href="{{url('accounts')}}" aria-label="{{config('app.name', 'Ready Rentals')}} dashboard">
                    <img src="{{asset('logo/ready_rentals_dark.svg')}}" alt="{{config('app.name', 'Ready Rentals')}}">
                </a>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link{{ $isDashboardPage ? ' active' : '' }}" href="{{url('accounts')}}" role="link" @if($isDashboardPage) aria-current="page" @endif>
                                <i class="bx bx-home"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                        
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link menu-link{{ $isUsersPage ? ' active' : '' }}" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isUsersPage ? 'true' : 'false' }}" aria-controls="sidebarApps">
                                    <i class="bx bx-user"></i> <span data-key="t-apps">Users</span>
                                </a>
                                <div class="collapse menu-dropdown{{ $isUsersPage ? ' show' : '' }}" id="sidebarApps">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{url('accounts/users')}}" class="nav-link{{ (request()->is('accounts/users*') && !request()->is('accounts/users/create')) ? ' active' : '' }}" @if((request()->is('accounts/users*') && !request()->is('accounts/users/create'))) aria-current="page" @endif data-key="t-api-key">View all users</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/users/create')}}" class="nav-link{{ request()->is('accounts/users/create') ? ' active' : '' }}" @if(request()->is('accounts/users/create')) aria-current="page" @endif data-key="t-chat"> Create new user </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                    
                            <li class="nav-item">
                                <a class="nav-link menu-link{{ $isPropertiesPage ? ' active' : '' }}" href="#sidebarProperties" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isPropertiesPage ? 'true' : 'false' }}" aria-controls="sidebarProperties">
                                    <i class="bx bx-building-house"></i> <span data-key="t-apps">Properties</span>
                                </a>
                                <div class="collapse menu-dropdown{{ $isPropertiesPage ? ' show' : '' }}" id="sidebarProperties">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties')}}" class="nav-link{{ (request()->is('accounts/properties*') && !request()->is('accounts/properties/create', 'accounts/properties/applications')) ? ' active' : '' }}" @if((request()->is('accounts/properties*') && !request()->is('accounts/properties/create', 'accounts/properties/applications'))) aria-current="page" @endif data-key="t-api-key">View all Properties</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties/create')}}" class="nav-link{{ request()->is('accounts/properties/create') ? ' active' : '' }}" @if(request()->is('accounts/properties/create')) aria-current="page" @endif data-key="t-chat"> Create new Property </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties/applications')}}" class="nav-link{{ request()->is('accounts/properties/applications') ? ' active' : '' }}" @if(request()->is('accounts/properties/applications')) aria-current="page" @endif data-key="t-chat"> Applications </a>
                                        </li>                                    
                                    </ul>
                                </div>
                            </li>
                        @endif
                    
                        <li class="nav-item">
                            <a class="nav-link menu-link{{ $isInvoicesPage ? ' active' : '' }}" href="#sidebarInvoices" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isInvoicesPage ? 'true' : 'false' }}" aria-controls="sidebarInvoices">
                                <i class="bx bx-receipt"></i> <span data-key="t-apps">Invoices</span>
                            </a>
                            <div class="collapse menu-dropdown{{ $isInvoicesPage ? ' show' : '' }}" id="sidebarInvoices">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('accounts/invoices')}}" class="nav-link{{ (request()->is('accounts/invoices*') && !request()->is('accounts/invoices/create')) ? ' active' : '' }}" @if((request()->is('accounts/invoices*') && !request()->is('accounts/invoices/create'))) aria-current="page" @endif data-key="t-api-key">View all invoices</a>
                                    </li>
                                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                                        <li class="nav-item">
                                            <a href="{{url('accounts/invoices/create')}}" class="nav-link{{ request()->is('accounts/invoices/create') ? ' active' : '' }}" @if(request()->is('accounts/invoices/create')) aria-current="page" @endif data-key="t-chat"> Create new Invoice </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link menu-link{{ $isMessagesPage ? ' active' : '' }}" href="{{url('accounts/chat')}}" role="link" @if($isMessagesPage) aria-current="page" @endif>
                                <i class="bx bx-envelope"></i> <span data-key="t-dashboards">Message Board</span>
                            </a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link menu-link{{ $isErrorsPage ? ' active' : '' }}" href="#sidebarMore" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isErrorsPage ? 'true' : 'false' }}" aria-controls="sidebarMore">
                                <i class="bx bx-dots-horizontal-rounded"></i> <span>More</span>
                            </a>
                            <div class="collapse menu-dropdown{{ $isErrorsPage ? ' show' : '' }}" id="sidebarMore">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Public Home Page</a></li>
                                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                                    <li class="nav-item"><a href="{{url('/accounts/log-viewer')}}" class="nav-link{{ $isErrorsPage ? ' active' : '' }}" @if($isErrorsPage) aria-current="page" @endif>Errors Log</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    </ul>
                    
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <button type="button" class="rr-admin-sidebar-backdrop" id="admin-sidebar-backdrop" aria-label="Close navigation menu" tabindex="-1"></button>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @php
                        $breadcrumbItems = [['label' => 'Dashboard', 'url' => url('accounts')]];

                        if ($isDashboardPage) {
                            $breadcrumbItems[0]['url'] = null;
                        } elseif ($isUsersPage) {
                            if (request()->is('accounts/users/create')) {
                                $breadcrumbItems[] = ['label' => 'Users', 'url' => url('accounts/users')];
                                $breadcrumbItems[] = ['label' => 'Create user', 'url' => null];
                            } elseif (request()->is('accounts/users/*/edit')) {
                                $breadcrumbItems[] = ['label' => 'Users', 'url' => url('accounts/users')];
                                $breadcrumbItems[] = ['label' => 'Edit user', 'url' => null];
                            } elseif (request()->is('accounts/users/*')) {
                                $breadcrumbItems[] = ['label' => 'Users', 'url' => url('accounts/users')];
                                $breadcrumbItems[] = ['label' => 'User profile', 'url' => null];
                            } else {
                                $breadcrumbItems[] = ['label' => 'Users', 'url' => null];
                            }
                        } elseif ($isPropertiesPage) {
                            if (request()->is('accounts/properties/applications')) {
                                $breadcrumbItems[] = ['label' => 'Properties', 'url' => url('accounts/properties')];
                                $breadcrumbItems[] = ['label' => 'Applications', 'url' => null];
                            } elseif (request()->is('accounts/properties/view-application-details/*')) {
                                $breadcrumbItems[] = ['label' => 'Properties', 'url' => url('accounts/properties')];
                                $breadcrumbItems[] = ['label' => 'Applications', 'url' => url('accounts/properties/applications')];
                                $breadcrumbItems[] = ['label' => 'Application details', 'url' => null];
                            } elseif (request()->is('accounts/properties/create')) {
                                $breadcrumbItems[] = ['label' => 'Properties', 'url' => url('accounts/properties')];
                                $breadcrumbItems[] = ['label' => 'Add property', 'url' => null];
                            } elseif (request()->is('accounts/properties/*/edit')) {
                                $breadcrumbItems[] = ['label' => 'Properties', 'url' => url('accounts/properties')];
                                $breadcrumbItems[] = ['label' => 'Edit property', 'url' => null];
                            } else {
                                $breadcrumbItems[] = ['label' => 'Properties', 'url' => null];
                            }
                        } elseif ($isInvoicesPage) {
                            if (request()->is('accounts/invoices/create')) {
                                $breadcrumbItems[] = ['label' => 'Invoices', 'url' => url('accounts/invoices')];
                                $breadcrumbItems[] = ['label' => 'Create invoice', 'url' => null];
                            } elseif (request()->is('accounts/invoices/edit/*')) {
                                $breadcrumbItems[] = ['label' => 'Invoices', 'url' => url('accounts/invoices')];
                                $breadcrumbItems[] = ['label' => 'Edit invoice', 'url' => null];
                            } elseif (request()->is('accounts/invoices/view/*')) {
                                $breadcrumbItems[] = ['label' => 'Invoices', 'url' => url('accounts/invoices')];
                                $breadcrumbItems[] = ['label' => 'Invoice details', 'url' => null];
                            } else {
                                $breadcrumbItems[] = ['label' => 'Invoices', 'url' => null];
                            }
                        } elseif ($isMessagesPage) {
                            $breadcrumbItems[] = ['label' => 'Message board', 'url' => null];
                        } elseif (request()->is('accounts/edit-profile')) {
                            $breadcrumbItems[] = ['label' => 'My profile', 'url' => null];
                        }
                    @endphp
                    <nav class="rr-admin-breadcrumb rr-admin-page-breadcrumb" aria-label="Breadcrumb">
                        <ol>
                            @foreach ($breadcrumbItems as $item)
                                <li @if ($loop->last) class="is-current" aria-current="page" @endif>
                                    @if (!empty($item['url']) && !$loop->last)
                                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                                    @else
                                        <span>{{ $item['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                    @include('partials.control_panel_alert_notifications')
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            ReadyRentalsOnline &copy; {{date('Y')}}. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </footer>
             
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
 
    {{-- Logout Form  --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" data-rr-page-preloader data-rr-preloader-message="Signing you out securely…">
        @csrf
    </form>


    <!-- JAVASCRIPT -->
    <script src="{{asset('controlPanel')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/node-waves/waves.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/feather-icons/feather.min.js"></script>
    <script src="{{asset('controlPanel')}}/js/pages/plugins/lord-icon-2.1.0.js"></script>


    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('resources/front-end-assets/js/loading-states.js') }}?v={{ filemtime(public_path('resources/front-end-assets/js/loading-states.js')) }}"></script>

    @if(request()->is('accounts/users*', 'accounts/invoices*'))
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endif
    <script src="{{asset('controlPanel')}}/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('controlPanel')}}/js/pages/sweetalerts.init.js"></script>
    <script src="{{ asset('controlPanel/js/app.js') }}?v={{ filemtime(public_path('controlPanel/js/app.js')) }}"></script>
    <script src="{{asset('controlPanel')}}/customJs.js"></script>
		<!--end::Javascript-->
    @if(request()->is('accounts/properties/create', 'accounts/properties/*/edit'))
    <script src="{{asset('controlPanel')}}/multi-img-picker/spartan-multi-image-picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endif



    <script>
        // Initialize select2 elements on document ready
        $(document).ready(function() {
 
            function updateDateTime() {
                var clock = document.getElementById('current-date-time');
                if (!clock) return;

                var now = new Date();
                var compact = window.innerWidth <= 1199;
                var options = {
                    weekday: compact ? 'short' : 'long',
                    year: 'numeric',
                    month: compact ? 'short' : 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    ...(compact ? {} : { second: 'numeric' }),
                    hour12: true
                };
                clock.textContent = now.toLocaleString(undefined, options);
            }

            updateDateTime();
            window.setInterval(updateDateTime, 1000);
            window.addEventListener('resize', updateDateTime);

            if ($.fn.select2) {
                $(".js-example-basic-single").select2({ minimumResultsForSearch: Infinity });
            }
 



            window.confirm_soft_delete = function(event) {
                event.preventDefault();
                var urlToRedirect = event.currentTarget.getAttribute('href'); 
                
                Swal.fire({
                    text: "Are you sure you want to delete this record?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if(result.value) {
                        window.location.href = urlToRedirect;
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Actions Cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            };
         


            window.activate_confirmation = function(event) {
                event.preventDefault();
                var urlToRedirect = event.currentTarget.getAttribute('href'); 
                
                Swal.fire({
                    text: "Are you sure you want to mark this record as Active?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, Mark as Active!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-success",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if(result.value) {
                        window.location.href = urlToRedirect;
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Actions Cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            };
 

            window.inactivate_confirmation = function(event) {
                event.preventDefault();
                var urlToRedirect = event.currentTarget.getAttribute('href'); 
                
                Swal.fire({
                    text: "Are you sure you want to mark this record as In-Active?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, Mark as InActive!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if(result.value) {
                        window.location.href = urlToRedirect;
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Actions Cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            };


            window.tinymce && window.tinymce.init({
               selector: '.tinymceEditor',
               height: 400,
               menubar: false,
               plugins: 'lists link',
               toolbar: 'bold italic underline | bullist numlist | link',
               toolbar_mode: 'wrap',
               statusbar: false,
               content_css: '//www.tiny.cloud/css/codepen.min.css',
               images_upload_url: '',  // Remove or leave empty as we won't use this
               automatic_uploads: false,
               file_picker_types: 'image',
               file_picker_callback: function(cb, value, meta) {
                     if (meta.filetype == 'image') {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('placeholder', 'Enter image URL');
                        
                        input.onchange = function() {
                           cb(input.value, { title: 'Image' });
                        };
                        
                        input.click();
                     }
               },
               paste_data_images: true,
               relative_urls: false,
               remove_script_host: false,
               convert_urls: true,
               menubar: false,
               link_class_list: [
                     { title: 'postLink', value: 'postLink' }
               ],
               setup: function(editor) {
                     editor.on('ExecCommand', function(e) {
                        if (e.command === 'mceInsertLink') {
                           setTimeout(function() {
                                 var links = editor.dom.select('a[href]:not([class])');
                                 tinymce.each(links, function(link) {
                                    editor.dom.setAttrib(link, 'class', 'postLink');
                                 });
                           }, 0);
                        }
                     });
               }
            });
 



            window.tinymce && window.tinymce.init({
               selector: '.tinymceEditorSimple',
               height: 400,
               menubar: true,
               plugins: 'advlist autolink lists link  charmap preview anchor searchreplace visualblocks  fullscreen insertdatetime table wordcount',
               toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media | code',
               content_css: '//www.tiny.cloud/css/codepen.min.css',
               images_upload_url: '',  // Remove or leave empty as we won't use this
               automatic_uploads: false,
               file_picker_types: 'image',
               file_picker_callback: function(cb, value, meta) {
                     if (meta.filetype == 'image') {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('placeholder', 'Enter image URL');
                        
                        input.onchange = function() {
                           cb(input.value, { title: 'Image' });
                        };
                        
                        input.click();
                     }
               },
               paste_data_images: true,
               relative_urls: false,
               remove_script_host: false,
               convert_urls: true,
               menubar: 'file edit view insert format tools table help',
               link_class_list: [
                     { title: 'postLink', value: 'postLink' }
               ],
               setup: function(editor) {
                     editor.on('ExecCommand', function(e) {
                        if (e.command === 'mceInsertLink') {
                           setTimeout(function() {
                                 var links = editor.dom.select('a[href]:not([class])');
                                 tinymce.each(links, function(link) {
                                    editor.dom.setAttrib(link, 'class', 'postLink');
                                 });
                           }, 0);
                        }
                     });
               }
            });

        });


        
        function showAjaxAlert(type, heading, message) {
            // Map alert types to Bootstrap classes
            const alertClasses = {
                success: 'alert-success',
                error: 'alert-danger',
                warning: 'alert-warning',
            };

            // Remove any existing alert classes and add the new one
            const alert = $('#ajax-alert');
            alert
                .removeClass('alert-success alert-danger alert-warning')
                .addClass(alertClasses[type]);

            // Set the heading and message
            $('#ajax-alert-heading').text(heading);
            $('#ajax-alert-message').text(message);

            // Show the alert
            alert.fadeIn().addClass('show');

            // Auto-hide the alert after 5 seconds
            setTimeout(function () {
                alert.fadeOut().removeClass('show');
            }, 5000);
        }

    </script>

    @yield('scripts')

    <script>
        (function () {
            var root = document.documentElement;
            var buttons = document.querySelectorAll('.light-dark-mode');

            function syncThemeControls() {
                var isDark = root.getAttribute('data-bs-theme') === 'dark';
                localStorage.setItem('rr-account-theme', isDark ? 'dark' : 'light');

                buttons.forEach(function (button) {
                    var label = isDark ? 'Switch to light mode' : 'Switch to dark mode';
                    var icon = button.querySelector('i');
                    button.setAttribute('aria-label', label);
                    button.title = label;
                    if (icon) icon.className = isDark ? 'bx bx-sun fs-22' : 'bx bx-moon fs-22';
                });
            }

            syncThemeControls();
            new MutationObserver(syncThemeControls).observe(root, {
                attributes: true,
                attributeFilter: ['data-bs-theme']
            });
        })();
    </script>

    <script>
        (function () {
            var toggle = document.getElementById('admin-menu-toggle');
            var sidebar = document.getElementById('admin-sidebar');
            var backdrop = document.getElementById('admin-sidebar-backdrop');
            if (!toggle || !sidebar || !backdrop) return;

            var mobile = window.matchMedia('(max-width: 991.98px)');
            function syncSidebarSize() {
                if (document.documentElement.getAttribute('data-layout') === 'vertical') {
                    document.documentElement.setAttribute('data-sidebar-size', 'lg');
                }
            }
            function setOpen(open) {
                var expanded = open && mobile.matches;
                var wasExpanded = document.body.classList.contains('rr-admin-sidebar-open');
                document.body.classList.toggle('rr-admin-sidebar-open', expanded);
                toggle.setAttribute('aria-expanded', String(expanded));
                toggle.setAttribute('aria-label', expanded ? 'Close navigation menu' : 'Open navigation menu');
                toggle.title = expanded ? 'Close navigation menu' : 'Open navigation menu';
                sidebar.setAttribute('aria-hidden', String(mobile.matches && !expanded));
                var icon = toggle.querySelector('i');
                if (icon) icon.className = expanded ? 'bx bx-x fs-22' : 'bx bx-menu fs-22';

                if (expanded) {
                    var firstMenuItem = sidebar.querySelector('#navbar-nav a[href]:not([href^="#"]), #navbar-nav button');
                    if (firstMenuItem) firstMenuItem.focus({ preventScroll: true });
                } else if (wasExpanded && mobile.matches) {
                    toggle.focus({ preventScroll: true });
                }
            }
            setOpen(false);
            toggle.addEventListener('click', function () {
                setOpen(!document.body.classList.contains('rr-admin-sidebar-open'));
            });
            backdrop.addEventListener('click', function () { setOpen(false); });
            sidebar.addEventListener('click', function (event) {
                var link = event.target.closest('a[href]');
                if (mobile.matches && link && !link.getAttribute('href').startsWith('#')) setOpen(false);
            });
            document.addEventListener('keydown', function (event) {
                if (!document.body.classList.contains('rr-admin-sidebar-open')) return;

                if (event.key === 'Escape') {
                    setOpen(false);
                    return;
                }
                if (event.key !== 'Tab') return;

                var focusable = Array.prototype.filter.call(
                    sidebar.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'),
                    function (element) { return element.getClientRects().length > 0; }
                );
                if (!focusable.length) return;

                var first = focusable[0];
                var last = focusable[focusable.length - 1];
                if (event.shiftKey && document.activeElement === first) {
                    event.preventDefault();
                    last.focus();
                } else if (!event.shiftKey && document.activeElement === last) {
                    event.preventDefault();
                    first.focus();
                } else if (!sidebar.contains(document.activeElement) && document.activeElement !== toggle) {
                    event.preventDefault();
                    first.focus();
                } else if (!event.shiftKey && document.activeElement === toggle) {
                    event.preventDefault();
                    first.focus();
                }
            });
            function syncViewport() {
                setOpen(false);
                syncSidebarSize();
            }
            syncSidebarSize();
            window.addEventListener('resize', syncSidebarSize);
            if (mobile.addEventListener) mobile.addEventListener('change', syncViewport);
            else mobile.addListener(syncViewport);
        })();
    </script>

    <script>
        (function () {
            var fullscreenButton = document.getElementById('admin-fullscreen-toggle');
            if (!fullscreenButton) return;

            function isFullscreen() {
                return !!(document.fullscreenElement || document.webkitFullscreenElement ||
                    document.mozFullScreenElement || document.msFullscreenElement ||
                    document.webkitIsFullScreen || document.mozFullScreen);
            }

            function syncFullscreenButton() {
                var active = isFullscreen();
                var label = active ? 'Exit full screen' : 'Enter full screen';
                fullscreenButton.setAttribute('aria-pressed', String(active));
                fullscreenButton.setAttribute('aria-label', label);
                fullscreenButton.setAttribute('title', label);
                document.body.classList.toggle('fullscreen-enable', active);
            }

            fullscreenButton.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                var active = isFullscreen();
                var target = document.documentElement;
                var action = active
                    ? (document.exitFullscreen || document.webkitExitFullscreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || document.msExitFullscreen)
                    : (target.requestFullscreen || target.webkitRequestFullscreen || target.mozRequestFullScreen || target.msRequestFullscreen);

                if (!action) return;

                try {
                    var result = action.call(active ? document : target);
                    if (result && typeof result.catch === 'function') {
                        result.catch(function () { syncFullscreenButton(); });
                    }
                } catch (error) {
                    syncFullscreenButton();
                }
            }, true);

            ['fullscreenchange', 'webkitfullscreenchange', 'mozfullscreenchange', 'MSFullscreenChange'].forEach(function (eventName) {
                document.addEventListener(eventName, syncFullscreenButton);
            });
            syncFullscreenButton();
        })();
    </script>

    <script>
        (function () {
            var activeActionMenu = null;

            function closeActionMenu(restoreFocus) {
                if (!activeActionMenu) return;

                var state = activeActionMenu;
                state.button.setAttribute('aria-expanded', 'false');
                state.button.parentElement.classList.remove('show');
                state.menu.classList.remove('show', 'rr-action-menu-portal');
                state.menu.removeAttribute('data-bs-popper');
                if (state.originalStyle === null) state.menu.removeAttribute('style');
                else state.menu.setAttribute('style', state.originalStyle);

                if (state.parent.isConnected) {
                    state.parent.insertBefore(state.menu, state.nextSibling && state.nextSibling.parentNode === state.parent ? state.nextSibling : null);
                }

                activeActionMenu = null;
                if (restoreFocus) state.button.focus();
            }

            function positionActionMenu() {
                if (!activeActionMenu) return;

                var buttonRect = activeActionMenu.button.getBoundingClientRect();
                var menu = activeActionMenu.menu;
                var viewportWidth = document.documentElement.clientWidth;
                var viewportHeight = window.innerHeight;
                var margin = 8;
                if (buttonRect.bottom < 0 || buttonRect.top > viewportHeight || buttonRect.right < 0 || buttonRect.left > viewportWidth) {
                    closeActionMenu(false);
                    return;
                }
                var menuWidth = menu.getBoundingClientRect().width;

                menu.style.left = Math.max(margin, Math.min(buttonRect.right - menuWidth, viewportWidth - menuWidth - margin)) + 'px';
                menu.style.maxHeight = Math.max(120, viewportHeight - margin * 2) + 'px';

                var menuHeight = Math.min(menu.scrollHeight, viewportHeight - margin * 2);
                var spaceBelow = viewportHeight - buttonRect.bottom - margin;
                var spaceAbove = buttonRect.top - margin;
                var openAbove = menuHeight > spaceBelow && spaceAbove > spaceBelow;
                var top = openAbove ? buttonRect.top - menuHeight - 4 : buttonRect.bottom + 4;
                top = Math.max(margin, Math.min(top, viewportHeight - menuHeight - margin));
                menu.style.top = top + 'px';
            }

            function openActionMenu(button) {
                var menu = button.parentElement.querySelector('.dropdown-menu');
                if (!menu) return;

                var parent = menu.parentElement;
                var nextSibling = menu.nextSibling;
                var originalStyle = menu.getAttribute('style');
                if (!menu.id) menu.id = 'rr-action-menu-' + Math.random().toString(36).slice(2);

                button.setAttribute('aria-haspopup', 'true');
                button.setAttribute('aria-controls', menu.id);
                button.setAttribute('aria-expanded', 'true');
                button.parentElement.classList.add('show');
                menu.classList.add('show', 'rr-action-menu-portal');
                document.body.appendChild(menu);

                activeActionMenu = { button: button, menu: menu, parent: parent, nextSibling: nextSibling, originalStyle: originalStyle };
                menu.style.position = 'fixed';
                menu.style.display = 'block';
                menu.style.left = '0';
                menu.style.top = '0';
                menu.style.right = 'auto';
                menu.style.bottom = 'auto';
                menu.style.transform = 'none';
                menu.style.zIndex = '1080';
                positionActionMenu();
            }

            document.addEventListener('click', function (event) {
                var target = event.target;
                var button = target && target.closest ? target.closest('.table-responsive .dropdown > [data-bs-toggle="dropdown"]') : null;

                if (button) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    if (activeActionMenu && activeActionMenu.button === button) {
                        closeActionMenu(false);
                    } else {
                        closeActionMenu(false);
                        openActionMenu(button);
                    }
                    return;
                }

                if (activeActionMenu) closeActionMenu(false);
            }, true);

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && activeActionMenu) {
                    event.preventDefault();
                    closeActionMenu(true);
                }
            });

            window.addEventListener('resize', positionActionMenu);
            window.addEventListener('scroll', positionActionMenu, true);
        })();
    </script>

</body>


</html>
