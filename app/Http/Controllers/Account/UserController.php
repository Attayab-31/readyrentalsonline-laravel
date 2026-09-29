<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\EmailHelper;
  

class UserController extends Controller
{
 


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $cunstruct_query = User::query();
 
        if($request->filled('searchTerm'))
        {
            // Perform search based on other fields if search term doesn't match user types
            $cunstruct_query->where('id', 'like', '%' . $request->searchTerm . '%')
                             ->orWhere('first_name', 'like', '%' . $request->searchTerm . '%')
                             ->orWhere('last_name', 'like', '%' . $request->searchTerm . '%')
                             ->orWhere('email', 'like', '%' . $request->searchTerm . '%');
        }   
 
        if($request->filled('account_status'))
        {
            $cunstruct_query->where('account_status',  $request->account_status);      
        } 
        

        if($request->filled('user_type'))
        {
            $cunstruct_query->where('user_type',  $request->user_type);      
        } 
        
        
        // Order the Records
        $cunstruct_query->orderby('id', "desc"); 
        
        $db_data['User'] = $cunstruct_query->paginate(50);

        $page_meta_data = array(
                                'page_title'=>'Manage Users',
                                ); 
        return view('Account.User.show_listings' , compact('db_data'))->with($page_meta_data);
    } 
 

    public function create()
    {   
        $page_meta_data = array(
                                'page_title'=>'Create new User | '.env('APP_NAME'),
                                ); 

        return view('Account.User.create')->with($page_meta_data);
    }    


    public function store(Request $request)
    {

        $validatedData = $request->validate([
                                          'first_name' => 'required|max:191',
                                          'last_name' => 'required|max:191',
                                          'user_type' => 'required',
                                          'account_status' => 'required',
                                          'email' => 'required|max:191|unique:users,email',
                                          'password' => 'required|min:8',
                                          'confirm_password' => 'same:password',
                                          ]);
 
        $profile_picture = User::handleFileUpload($request->file('profile_picture'), null);

        // Generate a unique identifier for the user
        $uniqueIdentifier = User::generateUniqueIdentifier();

        $new_user = new User;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->profile_slug = User::generate_slug($request->first_name.'-'.$request->last_name);
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->user_type = $request->user_type;
        $new_user->account_status = $request->account_status;
        $new_user->profile_picture = $profile_picture;
        $new_user->unique_identifier = $uniqueIdentifier; // Store the unique identifier
        $new_user->last_activity = now()->getTimestamp();
        $new_user->save();

        if($new_user->id  > 0)
        {  
            return redirect('/accounts/users')->with('success','New user has been created.');
        }
        else
        {
            return redirect('/accounts/users')->with('warning','Somthing went wrong. Please try again.');
        }
           
    }    


    public function edit($id)
    {   
        $db_data['User'] = User::where('id' , $id)->first();
        if($db_data['User'])
        {
            $page_meta_data = array(
                                    'page_title'=>'Update User | '.env('APP_NAME'),
                                    ); 
            return view('Account.User.edit',compact('db_data'))->with($page_meta_data);
        }                        
        else
        {
            return redirect('/accounts')->with('danger','The record you are trying to access, Does not exist.');
        }

    } 
 
    public function update(Request $request, $id)
    {   

        $db_data['User'] = User::where('id' , $id)->first();


        if($db_data['User'])
        {

 
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
                                              'user_type' => 'required',
                                              'email' => [
                                                          'required','email',
                                                           Rule::unique('users')->ignore($id),
                                                          ],
                                              ],$validation_messages);



            if($request->password !="" && $request->password != NULL)
            {
                $new_password = Hash::make($request->password);
            }
            else
            {
                $new_password = $db_data['User']->password;
            }

             
            $profile_picture = User::handleFileUpload($request->file('profile_picture'), $db_data['User']->profile_picture);

   
 
            $user_details = User::find($id);
            $user_details->first_name = $request->first_name;
            $user_details->last_name = $request->last_name;
            $user_details->email = $request->email;
            $user_details->password = $new_password;
            $user_details->user_type = $request->user_type;
            $user_details->account_status = $request->account_status;
            $user_details->profile_picture = $profile_picture;
            $user_details->save();
 

            if($user_details->updated_at  > $db_data['User']->updated_at)
            { 
              return redirect('/accounts/users')->with('success','User profile details has been updated.');
            }
            else
            {
              return redirect('/accounts/users')->with('warning','No changes were made to User profile details');
            }

        }                        
        else
        {
            return redirect('/accounts/users')->with('failure','The record you are trying to access, Does not exist.');
        }

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        $db_data['User'] = User::where('id' , $id)->first();
        if($db_data['User'])
        {
            $db_data['User']->delete();
            return redirect('/accounts/users')->with('success','Record has been deleted!');
        }                        
        else
        {
            return redirect('/accounts/users')->with('failure','Action failed. No data found! ');
        }
    }    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update_status($id , $status)
    {
        $db_data['User'] = User::where('id' , $id)->first();
        if($db_data['User'] && ($status == "active" || $status == "suspended" ))
        {
            $db_data['User']->account_status =  $status;
            $db_data['User']->save();

            return redirect('/accounts/users')->with('success','User has been marked as '.$status);
        }                        
        else
        {
            return redirect('/accounts/users')->with('failure','Action failed. No data found! ');
        }
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function delete_users_in_bulk(Request $request)
    {
        if(!empty($request->userToDelete))
        {
            User::whereIn('id', $request->userToDelete)->where('id' , '!=' , Auth::user()->id)->delete();
            $responce  = array(
                            "status" => "success",
                            );
        }
        else{
            $responce  = array(
                "status" => "error",
                );
        }

        return $responce; 
    }

    
    
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function resend_verification_email_to_all_unverified_users(Request $request, $user_id = null)
    {
 
        if($user_id != null)
        {
            $db_data['Unverified_Users'] = User::where('id' , $user_id)
                                                ->where('email_verified_at' , null)
                                                ->get();
        }
        else
        {
            $db_data['Unverified_Users'] = User::where('email_verified_at' , null)
                                                ->get();
        }
 
 
    
        
 
 
        $alerts_count = 0;
        
        foreach($db_data['Unverified_Users'] as $User)
        {
            $alerts_count++;
            
            $email_verification_token = Str::random(25);
            $db_data['verificationLink'] = url('verify-email/'.$email_verification_token);
 
            $User->email_verification_token = $email_verification_token;
            $User->save();
            
 
            $db_data['User'] = $User;
            $email = $User->email;
    
            $email_content_body = view('emails.emailVerificationLink' , compact('db_data'))->render();
            $db_data['nl_subject'] = "Please verify your email address!";
    
            $res = EmailHelper::sendEmail($recipient = $email,
                                            $subject = $db_data['nl_subject'],
                                            $content = $email_content_body,
                                            $bcc = [],
                                            $cc = [],
                                            $attachmentPath=""
                                        );
        }
 
 
         return redirect('/accounts/users')->with('success',$alerts_count.' Alerts has been sent!');
 
    }
    
    
    
    
    
    
    
    
    
    
}
