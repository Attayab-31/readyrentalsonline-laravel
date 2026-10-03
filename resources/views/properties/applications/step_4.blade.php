@extends('layouts.front_end')
@section('page_content')


@php
    $totalSteps = 8;
    $currentStep = 4;
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
                            Applicant Additional Information
                        @else 
                            Co-Applicant's Additional Information
                        @endif

                    </h4>
                    <p class="rr-application-instructions">Choose Yes or No for each question. We will only ask for more details when you answer Yes.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-4/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">


                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_have_pets" >Do you have any pets? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_have_pets_error">{{ $errors->first('pa_applicant_have_pets') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_have_pets" id="pa_applicant_have_pets">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_have_pets == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_have_pets == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label auto_disabled_label" for="pa_applicant_pet_type" >What kind of pet do you have? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_pet_type_error">{{ $errors->first('pa_applicant_pet_type') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" class="input_field" id="pa_applicant_pet_type" name="pa_applicant_pet_type" placeholder="For example, dog or cat" value="{{$db_data['PropertyApplication']->pa_applicant_pet_type}}">
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <label class="label in-label" for="pa_applicant_bankruptcy" >Have you ever filed for bankruptcy? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_bankruptcy_error">{{ $errors->first('pa_applicant_bankruptcy') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_bankruptcy" id="pa_applicant_bankruptcy">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_bankruptcy == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_bankruptcy == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_bankruptcy_year" >What year did this happen? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_bankruptcy_year_error">{{ $errors->first('pa_applicant_bankruptcy_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" inputmode="numeric" class="input_field" id="pa_applicant_bankruptcy_year" name="pa_applicant_bankruptcy_year" placeholder="Year" value="{{$db_data['PropertyApplication']->pa_applicant_bankruptcy_year}}">
                                    </div>
                                </div>  



                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_lawsuites" >Have you ever been involved in a lawsuit? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_lawsuites_error">{{ $errors->first('pa_applicant_lawsuites') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_lawsuites" id="pa_applicant_lawsuites">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_lawsuites == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_lawsuites == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_lawsuites_year" >What year did this happen? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_lawsuites_year_error">{{ $errors->first('pa_applicant_lawsuites_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" inputmode="numeric" class="input_field" id="pa_applicant_lawsuites_year" name="pa_applicant_lawsuites_year" placeholder="Year" value="{{$db_data['PropertyApplication']->pa_applicant_lawsuites_year}}">
                                    </div>
                                </div>  



                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_ever_evicted" >Have you ever been evicted from a home? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_ever_evicted_error">{{ $errors->first('pa_applicant_ever_evicted') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_ever_evicted" id="pa_applicant_ever_evicted">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_ever_evicted == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_ever_evicted == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_eviction_year" >What year did this happen? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_eviction_year_error">{{ $errors->first('pa_applicant_eviction_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" inputmode="numeric" class="input_field" id="pa_applicant_eviction_year" name="pa_applicant_eviction_year" placeholder="Year" value="{{$db_data['PropertyApplication']->pa_applicant_eviction_year}}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_felony_conviction" >Have you ever been convicted of a felony? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_felony_conviction_error">{{ $errors->first('pa_applicant_felony_conviction') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_felony_conviction" id="pa_applicant_felony_conviction">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_felony_conviction == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_felony_conviction == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_felony_conviction_year" >What year did this happen? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_felony_conviction_year_error">{{ $errors->first('pa_applicant_felony_conviction_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" inputmode="numeric" class="input_field" id="pa_applicant_felony_conviction_year" name="pa_applicant_felony_conviction_year" placeholder="Year" value="{{$db_data['PropertyApplication']->pa_applicant_felony_conviction_year}}">
                                    </div>
                                </div> 


                                <div class="col-md-3">
                                    <label class="label in-label" for="pa_applicant_judgments_or_fillings" >Do you have any court judgments or legal filings? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_judgments_or_fillings_error">{{ $errors->first('pa_applicant_judgments_or_fillings') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <select class="input_field" name="pa_applicant_judgments_or_fillings" id="pa_applicant_judgments_or_fillings">
                                            <option value="">Choose Yes or No</option>
                                            <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_judgments_or_fillings == "Yes") selected @endif >Yes </option>
                                            <option value="No" @if($db_data['PropertyApplication']->pa_applicant_judgments_or_fillings == "No") selected @endif >No </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 disabled_by_default">
                                    <label class="label in-label" for="pa_applicant_judgments_or_fillings_year" >What year did this happen? <span class="required-field">*</span> <span class="field_error" id="pa_applicant_judgments_or_fillings_year_error">{{ $errors->first('pa_applicant_judgments_or_fillings_year') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="text" inputmode="numeric" class="input_field" id="pa_applicant_judgments_or_fillings_year" name="pa_applicant_judgments_or_fillings_year" placeholder="Year" value="{{$db_data['PropertyApplication']->pa_applicant_judgments_or_fillings_year}}">
                                    </div>
                                </div>    
 
                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/step-3/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
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

    // Function to show or hide a field and its label based on the value of another field
    function toggleField(field, enable) {
        var fieldWrapper = field.closest('.col-md-3');
        fieldWrapper
            .toggle(enable)
            .attr('aria-hidden', enable ? 'false' : 'true');
        field.prop('disabled', !enable);
    }

    // Event listener to check "Do you have pets?" field value
    havePetsField.change(function() {
        // Show or hide "Pet Type" field based on the value of "Do you have pets?"
        toggleField(petTypeField, havePetsField.val() === 'Yes');
    });

    bankruptcyField.change(function() {
        toggleField(bankruptcyYearField, bankruptcyField.val() === 'Yes');
    });

    lawsuitsField.change(function() {
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

    // Get references to relevant fields for co-applicant
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

    // Function to toggle visibility of fields and labels for co-applicant
    function toggleFieldCoapplicant(field, enable) {
        var fieldWrapper = field.closest('.col-md-3');
        if (enable) {
            fieldWrapper.show();
        } else {
            fieldWrapper.hide();
        }
    }

    // Event listener to check "Do you have pets?" field value
    havePetsCoapplicantField.change(function() {
        toggleFieldCoapplicant(petTypeCoapplicantField, havePetsCoapplicantField.val() === 'Yes');
    });

    // Add event listeners for other fields for co-applicant
    bankruptcyCoapplicantField.change(function() {
        toggleFieldCoapplicant(bankruptcyYearCoapplicantField, bankruptcyCoapplicantField.val() === 'Yes');
    });

    lawsuitsCoapplicantField.change(function() {
        toggleFieldCoapplicant(lawsuitsYearCoapplicantField, lawsuitsCoapplicantField.val() === 'Yes');
    });

    evictionCoapplicantField.change(function() {
        toggleFieldCoapplicant(evictionYearCoapplicantField, evictionCoapplicantField.val() === 'Yes');
    });

    felonyConvictionCoapplicantField.change(function() {
        toggleFieldCoapplicant(felonyConvictionYearCoapplicantField, felonyConvictionCoapplicantField.val() === 'Yes');
    });

    judgmentsCoapplicantField.change(function() {
        toggleFieldCoapplicant(judgmentsYearCoapplicantField, judgmentsCoapplicantField.val() === 'Yes');
    });

    // Trigger initial state for co-applicant
    toggleFieldCoapplicant(petTypeCoapplicantField, havePetsCoapplicantField.val() === 'Yes');
    toggleFieldCoapplicant(bankruptcyYearCoapplicantField, bankruptcyCoapplicantField.val() === 'Yes');
    toggleFieldCoapplicant(lawsuitsYearCoapplicantField, lawsuitsCoapplicantField.val() === 'Yes');
    toggleFieldCoapplicant(evictionYearCoapplicantField, evictionCoapplicantField.val() === 'Yes');
    toggleFieldCoapplicant(felonyConvictionYearCoapplicantField, felonyConvictionCoapplicantField.val() === 'Yes');
    toggleFieldCoapplicant(judgmentsYearCoapplicantField, judgmentsCoapplicantField.val() === 'Yes');
});



</script>


@endsection
