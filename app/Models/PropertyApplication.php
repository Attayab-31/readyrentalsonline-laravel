<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PropertyApplication extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_applications';


    protected $casts = [
                       'pa_additional_documents' => 'array'
                       ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_application_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

   const CREATED_AT = 'pa_created_at';
   const UPDATED_AT = 'pa_updated_at';


   public static function generateTrackingId()
   {
       do {
           $trackingId = Str::lower(Str::random(18));
       } while (self::where('pa_tracking_id', $trackingId)->exists());

       return $trackingId;
   }





}
