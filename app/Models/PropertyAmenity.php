<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAmenity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_amenities';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_amenity_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

   const CREATED_AT = 'pa_created_at';
   const UPDATED_AT = 'pa_updated_at';

}
