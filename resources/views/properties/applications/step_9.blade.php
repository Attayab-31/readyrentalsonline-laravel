@extends('layouts.front_end')
@section('page_content')


@php
    $totalSteps = 9;
    $currentStep = 9;
@endphp

 <!-- FEATURE AREA START ( Feature - 6) -->
 <div class="ltn__feature-area section-bg-1 pt-50 pb-90 mb-120---">
    <div class="container">

        <div class="row ltn__custom-gutter--- justify-content-center">
 
            <div class="col-lg-12 col-sm-12 col-12">
                
                @include('partials.application-progress', ['currentStep' => $currentStep, 'totalSteps' => $totalSteps])

                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1" id="form-cotaniner">
 
                    <h4 class="title-2">Thank You!</h4>
                    
                    {{-- <p class="text-left" style="margin-bottom:0px !important;"> Your data is saved!</p> --}}

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-9/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        <div id="form_res" style="display:none"></div> 
                    
                        <div class="form-inner-part">
                            @php 
                                if($db_data['PropertyApplication']->pa_record_type == "applicant")
                                {
                                    if($db_data['PropertyApplication']->pa_number_of_co_applicants > 0)
                                    {
                                        // The applicant has selected at least one co-applicant
                                        $page_description = "Your application has been submitted. Please click the button below to start adding your co-applicants.";
                                        $button_label = "Add Co-Applicant";
                                    }
                                    else
                                    {
                                        // The applicant has selected 0 co-applicants
                                        $page_description = "Your application has been received. We are currently reviewing it and will be in touch with you soon.";
                                        $button_label = "Return to Home Page";
                                    }
                                }
                                elseif($db_data['PropertyApplication']->pa_record_type == "co-applicant")
                                {
                                    //Check the Number of the CoApplicants Records Has been Saved.
                                    $db_data['ParentPropertyApplication'] = App\Models\PropertyApplication::where('property_application_id' , $db_data['PropertyApplication']->pa_parent_application_id)->first();
                                    if($db_data['ParentPropertyApplication'])
                                    {
                                        $number_of_co_Applicants = $db_data['ParentPropertyApplication']->pa_number_of_co_applicants;
                                        // Get the Number of CoApplicants Saved
                                        $CoApplicantsAdded = App\Models\PropertyApplication::where('pa_parent_application_id' , $db_data['ParentPropertyApplication']->property_application_id)->count();
                                    }

                                    if($number_of_co_Applicants > $CoApplicantsAdded)
                                    {
                                        // The applicant has selected 0 co-applicants
                                        $page_description = "Your application for the CoApplicant has been received. We are currently reviewing it and will be in touch with you soon.";
                                        $button_label = "Add Co-Applicant";
                                    }
                                    else
                                    {
                                        // The applicant has selected 0 co-applicants
                                        $page_description = "Your application process is complete. We are currently reviewing it and will be in touch with you soon.";
                                        $button_label = "Return Home";
                                    }
                                }
                            @endphp
                    
                            <p>{{$page_description}}</p>
                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0" style="text-align:right !important;">
                            <a href="{{url('/online-application/step-8/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s">Back</a>
                            <button class="btn theme-btn-1 btn-effect-1 text-s" type="submit">{{$button_label}}</button>
                        </div>
                    </form>
                    
                </div>
            </div>
 
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

@endsection
 