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

        select {
            height: 32px !important;
            margin-bottom: 15px;
            width: 100%;
            background-color: var(--white);
            border: 2px solid;
            border-color: var(--border-color-9);
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

        .input_field_error
        {
            border: 2px solid !important;
            border-color: red !important;
        }
        
        
        .input_field_valid
        {
            border: 2px solid !important;
            border-color: green !important;
        }
        
        #sig-canvas {
          border: 2px dotted #CCCCCC;
          border-radius: 15px;
          cursor: crosshair;
        }


        #sig-canvas2 {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }
        
            
        @keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 0; }
          100% { opacity: 1; }
        }
        
        .blink {
          animation: blink 1s infinite;
        }

        
        
        .extra-large-select {
            font-size: 20px; /* Large font size for easier reading */
            padding: 10px 20px; /* More padding for a larger appearance */
            /*height: auto; */
            /* Adjust height as needed 
            width: 100%; /* Optional: Adjust width as needed */
            height: 52px !important;
        }

    </style>	

   <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('resources/front-end-assets')}}/img/bg/14.jpg" style="margin-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Submit Your Online Application</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{url('/')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li><a href="{{url('/applications')}}"><span class="ltn__secondary-color"><i class="fas fa-clipboard-list"></i></span> Applications</a></li>
                                <li>Submit Online Application</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
     
    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100" id="form_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">

                        <div id="form_res" style="display:none">
                            
                        </div>                                                

                        <form id="online-application-form-step-one" action="{{ url('applications/apply-online/process-form') }}" method="post">
		    	        @csrf

                            <h4 class="title-2">Select Property <small class="field-req-desc">Required fields are marked with *</small></h4>
                            <div class="row mb-20">
                                
                                <div class="col-md-12">
                                    <label class="label in-label" for="pa_property_id" >Select Your Property <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_property_id_error">{{ $errors->first('pa_property_id') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_property_id" id="pa_property_id">
                                            <option value="">--Select--</option>
                                            @foreach($db_data['Property'] as $Property)
                                                <option value="{{$Property->property_id}}" @if(old('pa_property_id') == $Property->property_id) selected @endif >{{'Title: '.$Property->p_title.' | Address: '.$Property->p_address}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>




                            <h4 class="title-2" style="margin-bottom: 15px;">Applicant Information <small class="field-req-desc">Required fields are marked with *</small></h4>
                        	<h4 class="title-3"><small class="field-req-desc" style="font-size:17px;">**Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</small></h4>

                            <div class="row">
                                
                                <div class="col-md-4">
                                	<label class="label in-label" for="pa_applicant_name" >Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_name" name="pa_applicant_name" placeholder=" Type..." placeholders="Enter name" value="{{ old('pa_applicant_name')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                	<label class="label in-label" for="pa_applicant_social_sec_num" >SS# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_social_sec_num_error">{{ $errors->first('pa_applicant_social_sec_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_social_sec_num" name="pa_applicant_social_sec_num" placeholder=" Type..." placeholders="Enter SS#" value="{{ old('pa_applicant_social_sec_num')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_driv_lic_num" >Driver Lic # <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_driv_lic_num_error">{{ $errors->first('pa_applicant_driv_lic_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_driv_lic_num" name="pa_applicant_driv_lic_num" placeholder=" Type..." placeholders="Enter Driver Lic #" value="{{ old('pa_applicant_driv_lic_num')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_dob" >Date of Birth <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_dob_error">{{ $errors->first('pa_applicant_dob') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="date" class="input_field" id="pa_applicant_dob" name="pa_applicant_dob" placeholder=" Type..." placeholders="Enter Date of Birth" value="{{ old('pa_applicant_dob')}}">
                                    </div>
                                </div>
                                     

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_email" >Email <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_email" name="pa_applicant_email" placeholder=" Type..." placeholders="Enter Email" value="{{ old('pa_applicant_email')}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_own_or_rent_monthly_payment" >Own/Rent Monthly Payment $ <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_own_or_rent_monthly_payment_error">{{ $errors->first('pa_applicant_own_or_rent_monthly_payment') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_own_or_rent_monthly_payment" name="pa_applicant_own_or_rent_monthly_payment" placeholder=" Type..." placeholders="Enter Own/Rent Monthly Payment $" value="{{ old('pa_applicant_own_or_rent_monthly_payment')}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_phone_num">Phone# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder=" Type..." placeholders="Enter Phone#" value="{{ old('pa_applicant_phone_num')}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_current_add" >Current Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_add_error">{{ $errors->first('pa_applicant_current_add') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_current_add" name="pa_applicant_current_add" placeholder=" Type..." placeholders="Enter Current Address" value="{{ old('pa_applicant_current_add')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_current_city" >Current City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_city_error">{{ $errors->first('pa_applicant_current_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_current_city" name="pa_applicant_current_city" placeholder=" Type..." placeholders="Enter Current City" value="{{ old('pa_applicant_current_city')}}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label class="label in-label" for="pa_applicant_current_state" >Current State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_state_error">{{ $errors->first('pa_applicant_current_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_current_state" name="pa_applicant_current_state" placeholder=" Type..." placeholders="Enter Current State" value="{{ old('pa_applicant_current_state')}}">
                                    </div>
                                </div>                                                                                                                                                                
                                <div class="col-md-2">
                                    <label class="label in-label" for="pa_applicant_current_zip" >Current ZIP Code <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_zip_error">{{ $errors->first('pa_applicant_current_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_current_zip" name="pa_applicant_current_zip" placeholder=" Type..." placeholders="Enter Current ZIP Code" value="{{ old('pa_applicant_current_zip')}}">
                                    </div>
                                </div>

                            </div>
 
                            <div class="row">

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_previous_add" >Previous Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_add_error">{{ $errors->first('pa_applicant_previous_add') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_previous_add" name="pa_applicant_previous_add" placeholder=" Type..." placeholders="Enter Previous Address" value="{{ old('pa_applicant_previous_add')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_previous_city" >Previous City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_city_error">{{ $errors->first('pa_applicant_previous_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_previous_city" name="pa_applicant_previous_city" placeholder=" Type..." placeholders="Enter Previous City" value="{{ old('pa_applicant_previous_city')}}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label class="label in-label" for="pa_applicant_previous_state" >Previous State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_state_error">{{ $errors->first('pa_applicant_previous_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_previous_state" name="pa_applicant_previous_state" placeholder=" Type..." placeholders="Enter Previous State" value="{{ old('pa_applicant_previous_state')}}">
                                    </div>
                                </div>                                                                                                                                                                
                                <div class="col-md-2">
                                    <label class="label in-label" for="pa_applicant_previous_zip" >Previous ZIP Code <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_zip_error">{{ $errors->first('pa_applicant_previous_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_previous_zip" name="pa_applicant_previous_zip" placeholder=" Type..." placeholders="Enter Previous ZIP Code" value="{{ old('pa_applicant_current_zip')}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_landlord_name" >Landlord name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_name_error">{{ $errors->first('pa_applicant_landlord_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_landlord_name" name="pa_applicant_landlord_name" placeholder=" Type..." placeholders="Enter Landlord name" value="{{ old('pa_applicant_landlord_name')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_landlord_phone" >Landlord phone # <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_phone_error">{{ $errors->first('pa_applicant_landlord_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_landlord_phone" name="pa_applicant_landlord_phone" placeholder=" Type..." placeholders="Enter Landlord phone #" value="{{ old('pa_applicant_landlord_phone')}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_applicant_reason_for_leaving" >Reason for leaving <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_reason_for_leaving_error">{{ $errors->first('pa_applicant_reason_for_leaving') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_reason_for_leaving" name="pa_applicant_reason_for_leaving" placeholder=" Type..." placeholders="Enter Reason for leaving" value="{{ old('pa_applicant_reason_for_leaving')}}">
                                    </div>
                                </div>                                                                                                                                         

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_have_pets" >Do you have pets? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_have_pets_error">{{ $errors->first('pa_applicant_have_pets') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_have_pets" id="pa_applicant_have_pets">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_have_pets') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_have_pets') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label auto_disabled_label" for="pa_applicant_pet_type" >Pet Type <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_pet_type_error">{{ $errors->first('pa_applicant_pet_type') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_pet_type" class="auto_disabled_field" name="pa_applicant_pet_type" placeholder=" Type..." placeholders="Enter Pet Type" value="{{ old('pa_applicant_pet_type')}}">
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <label class="label in-label" for="pa_applicant_bankruptcy" >Bankruptcy? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_error">{{ $errors->first('pa_applicant_bankruptcy') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_bankruptcy" id="pa_applicant_bankruptcy">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_bankruptcy') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_bankruptcy') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_bankruptcy_year" >Bankruptcy Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_year_error">{{ $errors->first('pa_applicant_bankruptcy_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_bankruptcy_year" class="auto_disabled_field" name="pa_applicant_bankruptcy_year" placeholder=" Type..." placeholders="Enter Bankruptcy Year" value="{{ old('pa_applicant_bankruptcy_year')}}">
                                    </div>
                                </div>  



                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_lawsuites" >Lawsuit? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_error">{{ $errors->first('pa_applicant_lawsuites') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_lawsuites" id="pa_applicant_lawsuites">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_lawsuites') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_lawsuites') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_lawsuites_year" >Lawsuit Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_year_error">{{ $errors->first('pa_applicant_lawsuites_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_lawsuites_year" class="auto_disabled_field" name="pa_applicant_lawsuites_year" placeholder=" Type..." placeholders="Enter Lawsuit Year" value="{{ old('pa_applicant_lawsuites_year')}}">
                                    </div>
                                </div>  



                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_ever_evicted" >Ever Been Evicted? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_ever_evicted_error">{{ $errors->first('pa_applicant_ever_evicted') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_ever_evicted" id="pa_applicant_ever_evicted">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_ever_evicted') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_ever_evicted') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_eviction_year" >Eviction Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_eviction_year_error">{{ $errors->first('pa_applicant_eviction_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_eviction_year" class="auto_disabled_field" name="pa_applicant_eviction_year" placeholder=" Type..." placeholders="Enter Eviction Year" value="{{ old('pa_applicant_eviction_year')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_felony_conviction" >Convicted of a felony? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_error">{{ $errors->first('pa_applicant_felony_conviction') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_felony_conviction" id="pa_applicant_felony_conviction">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_felony_conviction') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_felony_conviction') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_felony_conviction_year" >Felony Conviction Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_year_error">{{ $errors->first('pa_applicant_felony_conviction_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_felony_conviction_year" class="auto_disabled_field" name="pa_applicant_felony_conviction_year" placeholder=" Type..." placeholders="Enter Felony Conviction Year" value="{{ old('pa_applicant_felony_conviction_year')}}">
                                    </div>
                                </div> 


                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_judgments_or_fillings" >Judgements/filings <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_error">{{ $errors->first('pa_applicant_judgments_or_fillings') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_judgments_or_fillings" id="pa_applicant_judgments_or_fillings">
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if(old('pa_applicant_judgments_or_fillings') == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if(old('pa_applicant_judgments_or_fillings') == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_judgments_or_fillings_year" >Judgements/filings Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_year_error">{{ $errors->first('pa_applicant_judgments_or_fillings_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_judgments_or_fillings_year" class="auto_disabled_field" name="pa_applicant_judgments_or_fillings_year" placeholder=" Type..." placeholders="Enter Judgements/filings Year" value="{{ old('pa_applicant_judgments_or_fillings_year')}}">
                                    </div>
                                </div>                                                                                                                                                                                                                                                                        
                            </div>



                            <h4 class="title-2 mt-20">Employment Information <small class="field-req-desc">Required fields are marked with *</small></h4>

                            <div class="row">

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_name" >Employer Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_name_error">{{ $errors->first('pa_employer_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_name" name="pa_employer_name" placeholder=" Type..." placeholders="Enter Employer Name" value="{{ old('pa_employer_name')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employment_length" >Employment Length  in months <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employment_length_error">{{ $errors->first('pa_employment_length') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employment_length" name="pa_employment_length" placeholder=" Type..." placeholders="Enter Employment Length in months" value="{{ old('pa_employment_length')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_phone" >Employer Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_phone_error">{{ $errors->first('pa_employer_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_phone" name="pa_employer_phone" placeholder=" Type..." placeholders="Enter Employer Phone" value="{{ old('pa_employer_phone')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employment_position" >Employment Positions <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employment_position_error">{{ $errors->first('pa_employment_position') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employment_position" name="pa_employment_position" placeholder=" Type..." placeholders="Enter Employment Positions" value="{{ old('pa_employment_position')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_address" >Employer Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_address_error">{{ $errors->first('pa_employer_address') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_address" name="pa_employer_address" placeholder=" Type..." placeholders="Enter Employer Address" value="{{ old('pa_employer_address')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_city" >Employer City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_city_error">{{ $errors->first('pa_employer_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_city" name="pa_employer_city" placeholder=" Type..." placeholders="Enter Employer City" value="{{ old('pa_employer_city')}}">
                                    </div>
                                </div>                                                                                                                                 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_state" >Employer state <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_state_error">{{ $errors->first('pa_employer_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_state" name="pa_employer_state" placeholder=" Type..." placeholders="Enter Employer state" value="{{ old('pa_employer_state')}}">
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_employer_zip" >Employer Zip <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_zip_error">{{ $errors->first('pa_employer_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_zip" name="pa_employer_zip" placeholder=" Type..." placeholders="Enter Employer Zip" value="{{ old('pa_employer_zip')}}">
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_monthly_income" >Monthly income <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_monthly_income_error">{{ $errors->first('pa_monthly_income') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_monthly_income" name="pa_monthly_income" placeholder=" Type..." placeholders="Enter Monthly income" value="{{ old('pa_monthly_income')}}">
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_supervisor_name" >Supervisor Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_name_error">{{ $errors->first('pa_supervisor_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_name" name="pa_supervisor_name" placeholder=" Type..." placeholders="Enter Supervisor Name" value="{{ old('pa_supervisor_name')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_supervisor_phone" >Supervisor Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_phone_error">{{ $errors->first('pa_supervisor_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_phone" name="pa_supervisor_phone" placeholder=" Type..." placeholders="Enter Supervisor Phone" value="{{ old('pa_supervisor_phone')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_supervisor_fax" >Supervisor Fax <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_fax_error">{{ $errors->first('pa_supervisor_fax') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_fax" name="pa_supervisor_fax" placeholder=" Type..." placeholders="Enter Supervisor Fax" value="{{ old('pa_supervisor_fax')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_supervisor_email" >Supervisor Email <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_email_error">{{ $errors->first('pa_supervisor_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_email" name="pa_supervisor_email" placeholder=" Type..." placeholders="Enter Supervisor Email" value="{{ old('pa_supervisor_email')}}">
                                    </div>
                                </div>                                                                                                                                                                                                 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_other_monthly_income" >Other Mothly Income <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_other_monthly_income_error">{{ $errors->first('pa_other_monthly_income') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_other_monthly_income" name="pa_other_monthly_income" placeholder=" Type..." placeholders="Enter Other Mothly Income" value="{{ old('pa_other_monthly_income')}}">
                                    </div>
                                </div> 



                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_other_monthly_income_reason" >Other Monthly Income Reason <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_other_monthly_income_reason_error">{{ $errors->first('pa_other_monthly_income_reason') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_other_monthly_income_reason" name="pa_other_monthly_income_reason" placeholder=" Type..." placeholders="Enter Other Monthly Income Reason" value="{{ old('pa_other_monthly_income_reason')}}">
                                    </div>
                                </div>                                 

                            </div>


                            <h4 class="title-2 mt-20">Emergency Contact <small class="field-req-desc">Required fields are marked with *</small></h4>

                            <div class="row">

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_name" >Emergency Contact Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_name_error">{{ $errors->first('pa_emergency_contact_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_name" name="pa_emergency_contact_name" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ old('pa_emergency_contact_name')}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_phone" >Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_phone_error">{{ $errors->first('pa_emergency_contact_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_phone" name="pa_emergency_contact_phone" placeholder=" Type..." placeholders="Enter Phone" value="{{ old('pa_emergency_contact_phone')}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_address" >Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_address_error">{{ $errors->first('pa_emergency_contact_address') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_address" name="pa_emergency_contact_address" placeholder=" Type..." placeholders="Enter Address" value="{{ old('pa_emergency_contact_address')}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_city" >City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_city_error">{{ $errors->first('pa_emergency_contact_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_city" name="pa_emergency_contact_city" placeholder=" Type..." placeholders="Enter City" value="{{ old('pa_emergency_contact_city')}}">
                                    </div>
                                </div>                                                                                                                                 

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_state" >State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_state_error">{{ $errors->first('pa_emergency_contact_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_state" name="pa_emergency_contact_state" placeholder=" Type..." placeholders="Enter State" value="{{ old('pa_emergency_contact_state')}}">
                                    </div>
                                </div>  


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_zip" >Zip <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_zip_error">{{ $errors->first('pa_emergency_contact_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_zip" name="pa_emergency_contact_zip" placeholder=" Type..." placeholders="Enter Zip" value="{{ old('pa_emergency_contact_zip')}}">
                                    </div>
                                </div>  
 
                            </div>




                            <h4 class="title-2 mt-80">Applicant's Signature <span class="required-field">*</span> <span style="font-size: .6em !important;" class="form-text text-danger font-weight-bold" id="e_sign_error">{{ $errors->first('e_sign') }}</span></h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="sig-canvas" width="620" height="200">
                                        Your borwser does not support Canvas.
                                    </canvas>
                                </div>
                            </div>
                            <input type="hidden" name="e_sign" id="e_sign" value="">
                            
                            <span id="clearsignatureBtn" class="btn">Clear Your Signature</span>



                            <hr>

                            <div class="col-md-12">
                                <label class="label in-label" for="pa_is_there_a_coapplicant"><h3>is there a co-applicant? <span class="required-field">*</span></h3>  <span class="form-text text-danger font-weight-bold" id="pa_is_there_a_coapplicant_error">{{ $errors->first('pa_is_there_a_coapplicant') }}</span></label>
                                <div class="input-item input-item-name">
                                    <select class="input_field extra-large-select" name="pa_is_there_a_coapplicant" id="pa_is_there_a_coapplicant" >
                                        <option value="">--Select--</option>
                                        <option value="Yes" @if(old('pa_is_there_a_coapplicant') == "Yes") selected @endif >Yes </option>
                                        <option value="No" @if(old('pa_is_there_a_coapplicant') == "No") selected @endif >No </option>
                                    </select>
                                </div>
                            </div>
 

                            
                            <div id="coapplicant-fields">
                                
                                
                                
                                <h1 style="color:red">Please fill out Co-Applicant information below</h1>
                                
                                <!--All Field Goes here -->
                                
                                <div style="padding-top:50px !important">
                                    <hr>
                                </div>
                            
                                <h4 class="title-2 mt-20">Co-applicant Information <small class="field-req-desc">Required fields are marked with *</small></h4>
    
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_name" >Name <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_name_error">{{ $errors->first('pa_co_applicant_name') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_name" name="pa_co_applicant_name" placeholder=" Type..." placeholders="Enter name" value="{{ old('pa_co_applicant_name')}}">
                                        </div>
                                    </div>
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_social_sec_num" >SS# <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_social_sec_num_error">{{ $errors->first('pa_co_applicant_social_sec_num') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_social_sec_num" name="pa_co_applicant_social_sec_num" placeholder=" Type..." placeholders="Enter SS#" value="{{ old('pa_co_applicant_social_sec_num')}}">
                                        </div>
                                    </div>
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_driv_lic_num" >Driver Lic # <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_driv_lic_num_error">{{ $errors->first('pa_co_applicant_driv_lic_num') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_driv_lic_num" name="pa_co_applicant_driv_lic_num" placeholder=" Type..." placeholders="Enter Driver Lic #" value="{{ old('pa_co_applicant_driv_lic_num')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_dob" >Date of Birth <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_dob_error">{{ $errors->first('pa_co_applicant_dob') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="date" id="pa_co_applicant_dob" name="pa_co_applicant_dob" placeholder=" Type..." placeholders="Enter Date of Birth" value="{{ old('pa_co_applicant_dob')}}">
                                        </div>
                                    </div>
                                         
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_email" >Email <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_email_error">{{ $errors->first('pa_co_applicant_email') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_email" name="pa_co_applicant_email" placeholder=" Type..." placeholders="Enter Email" value="{{ old('pa_co_applicant_email')}}">
                                        </div>
                                    </div>
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_own_or_rent_monthly_payment" >Own/Rent Monthly Payment $ <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_own_or_rent_monthly_payment_error">{{ $errors->first('pa_co_applicant_own_or_rent_monthly_payment') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_own_or_rent_monthly_payment" name="pa_co_applicant_own_or_rent_monthly_payment" placeholder=" Type..." placeholders="Enter Own/Rent Monthly Payment $" value="{{ old('pa_co_applicant_own_or_rent_monthly_payment')}}">
                                        </div>
                                    </div>
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_phone_num">Phone# <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_phone_num_error">{{ $errors->first('pa_co_applicant_phone_num') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_phone_num" name="pa_co_applicant_phone_num" placeholder=" Type..." placeholders="Enter Phone#" value="{{ old('pa_co_applicant_phone_num')}}">
                                        </div>
                                    </div>
    
                                </div>
    
                                <div class="row">
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_current_add" >Current Address <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_current_add_error">{{ $errors->first('pa_co_applicant_current_add') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_current_add" name="pa_co_applicant_current_add" placeholder=" Type..." placeholders="Enter Current Address" value="{{ old('pa_co_applicant_current_add')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_current_city" >Current City <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_current_city_error">{{ $errors->first('pa_co_applicant_current_city') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_current_city" name="pa_co_applicant_current_city" placeholder=" Type..." placeholders="Enter Current City" value="{{ old('pa_co_applicant_current_city')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-2">
                                        <label class="label in-label" for="pa_co_applicant_current_state" >Current State <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_current_state_error">{{ $errors->first('pa_co_applicant_current_state') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_current_state" name="pa_co_applicant_current_state" placeholder=" Type..." placeholders="Enter Current State" value="{{ old('pa_co_applicant_current_state')}}">
                                        </div>
                                    </div>                                                                                                                                                                
                                    <div class="col-md-2">
                                        <label class="label in-label" for="pa_co_applicant_current_zip" >Current ZIP Code <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_current_zip_error">{{ $errors->first('pa_co_applicant_current_zip') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_current_zip" name="pa_co_applicant_current_zip" placeholder=" Type..." placeholders="Enter Current ZIP Code" value="{{ old('pa_co_applicant_current_zip')}}">
                                        </div>
                                    </div>
    
                                </div>
     
                                <div class="row">
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_previous_add" >Previous Address <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_previous_add_error">{{ $errors->first('pa_co_applicant_previous_add') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_previous_add" name="pa_co_applicant_previous_add" placeholder=" Type..." placeholders="Enter Previous Address" value="{{ old('pa_co_applicant_previous_add')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_previous_city" >Previous City <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_previous_city_error">{{ $errors->first('pa_co_applicant_previous_city') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_previous_city" name="pa_co_applicant_previous_city" placeholder=" Type..." placeholders="Enter Previous City" value="{{ old('pa_co_applicant_previous_city')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-2">
                                        <label class="label in-label" for="pa_co_applicant_previous_state" >Previous State <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_previous_state_error">{{ $errors->first('pa_co_applicant_previous_state') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_previous_state" name="pa_co_applicant_previous_state" placeholder=" Type..." placeholders="Enter Previous State" value="{{ old('pa_co_applicant_previous_state')}}">
                                        </div>
                                    </div>                                                                                                                                                                
                                    <div class="col-md-2">
                                        <label class="label in-label" for="pa_co_applicant_previous_zip" >Previous ZIP Code <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_previous_zip_error">{{ $errors->first('pa_co_applicant_previous_zip') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_previous_zip" name="pa_co_applicant_previous_zip" placeholder=" Type..." placeholders="Enter Previous ZIP Code" value="{{ old('pa_co_applicant_current_zip')}}">
                                        </div>
                                    </div>
    
                                </div>
    
                                <div class="row">
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_landlord_name" >Landlord name <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_landlord_name_error">{{ $errors->first('pa_co_applicant_landlord_name') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_landlord_name" name="pa_co_applicant_landlord_name" placeholder=" Type..." placeholders="Enter Landlord name" value="{{ old('pa_co_applicant_landlord_name')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_landlord_phone" >Landlord phone # <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_landlord_phone_error">{{ $errors->first('pa_co_applicant_landlord_phone') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_landlord_phone" name="pa_co_applicant_landlord_phone" placeholder=" Type..." placeholders="Enter Landlord phone #" value="{{ old('pa_co_applicant_landlord_phone')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_reason_for_leaving" >Reason for leaving <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_reason_for_leaving_error">{{ $errors->first('pa_co_applicant_reason_for_leaving') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_reason_for_leaving" name="pa_co_applicant_reason_for_leaving" placeholder=" Type..." placeholders="Enter Reason for leaving" value="{{ old('pa_co_applicant_reason_for_leaving')}}">
                                        </div>
                                    </div>                                                                                                                                         
    
                                </div>
    
                                <hr>
    
                                <div class="row">
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_have_pets" >Do you have pets? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_have_pets_error">{{ $errors->first('pa_co_applicant_have_pets') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_have_pets" id="pa_co_applicant_have_pets">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_have_pets') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_have_pets') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_pet_type" >Pet Type <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_pet_type_error">{{ $errors->first('pa_co_applicant_pet_type') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_pet_type" class="auto_disabled_field" name="pa_co_applicant_pet_type" placeholder=" Type..." placeholders="Enter Pet Type" value="{{ old('pa_co_applicant_pet_type')}}">
                                        </div>
                                    </div>
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_bankruptcy" >Bankruptcy? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_bankruptcy_error">{{ $errors->first('pa_co_applicant_bankruptcy') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_bankruptcy" id="pa_co_applicant_bankruptcy">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_bankruptcy') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_bankruptcy') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_bankruptcy_year" >Bankruptcy Year <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_bankruptcy_year_error">{{ $errors->first('pa_co_applicant_bankruptcy_year') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_bankruptcy_year" class="auto_disabled_field" name="pa_co_applicant_bankruptcy_year" placeholder=" Type..." placeholders="Enter Bankruptcy Year" value="{{ old('pa_co_applicant_bankruptcy_year')}}">
                                        </div>
                                    </div>  
    
    
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_lawsuites" >Lawsuite? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_lawsuites_error">{{ $errors->first('pa_co_applicant_lawsuites') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_lawsuites" id="pa_co_applicant_lawsuites">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_lawsuites') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_lawsuites') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_lawsuites_year" >Lawsuit Year <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_lawsuites_year_error">{{ $errors->first('pa_co_applicant_lawsuites_year') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_lawsuites_year" class="auto_disabled_field" name="pa_co_applicant_lawsuites_year" placeholder=" Type..." placeholders="Enter Lawsuit Year" value="{{ old('pa_co_applicant_lawsuites_year')}}">
                                        </div>
                                    </div>  
    
    
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_ever_evicted" >Ever Been Evicted? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_ever_evicted_error">{{ $errors->first('pa_co_applicant_ever_evicted') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_ever_evicted" id="pa_co_applicant_ever_evicted">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_ever_evicted') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_ever_evicted') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_eviction_year" >Eviction Year <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_eviction_year_error">{{ $errors->first('pa_co_applicant_eviction_year') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_eviction_year" class="auto_disabled_field" name="pa_co_applicant_eviction_year" placeholder=" Type..." placeholders="Enter Eviction Year" value="{{ old('pa_co_applicant_eviction_year')}}">
                                        </div>
                                    </div> 
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_felony_conviction" >Convicted of a felony? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_felony_conviction_error">{{ $errors->first('pa_co_applicant_felony_conviction') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_felony_conviction" id="pa_co_applicant_felony_conviction">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_felony_conviction') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_felony_conviction') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_felony_conviction_year" >Felony Conviction Year <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_felony_conviction_year_error">{{ $errors->first('pa_co_applicant_felony_conviction_year') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_felony_conviction_year" class="auto_disabled_field" name="pa_co_applicant_felony_conviction_year" placeholder=" Type..." placeholders="Enter Felony Conviction Year" value="{{ old('pa_co_applicant_felony_conviction_year')}}">
                                        </div>
                                    </div> 
    
    
                                    <div class="col-md-3">
                                        <label class="label in-label" for="pa_co_applicant_judgments_or_fillings" >Judgements/filings? <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_judgments_or_fillings_error">{{ $errors->first('pa_co_applicant_judgments_or_fillings') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <select class="input_field" name="pa_co_applicant_judgments_or_fillings" id="pa_co_applicant_judgments_or_fillings">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if(old('pa_co_applicant_judgments_or_fillings') == "Yes") selected @endif >Yes </option>
                                                <option value="No" @if(old('pa_co_applicant_judgments_or_fillings') == "No") selected @endif >No </option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 disabled_by_default">
                                        <label class="label in-label" for="pa_co_applicant_judgments_or_fillings_year" >Judgements/filings Year <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_judgments_or_fillings_year_error">{{ $errors->first('pa_co_applicant_judgments_or_fillings_year') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_judgments_or_fillings_year" class="auto_disabled_field" name="pa_co_applicant_judgments_or_fillings_year" placeholder=" Type..." placeholders="Enter Judgements/filings Year" value="{{ old('pa_co_applicant_judgments_or_fillings_year')}}">
                                        </div>
                                    </div>                                                                                                                                                                                                                                                                        
                                </div>
    
                                <h4 class="title-2 mt-20">Co-Applicant Employment Information <small class="field-req-desc">Required fields are marked with *</small></h4>
    
                                <div class="row">
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_name" >Employer Name <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_name_error">{{ $errors->first('pa_co_applicant_employer_name') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_name" name="pa_co_applicant_employer_name" placeholder=" Type..." placeholders="Enter Employer Name" value="{{ old('pa_co_applicant_employer_name')}}">
                                        </div>
                                    </div> 
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employment_length" >Employment Length in months <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employment_length_error">{{ $errors->first('pa_co_applicant_employment_length') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employment_length" name="pa_co_applicant_employment_length" placeholder=" Type..." placeholders="Enter Employment Length in months" value="{{ old('pa_co_applicant_employment_length')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_phone" >Employer Phone <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_phone_error">{{ $errors->first('pa_co_applicant_employer_phone') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_phone" name="pa_co_applicant_employer_phone" placeholder=" Type..." placeholders="Enter Employer Phone" value="{{ old('pa_co_applicant_employer_phone')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employment_position" >Employment Positions <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employment_position_error">{{ $errors->first('pa_co_applicant_employment_position') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employment_position" name="pa_co_applicant_employment_position" placeholder=" Type..." placeholders="Enter Employment Positions" value="{{ old('pa_co_applicant_employment_position')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_address" >Employer Address <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_address_error">{{ $errors->first('pa_co_applicant_employer_address') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_address" name="pa_co_applicant_employer_address" placeholder=" Type..." placeholders="Enter Employer Address" value="{{ old('pa_co_applicant_employer_address')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_city" >Employer City <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_city_error">{{ $errors->first('pa_co_applicant_employer_city') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_city" name="pa_co_applicant_employer_city" placeholder=" Type..." placeholders="Enter Employer City" value="{{ old('pa_co_applicant_employer_city')}}">
                                        </div>
                                    </div>                                                                                                                                 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_state" >Employer state <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_state_error">{{ $errors->first('pa_co_applicant_employer_state') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_state" name="pa_co_applicant_employer_state" placeholder=" Type..." placeholders="Enter Employer state" value="{{ old('pa_co_applicant_employer_state')}}">
                                        </div>
                                    </div> 
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_employer_zip" >Employer Zip <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_employer_zip_error">{{ $errors->first('pa_co_applicant_employer_zip') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_employer_zip" name="pa_co_applicant_employer_zip" placeholder=" Type..." placeholders="Enter Employer Zip" value="{{ old('pa_co_applicant_employer_zip')}}">
                                        </div>
                                    </div> 
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_monthly_income" >Monthly income <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_monthly_income_error">{{ $errors->first('pa_co_applicant_monthly_income') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_monthly_income" name="pa_co_applicant_monthly_income" placeholder=" Type..." placeholders="Enter Monthly income" value="{{ old('pa_co_applicant_monthly_income')}}">
                                        </div>
                                    </div> 
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_supervisor_name" >Supervisor Name <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_name_error">{{ $errors->first('pa_co_applicant_supervisor_name') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_supervisor_name" name="pa_co_applicant_supervisor_name" placeholder=" Type..." placeholders="Enter Supervisor Name" value="{{ old('pa_co_applicant_supervisor_name')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_supervisor_phone" >Supervisor Phone <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_phone_error">{{ $errors->first('pa_co_applicant_supervisor_phone') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_supervisor_phone" name="pa_co_applicant_supervisor_phone" placeholder=" Type..." placeholders="Enter Supervisor Phone" value="{{ old('pa_co_applicant_supervisor_phone')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_supervisor_fax" >Supervisor Fax <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_fax_error">{{ $errors->first('pa_co_applicant_supervisor_fax') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_supervisor_fax" name="pa_co_applicant_supervisor_fax" placeholder=" Type..." placeholders="Enter Supervisor Fax" value="{{ old('pa_co_applicant_supervisor_fax')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_supervisor_email" >Supervisor Email <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_email_error">{{ $errors->first('pa_co_applicant_supervisor_email') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_supervisor_email" name="pa_co_applicant_supervisor_email" placeholder=" Type..." placeholders="Enter Supervisor Email" value="{{ old('pa_co_applicant_supervisor_email')}}">
                                        </div>
                                    </div>                                                                                                                                                                                                 
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_other_monthly_income" >Other Mothly Income <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_other_monthly_income_error">{{ $errors->first('pa_co_applicant_other_monthly_income') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_other_monthly_income" name="pa_co_applicant_other_monthly_income" placeholder=" Type..." placeholders="Enter Other Mothly Income" value="{{ old('pa_co_applicant_other_monthly_income')}}">
                                        </div>
                                    </div> 
    
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_other_monthly_income_reason" >Other Monthly Income Reason <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_other_monthly_income_reason_error">{{ $errors->first('pa_co_applicant_other_monthly_income_reason') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_other_monthly_income_reason" name="pa_co_applicant_other_monthly_income_reason" placeholder=" Type..." placeholders="Enter Other Monthly Income Reason" value="{{ old('pa_co_applicant_other_monthly_income_reason')}}">
                                        </div>
                                    </div>                                 
    
                                </div>
    
                                <h4 class="title-2 mt-20">Co-Applicant Emergency Contact <small class="field-req-desc">Required fields are marked with *</small></h4>
    
                                <div class="row">
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_name" >Emergency Contact Name <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_name_error">{{ $errors->first('pa_co_applicant_emergency_contact_name') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_name" name="pa_co_applicant_emergency_contact_name" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ old('pa_co_applicant_emergency_contact_name')}}">
                                        </div>
                                    </div> 
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_phone" >Phone <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_phone_error">{{ $errors->first('pa_co_applicant_emergency_contact_phone') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_phone" name="pa_co_applicant_emergency_contact_phone" placeholder=" Type..." placeholders="Enter Phone" value="{{ old('pa_co_applicant_emergency_contact_phone')}}">
                                        </div>
                                    </div> 
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_address" >Address <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_address_error">{{ $errors->first('pa_co_applicant_emergency_contact_address') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_address" name="pa_co_applicant_emergency_contact_address" placeholder=" Type..." placeholders="Enter Address" value="{{ old('pa_co_applicant_emergency_contact_address')}}">
                                        </div>
                                    </div> 
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_city" >City <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_city_error">{{ $errors->first('pa_co_applicant_emergency_contact_city') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_city" name="pa_co_applicant_emergency_contact_city" placeholder=" Type..." placeholders="Enter City" value="{{ old('pa_co_applicant_emergency_contact_city')}}">
                                        </div>
                                    </div>                                                                                                                                 
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_state" >State <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_state_error">{{ $errors->first('pa_co_applicant_emergency_contact_state') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_state" name="pa_co_applicant_emergency_contact_state" placeholder=" Type..." placeholders="Enter State" value="{{ old('pa_co_applicant_emergency_contact_state')}}">
                                        </div>
                                    </div>  
    
    
                                    <div class="col-md-4">
                                        <label class="label in-label" for="pa_co_applicant_emergency_contact_zip" >Zip <span class="required-field"></span> <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_emergency_contact_zip_error">{{ $errors->first('pa_co_applicant_emergency_contact_zip') }}</span></label>
                                        <div class="input-item input-item-name">
                                            <input type="text" class="input_field" id="pa_co_applicant_emergency_contact_zip" name="pa_co_applicant_emergency_contact_zip" placeholder=" Type..." placeholders="Enter Zip" value="{{ old('pa_co_applicant_emergency_contact_zip')}}">
                                        </div>
                                    </div>  
     
                                </div>                            
    
    
    
                                <h4 class="title-2 mt-80">Co-Applicant's Signature <span class="required-field">*</span> <span style="font-size: .6em !important;" class="form-text text-danger font-weight-bold" id="e_sign_error">{{ $errors->first('e_sign') }}</span></h4>
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="sig-canvas2" width="620" height="200">
                                            Your borwser does not support Canvas.
                                        </canvas>
                                    </div>
                                </div>
                                <input type="hidden" name="e_sign2" id="e_sign2" value="">
                                <span id="clearsignatureBtn2" class="btn">Clear Your Signature</span>
    
                            </div>
                        
                        
                        
                        


                            <h4 class="title-2 mt-50">Additional Documents 
                                <p style="font-size: 13px;">Upload additional documents (Example: Government ID, Pay Stubs...) </p>
                            </h4>

                            <div class="row mt-20">

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_1" name="additional_doc_1" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_1')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_2" name="additional_doc_2" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_2')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_3" name="additional_doc_3" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_3')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_4" name="additional_doc_4" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_4')}}">
                                    </div>
                                </div> 
 
                            </div>



                            <div class="row mt-20 mb-20">


                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_5" name="additional_doc_5" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_5')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_6" name="additional_doc_6" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_6')}}">
                                    </div>
                                </div>  


                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_7" name="additional_doc_7" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_7')}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="input-item input-item-name">
                                        <input type="file" id="additional_doc_8" name="additional_doc_8" placeholder=" Type..." placeholders="" value="{{ old('additional_doc_8')}}">
                                    </div>
                                </div>                                                                                                 

                            </div>                            
















                            <h4 class="title-2 mt-20" style="color:red">Please Agree to Terms and Conditions </h4>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <label class="checkbox-item" for="pa_application_terms_agreement" >I Agree <a href="{{url('/terms-and-conditions-for-applications')}}" target="_blank" style="color:red">Applications Terms and Conditions</a> <span class="required-field"></span>
                                        <span class="form-text text-danger font-weight-bold" id="pa_application_terms_agreement_error">{{ $errors->first('pa_application_terms_agreement') }}</span>

                                        <input type="checkbox"  @if(old('pa_application_terms_agreement') == "on") selected @endif id="pa_application_terms_agreement" name="pa_application_terms_agreement">
                                        <span class="checkmark"></span>
                                    
                                    </label>
                                </div> 

                            </div>




                            <div class="btn-wrapper mt-50">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" id="form-sbm-btn" type="submit">Submit Application</button>
                            </div>

                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->


    <div class="mb-120">
    </div>


@endsection


@section('page_level_scripts')

<script>
    
    $(document).ready(function() {
        // Initially hide the coapplicant fields container
        $('#coapplicant-fields').hide();
        
        // Listen for changes in the pa_is_there_a_coapplicant select element
        $('#pa_is_there_a_coapplicant').change(function() {
            // Get the selected value
            var selectedValue = $(this).val();
            
            // Check if the selected value is 'Yes'
            if (selectedValue === 'Yes') {
                // Show the coapplicant fields container
                $('#coapplicant-fields').show();
            } else {
                // Hide the coapplicant fields container
                $('#coapplicant-fields').hide();
            }
        });
        
        
        
        
            
        // Get references to relevant fields
        var havePetsField = $('#pa_applicant_have_pets');
        var petTypeField = $('#pa_applicant_pet_type');
        var bankruptcyField = $('#pa_applicant_bankruptcy');
        var bankruptcyYearField = $('#pa_applicant_bankruptcy_year');
        var lawsuitsField = $('#pa_applicant_lawsuites');
        var lawsuitsYearField = $('#pa_applicant_lawsuites_year');
        var evictionField = $('#pa_applicant_ever_evicted');
        var evictionYearField = $('#pa_applicant_eviction_year');
        var felonyConvictionField = $('#pa_applicant_felony_conviction');
        var felonyConvictionYearField = $('#pa_applicant_felony_conviction_year');
        var judgmentsField = $('#pa_applicant_judgments_or_fillings');
        var judgmentsYearField = $('#pa_applicant_judgments_or_fillings_year');
        
        // Function to show or hide a field based on the value of another field
        function toggleField(field, enable)
        {
            if (enable) {
                field.show();
            } else {
                field.hide();
            }
        }
        
        // Event listener to check "Do you have pets?" field value
        havePetsField.change(function() {
            // Show or hide "Pet Type" field based on the value of "Do you have pets?"
            toggleField(petTypeField, havePetsField.val() === 'Yes');
        });
 
 
        bankruptcyField.change(function() {
            // Show or hide "Pet Type" field based on the value of "Do you have pets?"
            toggleField(bankruptcyYearField, bankruptcyField.val() === 'Yes');
        });
        
        
   
           lawsuitsField.change(function() {
            // Show or hide "Pet Type" field based on the value of "Do you have pets?"
            toggleField(lawsuitsYearField, lawsuitsField.val() === 'Yes');
        });
   
   
   
        evictionField.change(function() {
            toggleField(evictionYearField, evictionField.val() === 'Yes');
        });
   
   
   
         felonyConvictionField.change(function() {
            toggleField(felonyConvictionYearField, felonyConvictionField.val() === 'Yes');
        });
        
   
        judgmentsField.change(function() {
            toggleField(judgmentsYearField, judgmentsField.val() === 'Yes');
        });
        
        
        
        // Trigger initial state
        toggleField(petTypeField, havePetsField.val() === 'Yes');
        toggleField(bankruptcyYearField, bankruptcyField.val() === 'Yes');
        toggleField(lawsuitsYearField, lawsuitsField.val() === 'Yes');
        toggleField(evictionYearField, evictionField.val() === 'Yes');
        toggleField(felonyConvictionYearField, felonyConvictionField.val() === 'Yes');
        toggleField(judgmentsYearField, judgmentsField.val() === 'Yes');
     
     
    
        // Get references to relevant fields
        var havePetsCoapplicantField = $('#pa_co_applicant_have_pets');
        var petTypeCoapplicantField = $('#pa_co_applicant_pet_type');
        var bankruptcyCoapplicantField = $('#pa_co_applicant_bankruptcy');
        var bankruptcyYearCoapplicantField = $('#pa_co_applicant_bankruptcy_year');
        var lawsuitsCoapplicantField = $('#pa_co_applicant_lawsuites');
        var lawsuitsYearCoapplicantField = $('#pa_co_applicant_lawsuites_year');
        var evictionCoapplicantField = $('#pa_co_applicant_ever_evicted');
        var evictionYearCoapplicantField = $('#pa_co_applicant_eviction_year');
        var felonyConvictionCoapplicantField = $('#pa_co_applicant_felony_conviction');
        var felonyConvictionYearCoapplicantField = $('#pa_co_applicant_felony_conviction_year');
        var judgmentsCoapplicantField = $('#pa_co_applicant_judgments_or_fillings');
        var judgmentsYearCoapplicantField = $('#pa_co_applicant_judgments_or_fillings_year');
    
        // Function to toggle visibility of fields
        function toggleFieldCoapplicant(field, enable) {
            // if (enable) {
            //     field.closest('.col-md-3').removeClass('disabled_by_default');
            //     field.removeAttr('disabled');
            // } else {
            //     field.closest('.col-md-3').addClass('disabled_by_default');
            //     field.attr('disabled', 'disabled');
            // }
            
            if (enable) {
                field.show();
            } else {
                field.hide();
            }
            
        }
    
        // Event listener to check "Do you have pets?" field value
        havePetsCoapplicantField.change(function() {
            // Enable or disable "Pet Type" field based on the value of "Do you have pets?"
            toggleFieldCoapplicant(petTypeCoapplicantField, havePetsCoapplicantField.val() === 'Yes');
        });
        
        // Event listener to check "Do you have pets?" field value
        havePetsCoapplicantField.change(function() {
            // Enable or disable "Pet Type" field based on the value of "Do you have pets?"
            toggleFieldCoapplicant(petTypeCoapplicantField, havePetsCoapplicantField.val() === 'Yes');
        });
    
        // Add event listeners for other fields
        // Bankruptcy
        bankruptcyCoapplicantField.change(function() {
            toggleFieldCoapplicant(bankruptcyYearCoapplicantField, bankruptcyCoapplicantField.val() === 'Yes');
        });
    
        // Lawsuits
        lawsuitsCoapplicantField.change(function() {
            toggleFieldCoapplicant(lawsuitsYearCoapplicantField, lawsuitsCoapplicantField.val() === 'Yes');
        });
    
        // Eviction
        evictionCoapplicantField.change(function() {
            toggleFieldCoapplicant(evictionYearCoapplicantField, evictionCoapplicantField.val() === 'Yes');
        });
    
        // Felony Conviction
        felonyConvictionCoapplicantField.change(function() {
            toggleFieldCoapplicant(felonyConvictionYearCoapplicantField, felonyConvictionCoapplicantField.val() === 'Yes');
        });
    
        // Judgments/Fillings
        judgmentsCoapplicantField.change(function() {
            toggleFieldCoapplicant(judgmentsYearCoapplicantField, judgmentsCoapplicantField.val() === 'Yes');
        });
    
        // Trigger initial state
        toggleFieldCoapplicant(petTypeCoapplicantField, havePetsCoapplicantField.val() === 'Yes');
        toggleFieldCoapplicant(bankruptcyYearCoapplicantField, bankruptcyCoapplicantField.val() === 'Yes');
        toggleFieldCoapplicant(lawsuitsYearCoapplicantField, lawsuitsCoapplicantField.val() === 'Yes');
        toggleFieldCoapplicant(evictionYearCoapplicantField, evictionCoapplicantField.val() === 'Yes');
        toggleFieldCoapplicant(felonyConvictionYearCoapplicantField, felonyConvictionCoapplicantField.val() === 'Yes');
        toggleFieldCoapplicant(judgmentsYearCoapplicantField, judgmentsCoapplicantField.val() === 'Yes');
             
         
     
     
     
     
     
     
     
         
    });




    $(document).ready(function() {
        // Attach event listener to input fields
        $('.input_field').on('input', function() {
            var fieldValue = $(this).val().trim();
            var errorId = $(this).attr('id') + '_error';
            var label = $(this).closest('.input-item').find('.in-label');
            
            // Check if the field value is not empty
            if (fieldValue !== '') {
                // Add checkmark after the label
                // label.append('<i class="fa fa-check checkmark"></i>');
                // Turn the field border green
                $(this).removeClass('input_field_error').addClass('input_field_valid');
                $('#' + errorId).text(''); // Clear error message associated with the input field
            } else {
                // Remove checkmark after the label
                label.find('.checkmark').remove();
                // Turn the field border red
                $(this).removeClass('input_field_valid').addClass('input_field_error');
                $('#' + errorId).text('Field is required'); // Show error message associated with the input field
            }
        });
    });
    
</script>


                                <!--<div class="col-md-12">-->
                                <!--    <label class="label in-label" for="pa_property_id" >Select Your Property <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_property_id_error">{{ $errors->first('pa_property_id') }}</span></label>-->
                                <!--    <div class="input-item input-item-name">-->
                                <!--        <select class="input_field" name="pa_property_id" id="pa_property_id">-->
                                <!--            <option value="">--Select--</option>-->
                                <!--            @foreach($db_data['Property'] as $Property)-->
                                <!--                <option value="{{$Property->property_id}}" @if(old('pa_property_id') == $Property->property_id) selected @endif >{{'Title: '.$Property->p_title.' | Address: '.$Property->p_address}} </option>-->
                                <!--            @endforeach-->
                                <!--        </select>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
@endsection


