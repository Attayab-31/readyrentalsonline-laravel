<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#10253a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <script>document.documentElement.classList.add('rr-js');</script>

    <title>@yield('title', 'Sign In · Ready Rentals Online')</title>

    <!-- Favicon and Brand Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}?v={{ filemtime(public_path('favicon-48x48.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ filemtime(public_path('favicon-32x32.png')) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}?v={{ filemtime(public_path('logo/apple-touch-icon.png')) }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v={{ filemtime(public_path('manifest.webmanifest')) }}">

    <!-- Google Fonts: Poppins (Headings) & Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('controlPanel') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/front-end-assets/css/loading-states.css') }}?v={{ filemtime(public_path('resources/front-end-assets/css/loading-states.css')) }}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --rr-navy-900: #091622;
            --rr-navy-800: #0e1b29;
            --rr-navy-700: #10253a;
            --rr-navy-600: #162f49;
            --rr-slate-600: #2b5f8e;
            --rr-slate-700: #1d466c;
            --rr-slate-500: #3b7bb5;
            --rr-ice-200: #c8d9e4;
            --rr-ice-100: #e2ecf5;
            --rr-ice-50: #f4f7fa;
            --rr-border: #e2e8f0;
            --rr-border-focus: #2b5f8e;
            --rr-text-primary: #0e2235;
            --rr-text-muted: #536879;
            --rr-danger: #dc2626;
            --rr-success: #059669;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #0e1b29;
            color: var(--rr-text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px 16px;
            position: relative;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Subtle architectural background texture */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: 
                radial-gradient(circle at 18% 20%, rgba(43, 95, 142, 0.28) 0%, transparent 48%),
                radial-gradient(circle at 82% 80%, rgba(16, 37, 58, 0.55) 0%, transparent 52%),
                linear-gradient(145deg, #091622 0%, #0e1b29 55%, #10253a 100%);
            z-index: -2;
        }

        body::after {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.6;
            z-index: -1;
            pointer-events: none;
        }

        .auth-container {
            width: 100%;
            max-width: 460px;
            margin: auto;
            position: relative;
            z-index: 1;
        }

        /* Top Brand Header */
        .auth-brand-wrap {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-brand-link {
            display: inline-block;
            text-decoration: none;
            transition: transform 0.25s ease;
        }

        .auth-brand-link:hover {
            transform: scale(1.02);
        }

        .auth-brand-logo {
            height: 64px;
            max-height: 68px;
            width: auto;
            max-width: 260px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.25));
        }

        /* Auth Card */
        .auth-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 16px;
            box-shadow: 0 20px 48px rgba(9, 22, 34, 0.35), 0 4px 12px rgba(9, 22, 34, 0.12);
            padding: 36px 32px;
            position: relative;
        }

        .auth-header {
            margin-bottom: 24px;
            text-align: left;
        }

        .auth-portal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: var(--rr-ice-100);
            color: var(--rr-slate-700);
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .auth-title {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--rr-navy-900);
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .auth-subtitle {
            font-size: 13.5px;
            color: var(--rr-text-muted);
            line-height: 1.45;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--rr-navy-800);
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-input {
            width: 100%;
            height: 46px;
            padding: 10px 14px 10px 42px;
            font-family: inherit;
            font-size: 14px;
            color: var(--rr-text-primary);
            background-color: #ffffff;
            border: 1.5px solid #d2dce5;
            border-radius: 9px;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--rr-slate-600);
            box-shadow: 0 0 0 3px rgba(43, 95, 142, 0.16);
        }

        .input-wrap:focus-within .input-icon {
            color: var(--rr-slate-600);
        }

        .password-toggle-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease, background 0.15s ease;
        }

        .password-toggle-btn:hover {
            color: var(--rr-navy-900);
            background: #f1f5f9;
        }

        /* Meta Options: Remember & Forgot */
        .auth-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--rr-text-muted);
            cursor: pointer;
            font-weight: 500;
            user-select: none;
        }

        .remember-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--rr-slate-600);
            cursor: pointer;
            border-radius: 4px;
        }

        .auth-link {
            color: var(--rr-slate-600);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .auth-link:hover {
            color: var(--rr-navy-900);
            text-decoration: underline;
        }

        /* Buttons */
        .btn-submit {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #2b5f8e 0%, #1d466c 100%);
            color: #ffffff;
            border: none;
            border-radius: 9px;
            font-family: inherit;
            font-size: 14.5px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(43, 95, 142, 0.35);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #336ea2 0%, #173b5d 100%);
            box-shadow: 0 6px 18px rgba(43, 95, 142, 0.45);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(43, 95, 142, 0.25);
        }

        /* Alerts and Errors */
        .form-error {
            display: block;
            color: var(--rr-danger);
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
        }

        .status-alert {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-alert.alert-success {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .status-alert.alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* Trust Footer */
        .auth-trust-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            font-size: 12px;
            color: #64748b;
        }

        .auth-trust-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .auth-trust-item i {
            color: #059669;
            font-size: 15px;
        }

        /* Outside Card Links */
        .auth-footer-nav {
            margin-top: 22px;
            text-align: center;
            font-size: 13px;
        }

        .auth-back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .auth-back-link:hover {
            color: #ffffff;
        }

        .auth-copyright {
            margin-top: 16px;
            text-align: center;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.45);
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 26px 20px;
                border-radius: 14px;
            }
            .auth-brand-logo {
                height: 52px;
            }
            .auth-title {
                font-size: 20px;
            }
        }
    </style>
    </head>
<body>
@include('partials.page-preloader')

<div class="auth-container">
    <!-- Main Auth Card -->
    <div class="auth-card">
        <div class="auth-brand-wrap">
            <a href="{{ url('/') }}" class="auth-brand-link" title="{{ config('app.name', 'Ready Rentals Online') }}">
                <img src="{{ asset('logo/ready_rentals_dark.svg') }}" alt="{{ config('app.name', 'Ready Rentals Online') }}" class="auth-brand-logo">
            </a>
        </div>

        @yield('content')

        <!-- Security Trust Signals -->
        <div class="auth-trust-footer">
            <span class="auth-trust-item">
                <i class="ri-shield-check-fill"></i> 256-Bit SSL Encrypted
            </span>
            <span class="auth-trust-item">
                <i class="ri-lock-password-line"></i> Secure Portal
            </span>
        </div>
    </div>

    <!-- Footer Navigation -->
    <div class="auth-footer-nav">
        <a href="{{ url('/') }}" class="auth-back-link">
            <i class="ri-arrow-left-line"></i> Return to Ready Rentals Home
        </a>
        <div class="auth-copyright">
            Ready Rentals Online &copy; {{ date('Y') }}. All Rights Reserved.
        </div>
    </div>
</div>

<script>
    // Password visibility toggle functionality
    document.querySelectorAll('.password-toggle-btn').forEach(button => {
        button.addEventListener('click', function () {
            const inputId = this.getAttribute('data-target');
            const input = document.getElementById(inputId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ri-eye-off-fill';
            } else {
                input.type = 'password';
                icon.className = 'ri-eye-fill';
            }
        });
    });
</script>

@yield('scripts')

<script src="{{ asset('resources/front-end-assets/js/loading-states.js') }}?v={{ filemtime(public_path('resources/front-end-assets/js/loading-states.js')) }}"></script>

</body>
</html>
