@extends('layouts.front_end')
@section('page_content')

@php
    $totalSteps = 9;
    $currentStep = 8;
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
                            Applicant Signature 
                        @else 
                            Co-Applicant's Signature
                        @endif

                        
                        <span class="required-field">*</span> <span class="field_error" id="e_sign_error">{{ $errors->first('e_sign') }}</span>
                    </h4>
                    {{-- <p class="text-left" style="margin-bottom:0px !important;"> **Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p> --}}

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-8/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">
                                 
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="sig-canvas" width="620" height="200">
                                            Your borwser does not support Canvas.
                                        </canvas>
                                    </div>
                                </div>
                                <input type="hidden" name="e_sign" id="e_sign" value="">
                                <span id="clearsignatureBtn" class="btn">Clear Your Signature</span>
 
 
                            </div>



                            <h4 class="title-2 mt-20">Please Agree to Terms and Conditions </h4>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <label class="checkbox-item" for="pa_application_terms_agreement" >I Agree <a href="{{url('/terms-and-conditions-for-applications')}}" target="_blank" style="color:blue">Applications Terms and Conditions</a> <span class="required-field"></span><br>
                                        <span class="field_error" id="pa_application_terms_agreement_error">{{ $errors->first('pa_application_terms_agreement') }}</span>

                                        <input type="checkbox"  @if($db_data['PropertyApplication']->pa_application_terms_agreement == "on") checked @endif id="pa_application_terms_agreement" name="pa_application_terms_agreement">
                                        <span class="checkmark"></span>
                                    
                                    </label>
                                </div> 

                            </div>
                            
                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0" style="text-align:right !important;">
                            <a href="{{url('/online-application/step-7/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
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
 