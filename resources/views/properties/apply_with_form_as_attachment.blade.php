@extends('layouts.front_end')

@section('page_content')

   <div class="ltn__utilize-overlay"></div>

    <div class="rr-print-application-hero">
        <div class="container">
            <nav class="rr-print-application-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                <a href="{{ url('/applications') }}">Applications</a>
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                <span aria-current="page">Printable application</span>
            </nav>
            <div class="rr-print-application-hero__content">
                <p class="rr-print-application-eyebrow">Prefer to apply offline?</p>
                <h1>Download the rental application</h1>
                <p>Get the application document, complete it at your own pace, then upload the signed form and supporting documents.</p>
            </div>
        </div>
    </div>

    <main class="rr-print-application-main" id="form_container">
        <div class="container">
            <div class="rr-print-application-layout">
                <section class="rr-print-application-card" aria-labelledby="rr-print-application-title">
                    <div class="rr-print-application-card__icon" aria-hidden="true">
                        <i class="fas fa-file-word"></i>
                    </div>
                    <p class="rr-print-application-eyebrow">Your application document</p>
                    <h2 id="rr-print-application-title">Rental application form</h2>
                    <p class="rr-print-application-card__description">Download the editable Word document, fill in all applicant details, and sign it before uploading.</p>
                    <div class="rr-print-application-file" aria-label="Word document, DOCX format">
                        <i class="fas fa-file-alt" aria-hidden="true"></i>
                        <span>Microsoft Word document</span>
                        <strong>.DOCX</strong>
                    </div>
                    <a href="{{ asset('resources/files/static/ReadyRentalsOnline.com-Rental-application-workup.docx') }}"
                       download
                       class="rr-print-application-download btn-effect-1"
                       aria-label="Download the rental application Word document">
                        <span><i class="fas fa-download" aria-hidden="true"></i> Download application</span>
                        <i class="fas fa-arrow-right rr-print-application-download__arrow" aria-hidden="true"></i>
                    </a>
                    <p class="rr-print-application-card__note">You can print the downloaded document if you prefer to complete it by hand.</p>
                </section>

                <aside class="rr-print-application-next" aria-labelledby="rr-print-next-title">
                    <p class="rr-print-application-eyebrow">What happens next</p>
                    <h2 id="rr-print-next-title">A simple three-step process</h2>
                    <ol>
                        <li>
                            <span>1</span>
                            <div><strong>Download and complete</strong><p>Fill out the application and sign where indicated.</p></div>
                        </li>
                        <li>
                            <span>2</span>
                            <div><strong>Prepare your documents</strong><p>Gather any supporting documents you want to include.</p></div>
                        </li>
                        <li>
                            <span>3</span>
                            <div><strong>Upload it securely</strong><p>Send us your completed application online.</p></div>
                        </li>
                    </ol>
                    <a href="{{ url('applications/upload-application-form') }}" class="rr-print-application-upload">
                        Continue to application upload <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="{{ url('online-application') }}" class="rr-print-application-online">
                        Prefer the online application?
                    </a>
                </aside>
            </div>
        </div>
    </main>

    <!-- CONTACT MESSAGE AREA START -->
{{--     <div class="ltn__contact-message-area mb-120 mb--100 mt-30" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">

                        <div id="form_res" style="display:none">
                            
                        </div>                                                

                        <form id="offline-application-form" action="{{ url('applications/submit-application-form/process-form') }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <h4 class="title-2">Fill out the Form Below and upload the completed application here <small class="field-req-desc">Required fields are marked with *</small></h4>
                            <h4 class="title-3"><small class="field-req-desc" style="font-size:14px;">*** Please fill out the fields below ***</small></h4>

                            <div class="row mb-20">
                                
                                <div class="col-md-6">
                                    <label class="label in-label" for="pa_property_id" >Select Your Property <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_property_id_error">{{ $errors->first('pa_property_id') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="nice-select" name="pa_property_id" id="pa_property_id" required>
                                            <option value="">--Select--</option>
                                            @foreach($db_data['Property'] as $Property)
                                                <option value="{{$Property->property_id}}" @if(old('pa_property_id') == $Property->property_id) selected @endif >{{'Title: '.$Property->p_title.' | Address: '.$Property->p_address}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label class="label in-label" for="pa_application_document_attached">Attach Your Form (.docx) <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_application_document_attached_error">{{ $errors->first('pa_application_document_attached') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="pa_application_document_attached" name="pa_application_document_attached" accept=".docx" required>
                                    </div>
                                </div>

 
                                
                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_name">Your Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" id="pa_applicant_name" name="pa_applicant_name" placeholder=" Type..." placeholders="Enter Your Name" value="{{ old('pa_applicant_name')}}" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_email">Email Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="email" id="pa_applicant_email" name="pa_applicant_email" placeholder=" Type..." placeholders="Enter Email Address" value="{{ old('pa_applicant_email')}}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_phone_num">Phone# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="tel" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder=" Type..." placeholders="Enter Phone#" value="{{ old('pa_applicant_phone_num')}}" required>
                                    </div>
                                </div>

                            </div>                            


                            <h4 class="title-2 mt-20">Terms Agreement <small class="field-req-desc">Required fields are marked with *</small></h4>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <label class="checkbox-item" for="pa_application_terms_agreement" >I Agree <a href="{{url('/terms-and-conditions-for-applications')}}" target="_blank" style="color:red">Applications Terms and Conditions</a> <span class="required-field">*</span>
                                        <span class="form-text text-danger font-weight-bold" id="pa_application_terms_agreement_error">{{ $errors->first('pa_application_terms_agreement') }}</span>

                                        <input type="checkbox"  @if(old('pa_application_terms_agreement') == "on") checked @endif id="pa_application_terms_agreement" name="pa_application_terms_agreement" required>
                                        <span class="checkmark"></span>
                                    
                                    </label>
                                </div> 

                            </div>


                            <div class="btn-wrapper mt-50">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" id="form-sbm-btn" type="submit">Submit Application</button>
                            </div>

                        </form>

                        </div>
                </div>
            </div>
        </div>
    </div>
 --}}



    <div class="mb-120">
    </div>
 
@endsection