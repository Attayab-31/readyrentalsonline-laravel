@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')

    <!-- Welcome Banner -->
    <div class="portal-welcome-banner">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <span class="portal-welcome-badge">
                    <i class="ri-shield-check-line"></i>
                    @if(Auth::user()->isSuperAdmin())
                        Super Administrator
                    @elseif(Auth::user()->isAdmin())
                        Property Manager
                    @elseif(Auth::user()->isTenant())
                        Tenant Portal
                    @else
                        Client Portal
                    @endif
                </span>
                <h2 class="portal-welcome-title">Welcome back, {{ Auth::user()->first_name }}!</h2>
                <p class="portal-welcome-subtitle">Your rental portfolio, invoices and tenant activity at a glance.</p>
                @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                    <a href="{{ url('accounts/properties') }}" class="portal-property-summary">
                        <i class="ri-building-2-line"></i>
                        <strong>{{ number_format($db_data['TotalPropertiesCount']) }}</strong> properties in your portfolio
                        <i class="ri-arrow-right-line"></i>
                    </a>
                @endif
            </div>
            <div class="d-flex gap-2 flex-wrap">
                @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                    <a href="{{ url('accounts/invoices/create') }}" class="btn btn-light text-primary fw-semibold">
                        <i class="ri-add-line"></i> Create Invoice
                    </a>
                    <a href="{{ url('accounts/properties/create') }}" class="btn btn-soft-primary bg-white bg-opacity-25 text-white border-0">
                        <i class="ri-home-4-line"></i> Add Property
                    </a>
                @else
                    <a href="{{ url('accounts/invoices') }}" class="btn btn-light text-primary fw-semibold">
                        <i class="ri-receipt-line"></i> View Invoices
                    </a>
                    <a href="{{ url('accounts/chat') }}" class="btn btn-soft-primary bg-white bg-opacity-25 text-white border-0">
                        <i class="ri-chat-3-line"></i> Message Board
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Metric Cards Grid -->
    <div class="row g-3">
        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate portal-metric-card accent-slate h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="portal-metric-label">Total Users</div>
                        <div class="portal-metric-icon icon-navy">
                            <i class="ri-user-shared-line"></i>
                        </div>
                    </div>
                    <div class="portal-metric-value mb-3">
                        <span class="counter-value" data-target="{{ $db_data['TotalUsersCount'] }}">{{ $db_data['TotalUsersCount'] }}</span>
                    </div>
                    <div>
                        <a href="{{ url('accounts/users') }}" class="portal-metric-link">
                            Manage user accounts <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate portal-metric-card accent-rose h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="portal-metric-label">Open / Unpaid Invoices</div>
                        <div class="portal-metric-icon icon-rose">
                            <i class="ri-file-warning-line"></i>
                        </div>
                    </div>
                    <div class="portal-metric-value mb-3 text-danger">
                        <span class="counter-value" data-target="{{ $db_data['TotalInvoicesCount'] }}">0</span>
                    </div>
                    <div>
                        <a href="{{ url('accounts/invoices?i_status=open') }}" class="portal-metric-link text-danger">
                            View open invoices <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate portal-metric-card accent-emerald h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="portal-metric-label">Paid Invoices</div>
                        <div class="portal-metric-icon icon-emerald">
                            <i class="ri-checkbox-circle-line"></i>
                        </div>
                    </div>
                    <div class="portal-metric-value mb-3 text-success">
                        <span class="counter-value" data-target="{{ $db_data['TotalPaidInvoicesCount'] }}">0</span>
                    </div>
                    <div>
                        <a href="{{ url('accounts/invoices?i_status=paid') }}" class="portal-metric-link text-success">
                            View paid invoices <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-animate portal-metric-card accent-amber h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="portal-metric-label">Unread Messages</div>
                        <div class="portal-metric-icon icon-amber">
                            <i class="ri-mail-unread-line"></i>
                        </div>
                    </div>
                    <div class="portal-metric-value mb-3">
                        <span class="counter-value" data-target="{{ $db_data['TotalUnReadMessages'] }}">0</span>
                    </div>
                    <div>
                        <a href="{{ url('accounts/chat') }}" class="portal-metric-link">
                            Open message board <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts Row -->
    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
    <div class="row g-3 mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Management Quick Links</h5>
                    <span class="badge bg-primary">Ready Rentals Operations</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ url('accounts/properties') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 text-center hover-elevate bg-light">
                                    <i class="ri-building-line fs-2 text-primary mb-2 d-block"></i>
                                    <h6 class="mb-1 text-dark">Properties</h6>
                                    <small class="text-muted">Manage rental listings</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ url('accounts/properties/applications') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 text-center hover-elevate bg-light">
                                    <i class="ri-file-text-line fs-2 text-primary mb-2 d-block"></i>
                                    <h6 class="mb-1 text-dark">Applications</h6>
                                    <small class="text-muted">Review submitted rental forms</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ url('accounts/invoices') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 text-center hover-elevate bg-light">
                                    <i class="ri-money-dollar-circle-line fs-2 text-success mb-2 d-block"></i>
                                    <h6 class="mb-1 text-dark">Invoices</h6>
                                    <small class="text-muted">Track rent & ACH payments</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ url('accounts/chat') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 text-center hover-elevate bg-light">
                                    <i class="ri-chat-smile-2-line fs-2 text-warning mb-2 d-block"></i>
                                    <h6 class="mb-1 text-dark">Messages</h6>
                                    <small class="text-muted">Tenant communications</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section("scripts")
@endsection
