@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')
 
    <div class="row">
        <div class="col-xxl-12">
            <form action="{{ url('accounts/users/'.$db_data['User']->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit user</h4>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" name="first_name" id="first_name" value="{{$db_data['User']->first_name}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="first_name_error">{{ $errors->first('first_name') }}</span>
                                </div>
                            </div>
                                                            
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" name="last_name" id="last_name" value="{{$db_data['User']->last_name}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="last_name_error">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>                                

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address <span class="text-danger fw-bold">*</span></label>
                                    <input type="email" name="email" id="email" value="{{$db_data['User']->email}}" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="email_error">{{ $errors->first('email') }}</span>
                                </div>
                            </div> 
                        
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_type" class="form-label">User type</label>
                                    <select class="js-example-basic-single form-control" name="user_type">
                                        <option value="">--Select--</option>
                                        <option value="superAdmin" @if($db_data['User']->user_type == "superAdmin") selected @endif>super Admin</option>
                                        <option value="admin" @if($db_data['User']->user_type == "admin") selected @endif>Admin</option>
                                        <option value="user" @if($db_data['User']->user_type == "user") selected @endif>user</option>
                                    </select>
                                    <span class="text-danger form-error" id="user_type_error">{{ $errors->first('user_type') }}</span>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="account_status" class="form-label">Account status</label>
                                    <select class="js-example-basic-single form-control" name="account_status">
                                        <option value="">--Select--</option>
                                        <option value="active" @if($db_data['User']->account_status == "active") selected @endif>Active</option>
                                        <option value="suspended" @if($db_data['User']->account_status == "suspended") selected @endif>Suspended</option>
                                    </select>
                                    <span class="text-danger form-error" id="account_status_error">{{ $errors->first('account_status') }}</span>

                                </div>
                            </div>


                            <div class="col-6">
                                <div class="text-center">
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img src="{{$db_data['User']->getProfilePicture($db_data['User']->profile_picture)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input id="profile-img-file-input" type="file" name="profile_picture" class="profile-img-file-input">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <h5 class="fs-16 mb-1">Udpdate profile picture <span class="text-muted text-sm">(Optional)</span></h5>
                                    <p class="text-muted mb-0">Click on camera to upload new photo</p>
                                </div>
                            </div>
 

                        </div>

                        <div class="row mt-3">

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New password <span class="text-muted">Optional</span></label>
                                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="password_error">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                                                            
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm new passowrd <span class="text-muted">Optional</span></label>
                                    <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" placeholder="Type...">
                                    <span class="text-danger form-error" id="confirm_password_error">{{ $errors->first('confirm_password') }}</span>
                                </div>
                            </div>  

                        </div><!--end row-->
                    
                    </div>

                    <div class="card-footer">
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" id="formSubmitBTN">Submit</button>
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