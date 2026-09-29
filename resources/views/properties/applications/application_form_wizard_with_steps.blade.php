@extends('layouts.front_end')
@section('page_content')

<style>

input[type="text"], input[type="email"], input[type="password"], input[type="submit"], textarea, select {
    background-color: var(--white);
    border: 2px solid;
    border-color: var(--border-color-9);
    height: 40px !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    padding-left: 20px;
    font-size: 16px;
    color: var(--ltn__paragraph-color);
    width: 100%;
    margin-bottom: 30px;
    border-radius: 0;
    padding-right: 40px;
}


.contact-form-box
{
    padding: 20px 0px 70px;
    position: relative;
    z-index: 1;
}


.form-inner-part
{
    min-height: 300px; 
}


.title-2
{
    margin-bottom: 0px;
}

</style>



 <!-- FEATURE AREA START ( Feature - 6) -->
 <div class="ltn__feature-area section-bg-1 pt-50 pb-90 mb-120---">
    <div class="container">

        <div class="row ltn__custom-gutter--- justify-content-center">
 
            <div class="col-lg-12 col-sm-12 col-12">
 
                <div class="ltn__feature-item ltn__feature-item-6 bg-white  box-shadow-1">

                    <h4 class="title-2">Applicants Details</h4>
                    
                    <form action="#" class="ltn__form-box contact-form-box">
                        <p class="text-left"> To track your order please enter your Order ID in the box below and press the "Track Order" button. This was given to you on your receipt and in the confirmation email you should have received. </p>
                        
                        <div class="form-inner-part">
                            
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="nice-select">
                                            <option>Select Service Type</option>
                                            <option>Property Management </option>
                                            <option>Mortgage Service </option>
                                            <option>Consulting Service</option>
                                            <option>Home Buying</option>
                                            <option>Home Selling</option>
                                            <option>Escrow Services</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="nice-select">
                                            <option>Select Service Type</option>
                                            <option>Property Management </option>
                                            <option>Mortgage Service </option>
                                            <option>Consulting Service</option>
                                            <option>Home Buying</option>
                                            <option>Home Selling</option>
                                            <option>Escrow Services</option>
                                        </select>
                                    </div>
                                </div>                                

                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" id="name" value="{{old("name")}}" placeholder="Enter your name">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="name" class="required fs-7 fw-normal ">
                                        Title <span class="form-error text-danger font-weight-normal" id="name_error" >{{ $errors->first('name')}}</span>
                                    </label>
                                    <div class="input-item">
                                        <select class="nice-select">
                                            <option>Select Service Type</option>
                                            <option>Property Management </option>
                                            <option>Mortgage Service </option>
                                            <option>Consulting Service</option>
                                            <option>Home Buying</option>
                                            <option>Home Selling</option>
                                            <option>Escrow Services</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="btn-wrapper mt-0">
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">get a free service</button>
                        </div>
                    </form>
                </div>
            </div>
 
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->



@endsection




