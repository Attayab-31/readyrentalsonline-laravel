@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Update profile</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xxl-12">
            <form action="{{ url('accounts/update-profile') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Personal Details & Security</h4>
                        {{-- <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            </div>
                        </div> --}}
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="first_name_error">{{ $errors->first('first_name') }}</span>
                                </div>
                            </div>
                                                            
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="last_name_error">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>                                

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label"><i class="bx bx-lock"></i> Email address</label>
                                    <input type="email" disabled name="email" id="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="email_error">{{ $errors->first('email') }}</span>
                                </div>
                            </div> 
                        

                            <div class="col-12 col-lg-6">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{Auth::user()->getProfilePicture(Auth::user()->profile_picture)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input id="profile-img-file-input" type="file" name="profile_picture" class="profile-img-file-input">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <h5 class="fs-16 mb-1">Update profile picture</h5>
                                    <p class="text-muted mb-0">Click on camera to upload new photo</p>
                                </div>
                            </div>
 

                        </div>

                        <div class="row mt-3">

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New password <span class="text-muted">Optional</span></label>
                                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="password_error">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                                                            
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm new password <span class="text-muted">Optional</span></label>
                                    <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="confirm_password_error">{{ $errors->first('confirm_password') }}</span>
                                </div>
                            </div>  

                        </div><!--end row-->
                    
                    </div>

                    <div class="card-footer">
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" id="formSubmitBTN">Save Changes</button>
                            </div>
                        </div><!--end col-->

                    </div>

                </div>

            </form>
        </div>
    </div> 
 

@endsection


@section('scripts')
    <script>
        document.querySelector("#profile-img-file-input") &&
        document.querySelector("#profile-img-file-input").addEventListener("change", function() {
            var profileImage = document.querySelector(".user-profile-image");
            var file = document.querySelector(".profile-img-file-input").files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                profileImage.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
