@extends('layouts.front_end')

@section('page_content')

    <style type="text/css">
    	.font-weight-bold
    	{
    		font-weight: bold;
    	}
    </style>	

   <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('resources/front-end-assets')}}/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Contact Us</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{url('/')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/10.png" alt="Icon Image">
                        </div>
                        <h3>Email Address</h3>
                        <p>info@readyrentalsonline.com <br></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/11.png" alt="Icon Image">
                        </div>
                        <h3>Phone Number</h3>
                        <p>1-267-549-9625</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/12.png" alt="Icon Image">
                        </div>
                        <h3>Office Address</h3>
                        <p>1742 Delsea Drive,<br> Deptford NJ 08096</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->
    
    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100" id="form_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">Have a Question?</h4>

                       <div id="form_res" style="display:none">
                            
                        </div>                                                

                        <form id="contact-form" action="{{ url('contact-us/process-form') }}" method="post">
		    	        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="form-text text-danger font-weight-bold" id="full_name_error">{{ $errors->first('full_name') }}</span>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" id="full_name" name="full_name" placeholder="Enter your name" value="{{ old('full_name')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <span class="form-text text-danger font-weight-bold" id="email_error">{{ $errors->first('email') }}</span>
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" id="email" name="email" placeholder="Enter your Email Address" value="{{ old('email')}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="form-text text-danger font-weight-bold" id="service_type_error">{{ $errors->first('service_type') }}</span>
                                    <div class="input-item">
                                        <select class="nice-select" name="service_type" id="service_type">
                                            <option value="">Select Service Type</option>
                                            <option value="Property Rental" @if(old('service_type') == "Property Rental") selected @endif >Property Rental </option>
                                            <option value="General Help" @if(old('service_type') == "General Help") selected @endif >General Help </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="form-text text-danger font-weight-bold" id="phone_number_error">{{ $errors->first('phone_number') }}</span>
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" id="phone_number" name="phone_number" placeholder="Enter your Phone Number" value="{{ old('phone_number')}}">
                                    </div>
                                </div>
                            </div>

                            <span class="form-text text-danger font-weight-bold" id="message_error">{{ $errors->first('message') }}</span>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea name="message" id="message" placeholder="Enter message">{{old('message')}}</textarea>
                            </div>

                            {{-- <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label></p> --}}
                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" id="form-sbm-btn" type="submit">Submit</button>
                            </div>
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="gsoogle-map mb-120">
       
        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7%3A0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}

    </div>
    <!-- GOOGLE MAP AREA END -->


@endsection


@section('page_level_scripts')



@endsection


