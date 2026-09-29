@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')
 
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Control Panel Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

 
    <div class="row">
        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Total Users</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> <span class="counter-value" data-target="{{$db_data['TotalUsersCount']}}">0</span></h4>
                            <a href="{{url('accounts/users')}}" class="text-decoration-underline">View all users</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                <i class="bx bx-user-plus text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        @endif


        {{-- If Tenant is logged in then show the count of their invoices --}}
        @if(Auth::user()->isTenant())

            {{-- Get the Total Invoices Count from the Modal below --}}
            @php 
                $db_data['TotalInvoicesCount'] = \App\Models\Invoice::where('i_tenant_id' , Auth::user()->id)->count();
            @endphp
            
            
            
            {{-- Get the Total Invoices Count from the Modal below --}}
            @php 
                $db_data['TotalPaidInvoicesCount'] = \App\Models\Invoice::where('i_tenant_id' , Auth::user()->id)->where('i_status' , 'paid')->count();
            @endphp
            
    
        @elseif(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
            
            {{-- Get the Total Invoices Count from the Modal below --}}
            @php 
                $db_data['TotalInvoicesCount'] = \App\Models\Invoice::where('i_status' , 'unpaid')->count();
            @endphp
            
            
            {{-- Get the Total Invoices Count from the Modal below --}}
            @php 
                $db_data['TotalPaidInvoicesCount'] = \App\Models\Invoice::where('i_status' , 'paid')->count();
            @endphp

        @endif
    
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Open Invoices</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"> <span class="counter-value" data-target="{{$db_data['TotalInvoicesCount']}}">0</span></h4>
                                <a href="{{url('accounts/invoices?i_status=open')}}" class="text-decoration-underline">View all invoices</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle rounded fs-3">
                                    <i class="bx bx-file text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->



            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-0">Paid Invoices</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"> <span class="counter-value" data-target="{{$db_data['TotalPaidInvoicesCount']}}">0</span></h4>
                                <a href="{{url('accounts/invoices?i_status=paid')}}" class="text-decoration-underline">View all invoices</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                    <i class="bx bx-file text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
 
      
        
 

        {{-- Get UnRead Message and display the count in the card --}}
        @php 
            $db_data['TotalUnReadMessages'] = \App\Models\Message::where('receiver_id' , Auth::user()->id)
                                                                ->where('is_read' , false)
                                                                ->count();
        @endphp

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Unread Messages</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> <span class="counter-value" data-target="{{$db_data['TotalUnReadMessages']}}">0</span></h4>
                            <a href="{{url('accounts/chat')}}" class="text-decoration-underline">View all messages</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="bx bx-envelope text-info"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div>






@endsection


@section("scripts")
@endsection