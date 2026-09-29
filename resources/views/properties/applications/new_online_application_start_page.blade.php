@extends('layouts.front_end')
@section('page_content')

    <?php
        $totalSteps = 8; // Total number of steps
        $currentStep = 1; // Current step, change this value based on the current page
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
 

                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1">
 

                    
                    <h4 class="title-2">
                        {{-- <span class="step-number">Step 1:</span> --}}
                        Select Property and Co-Applicants
                    </h4>
                    <form id="online-application-form-with-steps" action="{{url('process-online-application')}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf

                        <div id="form_res" style="display:none"></div> 

                        <p class="text-left"> To track your order please enter your Order ID in the box below and press the "Track Order" button. This was given to you on your receipt and in the confirmation email you should have received. </p>
                        
                        <div class="form-inner-part">
                            
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="pa_property_id"  class="required fs-7 fw-normal ">
                                        Select the Property <span class="required-field">*</span> <span class="field_error" id="pa_property_id_error" >{{ $errors->first('pa_property_id')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="input_field" name="pa_property_id" id="pa_property_id">
                                            <option value="">--Select--</option>
                                            @foreach($db_data['Property'] as $Property)
                                                <option value="{{$Property->property_id}}"
                                                    @if(old('pa_property_id') == $Property->property_id) 
                                                        selected 
                                                    @elseif(request()->query('property') == $Property->p_slug) 
                                                        selected 
                                                    @endif
                                                >{{'Title: '.$Property->p_title.' | Address: '.$Property->p_address}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="pa_number_of_co_applicants"  class="required fs-7 fw-normal ">
                                        Number of co-applicants <span class="required-field">*</span> <span class="field_error" id="pa_number_of_co_applicants_error" >{{ $errors->first('pa_number_of_co_applicants')}}</span>
                                    </label>
                                    <p>If you have any co-applicants then please select the correct number. You will need to fill details for each applicant.</p>
                                    <div class="input-item">
                                        <select class="input_field" name="pa_number_of_co_applicants" id="pa_number_of_co_applicants">
                                            <option value="">--Select--</option>
                                            <option value="0" @if(old('pa_number_of_co_applicants') == "0") selected @endif >I will be the only Adult resident (1 Person)</option>
                                            <option value="1" @if(old('pa_number_of_co_applicants') == "1") selected @endif >I have 1 Co-Applicant (2 People)</option>
                                            <option value="2" @if(old('pa_number_of_co_applicants') == "2") selected @endif >I have 2 Co-Applicants (3 People)</option>
                                            <option value="3" @if(old('pa_number_of_co_applicants') == "3") selected @endif >I have 3 Co-Applicants (4 People)</option>
                                            <option value="4" @if(old('pa_number_of_co_applicants') == "4") selected @endif >I have 4 Co-Applicants (5 People)</option>
                                            <option value="5" @if(old('pa_number_of_co_applicants') == "5") selected @endif >I have 5 Co-Applicants (6 People)</option>
                                        </select>
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
 