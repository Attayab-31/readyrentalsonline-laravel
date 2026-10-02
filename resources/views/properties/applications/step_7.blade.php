@extends('layouts.front_end')
@section('page_content')


@php
    $totalSteps = 9;
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

                    <p class="text-left" style="margin-bottom:0px !important;"> **Upload additional documents (Example: Government ID, Pay Stubs...)</p>

                    <form id="online-application-form-with-steps" action="{{url('process-online-application/step-7/'.$db_data['PropertyApplication']->pa_tracking_id)}}" class="ltn__form-box contact-form-box" method="post" enctype="multipart/form-data">
                    @csrf


                        
                        <div class="form-inner-part">
                            
                            <div class="row">
        
                                    <input type="hidden" value="asdasd" name="dummyval" id="dummyval" />
                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_1" >File 1 <span class="field_error" id="additional_doc_1_error">{{ $errors->first('additional_doc_1') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_1" name="additional_doc_1" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_1}}">
                                    </div>
                                </div> 


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_2" >File 2 <span class="field_error" id="additional_doc_2_error">{{ $errors->first('additional_doc_2') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_2" name="additional_doc_2" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_2}}">
                                    </div>
                                </div>  
                                
                                
                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_3" >File 3 <span class="field_error" id="additional_doc_3_error">{{ $errors->first('additional_doc_3') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_3" name="additional_doc_3" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_3}}">
                                    </div>
                                </div>  



                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_4" >File 4 <span class="field_error" id="additional_doc_4_error">{{ $errors->first('additional_doc_4') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_4" name="additional_doc_4" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_4}}">
                                    </div>
                                </div>  
                                
 


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_5" >File 5 <span class="field_error" id="additional_doc_5_error">{{ $errors->first('additional_doc_5') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_5" name="additional_doc_5" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_5}}">
                                    </div>
                                </div>  


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_6" >File 6 <span class="field_error" id="additional_doc_6_error">{{ $errors->first('additional_doc_6') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_6" name="additional_doc_6" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_6}}">
                                    </div>
                                </div>  



                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_7" >File 7 <span class="field_error" id="additional_doc_7_error">{{ $errors->first('additional_doc_7') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_7" name="additional_doc_7" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_7}}">
                                    </div>
                                </div> 


                                <div class="col-md-4 mb-4">
                                    <label class="label in-label" for="additional_doc_8" >File 8 <span class="field_error" id="additional_doc_8_error">{{ $errors->first('additional_doc_8') }}</span></label>
                                    <div class="input-item input-item-name">
                                        <input type="file" class="input_field" id="additional_doc_8" name="additional_doc_8" placeholder=" Type..." placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->additional_doc_8}}">
                                    </div>
                                </div> 




                            </div>










                        </div>
                        <hr>
                        <div class="btn-wrapper mt-0" style="text-align:right !important;">
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
 