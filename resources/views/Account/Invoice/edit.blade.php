@extends('layouts.accounts')

@section("styles")
<!-- Add custom styles if needed -->
@endsection

@section('content')

<div class="row">
    <div class="col-xxl-12">
        <form class="form" action="{{ url('accounts/invoices/update/'.$invoice->invoice_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') <!-- Indicating the update method -->

            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Invoice</h4>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4 mb-3">
                            <label for="i_invoice_number" class="form-label">Invoice ID</label>
                            <input type="text" class="form-control" id="i_invoice_number" name="i_invoice_number" value="{{ old('i_invoice_number', $invoice->i_invoice_number) }}" disabled />
                            <span class="form-text text-danger font-weight-bold" id="error_i_invoice_number">{{ $errors->first('i_invoice_number') }}</span>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="i_tenant_id" class="form-label">Tenant</label>
                            @if(auth()->user()->user_type !== 'tenant')
                                <select class="form-select" name="i_tenant_id" id="i_tenant_id">
                                    <option value="" disabled>Select Tenant</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" {{ old('i_tenant_id', $invoice->i_tenant_id) == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->first_name.' '.$tenant->last_name }} ({{ $tenant->email }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="form-control" value="{{ $invoice->tenant->first_name.' '.$invoice->tenant->last_name }}" disabled />
                                <input type="hidden" name="i_tenant_id" value="{{ $invoice->i_tenant_id }}" />
                            @endif
                            <span class="form-text text-danger font-weight-bold" id="error_i_tenant_id">{{ $errors->first('i_tenant_id') }}</span>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="i_issue_date" class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="i_issue_date" name="i_issue_date" value="{{ old('i_issue_date', \Carbon\Carbon::parse($invoice->i_issue_date)->format('Y-m-d')) }}" />
                            <span class="form-text text-danger font-weight-bold" id="error_i_issue_date">{{ $errors->first('i_issue_date') }}</span>
                        </div>
                        
                        <div class="col-lg-4 mb-3">
                            <label for="i_due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="i_due_date" name="i_due_date" value="{{ old('i_due_date', \Carbon\Carbon::parse($invoice->i_due_date)->format('Y-m-d')) }}" />
                            <span class="form-text text-danger font-weight-bold" id="error_i_due_date">{{ $errors->first('i_due_date') }}</span>
                        </div>

                        <!-- Subtotal -->
                        <div class="col-lg-4 mb-3">
                            <label for="i_subtotal" class="form-label">Subtotal</label>
                            <input type="number" step="0.01" class="form-control" id="i_subtotal" name="i_subtotal" value="{{ old('i_subtotal', $invoice->i_subtotal) }}" oninput="calculateTotal()">
                            <span class="form-text text-danger font-weight-bold" id="error_i_subtotal">{{ $errors->first('i_subtotal') }}</span>
                        </div>

                        <!-- Fee -->
                        <div class="col-lg-4 mb-3">
                            <label for="i_fee" class="form-label">Fee</label>
                            <input type="number" step="0.01" class="form-control" id="i_fee" name="i_fee" value="{{ old('i_fee', $invoice->i_fee) }}" oninput="calculateTotal()">
                            <span class="form-text text-danger font-weight-bold" id="error_i_fee">{{ $errors->first('i_fee') }}</span>
                        </div>

                        <!-- Tax -->
                        <div class="col-lg-4 mb-3">
                            <label for="i_tax" class="form-label">Tax</label>
                            <input type="number" step="0.01" class="form-control" id="i_tax" name="i_tax" value="{{ old('i_tax', $invoice->i_tax) }}" oninput="calculateTotal()">
                            <span class="form-text text-danger font-weight-bold" id="error_i_tax">{{ $errors->first('i_tax') }}</span>
                        </div>
                        
                        <!-- Discount -->
                        <div class="col-lg-4 mb-3">
                            <label for="i_discount" class="form-label">Discount</label>
                            <input type="number" step="0.01" class="form-control" id="i_discount" name="i_discount" value="{{ old('i_discount', $invoice->i_discount) }}" oninput="calculateTotal()">
                            <span class="form-text text-danger font-weight-bold" id="error_i_discount">{{ $errors->first('i_discount') }}</span>
                        </div>
                        
                        <!-- Total -->
                        <div class="col-lg-4 mb-3">
                            <label for="i_total" class="form-label">Total</label>
                            <input type="number" step="0.01" class="form-control" id="i_total" name="i_total" value="{{ old('i_total', $invoice->i_total) }}" readonly>
                            <span class="form-text text-danger font-weight-bold" id="error_i_total">{{ $errors->first('i_total') }}</span>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="i_status" class="form-label">Invoice Status</label>
                            <select class="form-select" name="i_status" id="i_status">
                                <option value="paid" {{ old('i_status', $invoice->i_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ old('i_status', $invoice->i_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="overdue" {{ old('i_status', $invoice->i_status) == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="cancelled" {{ old('i_status', $invoice->i_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <span class="form-text text-danger font-weight-bold" id="error_i_status">{{ $errors->first('i_status') }}</span>
                        </div>  
                        
                        <!-- Notes -->
                        <div class="col-lg-12 mb-3">
                            <label for="i_notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="i_notes" name="i_notes" rows="3">{{ old('i_notes' , $invoice->i_notes) }}</textarea>
                            <span class="form-text text-danger font-weight-bold" id="error_i_notes">{{ $errors->first('i_notes') }}</span>
                        </div>

                    </div> <!-- end row -->
                </div> <!-- end card body -->

                <div class="card-footer">
                    <div class="col-lg-12">
                        <div class="text-end">
                            <a href="{{ url('account/invoices') }}" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Invoice</button>
                        </div>
                    </div><!--end col-->
                </div>
            </div><!-- end card -->
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function calculateTotal() {
        // Get all input values, default to 0 if empty or not a number
        const subtotal = parseFloat(document.getElementById('i_subtotal').value) || 0;
        const fee = parseFloat(document.getElementById('i_fee').value) || 0;
        const tax = parseFloat(document.getElementById('i_tax').value) || 0;
        const discount = parseFloat(document.getElementById('i_discount').value) || 0;

        // Calculate total
        const total = subtotal + fee + tax - discount;
        
        // Update total field, rounding to 2 decimal places
        document.getElementById('i_total').value = total.toFixed(2);
    }

    // Calculate total on page load in case there are old values
    document.addEventListener('DOMContentLoaded', function() {
        calculateTotal();
    });
</script>
@endsection