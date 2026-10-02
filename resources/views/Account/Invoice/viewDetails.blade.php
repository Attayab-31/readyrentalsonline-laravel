@extends('layouts.accounts')

@section('content')



        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Invoice Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('logo/ready_rentals_light.svg') }}" alt="Ready Rentals Online" style="height: 52px; width: auto;">
                                <div>
                                    <h5 class="card-title mb-0">Invoice #{{ $invoice->i_invoice_number }}</h5>
                                    <span class="text-muted fs-12">Official Statement · Ready Rentals Online</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                @if($invoice->i_status == 'unpaid')
                                <a href="{{ url('accounts/invoices/edit/'.$invoice->invoice_id) }}" class="btn btn-soft-primary btn-sm">
                                    <i class="ri-edit-line align-bottom"></i> Edit
                                </a>
                                @endif
                                <button type="button" class="btn btn-soft-secondary btn-sm" onclick="window.print()">
                                    <i class="ri-printer-line align-bottom"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th width="20%">Invoice Number</th>
                                        <td>#{{ $invoice->i_invoice_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge 
                                                @if($invoice->i_status == 'paid') bg-success 
                                                @elseif($invoice->i_status == 'unpaid') bg-warning 
                                                @else bg-danger @endif">
                                                {{ ucfirst($invoice->i_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Issue Date</th>
                                        <td>{{ \Carbon\Carbon::parse($invoice->i_issue_date)->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Due Date</th>
                                        <td>{{ \Carbon\Carbon::parse($invoice->i_due_date)->format('M d, Y') }}</td>
                                    </tr>
                                    @if($invoice->i_payment_date)
                                    <tr>
                                        <th>Payment Date</th>
                                        <td>{{ \Carbon\Carbon::parse($invoice->i_payment_date)->format('M d, Y') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>{{ $invoice->i_client_payment_method ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>${{ number_format($invoice->i_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $invoice->i_notes }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenant Information -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tenant Information</h5>
                    </div>
                    <div class="card-body">
                        @if($invoice->tenant)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td>{{ $invoice->tenant->first_name }} {{ $invoice->tenant->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $invoice->tenant->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $invoice->tenant->phone ?? 'N/A' }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Lease Start</th>
                                        <td>{{ $invoice->tenant->lease_start ? \Carbon\Carbon::parse($invoice->tenant->lease_start)->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lease End</th>
                                        <td>{{ $invoice->tenant->lease_end ? \Carbon\Carbon::parse($invoice->tenant->lease_end)->format('M d, Y') : 'N/A' }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning mb-0">No tenant information available</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Property Information -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Property Information</h5>
                    </div>
                    <div class="card-body">
                        @if($invoice->property)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th width="30%">Address</th>
                                        <td>{{ $invoice->property->p_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>City/State/Zip</th>
                                        <td>
                                            {{ $invoice->property->p_city }}, 
                                            {{ $invoice->property->p_state }} 
                                            {{ $invoice->property->p_zip }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bed/Bath</th>
                                        <td>{{ $invoice->property->p_bedrooms }} Beds / {{ $invoice->property->p_baths }} Baths</td>
                                    </tr>
                                    <tr>
                                        <th>Square Feet</th>
                                        <td>{{ $invoice->property->p_area }} sq ft</td>
                                    </tr>
                                    <tr>
                                        <th>Rent Amount</th>
                                        <td>${{ number_format($invoice->property->p_price, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning mb-0">No property information available</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Breakdown -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Payment Breakdown</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-end">${{ number_format($invoice->i_subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="text-end">${{ number_format($invoice->i_tax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fee</td>
                                        <td class="text-end">${{ number_format($invoice->i_fee, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-end">-${{ number_format($invoice->i_discount, 2) }}</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td><strong>Total</strong></td>
                                        <td class="text-end"><strong>${{ number_format($invoice->i_total, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Notes -->
        @if($invoice->i_admin_notes)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Admin Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $invoice->i_admin_notes }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif






@endsection
