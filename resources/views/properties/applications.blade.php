@extends('layouts.front_end')

@section('page_content')

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white mb-2">Rental Application</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul style="color: rgba(255,255,255,0.8);">
                                <li><a href="{{url('/')}}" class="text-white"><i class="fas fa-home me-1"></i> Home</a></li>
                                <li class="text-white-50">Apply For Property</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <section class="rr-section" style="background-color: var(--rr-ice-50);">
        <div class="container">
            <div class="rr-section-heading">
                <span class="rr-section-eyebrow">Choose Your Preference</span>
                <h2 class="rr-section-title">Select How You Wish To Apply</h2>
                <p class="rr-section-subtitle">
                    We offer multiple convenient ways to submit your rental application. Select the method that works best for you below.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Option 1: Apply Online -->
                <div class="col-lg-5 col-md-6">
                    <div class="rr-pillar-card text-center p-4 p-md-5">
                        <div class="rr-pillar-icon-wrap mx-auto">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3>Submit Online Application</h3>
                        <p>Complete our secure multi-step online form in just a few minutes. You will receive an application tracking ID to save your progress, and our team will review your application within 2 business days.</p>
                        
                        <div class="mt-4">
                            <a class="btn theme-btn-1 btn-effect-1 w-100 py-3 fw-bold" style="border-radius: var(--rr-radius-pill);" href="{{url('online-application')}}?property={{request()->query('property')}}">
                                <span>Start Online Application</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Option 2: Print or Download -->
                <div class="col-lg-5 col-md-6">
                    <div class="rr-pillar-card text-center p-4 p-md-5">
                        <div class="rr-pillar-icon-wrap mx-auto">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3>Download Printable Application</h3>
                        <p>Prefer filling out your application offline? Download our official rental application document. Once filled out and signed, you can upload it or submit it directly with your proof of income.</p>
                        
                        <div class="mt-4 d-flex flex-column gap-2">
                            <a class="btn theme-btn-1 btn-effect-1 w-100 py-3 fw-bold" style="border-radius: var(--rr-radius-pill);" href="{{url('applications/submit-application-form')}}">
                                <span>Download PDF Application</span>
                                <i class="fas fa-download ms-2"></i>
                            </a>
                            <a href="{{url('applications/upload-application-form')}}" class="btn btn-outline-secondary py-2 small fw-bold mt-1" style="border-radius: var(--rr-radius-pill);">
                                Already filled it out? Upload it here &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Callout -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div class="p-4 rounded-4 bg-white border text-center shadow-sm" style="border-color: var(--rr-line) !important;">
                        <h5 class="mb-2" style="font-weight: 700; color: var(--rr-navy-700);">Important Application Information</h5>
                        <p class="text-muted small mb-0">
                            Please ensure all applicant and co-applicant details, income documentation, and government-issued IDs are accurate. Review our <a href="{{url('terms-and-conditions-for-applications')}}" class="text-primary fw-bold">Application Terms &amp; Conditions</a> prior to submitting.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
