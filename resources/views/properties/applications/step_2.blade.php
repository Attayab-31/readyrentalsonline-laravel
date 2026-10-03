@extends('layouts.front_end')
@section('page_content')



@php
    $totalSteps = 8;
    $currentStep = 2;
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
                            Applicant's Information
                        @else 
                            Co-Applicant's Information
                        @endif
                    </h4>
                    <p class="rr-application-instructions">Please answer each question. If you do not know an answer or a question does not apply, enter “N/A”.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-2/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="pa_applicant_name"  class="required fs-7 fw-normal ">
                                        Name <span class="required-field">*</span> <span class="field_error" id="pa_applicant_name_error" >{{ $errors->first('pa_applicant_name')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" class="input_field" id="pa_applicant_name" name="pa_applicant_name" autocomplete="name" placeholder="Enter your full name" value="{{ $db_data['PropertyApplication']->pa_applicant_name}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_social_sec_num"  class="required fs-7 fw-normal ">
                                        Social Security Number <span class="required-field">*</span> <span class="field_error" id="pa_applicant_social_sec_num_error" >{{ $errors->first('pa_applicant_social_sec_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" inputmode="numeric" autocomplete="off" class="input_field" id="pa_applicant_social_sec_num" name="pa_applicant_social_sec_num" placeholder="Enter your Social Security Number" value="{{ $db_data['PropertyApplication']->pa_applicant_social_sec_num}}">
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <label for="pa_applicant_driv_lic_num"  class="required fs-7 fw-normal ">
                                        Driver’s License Number <span class="required-field">*</span> <span class="field_error" id="pa_applicant_driv_lic_num_error" >{{ $errors->first('pa_applicant_driv_lic_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="text" autocomplete="off" class="input_field" id="pa_applicant_driv_lic_num" name="pa_applicant_driv_lic_num" placeholder="Enter your driver’s license number" value="{{ $db_data['PropertyApplication']->pa_applicant_driv_lic_num}}">
                                    </div>
                                </div>
                                                                

                                <div class="col-md-4">
                                    <label for="pa_applicant_dob"  class="required fs-7 fw-normal ">
                                        Date of Birth <span class="required-field">*</span> <span class="field_error" id="pa_applicant_dob_error" >{{ $errors->first('pa_applicant_dob')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="date" autocomplete="bday" class="input_field" id="pa_applicant_dob" name="pa_applicant_dob" value="{{ $db_data['PropertyApplication']->pa_applicant_dob}}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="pa_applicant_email"  class="required fs-7 fw-normal ">
                                        Email <span class="required-field">*</span> <span class="field_error" id="pa_applicant_email_error" >{{ $errors->first('pa_applicant_email')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="email" autocomplete="email" class="input_field" id="pa_applicant_email" name="pa_applicant_email" placeholder="name@example.com" value="{{ $db_data['PropertyApplication']->pa_applicant_email}}">
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
                                        Phone Number <span class="required-field">*</span> <span class="field_error" id="pa_applicant_phone_num_error" >{{ $errors->first('pa_applicant_phone_num')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <input type="tel" inputmode="numeric" autocomplete="tel" class="input_field" id="pa_applicant_phone_num" name="pa_applicant_phone_num" placeholder="10-digit phone number" value="{{ $db_data['PropertyApplication']->pa_applicant_phone_num}}">
                                    </div>
                                </div>    

                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/'.$db_data['PropertyApplication']->pa_tracking_id.'/setup')}}" class="btn theme-btn-1 btn-effect-1">Back</a>
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
 