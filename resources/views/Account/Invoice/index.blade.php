@extends('layouts.accounts')

@section("styles")
<!-- Add custom styles if needed -->
@endsection

@section('content')



<div class="row">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ url('accounts/invoices') }}" class="g-3" method="GET">
                    @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Search</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row">     
                                <div class="col-md-3">
                                    <label for="i_invoice_number" class="form-label">Invoice ID</label>
                                    <input type="text" class="form-control" id="i_invoice_number" name="i_invoice_number" value="{{ app('request')->input('i_invoice_number') }}" placeholder="Type something...">
                                </div>

                                @if (!$isTenant) <!-- Tenant filter only visible to superAdmin -->
                                <div class="col-lg-3">
                                    <label for="i_tenant_id" class="form-label">Search Tenant</label>
                                    <select class="form-select" name="i_tenant_id" id="i_tenant_id">
                                        <option value="" disabled selected>Select Tenant</option>
                                        @foreach ($tenants as $tenant)
                                            <option value="{{ $tenant->id }}" {{ app('request')->input('i_tenant_id') == $tenant->id ? 'selected' : '' }}>
                                                {{ $tenant->first_name . ' ' . $tenant->last_name }} ({{ $tenant->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-danger font-weight-bold" id="error_i_tenant_id">{{ $errors->first('i_tenant_id') }}</span>
                                </div>
                                @endif

                                <div class="col-md-3 rr-admin-field">
                                    <label for="i_status" class="form-label rr-admin-field-label">Invoice Status</label>
                                    <select id="i_status" class="js-example-basic-single form-control rr-admin-select" name="i_status">
                                        <option value="">All invoice statuses</option>
                                        <option value="paid" @if(app('request')->input('i_status') == "paid") selected @endif>Paid</option>
                                        <option value="overdue" @if(app('request')->input('i_status') == "overdue") selected @endif>Overdue</option>
                                        <option value="cancelled" @if(app('request')->input('i_status') == "cancelled") selected @endif>Cancelled</option>
                                        <option value="open" @if(app('request')->input('i_status') == "open") selected @endif>Open</option>
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
                                        <i class="ri-search-line"></i> Filter Invoices
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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Invoices List</h4>
                @if(!$isTenant)
                <a href="{{ url('accounts/invoices/create') }}" class="btn btn-primary btn-sm">
                    <i class="ri-add-line"></i> Create Invoice
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>Tenant</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->i_invoice_number }}</td>
                                <td>
                                    @if($invoice->tenant)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                            <img src="{{$invoice->tenant->getProfilePicture($invoice->tenant->profile_picture)}}" alt="" class="img-fluid d-block" />
                                        </div>
                                        <div>
                                            <h5 class="fs-13 my-1"><a href="{{ route('users.show', $invoice->tenant->id) }}" class="text-reset">{{$invoice->tenant->first_name.' '.$invoice->tenant->last_name}}</a></h5>
                                            <span class="text-muted">{{$invoice->tenant->email}}</span>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <td>{{ $invoice->i_issue_date }}</td>
                                <td>{{ $invoice->i_due_date }}</td>
                                <td>${{ number_format($invoice->i_total, 2) }}</td>
                                <td>

                                    
                                    
                                    
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5 class="fs-13 my-1">
                                                 
                                            @if ($invoice->i_status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif ($invoice->i_status == 'unpaid')
                                                <span class="badge bg-danger">Unpaid</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($invoice->i_status) }}</span>
                                            @endif    
                                            </h5>
                                            <span class="text-muted">Payment Date: {{$invoice->i_payment_date}}</span>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a target="_blank" href="{{ url('invoices/pay/' . $invoice->i_invoice_number) }}" class="dropdown-item">
                                                    <i class="ri-eye-fill align-bottom me-0 text-muted"></i> Pay Now    
                                                </a>
                                            </li>

                                            @if (!$isTenant)

                                            <li>
                                                <a href="{{ url('accounts/invoices/edit/'.$invoice->invoice_id) }}" class="dropdown-item">
                                                    <i class="ri-pencil-fill align-bottom me-0 text-muted"></i> Edit
                                                </a>
                                            </li>
                                            
                                            
                                            <li>
                                                <form method="post" action="{{ url('accounts/invoices/delete/'.$invoice->invoice_id) }}" onsubmit="return confirm('Are you sure you want to delete this invoice?')">@csrf @method('DELETE')
                                                    <button type="submit" class="dropdown-item"><i class="ri-delete-bin-fill align-bottom me-0 text-muted"></i> Delete</button>
                                                </form>
                                            </li>


                                            <li>
                                                <a href="{{ url('accounts/invoices/view/'.$invoice->invoice_id) }}" class="dropdown-item">
                                                    <i class="ri-pencil-fill align-bottom me-0 text-muted"></i> View Invoice
                                                </a>
                                            </li>                                            
  
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No invoices found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
 
                <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                    @include('partials.paginations.ForControlPanel', ['paginator' => $invoices])
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
