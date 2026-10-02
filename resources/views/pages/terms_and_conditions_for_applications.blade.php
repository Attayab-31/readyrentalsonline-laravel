@extends('layouts.front_end')

@section('page_content')

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white mb-2">Application Terms &amp; Conditions</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul style="color: rgba(255,255,255,0.8);">
                                <li><a href="{{url('/')}}" class="text-white"><i class="fas fa-home me-1"></i> Home</a></li>
                                <li class="text-white-50">Applications Terms and Conditions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PAGE DETAILS AREA START -->
    <div class="rr-section" style="background-color: var(--rr-ice-50);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm" style="border-color: var(--rr-line) !important;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3 mb-4 border-bottom">
                            <div>
                                <h2 class="mb-1" style="font-size: 24px; font-weight: 700; color: var(--rr-navy-700);">Rental Application Terms &amp; Agreement</h2>
                                <span class="text-muted small"><i class="far fa-calendar-alt me-1"></i> Official Policy Document</span>
                            </div>
                            <span class="badge px-3 py-2 rounded-pill" style="background: var(--rr-ice-100); color: var(--rr-slate-600); font-weight: 700;">
                                Ready Rentals Online
                            </span>
                        </div>

                        <div class="legal-terms-content">
                            <ol class="list-group list-group-numbered list-group-flush" style="font-size: 15px; line-height: 1.7; color: var(--rr-text-muted);">
                                <li class="list-group-item border-0 px-0 py-2">
                                    I hereby state and represent that the information provided in this rental application is complete, truthful, and accurate.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    I understand that in the event a lease agreement is entered into, it may be cancelled by the Landlord if any of the information provided in the application is determined to be materially inaccurate or incomplete.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    I hereby authorize the Landlord or Landlord’s agents to verify the information on the application and correspond regarding any information—including personal, financial, and confidential details concerning my application, delinquency, and tenancy—via electronic transmission.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    Verification or re-verification of any information contained in the application will be retained by Landlord. I hereby authorize Landlord and/or its agents to obtain information about me, including but not limited to: credit history, tenant history, check writing history, court records, and/or criminal records, and instruct any contacted entities to release such information to them.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    Upon written request, Landlord or Landlord’s agents will provide the name and contact details of the source of the information used in the verification process.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    If any of the provided information changes during the term of the lease, the tenant must notify Landlord in writing within five (5) days and obtain written confirmation.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    I hereby authorize any landlord or landlord agents to accept any electronic communication for all occupants ("Electronic Notice"), which shall be deemed valid written notice for legal and operational purposes.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    Electronic notice shall be deemed received at the time the sending party receives electronic verification of receipt or transmission to the email/phone specified in the application.
                                </li>
                                <li class="list-group-item border-0 px-0 py-2">
                                    Any party receiving Electronic notice may request and shall be entitled to receive the notice on paper via certified mail within 10 days of written request.
                                </li>
                            </ol>
                        </div>

                        <div class="mt-4 pt-4 border-top text-center text-sm-start d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <span class="text-muted small">Questions about these terms? Contact our office directly.</span>
                            <a href="{{url('contact-us')}}" class="btn theme-btn-1 btn-sm px-4 py-2 fw-bold" style="border-radius: var(--rr-radius-pill);">
                                Contact Office
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE DETAILS AREA END -->

@endsection