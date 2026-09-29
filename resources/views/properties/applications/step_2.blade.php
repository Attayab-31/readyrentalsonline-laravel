@extends('layouts.front_end')
@section('page_content')



<?php
    $totalSteps = 8; // Total number of steps
    $currentStep = 2; // Current step, change this value based on the current page
    // Calculate the width percentage
    $stepWidth = ($currentStep / $totalSteps) * 100;
?>

 <!-- FEATURE AREA START ( Feature - 6) -->
 <div class="ltn__feature-area section-bg-1 pt-50 pb-90 mb-120---">
    <div class="container">

        <div class="row ltn__custom-gutter--- justify-content-center">
 
            <div class="col-lg-12 col-sm-12 col-12">
                
                <div class="w3-light-grey">
                    <div class="w3-container w3-red w3-center" style="width:<?= $stepWidth; ?>%">Step <?= $currentStep; ?> of <?= $totalSteps; ?></div>
                </div>

                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1" id="form-cotaniner">
 


                    <div id="form_res" style="display:none"></div> 


                    <h4 class="title-2">
                        {{-- <span class="step-number">Step 1:</span> --}}
                        @if($db_data['PropertyApplication']->pa_record_type == "applicant")
                            Applicant's Information
                        @else 
                            Co-Applicant's Information
                        @endif
                    </h4>
                    <p class="text-left" style="margin-bottom:0px !important;"> **Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-2/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="pa_applicant_name"  class="required fs-7 fw-normal ">
                                        Name <span class="required-field">*</span> <span class="field_error" id="pa_applicant_name_error" >{{ $errors->first('pa_applicant_name')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_name" name="pa_applicant_name" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_name}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_social_sec_num"  class="required fs-7 fw-normal ">
                                        SS# <span class="required-field">*</span> <span class="field_error" id="pa_applicant_social_sec_num_error" >{{ $errors->first('pa_applicant_social_sec_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_social_sec_num" name="pa_applicant_social_sec_num" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_social_sec_num}}">
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <label for="pa_applicant_driv_lic_num"  class="required fs-7 fw-normal ">
                                        Driver Lic # <span class="required-field">*</span> <span class="field_error" id="pa_applicant_driv_lic_num_error" >{{ $errors->first('pa_applicant_driv_lic_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_driv_lic_num" name="pa_applicant_driv_lic_num" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_driv_lic_num}}">
                                    </div>
                                </div>
                                                                

                                <div class="col-md-4">
                                    <label for="pa_applicant_dob"  class="required fs-7 fw-normal ">
                                        Date of Birth <span class="required-field">*</span> <span class="field_error" id="pa_applicant_dob_error" >{{ $errors->first('pa_applicant_dob')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="date" class="input_field" id="pa_applicant_dob" name="pa_applicant_dob" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_dob}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_email"  class="required fs-7 fw-normal ">
                                        Email <span class="required-field">*</span> <span class="field_error" id="pa_applicant_email_error" >{{ $errors->first('pa_applicant_email')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="email" class="input_field" id="pa_applicant_email" name="pa_applicant_email" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_email}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_own_or_rent_monthly_payment"  class="required fs-7 fw-normal ">
                                        Own/Rent Monthly Payment $ <span class="required-field">*</span> <span class="field_error" id="pa_applicant_own_or_rent_monthly_payment_error" >{{ $errors->first('pa_applicant_own_or_rent_monthly_payment')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_own_or_rent_monthly_payment" name="pa_applicant_own_or_rent_monthly_payment" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_own_or_rent_monthly_payment}}">
                                    </div>
                                </div>                                

                                <div class="col-md-4">
                                    <label for="pa_applicant_phone_num"  class="required fs-7 fw-normal ">
                                        Phone# <span class="required-field">*</span> <span class="field_error" id="pa_applicant_phone_num_error" >{{ $errors->first('pa_applicant_phone_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder=" Type..." placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_phone_num}}">
                                    </div>
                                </div>    

                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0" style="text-align:right !important;">
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
 