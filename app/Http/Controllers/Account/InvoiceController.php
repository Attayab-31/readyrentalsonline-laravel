<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use App\Http\Helpers\Email_functions;


class InvoiceController extends Controller
{
    /**
     * Display a list of all invoices.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Check if the logged-in user is a tenant
        $isTenant = auth()->user()->user_type === 'tenant';
    
        // Fetch tenants (only for superAdmins, tenants should not see this filter)
        $tenants = $isTenant ? [] : User::where('user_type', 'tenant')->get();
    
        // Query invoices
        $query = Invoice::with('tenant');
    
        // If the logged-in user is a tenant, restrict invoices to their own
        if ($isTenant) {
            $query->where('i_tenant_id', auth()->id());
        }
    
        // Apply search filters
        if ($request->filled('i_invoice_number')) {
            $query->where('i_invoice_number', 'like', '%' . $request->input('i_invoice_number') . '%');
        }
        if ($request->filled('i_tenant_id') && !$isTenant) {
            $query->where('i_tenant_id', $request->input('i_tenant_id'));
        }
        if ($request->filled('i_status'))
        {
            if($request->input('i_status') == "paid")
            {
                $query->where('i_status', 'paid');
            }
            elseif($request->input('i_status') == "open")
            {
                $query->where('i_status', 'unpaid');
                $query->orwhere('i_status', 'cancelled');
            }
        }
    
        // Get paginated results
        $invoices = $query->orderBy('i_issue_date', 'desc')->paginate(50);
    
        // Pass data to the view
        return view('Account.Invoice.index', compact('invoices', 'tenants', 'isTenant'));
    }
    

    /**
     * Show the form for creating a new invoice.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenants = User::where('user_type', 'tenant')->get(); // Assuming 'role' identifies tenants
        return view('Account.Invoice.create', compact('tenants'));
    }

    /**
     * Store a newly created invoice in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'i_tenant_id' => 'required|exists:users,id',
            'i_issue_date' => 'required|date',
            'i_due_date' => 'required|date|after_or_equal:i_issue_date',
            'i_subtotal' => 'required|numeric|min:0',
            'i_tax' => 'nullable|numeric|min:0',
            'i_total' => 'required|numeric|min:1',
            'i_notes' => 'nullable|string|max:1000',
            'i_fee' => 'nullable|numeric',
            'i_discount' => 'nullable|numeric',

        ]);

        $invoice = new Invoice($validated);
        $invoice->save();
 
            
        $heading = "New Invoice from readyrentalsonline Created";
        $to = $invoice->tenant->email;
        $subject = "New Invoice from Readyrentalsonline Created!";
        
        $result = Email_functions::sendNewEmail(
            $to,
            $subject,
            'email_templates.new_invoice_creation_alert', // Make sure this path matches your view
            [], // BCC array
            "notification@readyrentalsonline.com", // From email
            "ReadyRentalsOnline.com", // From name
            compact('invoice' , 'heading') // Pass data
        );
        
        if ($result['res_code'] !== 200) {
            // Log the error or handle it appropriately
            \Log::error('Email sending failed', $result);
        }
             
            
        return redirect('accounts/invoices')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display a specific invoice.
     *
     * @param  Invoice  $invoice
     * @return \Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('tenant');
        return view('Account.Invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing an existing invoice.
     *
     * @param  Invoice  $invoice
     * @return \Illuminate\View\View
     */
    public function edit($invoice_id = "")
    {   
        $invoice = Invoice::with('tenant')->where('invoice_id', $invoice_id)->first();
        if(!$invoice){
            return redirect('accounts/invoices')->with('failure', 'Invoice not found.');
        }
        $tenants = User::where('user_type', 'tenant')->get();
        return view('Account.Invoice.edit', compact('invoice', 'tenants'));
    }

    /**
     * Update an existing invoice in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $invoice_id = "")
    {
        $invoice = Invoice::with('tenant')->where('invoice_id', $invoice_id)->first();
        if(!$invoice){
            return redirect('accounts/invoices')->with('failure', 'Invoice not found.');
        }
        
        $validated = $request->validate([
            'i_tenant_id' => 'required|exists:users,id',
            'i_issue_date' => 'required|date',
            'i_due_date' => 'required|date|after_or_equal:i_issue_date',
            'i_subtotal' => 'required|numeric|min:0',
            'i_tax' => 'nullable|numeric|min:0',
            'i_total' => 'required|numeric|min:0',
            'i_notes' => 'nullable|string|max:1000',
            'i_fee' => 'nullable|numeric',
            'i_discount' => 'nullable|numeric',
            'i_status' => 'required',
        ]);

        $invoice->update($validated);

        return redirect('accounts/invoices')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Delete an existing invoice.
     *
     * @param  Invoice  $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->first();
        if(!$invoice){
            return redirect('accounts/invoices')->with('failure', 'Invoice not found.');
        }
        else
        {
            $invoice->delete();
        }

        return redirect('accounts/invoices')->with('success', 'Invoice deleted successfully.');
    }


    public function viewDetails($invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->first();
        if(!$invoice){
            return redirect('accounts/invoices')->with('failure', 'Invoice not found.');
        }
        else
        {
            return view('Account.Invoice.viewDetails', compact('invoice'));
        }
    }
    
}
