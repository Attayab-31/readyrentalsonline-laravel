<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Email_functions;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;
use App\Models\PropertyApplication;
 use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Validation\ValidationException;
 
class PropertyController extends Controller
{

    public function index(Request $request)
    {   
             
        $construct_query = Property::where('p_active_status','active');
        
        $search = $request->search;

        if(isset($search) &&  !empty($search) && $search != "" && $search != NULL )
        {
            $construct_query->where(function ($query) use ($search) {
                $query->where('p_title', 'like', '%'.$search.'%')
                    ->orWhere('p_address', 'like', '%'.$search.'%');
            });
        }


        $construct_query->orderBy('p_title','ASC');
        $db_data['Property'] = $construct_query->paginate(12)->withQueryString();
 
        $page_meta_data = array(
                                'page_title'=>'Explore Our Properties '.config('app.name'),
                                ); 

        return view('properties.property_listings' ,compact('db_data'))->with($page_meta_data);
    }


    public function property_details($p_slug)
    {   
        $db_data['Property'] = Property::where('p_active_status' , 'active')
                                         ->where('p_slug' , $p_slug)
                                         ->first();
        
        if($db_data['Property'])
        {   

            $db_data['AppSetting'] = AppSetting::find(1);
            $db_data['PropertyImage'] = PropertyImage::where('pi_property_id' , $db_data['Property']->property_id)->get();
            $db_data['PropertyAmenity'] = PropertyAmenity::where('pa_property_id' , $db_data['Property']->property_id)->get();
            

            $db_data['Related_Property'] = Property::where('p_active_status' , 'active')
                                                     ->where('p_title', 'like' , "%".$db_data['Property']->p_title.'%')
                                                     ->where('property_id' , '!=' , $db_data['Property']->property_id)
                                                     ->limit(2)
                                                     ->get();


            $page_meta_data = array(
                                    'page_title'=>$db_data['Property']->p_title.' | Explore Our Properties '.config('app.name'),
                                    ); 

            return view('properties.view_details' ,compact('db_data'))->with($page_meta_data);

        }
        else
        {
            abort(404);
        }
    }    
 


    public function process_inquiry_form(Request $request)
    {   

        $messages = [
                    ];

        $attributes = [
                       'full_name' => 'Full name',
                       'email' => 'email address',
                       'phone_number' => 'Phone number',
                       'inquiry_type' => 'Inquiry type',
                       'yourmessage' => 'Message',
                      ];
        $Rules= [
                'full_name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'sometimes|nullable',
                'inquiry_type' => 'required',
                'yourmessage' => 'required',
                ];

        $validatedData = $request->validate($Rules , $messages , $attributes);


        $email_content="
                        <h2>Property Title: <small>$request->property_title</small></h2>
                        <h2>Full name: <small>$request->full_name</small></h2>
                        <h2>Email: <small>$request->email</small></h2>
                        <h2>Inquiry Type: <small>$request->inquiry_type</small></h2>
                        <h2>Phone Number: <small>$request->phone_number</small></h2>
                        <h2>Message: <small>$request->yourmessage</small></h2>
                       ";

        $email_details = array(
                               'email_type' => "contact_us_form", 
                               'email_subject' => config('app.name')."| New Message Recieved",
                               'body' => $email_content, 
                               'view_to_use' => "email_templates.general_email_template",
                              );               

        $email_res = Email_functions::send_email($email_details);


        if($email_res['res_code'] == 200)
        {
            $res = array(
                        'res_code' => 200,
                        'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Inquiry Recieved!</b><br>
                                                Thank You! We have recieved your message and we will try to get back to you as soon as possible.</div>
                                           '
                        );
        }
        elseif($email_res['res_code'] == 100)
        {
            $res = array(
                        'res_code' => 100,
                        'res_msg_markup' =>'<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Email not sent!</b><br>
                                                Something went wrong. Please try again leter!</div>
                                            '                     
                        );
        }        
        else
        {
            $res = array(
                        'res_code' => 300,
                        'res_msg_markup' =>'<div class="alert alert-primary" role="alert"><b><i class="fas fa-times"></i> Somting went wrong!</b><br>
                                                Something went wrong. Please try again leter!</div>'                     
                        );
        }

        return $res;
    }  





    public function applications($value='')
    {

        $page_meta_data = array(
                                'page_title'=>"Submit Your Application Now | ".config('app.name'),
                               ); 


        return view('properties.applications')->with($page_meta_data);
     
    }


    public function apply_online($value='')
    {

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')
                                         ->get();    

        $page_meta_data = array(
                                'page_title'=>"Apply Online | ".config('app.name'),
                               ); 

        return view('properties.online_application_form' , compact('db_data'))->with($page_meta_data);

    }




    public function apply_online_process_form(Request $request)
    {   
  
        $e_sing_dummy_val = "data:image/png;base64,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";


        $messages = [
                    'required' => "Field Required",
                    'required_if' =>"Field Required", 
                    'e_sign.email' => "Please add your Electronic Signature"
                    ];
 
        $Rules = [
               'pa_property_id' => ['required', 'integer', \Illuminate\Validation\Rule::exists('properties', 'property_id')->where(fn ($query) => $query->where('p_active_status', 'active')->where('p_listing_status', 'for-rent'))],
               'pa_applicant_name' => 'required',
               'pa_applicant_social_sec_num' => 'required|digits:9',
               'pa_applicant_driv_lic_num' => 'required',
               'pa_applicant_dob' => 'required',
               'pa_applicant_email' => 'required',
               'pa_applicant_own_or_rent_monthly_payment' => 'required|numeric|max:9999.99',
               'pa_applicant_phone_num' => 'required|digits:10',
               'pa_applicant_current_add' => 'required',
               'pa_applicant_current_city' => 'required',
               'pa_applicant_current_state' => 'required',
               'pa_applicant_current_zip' => 'required|digits:5',
               'pa_applicant_previous_add' => 'required',
               'pa_applicant_previous_city' => 'required',
               'pa_applicant_previous_state' => 'required',
               'pa_applicant_previous_zip' => 'required|digits:5',
               'pa_applicant_landlord_name' => 'required',
               'pa_applicant_landlord_phone' => 'required|digits:10',
               'pa_applicant_reason_for_leaving' => 'required',


               'pa_applicant_have_pets' => 'required',
               'pa_applicant_pet_type' => 'required_if:pa_applicant_have_pets,Yes',

               'pa_applicant_bankruptcy' => 'required',
               'pa_applicant_bankruptcy_year' => 'required_if:pa_applicant_bankruptcy,Yes',

               'pa_applicant_lawsuites' => 'required',
               'pa_applicant_lawsuites_year' => 'required_if:pa_applicant_lawsuites,Yes',
               
               'pa_applicant_ever_evicted' => 'required',
               'pa_applicant_eviction_year' => 'required_if:pa_applicant_ever_evicted,Yes',

               'pa_applicant_felony_conviction' => 'required',
               'pa_applicant_felony_conviction_year' => 'required_if:pa_applicant_felony_conviction,Yes',

               'pa_applicant_judgments_or_fillings' => 'required',
               'pa_applicant_judgments_or_fillings_year' => 'required_if:pa_applicant_judgments_or_fillings,Yes',

               'pa_employer_name' => 'required',
               'pa_employment_length' => 'required',
               'pa_employer_phone' => 'required|digits:10',
               'pa_employment_position' => 'required',
               'pa_employer_address' => 'required',
               'pa_employer_city' => 'required',
               'pa_employer_state' => 'required',
               'pa_employer_zip' => 'required|digits:5',
               'pa_monthly_income' => 'required|numeric|max:99999.99',
               'pa_supervisor_name' => 'required',
               'pa_supervisor_phone' => 'required|digits:10',
               'pa_supervisor_fax' => 'required',
               'pa_supervisor_email' => 'required',
               'pa_other_monthly_income' => 'required|numeric',
               'pa_other_monthly_income_reason' => 'required',



               'pa_emergency_contact_name' => 'required',
               'pa_emergency_contact_phone' => 'required|digits:10',
               'pa_emergency_contact_address' => 'required',
               'pa_emergency_contact_city' => 'required',
               'pa_emergency_contact_state' => 'required',
               'pa_emergency_contact_zip' => 'required|digits:5',


               'pa_application_terms_agreement' => 'required|accepted',
            ];
 



            if($request->e_sign == $e_sing_dummy_val)
            {

                $Rules['e_sign'] = "required|email";
            }
            else
            {
                $Rules['e_sign'] = "required";
            }
 

            if($request->pa_is_there_a_coapplicant == "Yes")
            {
                
                $Rules['pa_co_applicant_name'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_social_sec_num'] = 'sometimes|nullable|digits:9';
                $Rules['pa_co_applicant_driv_lic_num'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_dob'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_email'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_own_or_rent_monthly_payment'] = 'sometimes|nullable|numeric|max:9999.99';
                $Rules['pa_co_applicant_phone_num'] = 'sometimes|nullable|digits:10';
                $Rules['pa_co_applicant_current_add'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_current_city'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_current_state'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_current_zip'] = 'sometimes|nullable|digits:5';
                $Rules['pa_co_applicant_previous_add'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_previous_city'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_previous_state'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_previous_zip'] = 'sometimes|nullable|digits:5';
                $Rules['pa_co_applicant_landlord_name'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_landlord_phone'] = 'sometimes|nullable|digits:10';
                $Rules['pa_co_applicant_reason_for_leaving'] = 'sometimes|nullable';
            
                $Rules['pa_co_applicant_have_pets'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_pet_type'] = 'required_if:pa_co_applicant_have_pets,Yes';
            
                $Rules['pa_co_applicant_bankruptcy'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_bankruptcy_year'] = 'required_if:pa_co_applicant_bankruptcy,Yes';
            
                $Rules['pa_co_applicant_lawsuites'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_lawsuites_year'] = 'required_if:pa_co_applicant_lawsuites,Yes';
            
                $Rules['pa_co_applicant_ever_evicted'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_eviction_year'] = 'required_if:pa_co_applicant_ever_evicted,Yes';
            
                $Rules['pa_co_applicant_felony_conviction'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_felony_conviction_year'] = 'required_if:pa_co_applicant_felony_conviction,Yes';
            
                $Rules['pa_co_applicant_judgments_or_fillings'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_judgments_or_fillings_year'] = 'required_if:pa_co_applicant_judgments_or_fillings,Yes';
            
                $Rules['pa_co_applicant_employer_name'] = 'sometimes|nullable';

                            
                $Rules['pa_co_applicant_employment_length'] = 'sometimes|nullable';
                            
                           
                $Rules['pa_co_applicant_employer_phone'] = 'sometimes|nullable|digits:10';
                $Rules['pa_co_applicant_employment_position'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_employer_address'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_employer_city'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_employer_state'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_employer_zip'] = 'sometimes|nullable|digits:5';
                $Rules['pa_co_applicant_monthly_income'] = 'sometimes|nullable|numeric|max:99999.99';
                $Rules['pa_co_applicant_supervisor_name'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_supervisor_phone'] = 'sometimes|nullable|digits:10';
                $Rules['pa_co_applicant_supervisor_fax'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_supervisor_email'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_other_monthly_income'] = 'sometimes|nullable|numeric|max:99999.99';
                $Rules['pa_co_applicant_other_monthly_income_reason'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_emergency_contact_name'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_emergency_contact_phone'] = 'sometimes|nullable|digits:10';
                $Rules['pa_co_applicant_emergency_contact_address'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_emergency_contact_city'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_emergency_contact_state'] = 'sometimes|nullable';
                $Rules['pa_co_applicant_emergency_contact_zip'] = 'sometimes|nullable|digits:5';
            
                                if ($request->e_sign2 == $e_sing_dummy_val) {
                $Rules['e_sign2'] = "required|email";
                } else {
                $Rules['e_sign2'] = "required";
                }
                
                
            }
                

                                           
                           
                           
                           
                        //   'pa_co_applicant_employment_length' => 'sometimes|nullable',
                           
            
                        //   'pa_co_applicant_employer_phone' => 'sometimes|nullable|digits:10',
                        //   'pa_co_applicant_employment_position' => 'sometimes|nullable',
                        //   'pa_co_applicant_employer_address' => 'sometimes|nullable',
                        //   'pa_co_applicant_employer_city' => 'sometimes|nullable',
                        //   'pa_co_applicant_employer_state' => 'sometimes|nullable',
                        //   'pa_co_applicant_employer_zip' => 'sometimes|nullable|digits:5',
                        //   'pa_co_applicant_monthly_income' => 'sometimes|nullable|numeric',
                        //   'pa_co_applicant_supervisor_name' => 'sometimes|nullable',
                        //   'pa_co_applicant_supervisor_phone' => 'sometimes|nullable|digits:10',
                        //   'pa_co_applicant_supervisor_fax' => 'sometimes|nullable',
                        //   'pa_co_applicant_supervisor_email' => 'sometimes|nullable',
                        //   'pa_co_applicant_other_monthly_income' => 'sometimes|nullable|numeric|max:99999.99',
                        //   'pa_co_applicant_other_monthly_income_reason' => 'sometimes|nullable',
                        //   'pa_co_applicant_emergency_contact_name' => 'sometimes|nullable',
                        //   'pa_co_applicant_emergency_contact_phone' => 'sometimes|nullable|digits:10',
                        //   'pa_co_applicant_emergency_contact_address' => 'sometimes|nullable',
                        //   'pa_co_applicant_emergency_contact_city' => 'sometimes|nullable',
                        //   'pa_co_applicant_emergency_contact_state' => 'sometimes|nullable',
                        //   'pa_co_applicant_emergency_contact_zip' => 'sometimes|nullable|digits:5',
                
                    
                
   
                
            






            $validatedData = $request->validate($Rules);



            
            $folderPath = public_path("resources/files/e-signs/"); //path location

            $img = $request->e_sign;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $e_Sign_file_name = Str::slug('online-Application-'.time().'-'.rand(0,99999)).'.'.$image_type;
            $file = $folderPath . $e_Sign_file_name;
            file_put_contents($file, $image_base64);

 
 
             $folderPath2 = public_path("resources/files/e-signs/"); // Path location for the second canvas
            
            $img2 = $request->e_sign2;
            $image_parts2 = explode(";base64,", $img2);
            $image_type_aux2 = explode("image/", $image_parts2[0]);
            $image_type2 = $image_type_aux2[1];
            $image_base64_2 = base64_decode($image_parts2[1]);
            $e_Sign_file_name2 = Str::slug('online-Application-'.time().'-'.rand(0,99999)).'.'.$image_type2;
            $file2 = $folderPath2 . $e_Sign_file_name2;
            file_put_contents($file2, $image_base64_2);

 
 
 

        $pa_additional_documents = array();


        /*Upload Additional Documents*/
        if($request->hasFile('additional_doc_1'))
        {
            $image = $request->file('additional_doc_1');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_1 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_1);
        
            array_push($pa_additional_documents, $additional_doc_1); 
        }



        if($request->hasFile('additional_doc_2'))
        {
            $image = $request->file('additional_doc_2');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_2 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_2);
        
            array_push($pa_additional_documents, $additional_doc_2); 
        }





        if($request->hasFile('additional_doc_3'))
        {
            $image = $request->file('additional_doc_3');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_3 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_3);
        
            array_push($pa_additional_documents, $additional_doc_3); 
        }




        if($request->hasFile('additional_doc_4'))
        {
            $image = $request->file('additional_doc_4');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_4 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_4);
        
            array_push($pa_additional_documents, $additional_doc_4); 
        }



        if($request->hasFile('additional_doc_5'))
        {
            $image = $request->file('additional_doc_5');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_5 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_5);
        
            array_push($pa_additional_documents, $additional_doc_5); 
        }



        if($request->hasFile('additional_doc_6'))
        {
            $image = $request->file('additional_doc_6');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_6 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_6);
        
            array_push($pa_additional_documents, $additional_doc_6); 
        }


        if($request->hasFile('additional_doc_7'))
        {
            $image = $request->file('additional_doc_7');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_7 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_7);
        
            array_push($pa_additional_documents, $additional_doc_7); 
        }



        if($request->hasFile('additional_doc_8'))
        {
            $image = $request->file('additional_doc_8');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_8 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_8);
        
            array_push($pa_additional_documents, $additional_doc_8); 
        }

 



           $new_application = new PropertyApplication;
           $new_application->pa_property_id =$request->pa_property_id;
           $new_application->pa_applicant_name =$request->pa_applicant_name;
           $new_application->pa_applicant_social_sec_num =$request->pa_applicant_social_sec_num;
           $new_application->pa_applicant_driv_lic_num =$request->pa_applicant_driv_lic_num;
           $new_application->pa_applicant_dob =$request->pa_applicant_dob;
           $new_application->pa_applicant_email =$request->pa_applicant_email;
           $new_application->pa_applicant_own_or_rent_monthly_payment =$request->pa_applicant_own_or_rent_monthly_payment;
           $new_application->pa_applicant_phone_num =$request->pa_applicant_phone_num;
           $new_application->pa_applicant_current_add =$request->pa_applicant_current_add;
           $new_application->pa_applicant_current_city =$request->pa_applicant_current_city;
           $new_application->pa_applicant_current_state =$request->pa_applicant_current_state;
           $new_application->pa_applicant_current_zip =$request->pa_applicant_current_zip;
           $new_application->pa_applicant_previous_add =$request->pa_applicant_previous_add;
           $new_application->pa_applicant_previous_city =$request->pa_applicant_previous_city;
           $new_application->pa_applicant_previous_state =$request->pa_applicant_previous_state;
           $new_application->pa_applicant_previous_zip =$request->pa_applicant_previous_zip;
           $new_application->pa_applicant_landlord_name =$request->pa_applicant_landlord_name;
           $new_application->pa_applicant_landlord_phone =$request->pa_applicant_landlord_phone;
           $new_application->pa_applicant_reason_for_leaving =$request->pa_applicant_reason_for_leaving;

           
           $new_application->pa_applicant_have_pets =$request->pa_applicant_have_pets;
           $new_application->pa_applicant_pet_type =$request->pa_applicant_pet_type;
           $new_application->pa_applicant_bankruptcy =$request->pa_applicant_bankruptcy;
           $new_application->pa_applicant_bankruptcy_year =$request->pa_applicant_bankruptcy_year;
           $new_application->pa_applicant_lawsuites =$request->pa_applicant_lawsuites;
           $new_application->pa_applicant_lawsuites_year =$request->pa_applicant_lawsuites_year;
           $new_application->pa_applicant_ever_evicted =$request->pa_applicant_ever_evicted;
           $new_application->pa_applicant_eviction_year =$request->pa_applicant_eviction_year;
           $new_application->pa_applicant_felony_conviction =$request->pa_applicant_felony_conviction;
           $new_application->pa_applicant_felony_conviction_year =$request->pa_applicant_felony_conviction_year;
           $new_application->pa_applicant_judgments_or_fillings =$request->pa_applicant_judgments_or_fillings;
           $new_application->pa_applicant_judgments_or_fillings_year =$request->pa_applicant_judgments_or_fillings_year;



           $new_application->pa_employer_name =$request->pa_employer_name;
           $new_application->pa_employment_length =$request->pa_employment_length;
           $new_application->pa_employer_phone =$request->pa_employer_phone;
           $new_application->pa_employment_position =$request->pa_employment_position;
           $new_application->pa_employer_address =$request->pa_employer_address;
           $new_application->pa_employer_city =$request->pa_employer_city;
           $new_application->pa_employer_state =$request->pa_employer_state;
           $new_application->pa_employer_zip =$request->pa_employer_zip;
           $new_application->pa_monthly_income =$request->pa_monthly_income;
           $new_application->pa_supervisor_name =$request->pa_supervisor_name;
           $new_application->pa_supervisor_phone =$request->pa_supervisor_phone;
           $new_application->pa_supervisor_fax =$request->pa_supervisor_fax;
           $new_application->pa_supervisor_email =$request->pa_supervisor_email;
           $new_application->pa_other_monthly_income =$request->pa_other_monthly_income;
           $new_application->pa_other_monthly_income_reason =$request->pa_other_monthly_income_reason;
           $new_application->pa_emergency_contact_name =$request->pa_emergency_contact_name;
           $new_application->pa_emergency_contact_phone =$request->pa_emergency_contact_phone;
           $new_application->pa_emergency_contact_address =$request->pa_emergency_contact_address;
           $new_application->pa_emergency_contact_city =$request->pa_emergency_contact_city;
           $new_application->pa_emergency_contact_state =$request->pa_emergency_contact_state;
           $new_application->pa_emergency_contact_zip =$request->pa_emergency_contact_zip;
    
           $new_application->pa_is_there_a_coapplicant = $request->pa_is_there_a_coapplicant;
           
           if($request->pa_is_there_a_coapplicant == "Yes")
           {
               $new_application->pa_co_applicant_name =$request->pa_co_applicant_name;
               $new_application->pa_co_applicant_social_sec_num =$request->pa_co_applicant_social_sec_num;
               $new_application->pa_co_applicant_driv_lic_num =$request->pa_co_applicant_driv_lic_num;
               $new_application->pa_co_applicant_dob =$request->pa_co_applicant_dob;
               $new_application->pa_co_applicant_email =$request->pa_co_applicant_email;
               $new_application->pa_co_applicant_own_or_rent_monthly_payment =$request->pa_co_applicant_own_or_rent_monthly_payment;
               $new_application->pa_co_applicant_phone_num =$request->pa_co_applicant_phone_num;
               $new_application->pa_co_applicant_current_add =$request->pa_co_applicant_current_add;
               $new_application->pa_co_applicant_current_city =$request->pa_co_applicant_current_city;
               $new_application->pa_co_applicant_current_state =$request->pa_co_applicant_current_state;
               $new_application->pa_co_applicant_current_zip =$request->pa_co_applicant_current_zip;
               $new_application->pa_co_applicant_previous_add =$request->pa_co_applicant_previous_add;
               $new_application->pa_co_applicant_previous_city =$request->pa_co_applicant_previous_city;
               $new_application->pa_co_applicant_previous_state =$request->pa_co_applicant_previous_state;
               $new_application->pa_co_applicant_previous_zip =$request->pa_co_applicant_previous_zip;
               $new_application->pa_co_applicant_landlord_name =$request->pa_co_applicant_landlord_name;
               $new_application->pa_co_applicant_landlord_phone =$request->pa_co_applicant_landlord_phone;
               $new_application->pa_co_applicant_reason_for_leaving =$request->pa_co_applicant_reason_for_leaving;
               $new_application->pa_co_applicant_have_pets =$request->pa_co_applicant_have_pets;
               $new_application->pa_co_applicant_pet_type =$request->pa_co_applicant_pet_type;
               $new_application->pa_co_applicant_bankruptcy =$request->pa_co_applicant_bankruptcy;
               $new_application->pa_co_applicant_bankruptcy_year =$request->pa_co_applicant_bankruptcy_year;
               $new_application->pa_co_applicant_lawsuites =$request->pa_co_applicant_lawsuites;
               $new_application->pa_co_applicant_lawsuites_year =$request->pa_co_applicant_lawsuites_year;
               $new_application->pa_co_applicant_ever_evicted =$request->pa_co_applicant_ever_evicted;
               $new_application->pa_co_applicant_eviction_year =$request->pa_co_applicant_eviction_year;
               $new_application->pa_co_applicant_felony_conviction =$request->pa_co_applicant_felony_conviction;
               $new_application->pa_co_applicant_felony_conviction_year =$request->pa_co_applicant_felony_conviction_year;
               $new_application->pa_co_applicant_judgments_or_fillings =$request->pa_co_applicant_judgments_or_fillings;
               $new_application->pa_co_applicant_judgments_or_fillings_year =$request->pa_co_applicant_judgments_or_fillings_year;
               $new_application->pa_co_applicant_employer_name =$request->pa_co_applicant_employer_name;
               $new_application->pa_co_applicant_employment_length =$request->pa_co_applicant_employment_length;
               $new_application->pa_co_applicant_employer_phone =$request->pa_co_applicant_employer_phone;
               $new_application->pa_co_applicant_employment_position =$request->pa_co_applicant_employment_position;
               $new_application->pa_co_applicant_employer_address =$request->pa_co_applicant_employer_address;
               $new_application->pa_co_applicant_employer_city =$request->pa_co_applicant_employer_city;
               $new_application->pa_co_applicant_employer_state =$request->pa_co_applicant_employer_state;
               $new_application->pa_co_applicant_employer_zip =$request->pa_co_applicant_employer_zip;
               $new_application->pa_co_applicant_monthly_income =$request->pa_co_applicant_monthly_income;
               $new_application->pa_co_applicant_supervisor_name =$request->pa_co_applicant_supervisor_name;
               $new_application->pa_co_applicant_supervisor_phone =$request->pa_co_applicant_supervisor_phone;
               $new_application->pa_co_applicant_supervisor_fax =$request->pa_co_applicant_supervisor_fax;
               $new_application->pa_co_applicant_supervisor_email =$request->pa_co_applicant_supervisor_email;
               $new_application->pa_co_applicant_other_monthly_income =$request->pa_co_applicant_other_monthly_income;
               $new_application->pa_co_applicant_other_monthly_income_reason =$request->pa_co_applicant_other_monthly_income_reason;
               $new_application->pa_co_applicant_emergency_contact_name =$request->pa_co_applicant_emergency_contact_name;
               $new_application->pa_co_applicant_emergency_contact_phone =$request->pa_co_applicant_emergency_contact_phone;
               $new_application->pa_co_applicant_emergency_contact_address =$request->pa_co_applicant_emergency_contact_address;
               $new_application->pa_co_applicant_emergency_contact_city =$request->pa_co_applicant_emergency_contact_city;
               $new_application->pa_co_applicant_emergency_contact_state =$request->pa_co_applicant_emergency_contact_state;
               $new_application->pa_co_applicant_emergency_contact_zip =$request->pa_co_applicant_emergency_contact_zip;
                $new_application->co_applicant_e_sign  = $e_Sign_file_name2;
                          
           }

           $new_application->pa_application_terms_agreement =$request->pa_application_terms_agreement;
           $new_application->pa_application_type = "online";
           $new_application->pa_additional_documents  = $pa_additional_documents;
           $new_application->e_sign  = $e_Sign_file_name;

           $new_application->save();

            if($new_application->property_application_id > 0)
            {

                $db_data['Property'] = Property::where('p_active_status','active')
                                                ->where('property_id' , $request->pa_property_id)
                                                ->first(); 


                /*Send Email to Admin About new Application*/
                $email_content="
                                <h2>Property title: <small>".$db_data['Property']->p_title."</small></h2>
                                <h2>Applicant name: <small>".$request->pa_applicant_name."</small></h2>
                                <h2>Applicant email: <small>".$request->pa_applicant_email."</small></h2>
                                <h2>Applicant phone: <small>".$request->pa_applicant_phone_num."</small></h2>
                                <h2>Application posted On: <small>".Carbon::now()->format('Y-m-d H:i:s')."</small></h2>
                               ";

          
                $email_details = array(
                                       'email_type' => "online_application", 
                                       'email_subject' => "New Application Recieved for ".$db_data['Property']->property_title." on ".config('app.name'),
                                       'body' => $email_content,    
                                       'view_to_use' => "email_templates.general_email_template",
                                      );               

                $email_res = Email_functions::send_email($email_details);
 

                $res = array(
                            'res_code' => 200,
                            'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Applciation Recieved!</b><br>
                                                    Thank You! We have recieved your Application and we will try to get back to you as soon as possible.</div>
                                               '
                            );
            }
            else
            {
                $res = array(
                            'res_code' => 100,
                            'res_msg_markup' =>'<div class="alert alert-primary" role="alert"><b><i class="fas fa-times"></i> Somting went wrong!</b><br>
                                                    Something went wrong. Please try again leter!</div>'                     
                            );
            }


            return $res;

    }






    public function apply_with_form_as_attachment($value='')
    {

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')
                                         ->get();    

        $page_meta_data = array(
                                'page_title'=>"Download Printable Application | ".config('app.name'),
                               ); 

        return view('properties.apply_with_form_as_attachment' , compact('db_data'))->with($page_meta_data);

    }


    public function apply_with_form_as_attachment_process_form(Request $request)
    {   

        $messages = [
                    'required' => "Field Required"
                    ];

        $Rules = [
                  'pa_property_id' => ['required', 'integer', \Illuminate\Validation\Rule::exists('properties', 'property_id')->where(fn ($query) => $query->where('p_active_status', 'active')->where('p_listing_status', 'for-rent'))],
                  'pa_applicant_name' => 'required',
                  'pa_applicant_email' => 'required|email',
                  'pa_applicant_phone_num' => 'required',
                  'pa_application_document_attached' => 'required|file|mimes:docx',
                  'pa_application_terms_agreement' => 'required|accepted',
                 ];


        $Attributes = [
                      ];


        $validatedData = $request->validate($Rules , $messages , $Attributes);


       /*Upload the Image file*/
        if($request->hasFile('pa_application_document_attached'))
        {
            $image = $request->file('pa_application_document_attached');

            $extension = $image->getClientOriginalExtension();
            $pa_application_document_attached = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$pa_application_document_attached);
        }
        else
        {
            $pa_application_document_attached = NULL;
        }

        
        $new_application = new PropertyApplication;
        $new_application->pa_property_id =$request->pa_property_id;
        $new_application->pa_applicant_name =$request->pa_applicant_name;
        $new_application->pa_applicant_email =$request->pa_applicant_email;
        $new_application->pa_applicant_phone_num =$request->pa_applicant_phone_num;
        $new_application->pa_application_document_attached =$pa_application_document_attached;
        $new_application->pa_application_type = "offline";
        $new_application->pa_application_terms_agreement  = $request->pa_application_terms_agreement;
        $new_application->save();


        if($new_application->property_application_id > 0)
        {

            $res = array(
                        'res_code' => 200,
                        'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Applciation Recieved!</b><br>
                                                Thank You! We have recieved your Application and we will try to get back to you as soon as possible.</div>
                                           '
                        );
        }
        else
        {
            $res = array(
                        'res_code' => 100,
                        'res_msg_markup' =>'<div class="alert alert-primary" role="alert"><b><i class="fas fa-times"></i> Somting went wrong!</b><br>
                                                Something went wrong. Please try again leter!</div>'                     
                        );
        }


        return $res;


    }   







    public function upload_application($value='')
    {

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')
                                         ->get();    

        $page_meta_data = array(
                                'page_title'=>"Apply Online | ".config('app.name'),
                               ); 

        return view('properties.upload_application' , compact('db_data'))->with($page_meta_data);

    }


    public function upload_application_process_form(Request $request)
    {   


        $e_sing_dummy_val = "data:image/png;base64,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";





        $messages = [
                    'required' => "Field Required",
                    'e_sign.email' => "Please add your Electronic Signature"
                    ];

        $Rules = [
                  'pa_property_id' => ['required', 'integer', \Illuminate\Validation\Rule::exists('properties', 'property_id')->where(fn ($query) => $query->where('p_active_status', 'active')->where('p_listing_status', 'for-rent'))],
                  'pa_applicant_name' => 'required',
                  'pa_applicant_email' => 'required|email',
                  'pa_applicant_phone_num' => 'required',
                  'pa_application_document_attached' => 'required|file',
                  'pa_application_terms_agreement' => 'required|accepted'
                 ];


        if($request->e_sign == $e_sing_dummy_val)
        {

            $Rules['e_sign'] = "required|email";
        }
        else
        {
            $Rules['e_sign'] = "required";
        }


        $Attributes = [
                      ];


        $validatedData = $request->validate($Rules , $messages , $Attributes);

 
 
        $img = $request->e_sign;
        $folderPath = public_path("resources/files/e-signs/"); //path location
         
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $e_Sign_file_name = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$image_type;
        $file = $folderPath . $e_Sign_file_name;
        file_put_contents($file, $image_base64);



        /*Upload the Image file*/
        if($request->hasFile('pa_application_document_attached'))
        {
            $image = $request->file('pa_application_document_attached');

            $extension = $image->getClientOriginalExtension();
            $pa_application_document_attached = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$pa_application_document_attached);
        }
        else
        {
            $pa_application_document_attached = NULL;
        }

 

        $pa_additional_documents = array();


        /*Upload Additional Documents*/
        if($request->hasFile('additional_doc_1'))
        {
            $image = $request->file('additional_doc_1');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_1 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_1);
        
            array_push($pa_additional_documents, $additional_doc_1); 
        }



        if($request->hasFile('additional_doc_2'))
        {
            $image = $request->file('additional_doc_2');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_2 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_2);
        
            array_push($pa_additional_documents, $additional_doc_2); 
        }





        if($request->hasFile('additional_doc_3'))
        {
            $image = $request->file('additional_doc_3');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_3 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_3);
        
            array_push($pa_additional_documents, $additional_doc_3); 
        }




        if($request->hasFile('additional_doc_4'))
        {
            $image = $request->file('additional_doc_4');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_4 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_4);
        
            array_push($pa_additional_documents, $additional_doc_4); 
        }



        if($request->hasFile('additional_doc_5'))
        {
            $image = $request->file('additional_doc_5');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_5 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_5);
        
            array_push($pa_additional_documents, $additional_doc_5); 
        }



        if($request->hasFile('additional_doc_6'))
        {
            $image = $request->file('additional_doc_6');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_6 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_6);
        
            array_push($pa_additional_documents, $additional_doc_6); 
        }


        if($request->hasFile('additional_doc_7'))
        {
            $image = $request->file('additional_doc_7');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_7 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_7);
        
            array_push($pa_additional_documents, $additional_doc_7); 
        }



        if($request->hasFile('additional_doc_8'))
        {
            $image = $request->file('additional_doc_8');

            $extension = $image->getClientOriginalExtension();
            $additional_doc_8 = Str::slug('Offline-Application-'.time().'-'.rand(0,99999)).'.'.$extension;
            $destinationPath = public_path('resources/files/dynamic');
            $image->move($destinationPath,$additional_doc_8);
        
            array_push($pa_additional_documents, $additional_doc_8); 
        }


        $new_application = new PropertyApplication;
        $new_application->pa_property_id =$request->pa_property_id;
        $new_application->pa_applicant_name =$request->pa_applicant_name;
        $new_application->pa_applicant_email =$request->pa_applicant_email;
        $new_application->pa_applicant_phone_num =$request->pa_applicant_phone_num;
        $new_application->pa_application_document_attached =$pa_application_document_attached;
        $new_application->pa_application_type = "offline";
        $new_application->pa_application_terms_agreement  = $request->pa_application_terms_agreement;
        $new_application->pa_additional_documents  = $pa_additional_documents;
        $new_application->e_sign  = $e_Sign_file_name;
        $new_application->save();


        if($new_application->property_application_id > 0)
        {

            $res = array(
                        'res_code' => 200,
                        'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Applciation Recieved!</b><br>
                                                Thank You! We have recieved your Application and we will try to get back to you as soon as possible.</div>
                                           '
                        );
        }
        else
        {
            $res = array(
                        'res_code' => 100,
                        'res_msg_markup' =>'<div class="alert alert-primary" role="alert"><b><i class="fas fa-times"></i> Somting went wrong!</b><br>
                                                Something went wrong. Please try again leter!</div>'                     
                        );
        }


        return $res;


    }




    

    public function application_form_wizard(Request $request)
    {   
        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();

        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.application_form_wizard',compact('db_data'))->with($page_meta_data);
    }



    public function application_form_wizard_with_steps(Request $request)
    {   
        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.application_form_wizard_with_steps',compact('db_data'))->with($page_meta_data);
    }
 






    public function online_application(Request $request)
    {   
        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.new_online_application_start_page', compact('db_data'))
            ->with('application', null)
            ->with($page_meta_data);
    }

    public function edit_online_application_setup(string $pa_tracking_id)
    {
        $application = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)
            ->where('pa_record_type', 'applicant')
            ->where(function ($query) {
                $query->whereNull('pa_current_step')->orWhere('pa_current_step', 2);
            })
            ->firstOrFail();

        $db_data['Property'] = Property::where('p_active_status', 'active')
            ->where('p_listing_status', 'for-rent')
            ->get();

        return view('properties.applications.new_online_application_start_page', compact('db_data', 'application'))
            ->with('page_title', 'Application '.config('app.name'));
    }

    public function update_online_application_setup(Request $request, string $pa_tracking_id)
    {
        $application = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)
            ->where('pa_record_type', 'applicant')
            ->where(function ($query) {
                $query->whereNull('pa_current_step')->orWhere('pa_current_step', 2);
            })
            ->firstOrFail();

        $validatedData = $request->validate([
            'pa_property_id' => [
                'required',
                'integer',
                \Illuminate\Validation\Rule::exists('properties', 'property_id')
                    ->where(fn ($query) => $query->where('p_active_status', 'active')->where('p_listing_status', 'for-rent')),
            ],
            'pa_number_of_co_applicants' => 'required|integer|between:0,5',
        ], [], [
            'pa_property_id' => 'Property',
            'pa_number_of_co_applicants' => 'Number of adults applying',
        ]);

        $application->pa_property_id = $validatedData['pa_property_id'];
        $application->pa_number_of_co_applicants = $validatedData['pa_number_of_co_applicants'];
        $application->save();

        return response()->json([
            'redirect_url' => url('online-application/step-2/'.$application->pa_tracking_id),
        ]);
    }
    

    public function process_online_application(Request $request)
    {   
        $messages = [
        ];

        $attributes = [
                'pa_property_id' => 'Property',
                'pa_number_of_co_applicants' => 'Number of Co-applicants',
                ];
        $Rules= [
                'pa_property_id' => ['required', 'integer', \Illuminate\Validation\Rule::exists('properties', 'property_id')->where(fn ($query) => $query->where('p_active_status', 'active')->where('p_listing_status', 'for-rent'))],
                'pa_number_of_co_applicants' => 'required|integer|between:0,5',
                ];

        $validatedData = $request->validate($Rules , $messages , $attributes);
 
        $pa_tracking_id =  PropertyApplication::generateTrackingId();
        
        //Save the Data 
        $new_application = new PropertyApplication;
        $new_application->pa_property_id =$request->pa_property_id;
        $new_application->pa_number_of_co_applicants = $request->pa_number_of_co_applicants;
        $new_application->pa_tracking_id = $pa_tracking_id;
        $new_application->pa_record_type = "applicant";
        $new_application->pa_application_type = "online";
        $new_application->save();

        // Determine next step URL
        $nextStepUrl = url('online-application/step-2/'.$pa_tracking_id);
        return response()->json(['redirect_url' => $nextStepUrl]);

    }
    




    public function online_application_step_2(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_2',compact('db_data'))->with($page_meta_data);
    }

     



    
    public function process_online_application_step_2(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            // Validation rules and attributes
            $attributes = [
                'pa_applicant_name' => 'Applicant name',
                'pa_applicant_social_sec_num' => 'SS#',
                'pa_applicant_driv_lic_num' => 'Driver Lic #',
                'pa_applicant_dob' => 'Date of birth',
                'pa_applicant_email' => 'Email',
                'pa_applicant_own_or_rent_monthly_payment' => 'Own or rent monthly payment',
                'pa_applicant_phone_num' => 'Phone #',
            ];
    
            $rules = [
                'pa_applicant_name' => 'required',
                'pa_applicant_social_sec_num' => 'required',
                'pa_applicant_driv_lic_num' => 'required',
                'pa_applicant_dob' => 'required',
                'pa_applicant_email' => 'required|email',
                'pa_applicant_own_or_rent_monthly_payment' => 'required',
                'pa_applicant_phone_num' => 'required|digits:10',
            ];
    
            // Validate the request
            $validatedData = $request->validate($rules, [], $attributes);
    
            // Save the data
            $new_application = $db_data['PropertyApplication'];
            $new_application->pa_applicant_name = $request->pa_applicant_name;
            $new_application->pa_applicant_social_sec_num = $request->pa_applicant_social_sec_num;
            $new_application->pa_applicant_driv_lic_num = $request->pa_applicant_driv_lic_num;
            $new_application->pa_applicant_dob = $request->pa_applicant_dob;
            $new_application->pa_applicant_email = $request->pa_applicant_email;
            $new_application->pa_applicant_own_or_rent_monthly_payment = $request->pa_applicant_own_or_rent_monthly_payment;
            $new_application->pa_applicant_phone_num = $request->pa_applicant_phone_num;
            $new_application->pa_current_step = 2;
            $new_application->save();
    
            // Determine next step URL
            $nextStepUrl = url('online-application/step-3/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
    
        } catch (ValidationException $e) {
            // Re-throw the validation exception to let Laravel handle it normally
            throw $e;
    
        } catch (Exception $e) {
            // Log unexpected exceptions in the custom application log
            Log::channel('application')->error('Error processing step 2 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return a JSON response with a generic error message
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.',
            ], 500);
        }
    }
    
    





    public function online_application_step_3(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_3',compact('db_data'))->with($page_meta_data);
    }

 
    public function process_online_application_step_3(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            $attributes = [
                'pa_applicant_current_add' => 'street address where you live now',
                'pa_applicant_current_city' => 'city where you live now',
                'pa_applicant_current_state' => 'state where you live now',
                'pa_applicant_current_zip' => 'ZIP code where you live now',
                'pa_applicant_previous_add' => 'previous street address',
                'pa_applicant_previous_city' => 'previous city',
                'pa_applicant_previous_state' => 'previous state',
                'pa_applicant_previous_zip' => 'previous ZIP code',
                'pa_applicant_landlord_name' => 'previous landlord name',
                'pa_applicant_landlord_phone' => 'previous landlord phone number',
                'pa_applicant_reason_for_leaving' => 'reason for leaving the previous address',
                'pa_previous_address_applicable' => 'previous-address question',
            ];
    
            $rules = [
                'pa_applicant_current_add' => 'required',
                'pa_applicant_current_city' => 'required',
                'pa_applicant_current_state' => 'required',
                'pa_applicant_current_zip' => 'required',
                'pa_previous_address_applicable' => 'required|in:Yes,No',
            ];
    
            if ($request->pa_previous_address_applicable == "Yes") {
                $rules['pa_applicant_previous_add'] = 'required';
                $rules['pa_applicant_previous_city'] = 'required';
                $rules['pa_applicant_previous_state'] = 'required';
                $rules['pa_applicant_previous_zip'] = 'required';
                $rules['pa_applicant_landlord_name'] = 'required';
                $rules['pa_applicant_landlord_phone'] = 'required';
                $rules['pa_applicant_reason_for_leaving'] = 'required';
            }
    
            // Validate the request
            $validatedData = $request->validate($rules, [], $attributes);
    
            // Save the data
            $new_application = $db_data['PropertyApplication'];
            $new_application->pa_applicant_current_add = $request->pa_applicant_current_add;
            $new_application->pa_applicant_current_city = $request->pa_applicant_current_city;
            $new_application->pa_applicant_current_state = $request->pa_applicant_current_state;
            $new_application->pa_applicant_current_zip = $request->pa_applicant_current_zip;
            $new_application->pa_previous_address_applicable = $request->pa_previous_address_applicable;
            $new_application->pa_applicant_previous_add = $request->pa_applicant_previous_add;
            $new_application->pa_applicant_previous_city = $request->pa_applicant_previous_city;
            $new_application->pa_applicant_previous_state = $request->pa_applicant_previous_state;
            $new_application->pa_applicant_previous_zip = $request->pa_applicant_previous_zip;
            $new_application->pa_applicant_landlord_name = $request->pa_applicant_landlord_name;
            $new_application->pa_applicant_landlord_phone = $request->pa_applicant_landlord_phone;
            $new_application->pa_applicant_reason_for_leaving = $request->pa_applicant_reason_for_leaving;
            $new_application->pa_current_step = 3;
            $new_application->save();
    
            // Determine the next step URL
            $nextStepUrl = url('online-application/step-4/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
    
        } catch (ValidationException $e) {
            // Re-throw the validation exception to let Laravel handle it normally
            throw $e;
    
        } catch (Exception $e) {
            // Log unexpected exceptions in the custom application log
            Log::channel('application')->error('Error processing step 3 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return a JSON response with a generic error message
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.',
            ], 500);
        }
    }
    


    public function online_application_step_4(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_4',compact('db_data'))->with($page_meta_data);
    }

 
    
    public function process_online_application_step_4(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            $attributes = [
                'pa_applicant_have_pets' => 'pet question',
                'pa_applicant_pet_type' => 'type of pet',
                'pa_applicant_bankruptcy' => 'bankruptcy question',
                'pa_applicant_bankruptcy_year' => 'year of bankruptcy',
                'pa_applicant_lawsuites' => 'lawsuit question',
                'pa_applicant_lawsuites_year' => 'year of lawsuit',
                'pa_applicant_ever_evicted' => 'eviction question',
                'pa_applicant_eviction_year' => 'year of eviction',
                'pa_applicant_felony_conviction' => 'felony conviction question',
                'pa_applicant_felony_conviction_year' => 'year of felony conviction',
                'pa_applicant_judgments_or_fillings' => 'court judgment or legal filing question',
                'pa_applicant_judgments_or_fillings_year' => 'year of court judgment or legal filing',
            ];
    
            $rules = [
                'pa_applicant_have_pets' => 'required',
                'pa_applicant_pet_type' => 'required_if:pa_applicant_have_pets,Yes',
                'pa_applicant_bankruptcy' => 'required',
                'pa_applicant_bankruptcy_year' => 'required_if:pa_applicant_bankruptcy,Yes',
                'pa_applicant_lawsuites' => 'required',
                'pa_applicant_lawsuites_year' => 'required_if:pa_applicant_lawsuites,Yes',
                'pa_applicant_ever_evicted' => 'required',
                'pa_applicant_eviction_year' => 'required_if:pa_applicant_ever_evicted,Yes',
                'pa_applicant_felony_conviction' => 'required',
                'pa_applicant_felony_conviction_year' => 'required_if:pa_applicant_felony_conviction,Yes',
                'pa_applicant_judgments_or_fillings' => 'required',
                'pa_applicant_judgments_or_fillings_year' => 'required_if:pa_applicant_judgments_or_fillings,Yes',
            ];
    
            // Validate the request
            $validatedData = $request->validate($rules, [], $attributes);
    
            // Save the data
            $new_application = $db_data['PropertyApplication'];
            $new_application->pa_applicant_have_pets = $request->pa_applicant_have_pets;
            $new_application->pa_applicant_pet_type = $request->pa_applicant_pet_type;
            $new_application->pa_applicant_bankruptcy = $request->pa_applicant_bankruptcy;
            $new_application->pa_applicant_bankruptcy_year = $request->pa_applicant_bankruptcy_year;
            $new_application->pa_applicant_lawsuites = $request->pa_applicant_lawsuites;
            $new_application->pa_applicant_lawsuites_year = $request->pa_applicant_lawsuites_year;
            $new_application->pa_applicant_ever_evicted = $request->pa_applicant_ever_evicted;
            $new_application->pa_applicant_eviction_year = $request->pa_applicant_eviction_year;
            $new_application->pa_applicant_felony_conviction = $request->pa_applicant_felony_conviction;
            $new_application->pa_applicant_felony_conviction_year = $request->pa_applicant_felony_conviction_year;
            $new_application->pa_applicant_judgments_or_fillings = $request->pa_applicant_judgments_or_fillings;
            $new_application->pa_applicant_judgments_or_fillings_year = $request->pa_applicant_judgments_or_fillings_year;
            $new_application->pa_current_step = 4;
            $new_application->save();
    
            // Determine the next step URL
            $nextStepUrl = url('online-application/step-5/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
    
        } catch (ValidationException $e) {
            // Re-throw the validation exception to let Laravel handle it normally
            throw $e;
    
        } catch (Exception $e) {
            // Log unexpected exceptions in the custom application log
            Log::channel('application')->error('Error processing step 4 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return a JSON response with a generic error message
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.',
            ], 500);
        }
    }
    




    public function online_application_step_5(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_5',compact('db_data'))->with($page_meta_data);
    }

 
    public function process_online_application_step_5(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            // Validation rules, messages, and attributes
            $attributes = [
                'pa_current_employment_status' => 'current work status',
                'pa_employer_name' => 'employer name',
                'pa_employment_length' => 'months worked there',
                'pa_employer_phone' => 'employer phone number',
                'pa_employment_position' => 'job title',
                'pa_employer_address' => 'employer street address',
                'pa_employer_city' => 'employer city',
                'pa_employer_state' => 'employer state',
                'pa_employer_zip' => 'employer ZIP code',
                'pa_monthly_income' => 'monthly income',
                'pa_supervisor_name' => 'supervisor name',
                'pa_supervisor_phone' => 'supervisor phone number',
                'pa_other_monthly_income' => 'other monthly income',
                'pa_other_monthly_income_reason' => 'source of other income',
            ];
            $otherIncomeReasonRules = [
                function ($attribute, $value, $fail) use ($request) {
                    if ((float) $request->pa_other_monthly_income > 0 && empty($value)) {
                        $fail('Please tell us where this other income comes from.');
                    }
                },
            ];

            if ($request->pa_current_employment_status == "Employed") {
                $Rules = [
                    'pa_current_employment_status' => 'required',
                    'pa_employer_name' => 'required',
                    'pa_employment_length' => 'required',
                    'pa_employer_phone' => 'required|digits:10',
                    'pa_employment_position' => 'required',
                    'pa_employer_address' => 'required',
                    'pa_employer_city' => 'required',
                    'pa_employer_state' => 'required',
                    'pa_employer_zip' => 'required|digits:5',
                    'pa_monthly_income' => 'required|numeric',
                    'pa_supervisor_name' => 'required',
                    'pa_supervisor_phone' => 'required|digits:10',
                    'pa_supervisor_fax' => 'nullable',
                    'pa_supervisor_email' => 'nullable',
                    'pa_other_monthly_income' => 'required|numeric',
                    'pa_other_monthly_income_reason' => $otherIncomeReasonRules,
                ];
            } elseif ($request->pa_current_employment_status == "Retired") {
                $Rules = [
                    'pa_monthly_income' => 'required|numeric',
                    'pa_other_monthly_income' => 'required|numeric',
                    'pa_other_monthly_income_reason' => $otherIncomeReasonRules,
                ];
            } elseif ($request->pa_current_employment_status == "Un-Employed") {
                $Rules = [
                    'pa_other_monthly_income' => 'required|numeric',
                    'pa_other_monthly_income_reason' => $otherIncomeReasonRules,
                ];
            } else {
                $Rules = [
                    'pa_current_employment_status' => 'required',
                ];
            }
    
            // Validate the request
            $validatedData = $request->validate($Rules, [], $attributes);
    
            // Save the data
            $new_application = $db_data['PropertyApplication'];
            $new_application->pa_current_employment_status = $request->pa_current_employment_status;
            $new_application->pa_employer_name = $request->pa_employer_name;
            $new_application->pa_employment_length = $request->pa_employment_length;
            $new_application->pa_employer_phone = $request->pa_employer_phone;
            $new_application->pa_employment_position = $request->pa_employment_position;
            $new_application->pa_employer_address = $request->pa_employer_address;
            $new_application->pa_employer_city = $request->pa_employer_city;
            $new_application->pa_employer_state = $request->pa_employer_state;
            $new_application->pa_employer_zip = $request->pa_employer_zip;
            $new_application->pa_monthly_income = $request->pa_monthly_income;
            $new_application->pa_supervisor_name = $request->pa_supervisor_name;
            $new_application->pa_supervisor_phone = $request->pa_supervisor_phone;
            $new_application->pa_supervisor_fax = $request->pa_supervisor_fax;
            $new_application->pa_supervisor_email = $request->pa_supervisor_email;
            $new_application->pa_other_monthly_income = $request->pa_other_monthly_income;
            $new_application->pa_other_monthly_income_reason = $request->pa_other_monthly_income_reason;
            $new_application->pa_current_step = 5;
            $new_application->save();
    
            // Determine the next step URL
            $nextStepUrl = url('online-application/step-6/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
    
        } catch (ValidationException $e) {
            // Re-throw the validation exception to let Laravel handle it normally
            throw $e;
    
        } catch (Exception $e) {
            // Log unexpected exceptions in the custom application log
            Log::channel('application')->error('Error processing step 5 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return a JSON response with a generic error message
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.',
            ], 500);
        }
    }
    



    public function online_application_step_6(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_6',compact('db_data'))->with($page_meta_data);
    }

 
    public function process_online_application_step_6(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            // Validation rules, messages, and attributes
            $attributes = [
                'pa_emergency_contact_name' => 'emergency contact full name',
                'pa_emergency_contact_phone' => 'emergency contact phone number',
                'pa_emergency_contact_address' => 'emergency contact street address',
                'pa_emergency_contact_city' => 'emergency contact city',
                'pa_emergency_contact_state' => 'emergency contact state',
                'pa_emergency_contact_zip' => 'emergency contact ZIP code',
            ];
    
            $Rules = [
                'pa_emergency_contact_name' => 'required',
                'pa_emergency_contact_phone' => 'required|digits:10',
                'pa_emergency_contact_address' => 'required',
                'pa_emergency_contact_city' => 'required',
                'pa_emergency_contact_state' => 'required',
                'pa_emergency_contact_zip' => 'required|digits:5',
            ];
    
            // Validate the request
            $validatedData = $request->validate($Rules, [], $attributes);
    
            // Save the Data
            $new_application = $db_data['PropertyApplication'];
            $new_application->pa_emergency_contact_name = $request->pa_emergency_contact_name;
            $new_application->pa_emergency_contact_phone = $request->pa_emergency_contact_phone;
            $new_application->pa_emergency_contact_address = $request->pa_emergency_contact_address;
            $new_application->pa_emergency_contact_city = $request->pa_emergency_contact_city;
            $new_application->pa_emergency_contact_state = $request->pa_emergency_contact_state;
            $new_application->pa_emergency_contact_zip = $request->pa_emergency_contact_zip;
            $new_application->pa_current_step = 6;
            $new_application->save();
    
            // Determine next step URL
            $nextStepUrl = url('online-application/step-7/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
    
        } catch (ValidationException $e) {
            // Re-throw the validation exception to let Laravel handle it normally
            throw $e;
    
        } catch (Exception $e) {
            // Log unexpected exceptions in the custom application log
            Log::channel('application')->error('Error processing step 6 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return a JSON response with a generic error message
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.',
            ], 500);
        }
    }
    


    public function online_application_step_7(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_7',compact('db_data'))->with($page_meta_data);
    }

 
    public function process_online_application_step_7(Request $request, $pa_tracking_id)
    {
        try {
            // Retrieve the application
            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            if (!$db_data['PropertyApplication']) {
                abort(404);
            }
    
            // Validation rules, messages, and attributes
            $pa_additional_documents = [];
    
            // Upload additional documents
            $fields = [
                'additional_doc_1',
                'additional_doc_2',
                'additional_doc_3',
                'additional_doc_4',
                'additional_doc_5',
                'additional_doc_6',
                'additional_doc_7',
                'additional_doc_8',
            ];

            $uploadRules = [];
            $uploadAttributes = [];
            foreach ($fields as $index => $field) {
                $uploadRules[$field] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
                $uploadAttributes[$field] = 'document ' . ($index + 1);
            }
            $request->validate($uploadRules, [
                'mimes' => 'Please choose a PDF or image file (JPG or PNG).',
                'max' => 'Each document must be 10 MB or smaller.',
            ], $uploadAttributes);
    
            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    try {
                        $image = $request->file($field);
                        $extension = $image->getClientOriginalExtension();
                        $filename = Str::slug('Offline-Application-' . time() . '-' . rand(0, 99999)) . '.' . $extension;
                        $destinationPath = public_path('resources/files/dynamic');
                        $image->move($destinationPath, $filename);
                        $pa_additional_documents[] = $filename;
                    } catch (Exception $e) {
                        Log::error("Error uploading file for field {$field}: " . $e->getMessage());
                    }
                }
            }
    
            // Save the data
            $new_application = $db_data['PropertyApplication'];
    
            if (!empty($pa_additional_documents)) {
                $new_application->pa_additional_documents = $pa_additional_documents;
            }
    
            $new_application->save();
    
            // Determine next step URL
            $nextStepUrl = url('online-application/step-8/' . $pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);
        } catch (ValidationException $e) {
            // Handle validation exception
            throw $e;
        } catch (Exception $e) {
            // Log unexpected exceptions
            Log::error('Error processing step 7 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.'
            ], 500);
        }
    }
    





    public function online_application_step_8(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_8',compact('db_data'))->with($page_meta_data);
    }


    public function process_online_application_step_8(Request $request, $pa_tracking_id)
    {   

        try {

            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
            if(!$db_data['PropertyApplication'])
            {
                abort(404);
            }


            $e_sing_dummy_val = "data:image/png;base64,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";


            if($request->e_sign == $e_sing_dummy_val)
            {
                $Rules= [
                    'e_sign' => 'required|email',
                    'pa_application_terms_agreement' => 'required|accepted',
                    ];
            }
            else
            {
                $Rules= [
                        'e_sign' => 'required',
                        'pa_application_terms_agreement' => 'required|accepted',
                        ];
            }
    
            $validatedData = $request->validate($Rules, [], [
                'e_sign' => 'signature',
                'pa_application_terms_agreement' => 'application terms agreement',
            ]);
    
                
            $folderPath = public_path("resources/files/e-signs/"); //path location
            $img = $request->e_sign;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $e_Sign_file_name = Str::slug('online-Application-'.time().'-'.rand(0,99999)).'.'.$image_type;
            $file = $folderPath . $e_Sign_file_name;
            file_put_contents($file, $image_base64);


            //Save the Data 
            $new_application = PropertyApplication::where('pa_tracking_id', $pa_tracking_id)->first();
            $new_application->e_sign  = $e_Sign_file_name;
            $new_application->pa_application_terms_agreement  = $request->pa_application_terms_agreement;
            $new_application->pa_current_step = 9;
            $new_application->save();

            // Determine next step URL
            $nextStepUrl = url('online-application/step-9/'.$pa_tracking_id);
            return response()->json(['redirect_url' => $nextStepUrl]);


        } catch (ValidationException $e) {
            // Handle validation exceptions
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Log unexpected exceptions
            Log::error('Error processing step 8 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.'
            ], 500);
        }

    }


 


    public function online_application_step_9(Request $request, $pa_tracking_id)
    {   
        $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
        if(!$db_data['PropertyApplication'])
        {
            abort(404);
        }

        $db_data['Property'] = Property::where('p_active_status','active')->where('p_listing_status', 'for-rent')->get();
        $page_meta_data = array(
                                'page_title'=>'Application '.config('app.name'),
                                ); 
        return view('properties.applications.step_9',compact('db_data'))->with($page_meta_data);
    }
 

    public function process_online_application_step_9(Request $request, $pa_tracking_id)
    {   
        try {

            $db_data['PropertyApplication'] = PropertyApplication::where('pa_tracking_id' , $pa_tracking_id)->first();
            if(!$db_data['PropertyApplication'])
            {
                abort(404);
            }


            if($db_data['PropertyApplication']->pa_record_type == "applicant")
            {
        
                if($db_data['PropertyApplication']->pa_number_of_co_applicants > 0)
                {
                    $pa_tracking_id =  PropertyApplication::generateTrackingId();
        
                    // Insert the CoApplicant Record
                    $new_application = new PropertyApplication;
                    $new_application->pa_tracking_id = $pa_tracking_id;
                    $new_application->pa_record_type = "co-applicant";
                    $new_application->pa_parent_application_id = $db_data['PropertyApplication']->property_application_id;
                    $new_application->save();
                    
                    // Determine next step URL
                    $nextStepUrl = url('online-application/step-2/'.$pa_tracking_id);
                    return response()->json(['redirect_url' => $nextStepUrl]);
        
                }
                else
                {
                    // Determine next step URL
                    $nextStepUrl = url('/');
                    return response()->json(['redirect_url' => $nextStepUrl]);
                }
            }
            elseif($db_data['PropertyApplication']->pa_record_type == "co-applicant") 
            {

                //Check the Number of the CoApplicants Records Has been Saved.
                $number_of_co_Applicants = 0;
                $CoApplicantsAdded = 0;
                $db_data['ParentPropertyApplication'] = PropertyApplication::where('property_application_id' , $db_data['PropertyApplication']->pa_parent_application_id)->first();
                if($db_data['ParentPropertyApplication'])
                {
                    $number_of_co_Applicants = $db_data['ParentPropertyApplication']->pa_number_of_co_applicants;
                    // Get the Number of CoApplicants Saved
                    $CoApplicantsAdded = PropertyApplication::where('pa_parent_application_id' , $db_data['ParentPropertyApplication']->property_application_id)->count();
                }

                if($number_of_co_Applicants > $CoApplicantsAdded)
                {
                    $pa_tracking_id =  PropertyApplication::generateTrackingId();
        
                    // Insert the CoApplicant Record
                    $new_application = new PropertyApplication;
                    $new_application->pa_tracking_id = $pa_tracking_id;
                    $new_application->pa_record_type = "co-applicant";
                    $new_application->pa_parent_application_id = $db_data['ParentPropertyApplication']->property_application_id;
                    $new_application->save();
                    
                    // Determine next step URL
                    $nextStepUrl = url('online-application/step-2/'.$pa_tracking_id);
                    return response()->json(['redirect_url' => $nextStepUrl]);
                }
                else
                {
                    // Determine next step URL
                    $nextStepUrl = url('/');
                    return response()->json(['redirect_url' => $nextStepUrl]);
                }
            }





        } catch (ValidationException $e) {
            // Handle validation exceptions
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Log unexpected exceptions
            Log::error('Error processing step 9 of online application', [
                'pa_tracking_id' => $pa_tracking_id,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'An unexpected error occurred while processing your application. Please try again later.'
            ], 500);
        }


    }

 


    public function shareProperty(Request $request)
    {
        $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'recipient_emails' => 'required|array',
            'recipient_emails.*' => 'email|max:255',
            'property_slug' => 'required|exists:properties,p_slug',
            'message' => 'nullable|string'
        ]);

        // Limit to 5 emails
        $emails = array_slice($request->recipient_emails, 0, 5);

        // Get property details
        $property = Property::where('p_slug', $request->property_slug)->first();

        // Prepare email data
        $data = [
            'sender_name' => $request->sender_name,
            'property_title' => $property->p_title,
            'property_address' => $property->p_address,
            'property_price' => $property->p_price,
            'property_url' => url('properties/explore-details/'.$property->p_slug),
            'message' => $request->message,
            'property_image' => asset('resources/files/dynamic/'.$property->p_banner_image)
        ];

        // Send email
        $result = Email_functions::sendNewEmail(
            $emails,
            $request->sender_name.' wants to share a property with you',
            'email_templates.property_share',
            [],
            'notification@readyrentalsonline.com',
            $request->sender_name,
            $data
        );

        return response()->json($result);
    }









}
