@extends('layouts.front_end')

@section('page_content')
    
    <style type="text/css">
        input[type="text"], input[type="email"], input[type="password"], input[type="submit"], textarea 
        {
            height: 50px !important;
            margin-bottom: 15px;
        }

        .input-item .nice-select 
        {
            line-height: 49px;
            height: 50px;
            margin-bottom: 15px;
        }


        /* Add this CSS to your existing stylesheet */
        .ltn__img-slide-item-4 img {
            width: 100%; /* Ensure images fill their container */
            height: 450px; /* Set a fixed height for all images */
            object-fit: cover; /* Maintain aspect ratio and cover entire container */
        }


    </style>

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left mb-0" style="background: linear-gradient(135deg, var(--rr-navy-700) 0%, var(--rr-slate-600) 100%); padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white mb-2">Property Details</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul style="color: rgba(255,255,255,0.8);">
                                <li><a href="{{url('/')}}" class="text-white"><i class="fas fa-home me-1"></i> Home</a></li>
                                <li class="text-white-50">Property Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <section class="rr-detail-summary">
        <div class="rr-shell rr-detail-summary-inner">
            <div>
                <p class="rr-eyebrow">{{ $db_data['Property']->p_listing_status === 'for-rent' ? 'For rent' : 'For sale' }}</p>
                <h1>{{ $db_data['Property']->p_title }}</h1>
                @if($db_data['Property']->p_address)
                    <p class="rr-address"><span aria-hidden="true">&#x2316;</span> {{ $db_data['Property']->p_address }}</p>
                @endif
            </div>
            <div class="rr-detail-summary-action">
                <div class="rr-detail-price">
                    @if(filled($db_data['Property']->p_price) && (float) $db_data['Property']->p_price > 0)
                        <strong>${{ number_format((float) $db_data['Property']->p_price, 0) }}</strong>
                        @if($db_data['Property']->p_listing_status === 'for-rent')<span>per month</span>@endif
                    @else
                        <strong class="rr-detail-price-note">Contact us for pricing</strong>
                    @endif
                </div>
                @if($db_data['Property']->p_listing_status === 'for-rent')
                    <a class="rr-button" href="{{url('applications')}}?property={{$db_data['Property']->p_slug}}">Apply now</a>
                @else
                    <a class="rr-button" href="{{url('contact-us')}}">Ask about this property</a>
                @endif
            </div>
        </div>
    </section>

    <!-- IMAGE SLIDER AREA START (img-slider-3) -->
    @if($db_data['PropertyImage']->isNotEmpty())
    <div class="ltn__img-slider-area mb-90">
        <div class="container-fluid">
            <div class="row ltn__image-slider-5-active slick-arrow-1 slick-arrow-1-inner ltn__no-gutter-all">
                @foreach($db_data['PropertyImage'] as $PropertyImage)
                <div class="col-lg-12">
                    <div class="ltn__img-slide-item-4">
                        <a href="{{asset('resources/files/dynamic/'.$PropertyImage->pi_image_name)}}" data-rel="lightcase:myCollection">
                            <img src="{{asset('resources/files/dynamic/'.$PropertyImage->pi_image_name)}}" alt="Image">
                        </a>
                    </div>
                </div>
                @endforeach
             </div>
        </div>
    </div>
    @endif
    <!-- IMAGE SLIDER AREA END -->

    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                        <h4 class="title-2">Description</h4>
                        <p>{!! $db_data['Property']->p_description !!}</p>

                        <h4 class="title-2">Property Detail</h4>  
                        <div class="property-detail-info-list section-bg-1 clearfix mb-60">                          
                            <ul>
                                <li><label>Home Area: </label> <span>{{$db_data['Property']->p_area}} sq ft</span></li>
                                <li><label>Bedrooms:</label> <span>{{$db_data['Property']->p_bedrooms}}</span></li>
                                <li><label>Baths:</label> <span>{{$db_data['Property']->p_baths}}</span></li>
                            </ul>
                            <ul>
                                <li><label>Property Status:</label> 

                                @if($db_data['Property']->p_listing_status == "for-rent")
                                	<span>For Rent</span>
                                @elseif($db_data['Property']->p_listing_status == "for-sell")
                                    <span>For Sale</span>
                                @endif
                                </li>

                            </ul>
                        </div>
{{--                                         
                        <h4 class="title-2">Facts and Features</h4>
                        <div class="property-detail-feature-list clearfix mb-45">                            
                            <ul>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Living Room</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Garage</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Dining Area</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Bedroom</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Bathroom</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Gym Area</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Garden</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6>Parking</h6>
                                            <small>20 x 16 sq feet</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}

                        <h4 class="title-2 mb-10">Amenities</h4>
                        <div class="property-details-amenities mb-60">
                            <div class="row">
                               
                                @foreach($db_data['PropertyAmenity'] as $PropertyAmenity)
                                    @if($loop->first || $loop->iteration%5 == 1)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="ltn__menu-widget">
                                            <ul>
                                    @endif
                                                <li>
                                                    <label class="checkbox-item">{{$PropertyAmenity->pa_title}}
                                                        <input type="checkbox" checked="checked" disabled>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </li>
                                    @if($loop->iteration == 5 || $loop->last)
                                            </ul>
                                        </div>
                                    </div>
                                    @endif

                                @endforeach 
  
                            </div>
                        </div>	

                    @if($db_data['Property']->p_map_location_markup != "" && $db_data['Property']->p_map_location_markup != null)
                        <h4 class="title-2">Location</h4>
                        <div class="property-details-google-map" style="margin-bottom: 175px;">
                            @php
                                $storedPropertyMap = trim((string) $db_data['Property']->p_map_location_markup);
                                $parsedPropertyMap = filter_var($storedPropertyMap, FILTER_VALIDATE_URL) ? parse_url($storedPropertyMap) : false;
                                $isOpenStreetMapEmbed = is_array($parsedPropertyMap)
                                    && ($parsedPropertyMap['scheme'] ?? '') === 'https'
                                    && ($parsedPropertyMap['host'] ?? '') === 'www.openstreetmap.org'
                                    && ($parsedPropertyMap['path'] ?? '') === '/export/embed.html';
                            @endphp
                            @if($isOpenStreetMapEmbed)
                                <iframe
                                    src="{{ $storedPropertyMap }}"
                                    title="Map showing {{ $db_data['Property']->p_address }}"
                                    width="100%"
                                    height="360"
                                    style="border: 0; border-radius: 12px;"
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen>
                                </iframe>
                            @else
                                {!! $db_data['Property']->p_map_location_markup !!}
                            @endif
                        </div>
                    @endif
 
 	
                        <h4 class="title-2">Related Properties</h4>
                        <div class="row">
                         
 
                        @if($db_data['Related_Property']->count() > 0)            
                           @foreach( $db_data['Related_Property'] as $Related_Property)
	
	                            <!-- ltn__product-item -->
	                            <div class="col-xl-6 col-sm-6 col-12">
	                                <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
	                                    <div class="product-img">
	                                        <a href="{{url('properties/explore-details/'.$Related_Property->p_slug)}}"><img src="{{asset('resources/files/dynamic/'.$Related_Property->p_banner_image)}}" alt="#"></a>
{{-- 	                                        <div class="real-estate-agent">
	                                            <div class="agent-img">
	                                                <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
	                                            </div>
	                                        </div> --}}
	                                    </div>
	                                    <div class="product-info">
	                                        <div class="product-badge">
	                                            <ul>
	                                                @if($Related_Property->p_listing_status == "for-rent")
					                                    <li class="sale-badge">For Rent</li>
					                                @elseif($Related_Property->p_listing_status == "for-sell")
					                                    <li class="sale-badge">For Sale</li>
					                                @endif
	                                            </ul>
	                                        </div>
	                                        <h2 class="product-title"><a href="{{url('properties/explore-details/'.$Related_Property->p_slug)}}">{{$Related_Property->p_title}}</a></h2>
	                                        <div class="product-img-location">
	                                            <ul>
	                                                <li>
	                                                    <a href="{{url('properties/explore-details/'.$Related_Property->p_slug)}}"><i class="flaticon-pin"></i> {{$Related_Property->p_address}}</a>
	                                                </li>
	                                            </ul>
	                                        </div>
	                                        <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
	                                            <li><span>{{$Related_Property->p_bedrooms}} </span>
	                                                Bedrooms
	                                            </li>
	                                            <li><span>{{$Related_Property->p_baths}} </span>
	                                                Bathrooms
	                                            </li>
	                                            <li><span>{{$Related_Property->p_area}} </span>
	                                                square Ft
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <div class="product-info-bottom">
	                                        <div class="product-price">
	                                            @if(filled($Related_Property->p_price) && (float) $Related_Property->p_price > 0)
	                                                <span>${{ number_format((float) $Related_Property->p_price, 0) }}@if($Related_Property->p_listing_status === 'for-rent')<label>/Month</label>@endif</span>
	                                            @else
	                                                <span>Contact for pricing</span>
	                                            @endif
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

                           @endforeach	 
                        @else
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <!-- FEATURE AREA START ( Feature - 6) -->
                                    <div class="ltn__feature-area section-bg-1 pt-30 pb-10 ">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="section-title-area ltn__section-title-2--- text-center">
                                                        <h5>No Related Proeprties Found!</h5> 
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <!-- FEATURE AREA END -->
                                </div>
                        @endif
 
                        </div>








                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar---">
                        <!-- Author Widget -->
                        <!--<div class="widget ltn__author-widget">-->
                        <!--    <div class="ltn__author-widget-inner text-center">-->
                        <!--        <img src="{{asset('resources/front-end-assets')}}/img/team/4.jpg" alt="Image">-->
                        <!--        <h5>Rosalina D. Willaimson</h5>-->
                        <!--        <small>Traveller/Photographer</small>-->
                        <!--        <div class="product-ratting">-->
                        <!--            <ul>-->
                        <!--                <li><a href="#"><i class="fas fa-star"></i></a></li>-->
                        <!--                <li><a href="#"><i class="fas fa-star"></i></a></li>-->
                        <!--                <li><a href="#"><i class="fas fa-star"></i></a></li>-->
                        <!--                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>-->
                        <!--                <li><a href="#"><i class="far fa-star"></i></a></li>-->
                        <!--                <li class="review-total"> <a href="#"> ( 1 Reviews )</a></li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis distinctio, odio, eligendi suscipit reprehenderit atque.</p>-->
                        <!--        <div class="ltn__social-media">-->
                        <!--            <ul>-->
                        <!--                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>-->
                        <!--                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>-->
                        <!--                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>-->
                                        
                        <!--                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
  
                        <div class="widget ltn__form-widget" id="form_container">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Drop us a Messege</h4>
                            
                           <div id="form_res" style="display:none">
                                
                            </div>


                            <form action="{{url('properties/process-inquiry-form')}}" id="prop_inqury_form" method="POST">
                                @csrf
                                <span class="form-text text-danger font-weight-bold" id="full_name_error">{{ $errors->first('full_name') }}</span>
                                <input type="text" name="full_name" id="full_name" placeholder="Your Name*">
                                
                                <span class="form-text text-danger font-weight-bold" id="email_error">{{ $errors->first('email') }}</span>
                                <input type="email" name="email" id="email" placeholder="Your e-Mail">
                                
                                <span class="form-text text-danger font-weight-bold" id="phone_number_error">{{ $errors->first('phone_number') }}</span>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Your Phone (optional)">
                                
                                <span class="form-text text-danger font-weight-bold" id="inquiry_type_error">{{ $errors->first('inquiry_type') }}</span>
                                <div class="input-item">
                                    <select class="nice-select" name="inquiry_type" id="inquiry_type">
                                        <option value="">--Select Service Type--</option>
                                        <option value="Book Property" @if(old('inquiry_type') == "Book Property") selected @endif >Book This Property </option>
                                        <option value="Property Rental" @if(old('inquiry_type') == "Property Rental") selected @endif >Inquire This Property </option>
                                        <option value="General Help" @if(old('inquiry_type') == "General Help") selected @endif >General Help</option>
                                    </select>
                                </div>
                            
                                <input type="hidden" name="property_title" id="property_title" value="{{$db_data['Property']->p_title}}">
                                
                                <span class="form-text text-danger font-weight-bold" id="yourmessage_error">{{ $errors->first('inquiry_type') }}</span>
                                <textarea name="yourmessage" id="yourmessage" placeholder="Write Message..."></textarea>
                                
                                <button type="submit" class="btn theme-btn-1" id="form-sbm-btn">Send Message</button>
                            </form>
                            
                        </div>
 
  						
  						@if($db_data['AppSetting'])
	                        <!-- Social Media Widget -->
	                        <div class="widget ltn__social-media-widget">
	                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
	                            <div class="ltn__social-media-2">
	                                <ul>
	                                  	@if($db_data['AppSetting']->as_facebook_profile != "" && $db_data['AppSetting']->as_facebook_profile != null)
	                                    	<li>
	                                    		<a href="{{$db_data['AppSetting']->as_facebook_profile}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
	                                    	</li>
	                                  	@endif

                                        @if($db_data['AppSetting']->as_linkedin_profile != "" && $db_data['AppSetting']->as_linkedin_profile != null)
                                            <li>
                                                <a href="{{$db_data['AppSetting']->as_linkedin_profile}}" target="_blank" title="Facebook"><i class="fab fa-linkedin"></i></a>
                                            </li>
                                        @endif


                                        @if($db_data['AppSetting']->as_twitter_profile != "" && $db_data['AppSetting']->as_twitter_profile != null)
                                            <li>
                                                <a href="{{$db_data['AppSetting']->as_twitter_profile}}" target="_blank" title="Facebook"><i class="fab fa-twitter"></i></a>
                                            </li>
                                        @endif


                                        @if($db_data['AppSetting']->as_instagram_profile != "" && $db_data['AppSetting']->as_instagram_profile != null)
                                            <li>
                                                <a href="{{$db_data['AppSetting']->as_instagram_profile}}" target="_blank" title="Facebook"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        @endif


                                        @if($db_data['AppSetting']->as_tiktok_profile != "" && $db_data['AppSetting']->as_tiktok_profile != null)
                                            <li>
                                                <a href="{{$db_data['AppSetting']->as_tiktok_profile}}" target="_blank" title="Facebook"><i class="fab fa-tiktok"></i></a>
                                            </li>
                                        @endif  
                                        


                                        @if($db_data['AppSetting']->as_youtube_profile != "" && $db_data['AppSetting']->as_youtube_profile != null)
                                            <li>
                                                <a href="{{$db_data['AppSetting']->as_youtube_profile}}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
                                            </li>
                                        @endif                                                                                                                                                                
	                                </ul>
	                            </div>
	                        </div>
  						@endif
 
                         <div class="widget ltn__banner-widget d-none">
                            <a href="shop.html"><img src="{{asset('resources/front-end-assets')}}/img/banner/2.jpg" alt="#"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->

@endsection
