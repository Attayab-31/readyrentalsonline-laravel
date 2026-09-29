@extends('layouts.accounts')

@section('content')
 
	<div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Property Management</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset " href="{{url('accounts/properties/create')}}">
                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light">+ Add new Property</button>
                                    </a>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive"  style="min-height: 250px">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
											<th scope="col">Property</th>
											<th scope="col">Area</th>
											<th scope="col"># Of Beds</th>
											<th scope="col">Listing Status</th>
											<th scope="col">Active Status</th>
											<th scope="col">Created at</th>
											<th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_data['Property'] as $property)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{asset('resources/files/dynamic/'.$property->p_banner_image)}}" alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-13 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{$property->p_title}}</a></h5>
                                                            <span class="text-muted">{{$property->p_address}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">{{$property->p_area}}</span>
                                                </td>

												<td>
													<div class="d-flex">
 
														<div class="flex-grow-1 ms-3">
															<span class="text-muted  text-muted d-block fs-7">Rooms: {{$property->p_rooms}}</span>
															<span class="text-muted  text-muted d-block fs-7">Beds:{{$property->p_bedrooms}}</span>
															<span class="text-muted  text-muted d-block fs-7">Baths: {{$property->p_baths}}</span>
														</div>
													</div>
												</td>

												<td>
													@if($property->p_listing_status == "for-rent")
														<span class="badge badge-light-success fs-7 fw-bold bg-danger text-white">Rental</span>
													@elseif($property->p_listing_status == "for-sell")
														<span class="badge badge-light-warning fs-7 fw-bold bg-warning text-white">For Sale</span>
													@else
														<span class="badge badge-light-primary fs-7 fw-bold">{{$property->p_listing_status}}</span>
													@endif
												</td>


												<td>
													@if($property->p_active_status == "active")
														<span class="badge badge-light-danger fs-7 fw-bold bg-success text-white">Active</span>
													@elseif($property->p_active_status == "inactive")
														<span class="badge badge-light-danger fs-7 fw-bold bg-danger text-white">In-Active</span>
													@else
														<span class="badge badge-light-primary fs-7 fw-bold">{{$property->p_active_status}}</span>
													@endif
												</td>

                                                <td>
                                                    <p class="mb-0">{{$property->p_created_at}}</p>
                                                    <span class="text-muted">{{$property->p_created_at->diffForHumans()}}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
															@if($property->p_active_status == "active")
															<li><a onclick="inactivate_confirmation(event)" href="{{url('accounts/properties/change-active-status/'.$property->property_id.'/inactive')}}" class="dropdown-item">Mark In-Activate</a></li>
															@elseif($property->p_active_status == "inactive")
															<li><a onclick="activate_confirmation(event)" href="{{url('accounts/properties/change-active-status/'.$property->property_id.'/active')}}" class="dropdown-item">Mark Activate</a></li>
															@else
															<li><a onclick="activate_confirmation(event)" href="{{url('accounts/properties/change-active-status/'.$property->property_id.'/active')}}" class="dropdown-item">Activate</a></li>
															@endif

															<li><a href="{{ url('accounts/properties/'.$property->property_id.'/edit') }}" class="dropdown-item"> Edit</a></li>
															@if(Auth::user()->user_type =="super-admin")
																<li><a onclick="confirm_soft_delete(event)" href="{{url('accounts/properties/delete-property-permanently/'.$property->property_id)}}" class="dropdown-item"> Delete</a> </li>
															@endif
 
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
                                @include('partials.paginations.ForControlPanel', ['paginator' => $db_data['Property']])
                            </div>

                        </div>
                    </div>
                </div>
             </div> <!-- end row-->
        </div>
    </div> 

@endsection

