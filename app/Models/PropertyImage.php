<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'property_images';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_image_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

   const CREATED_AT = 'pi_created_at';
   const UPDATED_AT = 'pi_updated_at';

}
