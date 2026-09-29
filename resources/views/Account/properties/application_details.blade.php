@extends('layouts.accounts')
@section("styles")
@endsection
@section('content')
<div class="row">
   <div class="col-xxl-12">
      <div class="card">
         <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Application Details</h4>
         </div>
         <div class="card-body">
            <div class="row mt-1 mb-2">
               <div class="col-lg-12 bg-warning-subtle py-3">
                  <div class="d-flex align-items-center">
                     <div class="fw-bold">Application General Details
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-3 mb-7">
                  <label for="p_listing_status" class="required fs-5 fw-bold mb-2 ">Selected Property</label>
                  <select disabled class="form-control" name="p_listing_status" id="p_listing_status" aria-label="Default select example">
                     <option value="">--Select--</option>
                     @foreach($db_data['Property'] as $Property)
                     <option value="{{$Property->property_id}}" @if($db_data['PropertyApplication']->pa_property_id == $Property->property_id) selected @endif>{{$Property->p_title}}</option>
                     @endforeach
                  </select>
                  <span class="form-text text-danger font-weight-bold">{{ $errors->first('p_listing_status') }}</span>
               </div>
               <div class="col-lg-3 mb-7">
                  <label for="pa_created_at" class="required fs-5 fw-bold mb-2 ">Applied On:</label>
                  <input disabled type="text" class="form-control " id="pa_created_at" name="pa_created_at" value="{{$db_data['PropertyApplication']->pa_created_at}}"  />
                  <span class="form-text text-danger font-weight-bold">{{ $errors->first('pa_created_at') }}</span>
               </div>
               @if($db_data['PropertyApplication']->pa_application_type == "offline")
               <div class="col-lg-2 mb-7">
                  <label for="pa_application_type" class="required fs-5 fw-bold mb-2 ">Application Type?</label>
                  <select disabled class="form-control" name="pa_application_type" id="pa_application_type" aria-label="Default select example">
                     <option selected>--Select--</option>
                     <option value="online" @if($db_data['PropertyApplication']->pa_application_type == "online") selected @endif>Online</option>
                     <option value="offline" @if($db_data['PropertyApplication']->pa_application_type == "offline") selected @endif>Offline</option>
                  </select>
                  <span class="form-text text-danger font-weight-bold">{{ $errors->first('pa_application_type') }}</span>
               </div>
               <div class="col-lg-2 mb-7"> 
                  <label for="pa_application_document_attached" class="required fs-5 fw-bold mb-2 ">Download Form</label>
                  <br>	
                  <a  href="{{asset('resources/files/dynamic/'.$db_data['PropertyApplication']->pa_application_document_attached)}}" class="menu-link px-3">
                  Click to Download
                  </a>
                  <span class="form-text text-danger font-weight-bold">{{ $errors->first('pa_application_document_attached') }}</span>
               </div>
               @else
               <div class="col-lg-4 mb-7">
                  <label for="pa_application_type" class="required fs-5 fw-bold mb-2 ">Application Type?</label>
                  <select disabled class="form-control" name="pa_application_type" id="pa_application_type" aria-label="Default select example">
                     <option selected>--Select--</option>
                     <option value="online" @if($db_data['PropertyApplication']->pa_application_type == "online") selected @endif>Online</option>
                     <option value="offline" @if($db_data['PropertyApplication']->pa_application_type == "offline") selected @endif>Offline</option>
                  </select>
                  <span class="form-text text-danger font-weight-bold">{{ $errors->first('pa_application_type') }}</span>
               </div>
               @endif
            </div>
            <hr>
            @if($db_data['PropertyApplication']->pa_application_type == "offline")
            @else
            {{-- 
            <h4 class="title-2">Applicant Information <small class="field-req-desc">Required fields are marked with *</small></h4>
            --}}
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_name" >Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_name" name="pa_applicant_name"   placeholders="Enter name" value="{{ $db_data['PropertyApplication']->pa_applicant_name}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_social_sec_num" >SS# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_social_sec_num_error">{{ $errors->first('pa_applicant_social_sec_num') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_social_sec_num" name="pa_applicant_social_sec_num"   placeholders="Enter SS#" value="{{ $db_data['PropertyApplication']->pa_applicant_social_sec_num}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_driv_lic_num" >Driver Lic # <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_driv_lic_num_error">{{ $errors->first('pa_applicant_driv_lic_num') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_driv_lic_num" name="pa_applicant_driv_lic_num"   placeholders="Enter Driver Lic #" value="{{ $db_data['PropertyApplication']->pa_applicant_driv_lic_num}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_dob" >Date of Birth <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_dob_error">{{ $errors->first('pa_applicant_dob') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="date" id="pa_applicant_dob" name="pa_applicant_dob"   placeholders="Enter Date of Birth" value="{{ $db_data['PropertyApplication']->pa_applicant_dob}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_email" >Email <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_email" name="pa_applicant_email"   placeholders="Enter Email" value="{{ $db_data['PropertyApplication']->pa_applicant_email}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_own_or_rent_monthly_payment" >Own/Rent Monthly Payment $ <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_own_or_rent_monthly_payment_error">{{ $errors->first('pa_applicant_own_or_rent_monthly_payment') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_own_or_rent_monthly_payment" name="pa_applicant_own_or_rent_monthly_payment"   placeholders="Enter Own/Rent Monthly Payment $" value="{{ $db_data['PropertyApplication']->pa_applicant_own_or_rent_monthly_payment}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_phone_num">Phone# <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_phone_num" name="pa_applicant_phone_num"   placeholders="Enter Phone#" value="{{ $db_data['PropertyApplication']->pa_applicant_phone_num}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_current_add" >Current Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_add_error">{{ $errors->first('pa_applicant_current_add') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_current_add" name="pa_applicant_current_add"   placeholders="Enter Current Address" value="{{ $db_data['PropertyApplication']->pa_applicant_current_add}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_current_city" >Current City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_city_error">{{ $errors->first('pa_applicant_current_city') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_current_city" name="pa_applicant_current_city"   placeholders="Enter Current City" value="{{ $db_data['PropertyApplication']->pa_applicant_current_city}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_current_state" >Current State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_state_error">{{ $errors->first('pa_applicant_current_state') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_current_state" name="pa_applicant_current_state"   placeholders="Enter Current State" value="{{ $db_data['PropertyApplication']->pa_applicant_current_state}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_current_zip" >Current ZIP Code <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_zip_error">{{ $errors->first('pa_applicant_current_zip') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_current_zip" name="pa_applicant_current_zip"   placeholders="Enter Current ZIP Code" value="{{ $db_data['PropertyApplication']->pa_applicant_current_zip}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_previous_add" >Previous Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_add_error">{{ $errors->first('pa_applicant_previous_add') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_previous_add" name="pa_applicant_previous_add"   placeholders="Enter Previous Address" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_add}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_previous_city" >Previous City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_city_error">{{ $errors->first('pa_applicant_previous_city') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_previous_city" name="pa_applicant_previous_city"   placeholders="Enter Previous City" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_city}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_previous_state" >Previous State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_state_error">{{ $errors->first('pa_applicant_previous_state') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_previous_state" name="pa_applicant_previous_state"   placeholders="Enter Previous State" value="{{ $db_data['PropertyApplication']->pa_applicant_previous_state}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_previous_zip" >Previous ZIP Code <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_zip_error">{{ $errors->first('pa_applicant_previous_zip') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_previous_zip" name="pa_applicant_previous_zip"   placeholders="Enter Previous ZIP Code" value="{{ $db_data['PropertyApplication']->pa_applicant_current_zip}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_landlord_name" >Landlord name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_name_error">{{ $errors->first('pa_applicant_landlord_name') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_landlord_name" name="pa_applicant_landlord_name"   placeholders="Enter Landlord name" value="{{ $db_data['PropertyApplication']->pa_applicant_landlord_name}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_landlord_phone" >Landlord phone # <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_phone_error">{{ $errors->first('pa_applicant_landlord_phone') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_landlord_phone" name="pa_applicant_landlord_phone"   placeholders="Enter Landlord phone #" value="{{ $db_data['PropertyApplication']->pa_applicant_landlord_phone}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_reason_for_leaving" >Reason for leaving <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_reason_for_leaving_error">{{ $errors->first('pa_applicant_reason_for_leaving') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_reason_for_leaving" name="pa_applicant_reason_for_leaving"   placeholders="Enter Reason for leaving" value="{{ $db_data['PropertyApplication']->pa_applicant_reason_for_leaving}}">
                  </div>
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_have_pets" >Do you have pets? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_have_pets_error">{{ $errors->first('pa_applicant_have_pets') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_have_pets" id="pa_applicant_have_pets">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_have_pets == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_have_pets == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label auto_disabled_label" for="pa_applicant_pet_type" >Pet Type <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_pet_type_error">{{ $errors->first('pa_applicant_pet_type') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_pet_type" class="auto_disabled_field" name="pa_applicant_pet_type"   placeholders="Enter Pet Type" value="{{ $db_data['PropertyApplication']->pa_applicant_pet_type}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_bankruptcy" >Bankruptcy? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_error">{{ $errors->first('pa_applicant_bankruptcy') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_bankruptcy" id="pa_applicant_bankruptcy">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_bankruptcy == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_bankruptcy == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_bankruptcy_year" >Bankruptcy Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_year_error">{{ $errors->first('pa_applicant_bankruptcy_year') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_bankruptcy_year" class="auto_disabled_field" name="pa_applicant_bankruptcy_year"   placeholders="Enter Bankruptcy Year" value="{{ $db_data['PropertyApplication']->pa_applicant_bankruptcy_year}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_lawsuites" >Lawsuites? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_error">{{ $errors->first('pa_applicant_lawsuites') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_lawsuites" id="pa_applicant_lawsuites">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_lawsuites == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_lawsuites == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_lawsuites_year" >Lawsuite Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_year_error">{{ $errors->first('pa_applicant_lawsuites_year') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_lawsuites_year" class="auto_disabled_field" name="pa_applicant_lawsuites_year"   placeholders="Enter Lawsuite Year" value="{{ $db_data['PropertyApplication']->pa_applicant_lawsuites_year}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_ever_evicted" >Ever Been Evicted? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_ever_evicted_error">{{ $errors->first('pa_applicant_ever_evicted') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_ever_evicted" id="pa_applicant_ever_evicted">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_ever_evicted == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_ever_evicted == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_eviction_year" >Eviction Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_eviction_year_error">{{ $errors->first('pa_applicant_eviction_year') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_eviction_year" class="auto_disabled_field" name="pa_applicant_eviction_year"   placeholders="Enter Eviction Year" value="{{ $db_data['PropertyApplication']->pa_applicant_eviction_year}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_felony_conviction" >Convicted of a felony? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_error">{{ $errors->first('pa_applicant_felony_conviction') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_felony_conviction" id="pa_applicant_felony_conviction">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_felony_conviction == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_felony_conviction == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_felony_conviction_year" >Felony Conviction Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_year_error">{{ $errors->first('pa_applicant_felony_conviction_year') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_felony_conviction_year" class="auto_disabled_field" name="pa_applicant_felony_conviction_year"   placeholders="Enter Felony Conviction Year" value="{{ $db_data['PropertyApplication']->pa_applicant_felony_conviction_year}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_judgments_or_fillings" >Judgements/filings <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_error">{{ $errors->first('pa_applicant_judgments_or_fillings') }}</span></label>
                  <div class="input-item input-item-name">
                     <select disabled class="form-control"  name="pa_applicant_judgments_or_fillings" id="pa_applicant_judgments_or_fillings">
                        <option value="">--Select--</option>
                        <option value="Yes" @if($db_data['PropertyApplication']->pa_applicant_judgments_or_fillings == "Yes") selected @endif >Yes </option>
                        <option value="No" @if($db_data['PropertyApplication']->pa_applicant_judgments_or_fillings == "No") selected @endif >No </option>
                     </select>
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_applicant_judgments_or_fillings_year" >Judgements/filings Year <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_year_error">{{ $errors->first('pa_applicant_judgments_or_fillings_year') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_applicant_judgments_or_fillings_year" class="auto_disabled_field" name="pa_applicant_judgments_or_fillings_year"   placeholders="Enter Judgements/filings Year" value="{{ $db_data['PropertyApplication']->pa_applicant_judgments_or_fillings_year}}">
                  </div>
               </div>
            </div>
            <div class="row mt-1 mb-2">
               <div class="col-lg-12 bg-warning-subtle py-3">
                  <div class="d-flex align-items-center">
                     <div class="fw-bold">Employment Information
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_name" >Employer Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_name_error">{{ $errors->first('pa_employer_name') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_name" name="pa_employer_name"   placeholders="Enter Employer Name" value="{{ $db_data['PropertyApplication']->pa_employer_name}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employment_length" >Employment Length <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employment_length_error">{{ $errors->first('pa_employment_length') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employment_length" name="pa_employment_length"   placeholders="Enter Employment Length" value="{{ $db_data['PropertyApplication']->pa_employment_length}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_phone" >Employer Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_phone_error">{{ $errors->first('pa_employer_phone') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_phone" name="pa_employer_phone"   placeholders="Enter Employer Phone" value="{{ $db_data['PropertyApplication']->pa_employer_phone}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employment_position" >Employment Positions <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employment_position_error">{{ $errors->first('pa_employment_position') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employment_position" name="pa_employment_position"   placeholders="Enter Employment Positions" value="{{ $db_data['PropertyApplication']->pa_employment_position}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_address" >Employer Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_address_error">{{ $errors->first('pa_employer_address') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_address" name="pa_employer_address"   placeholders="Enter Employer Address" value="{{ $db_data['PropertyApplication']->pa_employer_address}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_city" >Employer City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_city_error">{{ $errors->first('pa_employer_city') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_city" name="pa_employer_city"   placeholders="Enter Employer City" value="{{ $db_data['PropertyApplication']->pa_employer_city}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_state" >Employer state <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_state_error">{{ $errors->first('pa_employer_state') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_state" name="pa_employer_state"   placeholders="Enter Employer state" value="{{ $db_data['PropertyApplication']->pa_employer_state}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_employer_zip" >Employer City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_employer_zip_error">{{ $errors->first('pa_employer_zip') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_employer_zip" name="pa_employer_zip"   placeholders="Enter Employer City" value="{{ $db_data['PropertyApplication']->pa_employer_zip}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_monthly_income" >Monthly income <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_monthly_income_error">{{ $errors->first('pa_monthly_income') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_monthly_income" name="pa_monthly_income"   placeholders="Enter Monthly income" value="{{ $db_data['PropertyApplication']->pa_monthly_income}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_supervisor_name" >Supervisor Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_name_error">{{ $errors->first('pa_supervisor_name') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_supervisor_name" name="pa_supervisor_name"   placeholders="Enter Supervisor Name" value="{{ $db_data['PropertyApplication']->pa_supervisor_name}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_supervisor_phone" >Supervisor Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_phone_error">{{ $errors->first('pa_supervisor_phone') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_supervisor_phone" name="pa_supervisor_phone"   placeholders="Enter Supervisor Phone" value="{{ $db_data['PropertyApplication']->pa_supervisor_phone}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_supervisor_fax" >Supervisor Fax <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_fax_error">{{ $errors->first('pa_supervisor_fax') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_supervisor_fax" name="pa_supervisor_fax"   placeholders="Enter Supervisor Fax" value="{{ $db_data['PropertyApplication']->pa_supervisor_fax}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_supervisor_email" >Supervisor Email <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_supervisor_email_error">{{ $errors->first('pa_supervisor_email') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_supervisor_email" name="pa_supervisor_email"   placeholders="Enter Supervisor Email" value="{{ $db_data['PropertyApplication']->pa_supervisor_email}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_other_monthly_income" >Other Mothly Income <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_other_monthly_income_error">{{ $errors->first('pa_other_monthly_income') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_other_monthly_income" name="pa_other_monthly_income"   placeholders="Enter Other Mothly Income" value="{{ $db_data['PropertyApplication']->pa_other_monthly_income}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_other_monthly_income_reason" >Other Monthly Income Reason <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_other_monthly_income_reason_error">{{ $errors->first('pa_other_monthly_income_reason') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_other_monthly_income_reason" name="pa_other_monthly_income_reason"   placeholders="Enter Other Monthly Income Reason" value="{{ $db_data['PropertyApplication']->pa_other_monthly_income_reason}}">
                  </div>
               </div>
            </div>
            <div class="row mt-1 mb-2">
               <div class="col-lg-12 bg-warning-subtle py-3">
                  <div class="d-flex align-items-center">
                     <div class="fw-bold">Emergency Contact
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_name" >Emergency Contact Name <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_name_error">{{ $errors->first('pa_emergency_contact_name') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_name" name="pa_emergency_contact_name"   placeholders="Enter Emergency Contact Name" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_name}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_phone" >Phone <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_phone_error">{{ $errors->first('pa_emergency_contact_phone') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_phone" name="pa_emergency_contact_phone"   placeholders="Enter Phone" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_phone}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_address" >Address <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_address_error">{{ $errors->first('pa_emergency_contact_address') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_address" name="pa_emergency_contact_address"   placeholders="Enter Address" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_address}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_city" >City <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_city_error">{{ $errors->first('pa_emergency_contact_city') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_city" name="pa_emergency_contact_city"   placeholders="Enter City" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_city}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_state" >State <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_state_error">{{ $errors->first('pa_emergency_contact_state') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_state" name="pa_emergency_contact_state"   placeholders="Enter State" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_state}}">
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label" for="pa_emergency_contact_zip" >Zip <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_emergency_contact_zip_error">{{ $errors->first('pa_emergency_contact_zip') }}</span></label>
                  <div class="input-item input-item-name">
                     <input  disabled class="form-control"  type="text" id="pa_emergency_contact_zip" name="pa_emergency_contact_zip"   placeholders="Enter Zip" value="{{ $db_data['PropertyApplication']->pa_emergency_contact_zip}}">
                  </div>
               </div>
            </div>
            <div class="row mt-1 mb-2">
               <div class="col-lg-12 bg-warning-subtle py-3">
                  <div class="d-flex align-items-center">
                     <div class="fw-bold">Applicant Electronic Signature
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-9"></div>
               <img style="max-height: 200px;width: 83%;" src="{{asset('resources/files/e-signs'.'/'.$db_data['PropertyApplication']->e_sign)}}">
            </div>
            @endif
            <div class="row mt-1 mb-2">
               <div class="col-lg-12 bg-warning-subtle py-3">
                  <div class="d-flex align-items-center">
                     <div class="fw-bold">Additional Documents Uploaded by Applicant
                     </div>
                  </div>
               </div>
            </div>
            @if(is_array($db_data['PropertyApplication']->pa_additional_documents))
            <div class="row">
               @foreach($db_data['PropertyApplication']->pa_additional_documents as $doc)
               <div class="col-md-3 mb-3">
                  {{-- <label for="pa_application_document_attached" class="fs-5 fw-bold mb-2 ">File</label> --}}
                  {{-- <br>	 --}}
                  <a  href="{{asset('resources/files/dynamic/'. $doc)}}" target="_blank" class="menu-link px-3">
                  File: {{$loop->iteration}}  - Click to Download
                  </a>
               </div>
               @endforeach
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
</div>
@endsection