@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')
 
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{url('accounts/users')}}" class="g-3" method="GET">
                        @csrf
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Search filters</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                
                                <div class="row">     
                                    <div class="col-md-3">
                                        <label for="searchTerm" class="form-label">Search term</label>
                                        <input type="text" class="form-control"  id="searchTerm" name="searchTerm" value="{{ app('request')->input('searchTerm') }}" placeholder="Type something...">
                                    </div>

                                    <div class="col-md-3 rr-admin-field">
                                        <label for="user_type" class="form-label rr-admin-field-label">User type</label>
                                        <select id="user_type" class="js-example-basic-single form-control rr-admin-select" name="user_type">
                                            <option value="">All user types</option>
                                            <option value="superAdmin" @if(app('request')->input('user_type') == "superAdmin") selected @endif>Super Admin</option>
                                            <option value="admin" @if(app('request')->input('user_type') == "admin") selected @endif>Admin</option>
                                            <option value="user" @if(app('request')->input('user_type') == "user") selected @endif>User</option>
                                            <option value="tenant" @if(app('request')->input('user_type') == "tenant") selected @endif>Tenant</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 rr-admin-field">
                                        <label for="account_status" class="form-label rr-admin-field-label">Account status</label>
                                        <select id="account_status" class="js-example-basic-single form-control rr-admin-select" name="account_status">
                                            <option value="">All account statuses</option>
                                            <option value="active" @if(app('request')->input('account_status') == "active") selected @endif>Active</option>
                                            <option value="suspended" @if(app('request')->input('account_status') == "suspended") selected @endif>Suspended</option>
                                        </select>
                                    </div>

                                </div>
                                
                            </div>
                   
                            <div class="card-footer">
                                <div class="col-lg-12">
                                    <div class="text-end d-flex justify-content-end gap-2">
                                        <a href="{{ url()->current() }}" class="btn btn-soft-secondary">
                                            <i class="ri-refresh-line"></i> Reset Filters
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-search-line"></i> Filter Users
                                        </button>
                                    </div>
                                </div><!--end col-->
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end row-->
        </div>
    </div> 

    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex justify-content-between">
                            <h4 class="card-title mb-0">Application Users</h4>
                            <div class="flex-shrink-0">
                                <a href="{{url('accounts/users/create')}}" class="btn btn-primary btn-sm">
                                    <i class="ri-user-add-line"></i> Create New User
                                </a>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive"  style="min-height: 250px">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Details</th>
                                            <th scope="col">Type</th>
                                            {{-- <th scope="col">Email Verification</th> --}}
                                            <th scope="col">Account Status</th>
                                            <th scope="col">Signup date</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_data['User'] as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{$user->getProfilePicture($user->profile_picture)}}" alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-13 my-1"><a href="{{ route('users.show', $user->id) }}" class="text-reset">{{$user->first_name.' '.$user->last_name}}</a></h5>
                                                            <span class="text-muted">{{$user->email}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($user->user_type == "superAdmin")
                                                        <span class="badge bg-success">Super Admin</span>
                                                    @else       
                                                        <span class="badge bg-warning">{{$user->user_type}}</span>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    @if($user->email_verified_at == null)
                                                        <span class="badge bg-danger">Unverified</span>
                                                    @else       
                                                        <span class="badge bg-success">Verified</span>
                                                    @endif
                                                </td> --}}
                                                
                                                <td>
                                                    @if($user->account_status == "active")
                                                        <span class="badge bg-success">Active</span>
                                                    @else       
                                                        <span class="badge bg-danger">Suspended</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="mb-0">{{$user->created_at}}</p>
                                                    <span class="text-muted">{{$user->created_at->diffForHumans()}}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            {{-- <li><a href="{{url('accounts/users/'.$user->id)}}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-0 text-muted"></i> View profile</a></li> --}}
                                                            <li><a href="{{url('accounts/users/'.$user->id.'/edit')}}" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-0 text-muted"></i> Edit</a></li>
                                                            <li><form method="post" action="{{url('accounts/users/delete/'.$user->id)}}" onsubmit="return confirm('Delete this user?')">@csrf @method('DELETE')<button type="submit" class="dropdown-item"><i class="ri-delete-bin-fill align-bottom me-0 text-muted"></i> Delete</button></form></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                @include('partials.paginations.ForControlPanel', ['paginator' => $db_data['User']])
                            </div>

                        </div>
                    </div>
                </div>
             </div> <!-- end row-->
        </div>
    </div> 
 

@endsection


@section('scripts')
@endsection
