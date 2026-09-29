<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Sign In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('controlPanel')}}/images/favicon.ico">
    <script src="{{asset('controlPanel')}}/js/layout.js"></script>
    <link href="{{asset('controlPanel')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('controlPanel')}}/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{asset('controlPanel')}}/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Velzon.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Enter email">
                                            <span class="text-danger form-error" id="email_error">{{ $errors->first('email') }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <span class="text-danger form-error" id="password_error">{{ $errors->first('password') }}</span>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember" name="remember" {{ old('remember') ? 'checked' : '' }} id="remember">
                                            <label class="form-check-label"  for="remember">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="auth-signup-basic.html" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            {{-- <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('controlPanel')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/node-waves/waves.min.js"></script>
    <script src="{{asset('controlPanel')}}/libs/feather-icons/feather.min.js"></script>
    <script src="{{asset('controlPanel')}}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{asset('controlPanel')}}/js/plugins.js"></script>

    <!-- particles js -->
    <script src="{{asset('controlPanel')}}/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="{{asset('controlPanel')}}/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="{{asset('controlPanel')}}/js/pages/password-addon.init.js"></script>
</body>


</html>