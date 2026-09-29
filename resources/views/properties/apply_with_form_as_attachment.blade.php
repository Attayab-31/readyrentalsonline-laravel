@extends('layouts.front_end')

@section('page_content')

    <style type="text/css">
    	.font-weight-bold
    	{
    		font-weight: bold;
    	}

        input[type="text"], input[type="email"], input[type="password"],input[type="date"], input[type="submit"], textarea 
        {
            height: 32px !important;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-item .nice-select 
        {
            line-height: 32px;
            height: 32px;
            margin-bottom: 15px;
        }

		label 
		{
		    display: inline-block;
    		font-weight: bold;
		    color: #615a5a;
            font-size: 13px;
		}

		.form-text 
		{
    		margin-top: 0.25rem;
    		font-size: .975em;
		    color: #6c757d;
		}

		.field-req-desc
		{
			color: red;
			font-size: 12px;
		}	

		.required-field
		{
			color: red;
		}

        hr
        {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .ltn__breadcrumb-area 
        {
            /*padding-top: 20px;*/
            /*padding-bottom: 20px;*/
        }


    </style>	

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
                                <li><a href="{{url('/applications')}}"><span class="ltn__secondary-color"><i class="fas fa-clipboard-list"></i></span> Applications</a></li>
                                <li>Submit Your Application Form</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->


    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area" id="form_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">Download Your Form</h4>
                        <p>Click the link below to download the application form. After downloading the form, Fill out the form and attach your document <br> and <a style="color: red;font-weight: bold;text-decoration: underline;" href="{{url('applications/upload-application-form')}}">submit your application here</a>. We will reach back to you as soon as possible. Thank You! </p>
                        <a href="{{asset('resources/files/static/ReadyRentalsOnline.com-Rental-application-workup.docx')}}" download class="theme-btn-1 btn btn-effect-1"><i class="fas fa-clipboard-list"></i> Click Here to Download the Form</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT MESSAGE AREA START -->
{{--     <div class="ltn__contact-message-area mb-120 mb--100 mt-30" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">

                        <div id="form_res" style="display:none">
                            
                        </div>                                                

                        <form id="offline-application-form" action="{{ url('applications/submit-application-form/process-form') }}" method="post">
                        @csrf

                            <h4 class="title-2">Fill out the Form Below and upload the completed application here <small class="field-req-desc">Required fields are marked with *</small></h4>
                            <h4 class="title-3"><small class="field-req-desc" style="font-size:14px;">*** Please fill out the fields below ***</small></h4>

                            <div class="row mb-20">
                                
                                <div class="col-md-6">
                                    <label class="label in-label" for="pa_property_id" >Select Your Property <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_property_id_error">{{ $errors->first('pa_property_id') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="nice-select" name="pa_property_id" id="pa_property_id">
                                            <option value="">--Select--</option>
                                            @foreach($db_data['Property'] as $Property)
                                                <option value="{{$Property->property_id}}" @if(old('pa_property_id') == $Property->property_id) selected @endif >{{'Title: '.$Property->p_title.' | Address: '.$Property->p_address}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label class="label in-label" for="pa_application_document_attached">Attach Your Form <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_application_document_attached_error">{{ $errors->first('pa_application_document_attached') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" id="pa_application_document_attached" name="pa_application_document_attached" placeholder=" Type..." placeholders="Enter Attach Your Form" value="{{ old('pa_application_document_attached')}}">
                                    </div>
                                </div>

 
                                
                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_name">Your Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" id="pa_applicant_name" name="pa_applicant_name" placeholder=" Type..." placeholders="Enter Your Name" value="{{ old('pa_applicant_name')}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_email">Email Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" id="pa_applicant_email" name="pa_applicant_email" placeholder=" Type..." placeholders="Enter Email Address" value="{{ old('pa_applicant_email')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_phone_num">Phone# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder=" Type..." placeholders="Enter Phone#" value="{{ old('pa_applicant_phone_num')}}">
                                    </div>
                                </div>

                            </div>                            


                            <h4 class="title-2 mt-20">Terms Agreement <small class="field-req-desc">Required fields are marked with *</small></h4>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <label class="checkbox-item" for="pa_application_terms_agreement" >I Agree <a href="{{url('/terms-and-conditions-for-applications')}}" target="_blank" style="color:red">Applications Terms and Conditions</a> <span class="required-field">*</span>
                                        <span class="form-text text-danger font-weight-bold" id="pa_application_terms_agreement_error">{{ $errors->first('pa_application_terms_agreement') }}</span>

                                        <input type="checkbox"  @if(old('pa_application_terms_agreement') == "on") selected @endif id="pa_application_terms_agreement" name="pa_application_terms_agreement">
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