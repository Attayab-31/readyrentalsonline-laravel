@extends('layouts.front_end')

@section('page_content')

   <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('resources/front-end-assets')}}/img/bg/14.jpg" style="margin-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Submit Your Application Form</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{url('/')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                {{-- <li><a href="{{url('/applications')}}"><span class="ltn__secondary-color"><i class="fas fa-clipboard-list"></i></span> Applications</a></li> --}}
                                <li>Submit Your Application Form</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <section class="rr-upload-intro" aria-labelledby="rr-upload-title">
        <div class="container">
            <div class="rr-upload-intro__copy">
                <span class="rr-upload-intro__icon" aria-hidden="true"><i class="fas fa-file-upload"></i></span>
                <div>
                    <p class="rr-upload-intro__eyebrow">Offline application</p>
                    <h2 id="rr-upload-title">Upload your completed application</h2>
                    <p>Share your signed application and supporting documents securely. Fields marked with <span class="required-field">*</span> are required.</p>
                </div>
            </div>
            <a class="rr-upload-intro__link" href="{{ url('applications/submit-application-form') }}">
                <i class="fas fa-download" aria-hidden="true"></i>
                Download the application form
            </a>
        </div>
    </section>

    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area rr-upload-area mb-120 mb--100 mt-30" id="form_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg rr-upload-card">

                        <div id="form_res" style="display:none">
                            
                        </div>                                                

    <!-- Content -->
{{--     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>E-Signature</h1>
                <p>Sign in the canvas below and save your signature as an image!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="sig-canvas" width="620" height="160">
                    Get a better browser, bro.
                </canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                <button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <textarea id="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <img id="sig-image" src="" alt="Your signature will go here!"/>
            </div>
        </div>
    </div> --}}



                        <form id="offline-application-form" action="{{ url('applications/upload-application-form/process-form') }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <div class="rr-upload-section-heading">
                                <span class="rr-upload-section-heading__step">01</span>
                                <div>
                                    <h3>Application and contact details</h3>
                                    <p>Choose the rental property and tell us how to reach you.</p>
                                </div>
                            </div>

                            <div class="row rr-upload-fields">
                                
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
                                    <label class="label in-label" for="pa_application_document_attached">Completed application (.docx) <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_application_document_attached_error">{{ $errors->first('pa_application_document_attached') }}</span></label>
                                    <div class="rr-upload-file-input">
                                        <i class="fas fa-file-word" aria-hidden="true"></i>
                                        <input type="file" id="pa_application_document_attached" name="pa_application_document_attached" accept=".docx" aria-describedby="pa_application_document_attached_error" required>
                                        <span>Word document (.docx)</span>
                                    </div>
                                </div>

 
                                
                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_name">Full name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" id="pa_applicant_name" name="pa_applicant_name" placeholder="Enter your full name" value="{{ old('pa_applicant_name')}}" autocomplete="name" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_email">Email Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="email" id="pa_applicant_email" name="pa_applicant_email" placeholder="you@example.com" value="{{ old('pa_applicant_email')}}" autocomplete="email" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_phone_num">Phone# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="tel" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder="(555) 555-5555" value="{{ old('pa_applicant_phone_num')}}" autocomplete="tel" required>
                                    </div>
                                </div>

                            </div>                            


                            <section class="rr-upload-section" aria-labelledby="rr-additional-documents-title">
                                <div class="rr-upload-section-heading">
                                    <span class="rr-upload-section-heading__step">02</span>
                                    <div>
                                        <h3 id="rr-additional-documents-title">Supporting documents <span>Optional</span></h3>
                                        <p>Add up to eight helpful documents, such as government ID or proof of income.</p>
                                    </div>
                                </div>

                            <div class="row rr-upload-documents">

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_1">Additional document 1 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_1" name="additional_doc_1" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_1')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_2">Additional document 2 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_2" name="additional_doc_2" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_2')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_3">Additional document 3 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_3" name="additional_doc_3" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_3')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_4">Additional document 4 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_4" name="additional_doc_4" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_4')}}">
                                    </div>
                                </div> 



                            </div>



                            <div class="row rr-upload-documents">


                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_5">Additional document 5 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_5" name="additional_doc_5" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_5')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_6">Additional document 6 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_6" name="additional_doc_6" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_6')}}">
                                    </div>
                                </div>  


                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_7">Additional document 7 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_7" name="additional_doc_7" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_7')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="additional_doc_8">Additional document 8 (optional)</label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_8" name="additional_doc_8" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_8')}}">
                                    </div>
                                </div>                                                                                                 

                            </div>                            
                            </section>






                            <section class="rr-upload-section rr-signature-section" aria-labelledby="rr-signature-title">
                                <div class="rr-upload-section-heading">
                                    <span class="rr-upload-section-heading__step">03</span>
                                    <div>
                                        <h3 id="rr-signature-title">Your signature <span class="required-field">*</span></h3>
                                        <p>Sign in the box using your finger, stylus, or mouse.</p>
                                    </div>
                                </div>
                                <span class="form-text text-danger font-weight-bold" id="e_sign_error">{{ $errors->first('e_sign') }}</span>

                                <div class="rr-signature-pad">
                                    <canvas id="sig-canvas" width="620" height="200" aria-label="Draw your signature">
                                        Your browser does not support canvas. Please use a modern browser to sign.
                                    </canvas>
                                    <div class="rr-signature-pad__footer">
                                        <span>Signature required to submit</span>
                                        <button id="clearsignatureBtn" class="rr-signature-clear" type="button">
                                            <i class="fas fa-eraser" aria-hidden="true"></i> Clear signature
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="e_sign" id="e_sign" value="">
                            </section>

                            <section class="rr-upload-section rr-upload-terms" aria-labelledby="rr-upload-terms-title">
                                <div class="rr-upload-section-heading">
                                    <span class="rr-upload-section-heading__step">04</span>
                                    <div>
                                        <h3 id="rr-upload-terms-title">Review and agree</h3>
                                        <p>Please confirm that you accept the application terms before submitting.</p>
                                    </div>
                                </div>
                                <div class="rr-upload-terms__choice">
                                    <label class="checkbox-item" for="pa_application_terms_agreement">
                                        I agree to the <a href="{{url('/terms-and-conditions-for-applications')}}" target="_blank" rel="noopener noreferrer">Application Terms and Conditions</a>
                                        <span class="required-field">*</span>
                                        <span class="form-text text-danger font-weight-bold" id="pa_application_terms_agreement_error">{{ $errors->first('pa_application_terms_agreement') }}</span>
                                        <input type="checkbox" @if(old('pa_application_terms_agreement') == "on") checked @endif id="pa_application_terms_agreement" name="pa_application_terms_agreement" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </section>

                            <div class="btn-wrapper rr-upload-submit">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase upload-appform-submit-btn" id="form-sbm-btn" type="submit">
                                    <span>Submit Application</span>
                                </button>
                            </div>

                        </form>

                        </div>
                </div>
            </div>
        </div>
    </div>




    <div class="mb-120">
    </div>
 
@endsection