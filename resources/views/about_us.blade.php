@extends('layouts.front_end')

@section('page_content')

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white mb-2">About Ready Rentals Online</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul style="color: rgba(255,255,255,0.8);">
                                <li><a href="{{ url('/') }}" class="text-white"><i class="fas fa-home me-1"></i> Home</a></li>
                                <li class="text-white-50">About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- ABOUT US STORY AREA -->
    <section class="rr-section" style="background-color: #ffffff;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg border" style="border-color: var(--rr-line) !important;">
                            <img src="{{asset('resources/front-end-assets')}}/img/banner/banner-2.jpg" alt="Ready Rentals Online Home" class="w-100 object-fit-cover" style="height: 440px;">
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-4 p-3 rounded-3 shadow-md bg-white border" style="max-width: 280px; border-color: var(--rr-line) !important;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" style="background: var(--rr-ice-100); width: 44px; height: 44px;">
                                    <img src="{{asset('logo/brand-mark-light.svg')}}" alt="House Emblem" style="width: 26px; height: 26px;">
                                </div>
                                <div>
                                    <strong class="d-block" style="color: var(--rr-navy-700); font-size: 15px;">30+ Years Strong</strong>
                                    <span class="text-muted" style="font-size: 12.5px;">Family Owned &amp; Operated</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <span class="rr-section-eyebrow">Our Heritage &amp; Mission</span>
                        <h2 class="rr-section-title mb-3">Providing Quality Housing That Feels Like Home</h2>
                        <p class="rr-section-subtitle mb-4">
                            With over 30 years of experience, our family-owned business is here not only to provide you with housing, but to ensure you feel genuinely supported and at home.
                        </p>
                        <p class="text-muted" style="line-height: 1.7; font-size: 15px;">
                            We take pride in managing every property directly. When you call us, you speak with our local team. When maintenance is required, our in-house technicians handle it directly—without third-party delays or excuses.
                        </p>

                        <div class="row g-3 mt-2 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-primary" style="color: var(--rr-slate-600) !important;"></i>
                                    <span class="fw-bold" style="color: var(--rr-navy-700);">Direct Landlord Relationship</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-primary" style="color: var(--rr-slate-600) !important;"></i>
                                    <span class="fw-bold" style="color: var(--rr-navy-700);">Full-Time In-House Maintenance</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-primary" style="color: var(--rr-slate-600) !important;"></i>
                                    <span class="fw-bold" style="color: var(--rr-navy-700);">Energy-Efficient Fixtures</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-primary" style="color: var(--rr-slate-600) !important;"></i>
                                    <span class="fw-bold" style="color: var(--rr-navy-700);">Fair &amp; Fast Screening</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url('our-properties') }}" class="btn theme-btn-1 btn-effect-1 text-uppercase" style="border-radius: var(--rr-radius-pill); padding: 12px 28px;">
                                Explore Available Homes
                            </a>
                            <a href="{{ url('contact-us') }}" class="btn btn-outline-dark fw-bold" style="border-radius: var(--rr-radius-pill); padding: 12px 28px; border-color: var(--rr-line);">
                                Contact Our Office
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE COMMITMENTS GRID -->
    <section class="rr-section" style="background-color: var(--rr-ice-50);">
        <div class="container">
            <div class="rr-section-heading">
                <span class="rr-section-eyebrow">Our Standards</span>
                <h2 class="rr-section-title">What You Can Expect As Our Tenant</h2>
                <p class="rr-section-subtitle">
                    We treat every tenant with respect, professionalism, and prompt attentiveness throughout your residency.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Quality Move-In Standards</h3>
                        <p>Every home is thoroughly prepped, inspected, and cleaned before move-in to ensure a safe, comfortable environment from day one.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>In-House Repairs &amp; Upkeep</h3>
                        <p>Our dedicated maintenance crew handles routine maintenance and urgent repairs directly, saving you time and frustration.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Transparent Leases &amp; Terms</h3>
                        <p>No hidden fees or unexpected clauses. Clear lease agreements, easy online invoice payments, and direct communication.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); color: #ffffff;">
        <div class="container text-center py-4">
            <h2 class="text-white mb-3" style="font-size: clamp(26px, 3.5vw, 36px);">Have Questions About Our Homes?</h2>
            <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px; font-size: 16px;">
                Our family office is ready to assist you with inquiries, scheduled tours, and application assistance.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ url('contact-us') }}" class="btn btn-white fw-bold px-4 py-3" style="background: #ffffff; color: var(--rr-navy-700); border-radius: var(--rr-radius-pill);">
                    <i class="fas fa-envelope me-2"></i> Get In Touch
                </a>
                <a href="tel:1-267-549-9625" class="btn btn-outline-light fw-bold px-4 py-3" style="border-radius: var(--rr-radius-pill); border-color: rgba(255,255,255,0.4);">
                    <i class="fas fa-phone me-2"></i> Call 1-267-549-9625
                </a>
            </div>
        </div>
    </section>

@endsection
