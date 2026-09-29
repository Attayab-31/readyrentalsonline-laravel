<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>{{$page_title ?? "Laravel"}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{asset('controlPanel')}}/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('controlPanel')}}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('controlPanel')}}/js/layout.js"></script>
    <link href="{{asset('controlPanel')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/custom.min.css" rel="stylesheet" type="text/css" />


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

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{url('accounts')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('controlPanel')}}/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('controlPanel')}}/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{url('accounts')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('controlPanel')}}/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('controlPanel')}}/images/logo-light.png" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
 
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
 

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
 
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->getProfilePicture(Auth::user()->profile_picture)}}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{Auth::user()->user_type}}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome {{Auth::user()->first_name}}!</h6>
                                <a class="dropdown-item" href="{{url('accounts/edit-profile')}}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('accounts/caches/clear-app-cache')}}"><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Clear App Cache</span></a>
                                <a class="dropdown-item" href="#0" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

 
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{url('accounts')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('controlPanel')}}/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('controlPanel')}}/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{url('accounts')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('controlPanel')}}/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('controlPanel')}}/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('accounts')}}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="bx bx-home"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/')}}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="bx bx-home"></i> <span data-key="t-dashboards">Home Page</span>
                            </a>
                        </li>

                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                    <i class="bx bx-user"></i> <span data-key="t-apps">Users</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarApps">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{url('accounts/users')}}" class="nav-link" data-key="t-api-key">View all users</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/users/create')}}" class="nav-link" data-key="t-chat"> Create new user </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                    
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarProperties" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProperties">
                                    <i class="bx bx-building-house"></i> <span data-key="t-apps">Properties</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProperties">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties')}}" class="nav-link" data-key="t-api-key">View all Properties</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties/create')}}" class="nav-link" data-key="t-chat"> Create new Property </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('accounts/properties/applications')}}" class="nav-link" data-key="t-chat"> Applications </a>
                                        </li>                                    
                                    </ul>
                                </div>
                            </li>
                        @endif
                    
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarInvoices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices">
                                <i class="bx bx-receipt"></i> <span data-key="t-apps">Invoices</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarInvoices">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('accounts/invoices')}}" class="nav-link" data-key="t-api-key">View all invoices</a>
                                    </li>
                                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                                        <li class="nav-item">
                                            <a href="{{url('accounts/invoices/create')}}" class="nav-link" data-key="t-chat"> Create new Invoice </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('accounts/chat')}}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="bx bx-envelope"></i> <span data-key="t-dashboards">Message Board</span>
                            </a>
                        </li>
                    
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('/accounts/log-viewer')}}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="bx bx-envelope"></i> <span data-key="t-dashboards">View Errors Log</span>
                            </a>
                        </li>
                        @endif



                        <li class="menu-title"><i class="bx bx-menu-alt-right"></i> <span data-key="t-components">Components</span></li>
                    </ul>
                    
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @include('partials.control_panel_alert_notifications')
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            ReadyRentalsOnline &copy; {{date('Y')}}. All Rights Reserved.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                <span id="current-date-time"></span>
                            </div>
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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    
    <!-- JAVASCRIPT -->
    <script src="{{asset('controlPanel')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/node-waves/waves.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/feather-icons/feather.min.js"></script>
    <script src="{{asset('controlPanel')}}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{asset('controlPanel')}}/js/plugins.js"></script>
    
    
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('controlPanel')}}/js/pages/sweetalerts.init.js"></script>
    <script src="{{asset('controlPanel')}}/js/app.js"></script>
    <script src="{{asset('controlPanel')}}/customJs.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    		<!--end::Javascript-->
    <script src="{{asset('controlPanel')}}/multi-img-picker/spartan-multi-image-picker.js"></script>



    <script>
        // Initialize select2 elements on document ready
        $(document).ready(function() {
 
            $(".js-example-basic-single").select2();
  
            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',      // Display day of the week, e.g., "Monday"
                    year: 'numeric',
                    month: 'long',        // Full month name, e.g., "October"
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                    hour12: true          // 12-hour format with AM/PM
                };
                document.getElementById('current-date-time').textContent = now.toLocaleString(undefined, options);
            }

            setInterval(updateDateTime, 1000); // Update date and time every second
            updateDateTime(); // Initial call to display date and time immediately
 



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


            tinymce.init({
               selector: '.tinymceEditor',
               height: 400,
               menubar: true,
               plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
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
 



            tinymce.init({
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
    
</body>


</html>