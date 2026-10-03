@extends('layouts.front_end')
@section('page_content')

@php
    $totalSteps = 8;
    $currentStep = 6;
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
                            Applicant Emergency Contact
                        @else 
                            Co-Applicant's Emergency Contact
                        @endif

                    </h4>
                    <p class="rr-application-instructions">Please answer each question. If you do not know an answer or a question does not apply, enter “N/A”.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-6/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">

                                 
                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_name" >Emergency Contact Name <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_name_error">{{ $errors->first('pa_emergency_contact_name') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_name" name="pa_emergency_contact_name" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_name}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_phone" >Phone <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_phone_error">{{ $errors->first('pa_emergency_contact_phone') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_phone" name="pa_emergency_contact_phone" placeholder=" Type..." placeholders="Enter Phone" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_phone}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_address" >Address <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_address_error">{{ $errors->first('pa_emergency_contact_address') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_address" name="pa_emergency_contact_address" placeholder=" Type..." placeholders="Enter Address" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_address}}">
                                    </div>
                                </div> 


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_city" >City <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_city_error">{{ $errors->first('pa_emergency_contact_city') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_city" name="pa_emergency_contact_city" placeholder=" Type..." placeholders="Enter City" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_city}}">
                                    </div>
                                </div>                                                                                                                                 

                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_state" >State <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_state_error">{{ $errors->first('pa_emergency_contact_state') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_state" name="pa_emergency_contact_state" placeholder=" Type..." placeholders="Enter State" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_state}}">
                                    </div>
                                </div>  


                                <div class="col-md-4">
                                    <label class="label in-label" for="pa_emergency_contact_zip" >Zip <span class="required-field">*</span> <span class="field_error" id="pa_emergency_contact_zip_error">{{ $errors->first('pa_emergency_contact_zip') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_emergency_contact_zip" name="pa_emergency_contact_zip" placeholder=" Type..." placeholders="Enter Zip" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_zip}}">
                                    </div>
                                </div>  
 
                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/step-5/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
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
 