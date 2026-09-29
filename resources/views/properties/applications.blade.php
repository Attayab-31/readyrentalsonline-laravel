@extends('layouts.front_end')

@section('page_content')




<!-- FEATURE AREA START ( Feature - 6) -->
    <div class="ltn__feature-area section-bg-1 pt-40 pb-90 mb-120---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Apply For Property</h6>
                        <h1 class="section-title">Select Application Type </h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter--- justify-content-center">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1 active">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-house"></i></span> -->
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/icon-img/21.png" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="{{url('online-application')}}">Apply Online</a></h3>
                            <p>You can apply online by filling a form. After clicking the link below you will be redirected to online application form. After you have submitted the form, we will try to reach out to you within 2 Business days</p>
                            <a class="theme-btn-1 btn btn-effect-1" href="{{url('online-application')}}?property={{request()->query('property')}}">Apply Online Now <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1 active">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-house-3"></i></span> -->
                            <img src="{{asset('resources/front-end-assets')}}/img/icons/icon-img/22.png" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="{{url('applications/submit-application-form')}}">Download Application</a></h3>
                            <p>Click the link below to download the application form. After filling the form </p>
                            <a class="theme-btn-1 btn btn-effect-1" href="{{url('applications/submit-application-form')}}">Download Application <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->




@endsection
