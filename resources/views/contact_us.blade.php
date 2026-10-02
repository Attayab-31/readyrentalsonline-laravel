@extends('layouts.front_end')

@section('page_content')

    <style type="text/css">
    	.font-weight-bold {
    		font-weight: bold;
    	}
        .rr-contact-card {
            background: #ffffff;
            border: 1px solid var(--rr-line);
            border-radius: var(--rr-radius-lg);
            padding: 36px 28px;
            box-shadow: var(--rr-shadow-sm);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }
        .rr-contact-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--rr-shadow-hover);
            border-color: var(--rr-ice-200);
        }
        .rr-contact-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            border-radius: var(--rr-radius-md);
            background: linear-gradient(135deg, var(--rr-ice-100) 0%, var(--rr-ice-50) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--rr-slate-600);
            border: 1px solid var(--rr-line);
        }
        .rr-contact-card h3 {
            font-size: 19px;
            font-weight: 700;
            color: var(--rr-navy-700);
            margin-bottom: 10px;
        }
        .rr-contact-card p {
            color: var(--rr-text-muted);
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }
        .rr-contact-card a {
            color: var(--rr-slate-600);
            font-weight: 600;
        }
        .rr-contact-card a:hover {
            color: var(--rr-navy-700);
            text-decoration: underline;
        }
    </style>	

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white mb-2">Contact Our Office</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul style="color: rgba(255,255,255,0.8);">
                                <li><a href="{{url('/')}}" class="text-white"><i class="fas fa-home me-1"></i> Home</a></li>
                                <li class="text-white-50">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="rr-section" style="background-color: var(--rr-ice-50);">
        <div class="container">
            <div class="rr-section-heading">
                <span class="rr-section-eyebrow">Get In Touch</span>
                <h2 class="rr-section-title">We Are Here To Help</h2>
                <p class="rr-section-subtitle">Reach out directly to our family team for property questions, scheduled walk-throughs, or application support.</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="rr-contact-card">
                        <div class="rr-contact-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h3>Email Address</h3>
                        <p><a href="mailto:info@readyrentalsonline.com">info@readyrentalsonline.com</a></p>
                        <p class="text-muted small mt-1">We respond within 1-2 business days</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="rr-contact-card">
                        <div class="rr-contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Direct Phone</h3>
                        <p><a href="tel:1-267-549-9625">1-267-549-9625</a></p>
                        <p class="text-muted small mt-1">Call for prompt assistance</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="rr-contact-card">
                        <div class="rr-contact-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3>Office Location</h3>
                        <p>1742 Delsea Drive<br>Deptford, NJ 08096</p>
                        <p class="text-muted small mt-1">Serving South Jersey &amp; Beyond</p>
                    </div>
                </div>
            </div>

            <!-- CONTACT FORM AREA -->
            <div class="row justify-content-center" id="form_container">
                <div class="col-lg-10">
                    <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm" style="border-color: var(--rr-line) !important;">
                        <div class="mb-4 text-center">
                            <h3 class="mb-2" style="font-weight: 700; color: var(--rr-navy-700);">Send Us a Message</h3>
                            <p class="text-muted">Fill out the inquiry form below and our team will get back to you promptly.</p>
                        </div>

                        @if(session('contact_submission_status') === 'success')
                            @include('partials.contact_submission_status', ['success' => true])
                        @else
                            @if(session('contact_submission_status') === 'error')
                                @include('partials.contact_submission_status', ['success' => false])
                            @endif
                            <div id="form_res" style="display:none"></div>
                            <form id="contact-form" action="{{ url('contact-us/process-form') }}" method="post">
		    	                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-muted" for="full_name">Your Full Name *</label>
                                        <span class="form-text text-danger font-weight-bold d-block mb-1" id="full_name_error">{{ $errors->first('full_name') }}</span>
                                        <div class="input-item input-item-name ltn__custom-icon m-0">
                                            <input type="text" id="full_name" name="full_name" placeholder="John Doe" value="{{ old('full_name')}}" class="form-control" autocomplete="name" aria-describedby="full_name_error" required style="border-radius: var(--rr-radius-sm); border: 1px solid var(--rr-line); height: 48px;">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-muted" for="email">Email Address *</label>
                                        <span class="form-text text-danger font-weight-bold d-block mb-1" id="email_error">{{ $errors->first('email') }}</span>
                                        <div class="input-item input-item-email ltn__custom-icon m-0">
                                            <input type="email" id="email" name="email" placeholder="name@example.com" value="{{ old('email')}}" class="form-control" autocomplete="email" aria-describedby="email_error" required style="border-radius: var(--rr-radius-sm); border: 1px solid var(--rr-line); height: 48px;">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-muted" for="service_type">Inquiry Reason *</label>
                                        <span class="form-text text-danger font-weight-bold d-block mb-1" id="service_type_error">{{ $errors->first('service_type') }}</span>
                                        <div class="input-item m-0">
                                            <select class="nice-select" name="service_type" id="service_type" aria-describedby="service_type_error" required style="border-radius: var(--rr-radius-sm); border: 1px solid var(--rr-line); height: 48px; line-height: 48px;">
                                                <option value="">Select Service Type</option>
                                                <option value="Property Rental" @if(old('service_type') == "Property Rental") selected @endif>Property Rental</option>
                                                <option value="General Help" @if(old('service_type') == "General Help") selected @endif>General Help</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-muted" for="phone_number">Phone Number *</label>
                                        <span class="form-text text-danger font-weight-bold d-block mb-1" id="phone_number_error">{{ $errors->first('phone_number') }}</span>
                                        <div class="input-item input-item-phone ltn__custom-icon m-0">
                                            <input type="tel" id="phone_number" name="phone_number" placeholder="(555) 000-0000" value="{{ old('phone_number')}}" class="form-control" autocomplete="tel" aria-describedby="phone_number_error" required style="border-radius: var(--rr-radius-sm); border: 1px solid var(--rr-line); height: 48px;">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="form-label fw-bold small text-muted" for="message">Your Message *</label>
                                        <span class="form-text text-danger font-weight-bold d-block mb-1" id="message_error">{{ $errors->first('message') }}</span>
                                        <div class="input-item input-item-textarea ltn__custom-icon m-0">
                                            <textarea name="message" id="message" placeholder="Please tell us how we can assist you..." class="form-control" aria-describedby="message_error" required style="border-radius: var(--rr-radius-sm); border: 1px solid var(--rr-line); min-height: 130px;">{{old('message')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase fw-bold px-5 py-3" id="form-sbm-btn" type="submit" style="border-radius: var(--rr-radius-pill);">
                                        <span>Send Message</span>
                                        <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                                <p class="form-messege mb-0 mt-20 text-center"></p>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->

@endsection

@section('page_level_scripts')
@endsection
