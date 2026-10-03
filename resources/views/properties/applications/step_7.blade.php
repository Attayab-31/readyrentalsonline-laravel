@extends('layouts.front_end')
@section('page_content')


@php
    $totalSteps = 8;
    $currentStep = 7;
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
                        Additional Documents
                    </h4>

                    <p class="rr-application-instructions">You may add extra documents, such as proof of income. This step is optional; choose Save and Continue if you have nothing to add. Accepted files: PDF, JPG, or PNG, up to 10 MB each.</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-7/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post" enctype="multipart/form-data">
                    @csrf



                        <div class="form-inner-part">

                            <div class="row">

                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_1" >Document 1 (optional) <span class="field_error" id="additional_doc_1_error">{{ $errors->first('additional_doc_1') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_1" name="additional_doc_1">
                                    </div>
                                </div>


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_2" >Document 2 (optional) <span class="field_error" id="additional_doc_2_error">{{ $errors->first('additional_doc_2') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_2" name="additional_doc_2">
                                    </div>
                                </div>


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_3" >Document 3 (optional) <span class="field_error" id="additional_doc_3_error">{{ $errors->first('additional_doc_3') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_3" name="additional_doc_3">
                                    </div>
                                </div>



                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_4" >Document 4 (optional) <span class="field_error" id="additional_doc_4_error">{{ $errors->first('additional_doc_4') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_4" name="additional_doc_4">
                                    </div>
                                </div>




                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_5" >Document 5 (optional) <span class="field_error" id="additional_doc_5_error">{{ $errors->first('additional_doc_5') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_5" name="additional_doc_5">
                                    </div>
                                </div>


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_6" >Document 6 (optional) <span class="field_error" id="additional_doc_6_error">{{ $errors->first('additional_doc_6') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_6" name="additional_doc_6">
                                    </div>
                                </div>



                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_7" >Document 7 (optional) <span class="field_error" id="additional_doc_7_error">{{ $errors->first('additional_doc_7') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_7" name="additional_doc_7">
                                    </div>
                                </div>


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_8" >Document 8 (optional) <span class="field_error" id="additional_doc_8_error">{{ $errors->first('additional_doc_8') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="input_field" id="additional_doc_8" name="additional_doc_8">
                                    </div>
                                </div>




                            </div>










                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0 rr-application-actions">
                            <a href="{{url('/online-application/step-6/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="btn theme-btn-1 btn-effect-1 text-s" >Back</a>
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

