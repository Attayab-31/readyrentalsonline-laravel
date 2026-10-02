<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#10253a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="description" content="Magnifica Questionnaire Form Wizard includes Corona Virus Covid-19 questionnaire">
    <meta name="author" content="Ansonika">
    <title>Submit your Application</title>

    <!-- Favicons-->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v={{ filemtime(public_path('favicon.svg')) }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}?v={{ filemtime(public_path('favicon-48x48.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ filemtime(public_path('favicon-32x32.png')) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}?v={{ filemtime(public_path('logo/apple-touch-icon.png')) }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}?v={{ filemtime(public_path('manifest.webmanifest')) }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('wizard_assets')}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('wizard_assets')}}/css/menu.css" rel="stylesheet">
    <link href="{{asset('wizard_assets')}}/css/style.css" rel="stylesheet">
	<link href="{{asset('wizard_assets')}}/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('wizard_assets')}}/css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="{{asset('wizard_assets')}}/js/modernizr.js"></script>

    <style>
        #wizard_container
        {
            min-height: 43rem !important;
        }

        #middle-wizard {
            width: 100% !important ;
        }

        .custom-label
        {
            font-weight: 550;
            padding-bottom: 2rem;
        }

        h3.main_question {
            margin: 0 0 0px 0;
        }


        #wizard_container {
            padding: 60px;
            -webkit-box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.1);
            -moz-box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.1);
            box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.1);
            /* background: url(../img/pattern_1.png) repeat; */
            background: none !important;
            position: relative;
        }



        .required-field
        {
            color: red !important;
        }
        .ui-progressbar
        {
            height: 15px;
            width: 100%;
        }

        label
        {
            font-weight: 500;
            margin-bottom: -3px;
            color: #222;
        }

        .form-control
        {
            height: calc(2.65rem + -4px) !important;
        }

        @media (max-width: 767px) {
            #form_container { padding: 12px; }
            #wizard_container { min-height: 0 !important; padding: 24px 18px; }
            #middle-wizard { padding: 0 !important; }
            .custom-label { padding-bottom: 1rem; }
            h3.main_question { font-size: 20px; line-height: 1.35; }
            .step { padding-inline: 0 !important; }
            .container_radio, .container_check { width: 100% !important; }
            .form-control, select.form-control { min-height: 44px; }
            .button-group, .submit, .forward, .backward { max-width: 100%; }
        }

        @media (max-width: 380px) {
            #form_container { padding: 8px; }
            #wizard_container { padding: 18px 12px; }
        }

        

/* 
        .container_radio
        {
            display: inline-block !important;
            width: 25% !important;
        } */
    </style>
</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	{{-- <header> --}}
		{{-- <div class="container">
		    <div class="row">
                <div class="col-3">
                     <a href="{{ url('/') }}"><img src="{{asset('wizard_assets')}}/img/logo.svg" alt="" width="178" height="45" class="d-none d-md-block"><img src="{{asset('wizard_assets')}}/img/logo_mobile.svg" alt="" width="62" height="45" class="d-block d-md-none"></a>
                </div>
                <div class="col-9">
                    <div id="social">
                        <ul>
                            <li><a href="#0"><i class="icon-facebook"></i></a></li>
                            <li><a href="#0"><i class="icon-twitter"></i></a></li>
                            <li><a href="#0"><i class="icon-google"></i></a></li>
                            <li><a href="#0"><i class="icon-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <!-- /social -->
					<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
					<!-- /menu button -->
                    <nav>
						<ul class="cd-primary-nav">
							<li><a href="without_branch_layout_2.html" class="animated_link">Questionnaire without branch</a></li>
                            <li><a href="with_branch_layout_2.html" class="animated_link">Questionnaire with branch</a></li>
							<li><a href="prevention.html" class="animated_link">Prevention Tips</a></li>
							<li><a href="faq.html" class="animated_link">Faq</a></li>
							<li><a href="contacts.html" class="animated_link">Contact Us</a></li>
							<li><a href="https://1.envato.market/OAmnr" class="animated_link" target="_parent">Purchase this template</a><li>
						</ul>
					</nav>
					<!-- /menu -->
                </div>
            </div>
		</div> --}}
		<!-- /container -->
	{{-- </header> --}}
	<!-- /Header -->

	<div class="contsainer">
        <div id="form_container">
            <div class="row no-gutters">
                {{-- <div class="col-lg-3">
                    <div id="left_form">
                        <figure>
                            <h1 style="color: white !important;">Ready Rentals Online</h1>
                        </figure>
                        <h4 style="color: white !important;">Submit your Application <span></span></h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, totam mollitia voluptatum commodi libero placeat vero. Ab aut et placeat quo.</p>
                        <a href="{{url('/')}}" class="btn_1 rounded yellow purchase" target="_parent">Return Home</a>
                        <a href="#wizard_container" class="btn_1 rounded mobile_btn yellow">Start Now!</a>
                        <a href="#0" id="more_info" data-toggle="modal" data-target="#more-info"><i class="pe-7s-info"></i></a>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div id="wizard_container">
                        <div id="top-wizard">
                            <div id="progressbar"></div>
                            <span id="location"></span>
                        </div>
                        <!-- /top-wizard -->
                        <form  id="online-application-form" action="{{url('applications/apply-online/process-form')}}" method="post">
                            @csrf
                            <input id="website" name="website" type="text" value="">
                            <!-- Leave for security protection, read docs for details -->
                            <div id="middle-wizard">

                                <div class="step">
                                    <h3 class="main_question">Step 1 - Select the property you are interested in</h3>
                                    <p>We can add More Textual Description here about this step.</p>

                                    <div class="row mt-5">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="version_2 active">Select Property <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_property_id_error">{{ $errors->first('pa_property_id') }}</span> </label>
                                                    <select class="form-control required" name="pa_property_id" id="pa_property_id" >
                                                        <option value="">--Select--</option>
                                                        @foreach($db_data['Property'] as $property)
                                                            <option value="{{$property->property_id}}" @if(old('pa_property_id') == $property->property_id) selected @endif >{{'Title: '.$property->p_title.' | Address: '.$property->p_address}} </option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
 
                                    </div>
                                    <!-- /row -->
  

                                </div>
                                <!-- /step-->
 

                                <div class="step">
                                    <h3 class="main_question">Step 2 - Applicant Information</h3>
                                    <p>**Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p>
 

                                    <div class="row mt-5">

                                       <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Name 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_name_error">{{ $errors->first('pa_applicant_name') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_name" id="pa_applicant_name" value="{{old('pa_applicant_name')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">SS# 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_social_sec_num_error">{{ $errors->first('pa_applicant_social_sec_num') }}</span>
                                                </label>
                                                <input type="number" min="9" max="9" name="pa_applicant_social_sec_num" id="pa_applicant_social_sec_num" value="{{old('pa_applicant_social_sec_num')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Driver Lic # 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_driv_lic_num_error">{{ $errors->first('pa_applicant_driv_lic_num') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_driv_lic_num" id="pa_applicant_driv_lic_num" value="{{old('pa_applicant_driv_lic_num')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Date of Birth 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_dob_error">{{ $errors->first('pa_applicant_dob') }}</span>
                                                </label>
                                                <input type="date" name="pa_applicant_dob" id="pa_applicant_dob" value="{{old('pa_applicant_dob')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>                                        
 
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Email 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_email_error">{{ $errors->first('pa_applicant_email') }}</span>
                                                </label>
                                                <input type="email" name="pa_applicant_email" id="pa_applicant_email" value="{{old('pa_applicant_email')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Own/Rent Monthly Payment $ 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_own_or_rent_monthly_payment_error">{{ $errors->first('pa_applicant_own_or_rent_monthly_payment') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_own_or_rent_monthly_payment" id="pa_applicant_own_or_rent_monthly_payment" value="{{old('pa_applicant_own_or_rent_monthly_payment')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Phone# 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_phone_num_error">{{ $errors->first('pa_applicant_phone_num') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_phone_num" id="pa_applicant_phone_num" value="{{old('pa_applicant_phone_num')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>
 
                                                  
                                    </div>
 
                                </div>
                                <!-- /step-->





                                



                                <div class="step">
                                    <h3 class="main_question">Step 3 - Applicant Address Information</h3>
                                    <p>**Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p>
 

                                    <div class="row mt-5">

                                       <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Current Address 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_add_error">{{ $errors->first('pa_applicant_current_add') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_current_add" id="pa_applicant_current_add" value="{{old('pa_applicant_current_add')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Current City 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_city_error">{{ $errors->first('pa_applicant_current_city') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_current_city" id="pa_applicant_current_city" value="{{old('pa_applicant_current_city')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Current State 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_state_error">{{ $errors->first('pa_applicant_current_state') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_current_state" id="pa_applicant_current_state" value="{{old('pa_applicant_current_state')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Current ZIP Code 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_current_zip_error">{{ $errors->first('pa_applicant_current_zip') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_current_zip" id="pa_applicant_current_zip" value="{{old('pa_applicant_current_zip')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>                                        
                                    

                                    </div>

                                    <div class="row mt-2">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Previous Address 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_add_error">{{ $errors->first('pa_applicant_previous_add') }}</span>
                                                </label>
                                                <input type="email" name="pa_applicant_previous_add" id="pa_applicant_previous_add" value="{{old('pa_applicant_previous_add')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Previous City 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_city_error">{{ $errors->first('pa_applicant_previous_city') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_previous_city" id="pa_applicant_previous_city" value="{{old('pa_applicant_previous_city')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Previous State 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_state_error">{{ $errors->first('pa_applicant_previous_state') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_previous_state" id="pa_applicant_previous_state" value="{{old('pa_applicant_previous_state')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Previous ZIP Code 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_previous_zip_error">{{ $errors->first('pa_applicant_previous_zip') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_previous_zip" id="pa_applicant_previous_zip" value="{{old('pa_applicant_previous_zip')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-2">


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Landlord name 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_name_error">{{ $errors->first('pa_applicant_landlord_name') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_landlord_name" id="pa_applicant_landlord_name" value="{{old('pa_applicant_landlord_name')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>                                        
                                        
                                        

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Landlord phone # 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_landlord_phone_error">{{ $errors->first('pa_applicant_landlord_phone') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_landlord_phone" id="pa_applicant_landlord_phone" value="{{old('pa_applicant_landlord_phone')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div> 



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Reason for leaving 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_reason_for_leaving_error">{{ $errors->first('pa_applicant_reason_for_leaving') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_reason_for_leaving" id="pa_applicant_reason_for_leaving" value="{{old('pa_applicant_reason_for_leaving')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                    </div>
 
                                </div>





                                <div class="step">
                                    <h3 class="main_question">Step 4 - Applicant Additional Information</h3>
                                    <p>**Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p>
 

                                    <div class="row mt-5">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Do you have pets? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_have_pets_error">{{ $errors->first('pa_applicant_have_pets') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_have_pets" id="pa_applicant_have_pets" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_have_pets') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_have_pets') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Pet Type 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_pet_type_error">{{ $errors->first('pa_applicant_pet_type') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_pet_type" id="pa_applicant_pet_type" value="{{old('pa_applicant_pet_type')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Bankruptcy? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_error">{{ $errors->first('pa_applicant_bankruptcy') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_bankruptcy" id="pa_applicant_bankruptcy" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_bankruptcy') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_bankruptcy') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Bankruptcy Year 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_bankruptcy_year_error">{{ $errors->first('pa_applicant_bankruptcy_year') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_bankruptcy_year" id="pa_applicant_bankruptcy_year" value="{{old('pa_applicant_bankruptcy_year')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Lawsuit? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_error">{{ $errors->first('pa_applicant_lawsuites') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_lawsuites" id="pa_applicant_lawsuites" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_lawsuites') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_lawsuites') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Lawsuit Year 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_lawsuites_year_error">{{ $errors->first('pa_applicant_lawsuites_year') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_lawsuites_year" id="pa_applicant_lawsuites_year" value="{{old('pa_applicant_lawsuites_year')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>
                                        



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Ever Been Evicted? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_ever_evicted_error">{{ $errors->first('pa_applicant_ever_evicted') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_ever_evicted" id="pa_applicant_ever_evicted" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_ever_evicted') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_ever_evicted') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Eviction Year 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_eviction_year_error">{{ $errors->first('pa_applicant_eviction_year') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_eviction_year" id="pa_applicant_eviction_year" value="{{old('pa_applicant_eviction_year')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>

                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Convicted of a felony? <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_error">{{ $errors->first('pa_applicant_felony_conviction') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_felony_conviction" id="pa_applicant_felony_conviction" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_felony_conviction') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_felony_conviction') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Felony Conviction Year 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_felony_conviction_year_error">{{ $errors->first('pa_applicant_felony_conviction_year') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_felony_conviction_year" id="pa_applicant_felony_conviction_year" value="{{old('pa_applicant_felony_conviction_year')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="version_2 active">Judgements/filings <span class="required-field">*</span> <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_error">{{ $errors->first('pa_applicant_judgments_or_fillings') }}</span> </label>
                                                    <select class="form-control required" name="pa_applicant_judgments_or_fillings" id="pa_applicant_judgments_or_fillings" >
                                                        <option value="">--Select--</option>
                                                        <option value="Yes" @if(old('pa_applicant_judgments_or_fillings') == "Yes") selected @endif >Yes </option>
                                                        <option value="No" @if(old('pa_applicant_judgments_or_fillings') == "No") selected @endif >No </option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 disabled_by_default">
                                            <div class="form-group">
                                                <label class="version_2 active">Judgements/filings Year 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_applicant_judgments_or_fillings_year_error">{{ $errors->first('pa_applicant_judgments_or_fillings_year') }}</span>
                                                </label>
                                                <input type="text" name="pa_applicant_judgments_or_fillings_year" id="pa_applicant_judgments_or_fillings_year" value="{{old('pa_applicant_judgments_or_fillings_year')}}" class="form-control" placeholder="type...">
                                            </div>
                                        </div>

                                    </div>
  
                                </div>
 
                                <div class="step">
                                    <h3 class="main_question">Step 5 - Employment Information</h3>
                                    <p>**Please do not leave any questions blank, Type N/A in the box if the questions does not apply to you or you don't have the answer at the time.</p>
  
                                    <div class="row mt-5">

                                       <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer Name 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_name_error">{{ $errors->first('pa_employer_name') }}</span>
                                                </label>
                                                <input type="text" name="pa_employer_name" id="pa_employer_name" value="{{old('pa_employer_name')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employment Length  in months 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employment_length_error">{{ $errors->first('pa_employment_length') }}</span>
                                                </label>
                                                <input type="text" name="pa_employment_length" id="pa_employment_length" value="{{old('pa_employment_length')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer Phone 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_phone_error">{{ $errors->first('pa_employer_phone') }}</span>
                                                </label>
                                                <input type="text" name="pa_employer_phone" id="pa_employer_phone" value="{{old('pa_employer_phone')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employment Positions 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employment_position_error">{{ $errors->first('pa_employment_position') }}</span>
                                                </label>
                                                <input type="text" name="pa_employment_position" id="pa_employment_position" value="{{old('pa_employment_position')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>                                        
                                    

                                    {{-- </div>

                                    <div class="row mt-2"> --}}

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer Address 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_address_error">{{ $errors->first('pa_employer_address') }}</span>
                                                </label>
                                                <input type="email" name="pa_employer_address" id="pa_employer_address" value="{{old('pa_employer_address')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer City 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_city_error">{{ $errors->first('pa_employer_city') }}</span>
                                                </label>
                                                <input type="text" name="pa_employer_city" id="pa_employer_city" value="{{old('pa_employer_city')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer state 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_state_error">{{ $errors->first('pa_employer_state') }}</span>
                                                </label>
                                                <input type="text" name="pa_employer_state" id="pa_employer_state" value="{{old('pa_employer_state')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Employer Zip 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_employer_zip_error">{{ $errors->first('pa_employer_zip') }}</span>
                                                </label>
                                                <input type="text" name="pa_employer_zip" id="pa_employer_zip" value="{{old('pa_employer_zip')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                    {{-- </div>
                                    <div class="row mt-2"> --}}


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Monthly income 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_monthly_income_error">{{ $errors->first('pa_monthly_income') }}</span>
                                                </label>
                                                <input type="text" name="pa_monthly_income" id="pa_monthly_income" value="{{old('pa_monthly_income')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>                                        
                                        
                                        

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Supervisor Name 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_supervisor_name_error">{{ $errors->first('pa_supervisor_name') }}</span>
                                                </label>
                                                <input type="text" name="pa_supervisor_name" id="pa_supervisor_name" value="{{old('pa_supervisor_name')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div> 



                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Supervisor Phone 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_supervisor_phone_error">{{ $errors->first('pa_supervisor_phone') }}</span>
                                                </label>
                                                <input type="text" name="pa_supervisor_phone" id="pa_supervisor_phone" value="{{old('pa_supervisor_phone')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Supervisor Fax 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_fax_error">{{ $errors->first('pa_co_applicant_supervisor_fax') }}</span>
                                                </label>
                                                <input type="text" name="pa_co_applicant_supervisor_fax" id="pa_co_applicant_supervisor_fax" value="{{old('pa_co_applicant_supervisor_fax')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Supervisor Email 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_supervisor_email_error">{{ $errors->first('pa_co_applicant_supervisor_email') }}</span>
                                                </label>
                                                <input type="text" name="pa_co_applicant_supervisor_email" id="pa_co_applicant_supervisor_email" value="{{old('pa_co_applicant_supervisor_email')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Other Mothly Income 
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_other_monthly_income_error">{{ $errors->first('pa_co_applicant_other_monthly_income') }}</span>
                                                </label>
                                                <input type="text" name="pa_co_applicant_other_monthly_income" id="pa_co_applicant_other_monthly_income" value="{{old('pa_co_applicant_other_monthly_income')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="version_2 active">Other Monthly Income Reason
                                                    <span class="required-field">*</span>
                                                    <span class="form-text text-danger font-weight-bold" id="pa_co_applicant_other_monthly_income_error">{{ $errors->first('pa_co_applicant_other_monthly_income') }}</span>
                                                </label>
                                                <input type="text" name="pa_co_applicant_other_monthly_income" id="pa_co_applicant_other_monthly_income" value="{{old('pa_co_applicant_other_monthly_income')}}" class="form-control required" placeholder="type...">
                                            </div>
                                        </div>


                                    </div>
 
                                </div>
   

                                <div class="step">
                                    <h3 class="main_question">Step 6 - Applicant's Signature</h3>
                                    <p>**Please add your Electronic Signature.</p>
  
                                    <div class="row mt-5">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <canvas id="sig-canvas" width="620" height="200">
                                                    Your borwser does not support Canvas.
                                                </canvas>
                                            </div>
                                        </div>
                                        <input type="hidden" name="e_sign" id="e_sign" value="">
                                        
                                        <span id="clearsignatureBtn" class="btn">Clear Your Signature</span>
            



                                        <h4 class="title-2 mt-80">Co-Applicant's Signature <span class="required-field">*</span> <span style="font-size: .6em !important;" class="form-text text-danger font-weight-bold" id="e_sign_error">{{ $errors->first('e_sign') }}</span></h4>
    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <canvas id="sig-canvas2" width="620" height="200">
                                                    Your borwser does not support Canvas.
                                                </canvas>
                                            </div>
                                        </div>
                                        <input type="hidden" name="e_sign2" id="e_sign2" value="">
                                        <span id="clearsignatureBtn2" class="btn">Clear Your Signature</span>
            





                                    </div>
                                </div>



                                <div class="submit step" id="end">
                                    <div class="summary">
                                        <div class="wrapper">
                                            <h3>Thank your for your time<br><span id="name_field"></span>!</h3>
                                            <p>We will contat you shorly at the following email address <strong id="email_field"></strong> and if necessary take measures.</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="form-group terms">
                                                <label class="container_check">Please accept our <a href="#" data-toggle="modal" data-target="#terms-txt">Terms and conditions</a> before Submit
                                                    <input type="checkbox" name="terms" value="Yes" class="required">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /step last-->

                            </div>
                            <!-- /middle-wizard -->
                            <div id="bottom-wizard">
                                <button type="button" name="backward" class="backward">Prev</button>
                                <button type="button" name="forward" class="forward">Next</button>
                                <button type="submit" name="process" class="submit">Submit</button>
                            </div>
                            <!-- /bottom-wizard -->
                        </form>
                    </div>
                    <!-- /Wizard container -->
                </div>
            </div><!-- /Row -->
        </div><!-- /Form_container -->
    </div>
<!-- /container -->

{{-- <div class="container">
    <footer id="home" class="clearfix">
        <p>© 2021 Magnifica</p>
        <ul>
            <li><a href="https://1.envato.market/OAmnr" class="animated_link" target="_parent">Purchase this template</a></li>
            <li><a href="index-2.html" class="animated_link">Layout 1</a></li>
            <li><a href="faq.html" class="animated_link">Faq</a></li>
            <li><a href="prevention.html" class="animated_link">Prevention Tips</a></li>
        </ul>
    </footer>
</div> --}}
<!-- /container -->

<div class="cd-overlay-nav">
    <span></span>
</div>
<!-- /cd-overlay-nav -->
<div class="cd-overlay-content">
    <span></span>
</div>
<!-- /cd-overlay-content -->

	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Modal info -->
	<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="{{asset('wizard_assets')}}/js/jquery-3.7.1.min.js"></script>
    <script src="{{asset('wizard_assets')}}/js/common_scripts.min.js"></script>
	<script src="{{asset('wizard_assets')}}/js/velocity.min.js"></script>
	<script src="{{asset('wizard_assets')}}/js/common_functions.js"></script>

	<!-- Wizard script with branch -->
    <script src="{{asset('wizard_assets')}}/js/wizard_with_branch.js"></script>
    <script src="{{asset('resources/front-end-assets/js/contact.js')}}"></script>
 
</body>

</html>
