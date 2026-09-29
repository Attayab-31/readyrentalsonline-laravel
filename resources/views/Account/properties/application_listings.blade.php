@extends('layouts.accounts')

@section('content')
 
	<div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Manage Applications</h4>
                        </div><!-- end card header -->
                        <div class="card-body">

							<div class="table-responsive" >
								<table class="table align-middle table-nowrap mb-0">
									<thead class="table-light">
										<tr>
											<th class="col">Property</th>
											<th class="col">Applicant Details</th>
											<th class="col">Applied On</th>
											<th class="col">Application Type</th>
											<th class="col">Created at</th>
											<th class="col">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($db_data['PropertyApplication'] as $application)
										<tr>
											<td class="d-flex">
												<img src="{{asset('resources/files/dynamic/'.$application->p_banner_image)}}" alt="" class="avatar-xs rounded-3 me-2">
												<div>
													<h5 class="fs-13 mb-0">{{$application->p_title}}</h5>
													<p class="fs-12 mb-0 text-muted">{{$application->p_address}}</p>
												</div>
											</td>

											<td>
												<span class="text-muted text-muted d-block fs-7">Fullname: {{$application->pa_applicant_name}}</span>
												<span class="text-muted text-muted d-block fs-7">Email: {{$application->pa_applicant_email}}</span>
												<span class="text-muted text-muted d-block fs-7">Phone:{{$application->pa_applicant_phone_num}}</span>
											</td>
								
											<td>
												<div class="d-flex justify-content-start flex-column">
													<span class="text-muted text-muted d-block fs-7">{{$application->pa_created_at}}</span>
												</div>
											</td>
								
											<td>
												@if($application->pa_application_type == "online")
												<span class="badge badge-light-success fs-7 bg-danger text-white">Online</span>
												@elseif($application->pa_application_type == "offline")
												<div class="d-flex justify-content-start flex-column">
													<a href="{{asset('resources/files/dynamic/'.$application->pa_application_document_attached)}}" download="" class="text-dark fw-bolder text-hover-primary fs-6">
														<span class="badge badge-light-warning fs-7 bg-warning text-white">Offline</span>
													</a>
								
													<a href="{{asset('resources/files/dynamic/'.$application->pa_application_document_attached)}}" download="" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
														<span class="text-muted text-muted d-block fs-7">Download Form</span>
													</a>
												</div>
												@else
												<span class="badge badge-light-primary fs-7 fw-bold">{{$application->pa_application_type}}</span>
												@endif
											</td>
							
											<td>
												<span class="text-muted text-muted d-block fs-7">{{$application->pa_created_at->format('F j, Y')}}</span>
												<span class="text-muted text-muted d-block fs-7">{{$application->pa_created_at->diffForHumans()}}</span>
											</td>
											
							
											<td class="text-end">
												<div class="dropdown d-inline-block">
													<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="ri-more-fill align-middle"></i>
													</button>
													<ul class="dropdown-menu dropdown-menu-end">
														@if(Auth::user()->isSuperAdmin())
														<li><a onclick="confirm_soft_delete(event)" href="{{url('accounts/properties/applications/delete-permanently/'.$application->property_application_id)}}" class="dropdown-item"> Delete</a></li>
														@endif
														<li><a href="{{url('accounts/properties/view-application-details/'.$application->property_application_id)}}" class="dropdown-item"> View Details</a></li>
														@if($application->pa_application_type == "online")
														<li><a href="{{url('accounts/properties/print-application-details/'.$application->property_application_id)}}" class="dropdown-item"> Print</a></li>
														@endif
													</ul>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								
							</div>
							
							<div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
								@include('partials.paginations.ForControlPanel', ['paginator' => $db_data['PropertyApplication']])
							</div>
							

 
						</div>
					</div>
				</div>
			</div> <!-- end row-->
		</div>
	</div> 

	@endsection