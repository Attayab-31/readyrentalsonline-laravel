@extends('layouts.front_end')
@section('page_content')


@php
    $totalSteps = 8;
    $currentStep = 3;
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
                            Applicant Address Information
                        @else 
                            Co-Applicant's Address Information
                        @endif
                    
                    </h4>
                    <p class="rr-application-instructions">Please answer each question. If you do not know an answer or a question does not apply, enter “N/A”.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-3/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="pa_applicant_current_add"  class="required fs-7 fw-normal ">
                                        Current Address <span class="required-field">*</span> <span class="field_error" id="pa_applicant_current_add_error" >{{ $errors->first('pa_applicant_current_add')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_current_add" name="pa_applicant_current_add" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_current_add}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_current_city"  class="required fs-7 fw-normal ">
                                        Current City <span class="required-field">*</span> <span class="field_error" id="pa_applicant_current_city_error" >{{ $errors->first('pa_applicant_current_city')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_current_city" name="pa_applicant_current_city" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_current_city}}">
                                    </div>
                                </div>
                                
   

                                <div class="col-md-4">
                                    <label for="pa_applicant_current_state"  class="required fs-7 fw-normal ">
                                        Current State <span class="required-field">*</span> <span class="field_error" id="pa_applicant_current_state_error" >{{ $errors->first('pa_applicant_current_state')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_current_state" name="pa_applicant_current_state" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_current_state}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_current_zip"  class="required fs-7 fw-normal ">
                                        Current ZIP Code <span class="required-field">*</span> <span class="field_error" id="pa_applicant_current_zip_error" >{{ $errors->first('pa_applicant_current_zip')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_current_zip" name="pa_applicant_current_zip" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_current_zip}}">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="pa_previous_address_applicable"  class="required fs-7 fw-normal ">
                                            Do you have a Previous Address? <span class="required-field">*</span> <span class="field_error" id="pa_previous_address_applicable_error" >{{ $errors->first('pa_previous_address_applicable')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <select class="input_field" name="pa_previous_address_applicable" id="pa_previous_address_applicable">
                                                <option value="">--Select--</option>
                                                <option value="Yes" @if($db_data['PropertyApplication']->pa_previous_address_applicable == "Yes") selected @endif >Yes</option>
                                                <option value="No" @if($db_data['PropertyApplication']->pa_previous_address_applicable == "No") selected @endif >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row previous_address_fields">

                                    <div class="col-md-4">
                                        <label for="pa_applicant_previous_add"  class="required fs-7 fw-normal ">
                                            Previous Address <span class="required-field">*</span> <span class="field_error" id="pa_applicant_previous_add_error" >{{ $errors->first('pa_applicant_previous_add')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_previous_add" name="pa_applicant_previous_add" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_add}}">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="pa_applicant_previous_city"  class="required fs-7 fw-normal ">
                                            Previous City <span class="required-field">*</span> <span class="field_error" id="pa_applicant_previous_city_error" >{{ $errors->first('pa_applicant_previous_city')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_previous_city" name="pa_applicant_previous_city" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_city}}">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="pa_applicant_previous_state"  class="required fs-7 fw-normal ">
                                            Previous State <span class="required-field">*</span> <span class="field_error" id="pa_applicant_previous_state_error" >{{ $errors->first('pa_applicant_previous_state')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_previous_state" name="pa_applicant_previous_state" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_state}}">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="pa_applicant_previous_zip"  class="required fs-7 fw-normal ">
                                            Previous ZIP Code <span class="required-field">*</span> <span class="field_error" id="pa_applicant_previous_zip_error" >{{ $errors->first('pa_applicant_previous_zip')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_previous_zip" name="pa_applicant_previous_zip" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_zip}}">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="pa_applicant_landlord_name"  class="required fs-7 fw-normal ">
                                            Landlord name <span class="required-field">*</span> <span class="field_error" id="pa_applicant_landlord_name_error" >{{ $errors->first('pa_applicant_landlord_name')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_landlord_name" name="pa_applicant_landlord_name" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_landlord_name}}">
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <label for="pa_applicant_landlord_phone"  class="required fs-7 fw-normal ">
                                            Landlord phone # <span class="required-field">*</span> <span class="field_error" id="pa_applicant_landlord_phone_error" >{{ $errors->first('pa_applicant_landlord_phone')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_landlord_phone" name="pa_applicant_landlord_phone" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_landlord_phone}}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="pa_applicant_reason_for_leaving"  class="required fs-7 fw-normal ">
                                            Reason for leaving <span class="required-field">*</span> <span class="field_error" id="pa_applicant_reason_for_leaving_error" >{{ $errors->first('pa_applicant_reason_for_leaving')}}</span>
                                        </label>
                                        <div class="input-item">
                                            <input type="text" class="input_field" id="pa_applicant_reason_for_leaving" name="pa_applicant_reason_for_leaving" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_reason_for_leaving}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/step-2/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
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

    $(document).ready(function() {
            // Function to show or hide fields based on employment status
            function toggleFields() {
                if ($('#pa_previous_address_applicable').val() === 'Yes') {
                    $('.previous_address_fields').show();
                } else {
                    $('.previous_address_fields').hide();
                }
            }

            // Initially hide the fields if the status is not "Employed"
            toggleFields();

            // Event listener for change in employment status
            $('#pa_previous_address_applicable').change(function() {
                toggleFields();
            });
        });

    
    </script>

@endsection