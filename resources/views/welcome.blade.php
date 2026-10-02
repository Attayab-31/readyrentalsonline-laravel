@extends('layouts.front_end')

@section('page_content')

    <div class="ltn__utilize-overlay"></div>

    <!-- =========================================================================
         1. HERO SECTION (Architectural & Brand-Aligned)
         ========================================================================= -->
    <section class="rr-hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left: Headline, Value Proposition & Search -->
                <div class="col-lg-7">
                    <div class="rr-hero-badge">
                        <span class="rr-hero-badge-icon">
                            <img src="{{asset('logo/brand-mark-light.svg')}}" alt="House Mark">
                        </span>
                        <span>Family-Owned &amp; Operated for Over 30 Years</span>
                    </div>

                    <h1 class="rr-hero-title">
                        Quality Rental Homes. <br>
                        <span class="rr-highlight">Personalized Service.</span>
                    </h1>

                    <p class="rr-hero-desc">
                        We own, manage, and care for verified residential properties throughout South Jersey. Deal directly with our local family team—enjoy responsive in-house maintenance, transparent leases, and fast application decisions.
                    </p>

                    <!-- Hero Search Widget -->
                    <div class="rr-hero-search-box">
                        <form action="{{url('our-properties')}}" method="get" class="rr-hero-search-form" role="search">
                            <div class="rr-hero-search-input-wrap">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" aria-label="Search available homes by street name, address, or city" placeholder="Search by street name, address, or city..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="rr-hero-search-btn">
                                <span>Find Homes</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Trust Statistics Strip -->
                    <div class="rr-hero-trust-row">
                        <div class="rr-hero-trust-item">
                            <strong>30+</strong>
                            <span>Years Experience</span>
                        </div>
                        <div class="rr-hero-trust-sep d-none d-sm-block"></div>
                        <div class="rr-hero-trust-item">
                            <strong>100%</strong>
                            <span>In-House Maintenance</span>
                        </div>
                        <div class="rr-hero-trust-sep d-none d-sm-block"></div>
                        <div class="rr-hero-trust-item">
                            <strong>48h</strong>
                            <span>Fast Application Review</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Feature Showcase -->
                <div class="col-lg-5">
                    <div class="rr-hero-visual-card">
                        <img src="{{ asset('resources/front-end-assets/img/hero-house.png') }}" alt="Modern two-story rental home" class="rr-hero-main-img">

                        <div class="rr-hero-floating-badge rr-hero-badge-top">
                            <div class="rr-badge-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="rr-badge-text">
                                <strong>Verified Rentals</strong>
                                <span>Direct Landlord Care</span>
                            </div>
                        </div>

                        <div class="rr-hero-floating-badge rr-hero-badge-bottom">
                            <div class="rr-badge-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="rr-badge-text">
                                <strong>In-House Repairs</strong>
                                <span>Dedicated Team</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         2. CORE PILLARS (Why Choose Ready Rentals Online)
         ========================================================================= -->
    <section class="rr-section" style="background-color: #ffffff;">
        <div class="container">
            <div class="rr-section-heading">
                <span class="rr-section-eyebrow">The Ready Rentals Difference</span>
                <h2 class="rr-section-title">Built on 30+ Years of Tenant Trust</h2>
                <p class="rr-section-subtitle">
                    Unlike impersonal management companies or third-party brokers, we directly oversee every property with pride, integrity, and personal accountability.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Family-Owned Care</h3>
                        <p>Over three decades serving local tenants. You have direct communication with our family team rather than navigating an anonymous call center.</p>
                        <a href="{{url('about-us')}}" class="rr-pillar-link">Our Story <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <h3>In-House Maintenance</h3>
                        <p>No waiting weeks for outside contractors. Our dedicated full-time repair team resolves service and emergency requests promptly and professionally.</p>
                        <a href="{{url('contact-us')}}" class="rr-pillar-link">Get Support <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h3>Streamlined Applications</h3>
                        <p>Apply online via our digital form or download a printable PDF form. We review applications thoroughly and aim to respond within 2 business days.</p>
                        <a href="{{url('online-application')}}" class="rr-pillar-link">Apply Now <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="rr-pillar-card">
                        <div class="rr-pillar-icon-wrap">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <h3>We Buy Homes For Cash</h3>
                        <p>Looking to sell your home or vacant lot quickly? We make competitive cash offers in as-is condition, pay fees, and can offer advances before closing.</p>
                        <a href="{{url('contact-us')}}" class="rr-pillar-link">Sell Your Home <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         3. FEATURED PROPERTIES (Modern Real Estate Grid)
         ========================================================================= -->
    <section class="rr-section" style="background-color: var(--rr-ice-50);" id="featured-homes">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4 gap-3">
                <div>
                    <span class="rr-section-eyebrow">Available Homes</span>
                    <h2 class="rr-section-title mb-1">Featured Properties</h2>
                    <p class="rr-section-subtitle mb-0">Browse our verified inventory of available rental properties and homes for sale.</p>
                </div>
                <div>
                    <a href="{{url('our-properties')}}" class="btn theme-btn-1 btn-effect-1 rr-view-properties-btn text-uppercase" style="border-radius: var(--rr-radius-pill); padding: 12px 26px;">
                        <span>View All Properties</span>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            @if($db_data['Property']->count() > 0)
                <div class="rr-featured-grid">
                    @foreach($db_data['Property'] as $Property)
                        @php
                            $detailUrl = url('properties/explore-details/'.$Property->p_slug);
                            $isRent = $Property->p_listing_status === 'for-rent';
                            $imgSrc = $Property->p_banner_image 
                                ? asset('resources/files/dynamic/'.$Property->p_banner_image)
                                : asset('resources/front-end-assets/img/banner/banner-1.jpg');
                        @endphp
                        <article class="rr-property-card-modern">
                            <div class="rr-card-media">
                                <a href="{{ $detailUrl }}" aria-label="{{ $Property->p_title }}">
                                    <img src="{{ $imgSrc }}" alt="{{ $Property->p_title }}" loading="lazy">
                                </a>
                                <span class="rr-card-badge-status {{ $isRent ? '' : 'rr-card-badge-sale' }}">
                                    {{ $isRent ? 'For Rent' : 'For Sale' }}
                                </span>
                            </div>

                            <div class="rr-card-body-modern">
                                <div class="rr-card-price-modern">
                                    @if(filled($Property->p_price) && (float) $Property->p_price > 0)
                                        <strong>${{ number_format((float) $Property->p_price, 0) }}</strong>
                                        @if($isRent)<span>/ month</span>@endif
                                    @else
                                        <strong>Contact for pricing</strong>
                                    @endif
                                </div>

                                <h3 class="rr-card-title-modern">
                                    <a href="{{ $detailUrl }}">{{ $Property->p_title }}</a>
                                </h3>

                                @if($Property->p_address)
                                    <p class="rr-card-address-modern">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $Property->p_address }}</span>
                                    </p>
                                @endif

                                <div class="rr-card-specs-modern">
                                    @if($Property->p_bedrooms)
                                        <span><strong>{{ $Property->p_bedrooms }}</strong> Beds</span>
                                    @endif
                                    @if($Property->p_baths)
                                        <span><strong>{{ $Property->p_baths }}</strong> Baths</span>
                                    @endif
                                    @if($Property->p_area)
                                        <span><strong>{{ $Property->p_area }}</strong> Sq Ft</span>
                                    @endif
                                </div>

                                <div class="rr-card-actions-modern">
                                    @if($isRent)
                                        <a href="{{url('online-application')}}?property={{$Property->p_slug}}" class="rr-btn-primary-sm">
                                            Apply Online
                                        </a>
                                    @else
                                        <a href="{{ $detailUrl }}" class="rr-btn-primary-sm">
                                            View Details
                                        </a>
                                    @endif

                                    <a href="{{ $detailUrl }}" class="rr-btn-outline-sm" title="View details">
                                        <i class="fas fa-info-circle"></i> Details
                                    </a>

                                    <button type="button" 
                                            class="rr-btn-outline-sm share-property-btn" 
                                            data-property-slug="{{$Property->p_slug}}" 
                                            data-property-title="{{$Property->p_title}}"
                                            title="Share with Friend">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5 bg-white rounded-4 border p-5">
                    <div class="mb-3">
                        <img src="{{asset('logo/brand-mark-light.svg')}}" alt="Ready Rentals" style="height: 52px; opacity: 0.6;">
                    </div>
                    <h3 class="mb-2">No Properties Currently Listed</h3>
                    <p class="text-muted mb-4">Please check back soon or get in touch with our office to inquire about upcoming rental opportunities.</p>
                    <a href="{{url('contact-us')}}" class="btn theme-btn-1 btn-effect-1">Contact Our Office</a>
                </div>
            @endif
        </div>
    </section>

    <!-- =========================================================================
         4. HOW IT WORKS (Application Journey)
         ========================================================================= -->
    <section class="rr-section" style="background-color: #ffffff;">
        <div class="container">
            <div class="rr-section-heading">
                <span class="rr-section-eyebrow">Simple &amp; Transparent</span>
                <h2 class="rr-section-title">How To Rent With Us</h2>
                <p class="rr-section-subtitle">
                    We have streamlined the rental process into four clear steps so you can find your next home without unnecessary delays or confusion.
                </p>
            </div>

            <div class="rr-timeline-grid">
                <div class="rr-timeline-step">
                    <div class="rr-step-num">01</div>
                    <h4>Browse Properties</h4>
                    <p>Review our available homes with transparent pricing, full descriptions, photos, and amenity details.</p>
                </div>

                <div class="rr-timeline-step">
                    <div class="rr-step-num">02</div>
                    <h4>Submit Application</h4>
                    <p>Choose our online application wizard or download a printable PDF form with clear guidelines.</p>
                </div>

                <div class="rr-timeline-step">
                    <div class="rr-step-num">03</div>
                    <h4>Quick 48h Review</h4>
                    <p>Our family team directly verifies your submission and contacts you within two business days to schedule a tour.</p>
                </div>

                <div class="rr-timeline-step">
                    <div class="rr-step-num">04</div>
                    <h4>Welcome Home</h4>
                    <p>Sign your lease, receive your keys, and enjoy reliable in-house property maintenance from day one.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         5. CASH HOME BUYING (Looking to Sell Your Home or Lot)
         ========================================================================= -->
    <section class="py-5" style="background-color: var(--rr-ice-50);">
        <div class="container">
            <div class="rr-cash-sale-card">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-3" style="font-size: 12px; letter-spacing: 0.08em;">
                            Homeowners &amp; Land Sellers
                        </span>
                        <h2>Looking to Sell Your Home or Lot Fast?</h2>
                        <p>
                            We offer fair cash prices for homes and vacant parcels in any condition. Skip the commissions, repairs, and prolonged inspections. We handle all paperwork and closing fees, and can provide cash advances before closing when needed.
                        </p>
                        <div class="rr-cash-perks">
                            <div class="rr-cash-perk-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Sell As-Is (No Repairs Needed)</span>
                            </div>
                            <div class="rr-cash-perk-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Zero Realtor Commissions</span>
                            </div>
                            <div class="rr-cash-perk-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Closing Advance Assistance Available</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{url('contact-us')}}" class="rr-btn-white">
                            <span>Request Cash Offer</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="mt-3 text-white-50" style="font-size: 13.5px;">
                            Or call us directly at <a href="tel:1-267-549-9625" class="text-white fw-bold">1-267-549-9625</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         6. CALL TO ACTION (Final Push)
         ========================================================================= -->
    <section class="rr-section" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); color: #ffffff;">
        <div class="container text-center">
            <div class="max-w-700 mx-auto" style="max-width: 680px; margin: 0 auto;">
                <div class="mb-3">
                    <img src="{{asset('logo/brand-mark-dark.svg')}}" alt="Ready Rentals Brand Mark" class="rr-cta-brand-mark">
                </div>
                <h2 class="text-white mb-3" style="font-size: clamp(28px, 4vw, 44px); font-weight: 800;">Ready to Find Your Next Home?</h2>
                <p class="text-white-50 mb-4" style="font-size: 17px; line-height: 1.6;">
                    Explore our updated listings or speak directly with our family team today. We are here to help you feel truly at home.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{url('our-properties')}}" class="btn btn-white fw-bold px-4 py-3" style="background: #ffffff; color: var(--rr-navy-700); border-radius: var(--rr-radius-pill);">
                        <i class="fas fa-search me-2"></i> Explore Available Properties
                    </a>
                    <a href="{{url('online-application')}}" class="btn btn-outline-light fw-bold px-4 py-3" style="border-radius: var(--rr-radius-pill); border-color: rgba(255,255,255,0.4);">
                        <i class="fas fa-laptop me-2"></i> Submit Online Application
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
