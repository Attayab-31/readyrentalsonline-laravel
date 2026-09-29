<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Auth;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($value='')
    {
        $page_meta_data = array(
                                'page_title'=>'Update your Profile',
                                ); 
        return view('Account.Profile.edit')->with($page_meta_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
       $user_id = Auth()->user()->id;
       $user_details = User::find($user_id);
       if(empty($user_details))
       {
           return redirect('/accounts')->with('warning','No changes made');
       }
       else
       {
           $old_password = $user_details->password;
           $last_updated_at = $user_details->updated_at;
       }
     
       $validation_messages = [

                             'first_name.required' => 'First name field can not be empty',
                             'last_name.required' => 'Last name field can not be empty',
                             'email.required' => 'Email address field can not be empty'
                             ];

        $validatedData = $request->validate([
                                           'first_name' => 'required',
                                           'last_name' => 'required',
                                           'profile_picture' => 'sometimes|nullable|image',
                                           'password' => 'sometimes|nullable|min:8',
                                           'confirm_password' => 'same:password',
                                           ],$validation_messages);




        /*Upload the Image file*/
        if($request->hasFile('profile_picture'))
        {
            $image = $request->file('profile_picture');
            $size = getimagesize($image);

            list($width, $height, $type, $attr) = $size;
            $file_mime = $size['mime'];
            $ml_width = $size['0'];
            $ml_height = $size['1'];

            $extension = $image->getClientOriginalExtension();
            $profile_picture = Str::slug($request->p_title.'-'.config('app.name'),'-').'-'.rand(0,99999).'.'.$extension;
            $destinationPath = 'resources/files/dynamic';
            $image->move($destinationPath,$profile_picture);
        
        }
        else
        {
            $profile_picture = $user_details->profile_picture;
        }
 

        $user_details = User::find(Auth::user()->id);
        $user_details->first_name = $request->first_name;
        $user_details->last_name = $request->last_name;
        if($request->password !="" && $request->password != NULL)
        {
            $user_details->password = Hash::make($request->password);
        }
        $user_details->profile_picture = $profile_picture;
        $update_res =  $user_details->save();

        if($user_details->updated_at  > $last_updated_at)
        { 
          return redirect('/accounts/edit-profile')->with('success','Profile updated');
        }
        else
        {
          return redirect('/accounts/edit-profile')->with('warning','No changes were made to your profile details');
        } 
    }




}