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
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image mb-0"  data-bs-bg="{{asset('resources/front-end-assets')}}/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Property Details</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{url('/')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Property Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- IMAGE SLIDER AREA START (img-slider-3) -->
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
    <!-- IMAGE SLIDER AREA END -->

    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="#">Featured</a>
                                </li>
                                <li class="ltn__blog-category">
                                @if($db_data['Property']->p_listing_status == "for-rent")
                                    <a class="bg-orange" href="#">For Rent</a>
                                @elseif($db_data['Property']->p_listing_status == "for-sell")
                                    <a class="bg-orange" href="#">For Sell</a>
                                @endif
                                </li>
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i>{{ $db_data['Property']->p_created_at }}
                                </li>
                            </ul>
                        </div>
                        <h1>{{ $db_data['Property']->p_title }}
                          <a class="theme-btn-1 btn btn-effect-1" href="{{url('applications')}}" tabindex="0">APPLY NOW</a> 
                        </h1>

                        {{-- <div class="product-price"> --}}
                        {{-- </div> --}}

                        <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span> {{ $db_data['Property']->p_address }}</label>
                        <h4 class="title-2">Description</h4>
                        <p>{!! $db_data['Property']->p_description !!}</p>

                        <h4 class="title-2">Property Detail</h4>  
                        <div class="property-detail-info-list section-bg-1 clearfix mb-60">                          
                            <ul>
                                <li><label>Home Area: </label> <span>{{$db_data['Property']->p_area}}</span></li>
                                <li><label>Rooms:</label> <span>{{$db_data['Property']->p_rooms}}</span></li>
                                <li><label>Baths:</label> <span>{{$db_data['Property']->p_baths}}</span></li>
                                <li><label>Year built:</label> <span>{{$db_data['Property']->b_year_built}}</span></li>
                            </ul>
                            <ul>
                                {{-- <li><label>Lot Area:</label> <span>{{$db_data['Property']->p_area}} </span></li> --}}
                                <li><label>Beds:</label> <span>{{$db_data['Property']->p_rooms}}</span></li>
                                <li><label>Price:</label> <span>{{$db_data['Property']->p_price}}</span></li>
                                <li><label>Property Status:</label> 

                                @if($db_data['Property']->p_listing_status == "for-rent")
                                	<span>For Rent</span>
                                @elseif($db_data['Property']->p_listing_status == "for-sell")
                                	<span>For Sell</span>
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

                        <h4 class="title-2">From Our Gallery</h4>
                        <div class="ltn__property-details-gallery mb-30">
                            <div class="row">

				                @foreach($db_data['PropertyImage'] as $PropertyImage)
                                <div class="col-md-6">
                                    <a href="{{asset('resources/files/dynamic/'.$PropertyImage->pi_image_name)}}" data-rel="lightcase:myCollection">
                                        <img class="mb-30" src="{{asset('resources/files/dynamic/'.$PropertyImage->pi_image_name)}}" alt="Image">
                                    </a>
                                </div>
				                @endforeach

                            </div>
                        </div>

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
                            {!! $db_data['Property']->p_map_location_markup !!}
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
					                                    <li class="sale-badge">For Sell</li>
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
	                                            <span>${{$Related_Property->p_price}}<label>/Month</label></span>
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

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center---">
                        <h1 class="section-title">Related Properties</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__related-product-slider-two-active slick-arrow-1">
                <!-- ltn__product-item -->
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('resources/front-end-assets')}}/img/product-3/1.jpg" alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badg">For Rent</li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bed
                                </li>
                                <li><span>2 </span>
                                    Bath
                                </li>
                                <li><span>3450 </span>
                                    Square Ft
                                </li>
                            </ul>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="portfolio-details.html" title="Compare">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info-bottom">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('resources/front-end-assets')}}/img/product-3/2.jpg" alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badg">For Sale</li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bed
                                </li>
                                <li><span>2 </span>
                                    Bath
                                </li>
                                <li><span>3450 </span>
                                    Square Ft
                                </li>
                            </ul>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="portfolio-details.html" title="Compare">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info-bottom">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('resources/front-end-assets')}}/img/product-3/3.jpg" alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badg">For Rent</li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bed
                                </li>
                                <li><span>2 </span>
                                    Bath
                                </li>
                                <li><span>3450 </span>
                                    Square Ft
                                </li>
                            </ul>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="portfolio-details.html" title="Compare">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info-bottom">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('resources/front-end-assets')}}/img/product-3/4.jpg" alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badg">For Rent</li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bed
                                </li>
                                <li><span>2 </span>
                                    Bath
                                </li>
                                <li><span>3450 </span>
                                    Square Ft
                                </li>
                            </ul>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="portfolio-details.html" title="Compare">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info-bottom">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('resources/front-end-assets')}}/img/product-3/5.jpg" alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{asset('resources/front-end-assets')}}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badg">For Rent</li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bed
                                </li>
                                <li><span>2 </span>
                                    Bath
                                </li>
                                <li><span>3450 </span>
                                    Square Ft
                                </li>
                            </ul>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="portfolio-details.html" title="Compare">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info-bottom">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->

@endsection
