<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'property_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

   const CREATED_AT = 'p_created_at';
   const UPDATED_AT = 'p_updated_at';



    /**
     * Boot the model.
     */

    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            $post->p_slug = $post->createSlug($post->p_title);
            $post->save();
        });
    }

     
    private function createSlug($title)
    {
        $p_slug = Str::slug($title);
        if(static::whereP_slug($p_slug = Str::slug($title))->exists()) 
        {
            $max = static::whereP_title($title)->latest('property_id')->skip(1)->value('p_slug');

            if (is_numeric($max[-1])) 
            {
                return preg_replace_callback('/(\d+)$/', function ($mathces) 
                {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$p_slug}-2";
        }

        return $p_slug;
    }



}
