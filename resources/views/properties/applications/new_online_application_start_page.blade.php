@extends('layouts.front_end')
@section('page_content')

    @php
        $totalSteps = 8;
        $currentStep = 1;
    @endphp

 <!-- FEATURE AREA START ( Feature - 6) -->
 <div class="ltn__feature-area section-bg-1 pt-50 pb-90 mb-120---">
    <div class="container">

        <div class="row ltn__custom-gutter--- justify-content-center">

            <div class="col-lg-12 col-sm-12 col-12">

                @include('partials.application-progress', ['currentStep' => $currentStep, 'totalSteps' => $totalSteps])


                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1">



                    <h4 class="title-2">
                        {{-- <span class="step-number">Step 1:</span> --}}
                        Choose a Home and Household Size
                    </h4>
                    <form id="online-application-form-with-steps" action="{{ $application ? url('process-online-application/'.$application->pa_tracking_id.'/setup') : url('process-online-application') }}" class="ltn__form-box contact-form-box" method="post">
                    @csrf

                        <div id="form_res" style="display:none"></div>

                        <p class="text-left">First, choose the home and tell us how many adults will apply. The application has 8 steps. Select “Save and Continue” at the end of each step to save your answers.</p>

                        <div class="form-inner-part">

                            <div class="row">

                                <div class="col-md-12">
                                    <label for="pa_property_id"  class="required fs-7 fw-normal ">
                                        Select the Property <span class="required-field">*</span> <span class="field_error" id="pa_property_id_error" >{{ $errors->first('pa_property_id')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="input_field" name="pa_property_id" id="pa_property_id" required>
                                            <option value="">--Select--</option>
                                            @foreach($db_data['Property'] as $Property)
                                                <option value="{{$Property->property_id}}"
                                                    @if(old('pa_property_id', $application?->pa_property_id) == $Property->property_id)
                                                        selected 
                                                    @elseif(! $application && request()->query('property') == $Property->p_slug)
                                                        selected 
                                                    @endif
                                                >{{ $Property->p_title }}{{ $Property->p_address ? ' — '.$Property->p_address : '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="pa_number_of_co_applicants"  class="required fs-7 fw-normal ">
                                        Number of co-applicants <span class="required-field">*</span> <span class="field_error" id="pa_number_of_co_applicants_error" >{{ $errors->first('pa_number_of_co_applicants')}}</span>
                                    </label>
                                    <p>Count every adult who will live in the home. Each adult applying will complete their own details.</p>
                                    <div class="input-item">
                                        <select class="input_field" name="pa_number_of_co_applicants" id="pa_number_of_co_applicants" required>
                                            <option value="">Choose the number of adults</option>
                                            <option value="0" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "0") selected @endif>I am the only adult applying (1 adult)</option>
                                            <option value="1" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "1") selected @endif>We are 2 adults</option>
                                            <option value="2" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "2") selected @endif>We are 3 adults</option>
                                            <option value="3" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "3") selected @endif>We are 4 adults</option>
                                            <option value="4" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "4") selected @endif>We are 5 adults</option>
                                            <option value="5" @if(old('pa_number_of_co_applicants', $application?->pa_number_of_co_applicants) == "5") selected @endif>We are 6 adults</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
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
