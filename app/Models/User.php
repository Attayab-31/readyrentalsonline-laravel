<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (User $user): void {
            if (blank($user->unique_identifier)) {
                $user->unique_identifier = static::generateUniqueIdentifier();
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_type',
        'account_status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 

    public static function getProfilePicture($profile_picture)
    {
        if($profile_picture != "" && $profile_picture != null)
        {
            return asset('resources/files/dynamic/'.$profile_picture);   
        } 
        else
        {
            return asset("controlPanel/images/users/user-dummy-img.jpg");
        }
    }
     

    public static function generate_slug($name , $ignore_id = "")
    {
    
        $profile_slug = Str::slug($name, '-');
 
 
        if($ignore_id != null && $ignore_id != "" ) 
        {
            $check_slug = User::where('profile_slug' , $profile_slug)->where('id' , '!=' , $ignore_id)->first();  
        }
        else
        {
            $check_slug = User::where('profile_slug' , $profile_slug)->first();  
        }
 
        if($check_slug === null)
        {   
            /*The slug does not exist*/
            return $profile_slug;
        }
        else
        {
 
            $i = 1;
            $already_exists = true;
 
            do {
               
                $newSlug = $profile_slug.'-'.$i;
                $check_slug = User::where('profile_slug' , $newSlug)->first();
 
                if($check_slug === null)
                { 
                    $already_exists =false;
                    return $newSlug;
                }
                $i++;
 
            } while ($already_exists);
        }
    
    }
 

    public static function handleFileUpload($file, $return = null)
    {
        if ($file) {
           $originalFileName = $file->getClientOriginalName();
           $extension = $file->getClientOriginalExtension();
           $sanitizedFileName = preg_replace('/[^A-Za-z0-9\-\_\.]/', '-', pathinfo($originalFileName, PATHINFO_FILENAME));
           $uniqueKey = time();
           $uniqueFileName = $sanitizedFileName . '-' . $uniqueKey . '.' . $extension;
           $destinationPath = public_path('resources/files/dynamic');
           $file->move($destinationPath, $uniqueFileName);
            return $uniqueFileName; // Return the unique file name
        }
        return $return; // Return null if no file is uploaded
    }
 

    public static function generateUniqueIdentifier()
    {
        do {
            // Generate a random 8-character string
            $uniqueIdentifier = Str::random(8);
    
            // Insert hyphen after the first 4 characters
            $uniqueIdentifier = substr($uniqueIdentifier, 0, 4) . '-' . substr($uniqueIdentifier, 4);
    
        } while (User::where('unique_identifier', $uniqueIdentifier)->exists());
    
        return $uniqueIdentifier;
    }
   

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->user_type === 'superAdmin';
    }

    public function isTenant()
    {
        return $this->user_type === 'tenant';
    }


    

}
