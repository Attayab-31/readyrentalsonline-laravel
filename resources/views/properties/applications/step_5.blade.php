@extends('layouts.front_end')
@section('page_content')

@php
    $totalSteps = 8;
    $currentStep = 5;
@endphp

 <!-- FEATURE AREA START ( Feature - 6) -->
 <div class="ltn__feature-area section-bg-1 pt-50 pb-90 mb-120---">
    <div class="container">

        <div class="row ltn__custom-gutter--- justify-content-center">
 
            <div class="col-lg-12 col-sm-12 col-12">
                
                @include('partials.application-progress', ['currentStep' => $currentStep, 'totalSteps' => $totalSteps])

                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1" id="form-cotaniner">
 
                    <div id="form_res" style="display:none"></div> 

                    
                    <h4 class="title-2">
                        {{-- <span class="step-number">Step 1:</span> --}}
 
                        @if($db_data['PropertyApplication']->pa_record_type == "applicant")
                            Applicant Employment Information
                        @else 
                            Co-Applicant's Employment Information
                        @endif

                    </h4>
                    <p class="rr-application-instructions">Please answer each question. If you do not know an answer or a question does not apply, enter “N/A”.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-5/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">


                            <div class="row">

                                <div class="col-md-4" id="pa_current_employment_status_container">
                                    <label for="pa_current_employment_status"  class="required fs-7 fw-normal ">
                                        Current Employment Status <span class="required-field">*</span> <span class="field_error" id="pa_current_employment_status_error" >{{ $errors->first('pa_current_employment_status')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="input_field" name="pa_current_employment_status" id="pa_current_employment_status">
                                            <option value="">--Select--</option>
                                            <option value="Employed" @if($db_data['PropertyApplication']->pa_current_employment_status == "Employed") selected @endif >Employed</option>
                                            <option value="Retired" @if($db_data['PropertyApplication']->pa_current_employment_status == "Retired") selected @endif >Retired</option>
                                            <option value="Un-Employed" @if($db_data['PropertyApplication']->pa_current_employment_status == "Un-Employed") selected @endif >Un-Employed</option>
                                        </select>
                                    </div>
                                </div>

                            </div>




                            <div class="row additional-fields">

                                 
                                <div class="col-md-4" id="pa_employer_name_container">
                                    <label class="label in-label" for="pa_employer_name" >Employer Name <span class="required-field">*</span> <span class="field_error" id="pa_employer_name_error">{{ $errors->first('pa_employer_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_name" name="pa_employer_name" placeholder=" Type..." placeholders="Enter Employer Name" value="{{ $db_data['PropertyApplication']->pa_employer_name}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_employment_length_container">
                                    <label class="label in-label" for="pa_employment_length" >Employment Length  in months <span class="required-field">*</span> <span class="field_error" id="pa_employment_length_error">{{ $errors->first('pa_employment_length') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employment_length" name="pa_employment_length" placeholder=" Type..." placeholders="Enter Employment Length in months" value="{{ $db_data['PropertyApplication']->pa_employment_length}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_employer_phone_container">
                                    <label class="label in-label" for="pa_employer_phone" >Employer Phone <span class="required-field">*</span> <span class="field_error" id="pa_employer_phone_error">{{ $errors->first('pa_employer_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_phone" name="pa_employer_phone" placeholder=" Type..." placeholders="Enter Employer Phone" value="{{ $db_data['PropertyApplication']->pa_employer_phone}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_employment_position_container">
                                    <label class="label in-label" for="pa_employment_position" >Employment Positions <span class="required-field">*</span> <span class="field_error" id="pa_employment_position_error">{{ $errors->first('pa_employment_position') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employment_position" name="pa_employment_position" placeholder=" Type..." placeholders="Enter Employment Positions" value="{{ $db_data['PropertyApplication']->pa_employment_position}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_employer_address_container">
                                    <label class="label in-label" for="pa_employer_address" >Employer Address <span class="required-field">*</span> <span class="field_error" id="pa_employer_address_error">{{ $errors->first('pa_employer_address') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_address" name="pa_employer_address" placeholder=" Type..." placeholders="Enter Employer Address" value="{{ $db_data['PropertyApplication']->pa_employer_address}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_employer_city_container">
                                    <label class="label in-label" for="pa_employer_city" >Employer City <span class="required-field">*</span> <span class="field_error" id="pa_employer_city_error">{{ $errors->first('pa_employer_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_city" name="pa_employer_city" placeholder=" Type..." placeholders="Enter Employer City" value="{{ $db_data['PropertyApplication']->pa_employer_city}}">
                                    </div>
                                </div>                                                                                                                                 



                                <div class="col-md-4" id="pa_employer_state_container">
                                    <label class="label in-label" for="pa_employer_state" >Employer state <span class="required-field">*</span> <span class="field_error" id="pa_employer_state_error">{{ $errors->first('pa_employer_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_state" name="pa_employer_state" placeholder=" Type..." placeholders="Enter Employer state" value="{{ $db_data['PropertyApplication']->pa_employer_state}}">
                                    </div>
                                </div> 

                                <div class="col-md-4" id="pa_employer_zip_container">
                                    <label class="label in-label" for="pa_employer_zip" >Employer Zip <span class="required-field">*</span> <span class="field_error" id="pa_employer_zip_error">{{ $errors->first('pa_employer_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_employer_zip" name="pa_employer_zip" placeholder=" Type..." placeholders="Enter Employer Zip" value="{{ $db_data['PropertyApplication']->pa_employer_zip}}">
                                    </div>
                                </div> 

                                <div class="col-md-4" id="pa_monthly_income_container">
                                    <label class="label in-label" for="pa_monthly_income" >Monthly income <span class="required-field">*</span> <span class="field_error" id="pa_monthly_income_error">{{ $errors->first('pa_monthly_income') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_monthly_income" name="pa_monthly_income" placeholder=" Type..." placeholders="Enter Monthly income" value="{{ $db_data['PropertyApplication']->pa_monthly_income}}">
                                    </div>
                                </div> 

                                <div class="col-md-4" id="pa_supervisor_name_container">
                                    <label class="label in-label" for="pa_supervisor_name" >Supervisor Name <span class="required-field">*</span> <span class="field_error" id="pa_supervisor_name_error">{{ $errors->first('pa_supervisor_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_name" name="pa_supervisor_name" placeholder=" Type..." placeholders="Enter Supervisor Name" value="{{ $db_data['PropertyApplication']->pa_supervisor_name}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_supervisor_phone_container">
                                    <label class="label in-label" for="pa_supervisor_phone" >Supervisor Phone <span class="required-field">*</span> <span class="field_error" id="pa_supervisor_phone_error">{{ $errors->first('pa_supervisor_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_phone" name="pa_supervisor_phone" placeholder=" Type..." placeholders="Enter Supervisor Phone" value="{{ $db_data['PropertyApplication']->pa_supervisor_phone}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_supervisor_fax_container">
                                    <label class="label in-label" for="pa_supervisor_fax" >Supervisor Fax <span class="required-field"> </span> <span class="field_error" id="pa_supervisor_fax_error">{{ $errors->first('pa_supervisor_fax') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_supervisor_fax" name="pa_supervisor_fax" placeholder=" Type..." placeholders="Enter Supervisor Fax" value="{{ $db_data['PropertyApplication']->pa_supervisor_fax}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_supervisor_email_container">
                                    <label class="label in-label" for="pa_supervisor_email" >Supervisor Email <span class="required-field"> </span> <span class="field_error" id="pa_supervisor_email_error">{{ $errors->first('pa_supervisor_email') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="email" class="input_field" id="pa_supervisor_email" name="pa_supervisor_email" placeholder=" Type..." placeholders="Enter Supervisor Email" value="{{ $db_data['PropertyApplication']->pa_supervisor_email}}">
                                    </div>
                                </div>                                                                                                                                                                                                 


                                <div class="col-md-4" id="pa_other_monthly_income_container">
                                    <label class="label in-label" for="pa_other_monthly_income" >Other Mothly Income <span class="required-field">*</span> <span class="field_error" id="pa_other_monthly_income_error">{{ $errors->first('pa_other_monthly_income') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_other_monthly_income" name="pa_other_monthly_income" placeholder=" Type..." placeholders="Enter Other Mothly Income" value="{{ $db_data['PropertyApplication']->pa_other_monthly_income}}">
                                    </div>
                                </div> 



                                <div class="col-md-4" id="pa_other_monthly_income_reason_container">
                                    <label class="label in-label" for="pa_other_monthly_income_reason" >Other Monthly Income Reason <span class="required-field">*</span> <span class="field_error" id="pa_other_monthly_income_reason_error">{{ $errors->first('pa_other_monthly_income_reason') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_other_monthly_income_reason" name="pa_other_monthly_income_reason" placeholder=" Type..." placeholders="Enter Other Monthly Income Reason" value="{{ $db_data['PropertyApplication']->pa_other_monthly_income_reason}}">
                                    </div>
                                </div>
 
                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/step-4/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Save and Continue</button>
                        </div>
                    </form>
                </div>
            </div>
 
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

@endsection
 

@section('page_level_scripts')

    <script>

        $(document).ready(function () {
 
        
            // Initially hide all fields
            handleConditioanFields();
        
            // Show/hide fields based on current employment status selection
            $("#pa_current_employment_status").change(function ()
            {
                handleConditioanFields();
            });
        });
        
        
        
        
        function handleConditioanFields()
        {
                var employmentStatus = $("#pa_current_employment_status").val();
        
                // If "Employed" is selected, show the relevant fields
                if (employmentStatus === "Employed") {
                    $("#pa_employer_name_container").show();
                    $("#pa_employment_length_container").show();
                    $("#pa_employer_phone_container").show();
                    $("#pa_employment_position_container").show();
                    $("#pa_employer_address_container").show();
                    $("#pa_employer_city_container").show();
                    $("#pa_employer_state_container").show();
                    $("#pa_employer_zip_container").show();
                    $("#pa_monthly_income_container").show();
                    $("#pa_supervisor_name_container").show();
                    $("#pa_supervisor_phone_container").show();
                    $("#pa_supervisor_fax_container").show();
                    $("#pa_supervisor_email_container").show();
                    $("#pa_other_monthly_income_container").show();
                    $("#pa_other_monthly_income_reason_container").show();
                }
                // If "Retired" is selected, show only the relevant fields
                else if (employmentStatus === "Retired") {
                    $("#pa_employer_name_container").hide();
                    $("#pa_employment_length_container").hide();
                    $("#pa_employer_phone_container").hide();
                    $("#pa_employment_position_container").hide();
                    $("#pa_employer_address_container").hide();
                    $("#pa_employer_city_container").hide();
                    $("#pa_employer_state_container").hide();
                    $("#pa_employer_zip_container").hide();
                    $("#pa_monthly_income_container").show();
                    $("#pa_supervisor_name_container").hide();
                    $("#pa_supervisor_phone_container").hide();
                    $("#pa_supervisor_fax_container").hide();
                    $("#pa_supervisor_email_container").hide();
                    $("#pa_other_monthly_income_container").show();
                    $("#pa_other_monthly_income_reason_container").show();
                }
                // If "Un-Employed" is selected, show only the relevant fields
                else if (employmentStatus === "Un-Employed") {
                    $("#pa_employer_name_container").hide();
                    $("#pa_employment_length_container").hide();
                    $("#pa_employer_phone_container").hide();
                    $("#pa_employment_position_container").hide();
                    $("#pa_employer_address_container").hide();
                    $("#pa_employer_city_container").hide();
                    $("#pa_employer_state_container").hide();
                    $("#pa_employer_zip_container").hide();
                    $("#pa_monthly_income_container").hide();
                    $("#pa_supervisor_name_container").hide();
                    $("#pa_supervisor_phone_container").hide();
                    $("#pa_supervisor_fax_container").hide();
                    $("#pa_supervisor_email_container").hide();
                    $("#pa_other_monthly_income_container").show();
                    $("#pa_other_monthly_income_reason_container").show();
                } else {
                    // If no status selected, hide all the fields
                    hideAllFields();
                }
                
        }
    
    </script>

@endsection