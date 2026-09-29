<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // Add these constants at the top of your Invoice model
    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_REQUIRES_VERIFICATION = 'requires_verification';
    const PAYMENT_STATUS_SUCCEEDED = 'succeeded';
    const PAYMENT_STATUS_FAILED = 'failed';

    const PAYMENT_METHOD_CARD = 'card';
    const PAYMENT_METHOD_ACH = 'ach';

    use HasFactory;

    // Table name
    protected $table = 'invoices';

    // Primary key
    protected $primaryKey = 'invoice_id';

    // Disable auto-incrementing for the primary key if needed (optional)
    public $incrementing = true;

 

    // Timestamp fields
    public $timestamps = true;

    // Mass assignable attributes
    protected $fillable = [
        'i_tenant_id',
        'i_invoice_number',
        'i_issue_date',
        'i_due_date',
        'i_status',
        'i_subtotal',
        'i_tax',
        'i_total',
        'i_amount_paid',
        'i_notes',
        'i_fee',
        'i_discount',

        // New Fields for ACH
        'i_payment_method',
        'i_payment_status',
        'i_payment_intent_id',
        'i_payment_metadata',
        'i_microdeposit_verified',
        'i_payment_date'

    ];

    // Default attribute values
    protected $attributes = [
        'i_status' => 'unpaid',
        'i_subtotal' => 0.00,
        'i_tax' => 0.00,
        'i_total' => 0.00,
        'i_amount_paid' => 0.00,
    ];


    // In your Invoice model
    protected $casts = [
        'i_payment_metadata' => 'array',
        'i_microdeposit_verified' => 'boolean'
    ];
    
   const CREATED_AT = 'i_created_at';
   const UPDATED_AT = 'i_updated_at';

    /**
     * Generate a unique invoice number
     *
     * @return string
     */
    public static function generateInvoiceNumber()
    {
        // Format: INV-{Year}{Month}{Random 5-digit Number}
        $prefix = 'INV-' . date('Y') . date('m');
        $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        // Combine prefix and random number
        $invoiceNumber = $prefix . '-' . $randomNumber;

        // Ensure uniqueness
        while (self::where('i_invoice_number', $invoiceNumber)->exists()) {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $invoiceNumber = $prefix . '-' . $randomNumber;
        }

        return $invoiceNumber;
    }

    /**
     * Set the `i_invoice_number` before creating a new record
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically generate invoice number before creating a record
        static::creating(function ($invoice) {
            if (empty($invoice->i_invoice_number)) {
                $invoice->i_invoice_number = self::generateInvoiceNumber();
            }
        });
    }

    /**
     * Relationship with the Tenant (User) model
     */
    public function tenant()
    {
        return $this->belongsTo(User::class, 'i_tenant_id', 'id');
    }
}
