<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;
use App\Models\PropertyApplication;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $first_name = $request->first_name;
        $email = $request->email;

        $construct_query = Property::orderBy('p_title','asc');

        if(isset($first_name) &&  !empty($first_name) && $first_name != "" && $first_name != NULL )
        {
            $construct_query->where('first_name', 'like', '%'.$first_name.'%');      
        }

        if(isset($email) &&  !empty($email) && $email != "" && $email != NULL )
        {
            $construct_query->where('email', 'like', '%'.$email.'%');      
        }

        $db_data['Property'] = $construct_query->paginate(100);

        $page_meta_data = array(
                                'page_title'=>'All Properties | '.env('APP_NAME').' Admin',
                                ); 


        return view('Account.properties.show_listings',compact('db_data'))->with($page_meta_data);        
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_meta_data = array(
                                'page_title'=>'Create new Property | '.env('APP_NAME').' Admin',
                                ); 


        return view('Account.properties.create')->with($page_meta_data); 
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [ 
                    ];


        $attributes = [
                       'p_title' => 'Title',
                       'p_banner_image' => 'Banner Image',
                       'p_address' => 'Address',
                       'p_area' => 'Area',
                       'p_rooms' => '# of Rooms',
                       'p_baths' => '# of Bathrooms',
                       'b_year_built' => 'Year Built',
                       'p_bedrooms' => '# of Bedrooms',
                       'p_listing_status' => 'Listing status',
                       'p_demo_video' => 'Demo video',
                       'p_map_location_markup' => 'Map Location Markup',
                       'p_price' => 'Price',
                       'p_short_description' => 'Property Short Description',
                       'p_description' => 'Property Details Description',
                       ];

        $Rules  = [
                   'p_title' => 'required',
                   'p_banner_image' => 'required|image',
                   'p_address' => 'required',
                   'p_area' => 'sometimes|nullable',
                   'p_rooms' => 'sometimes|nullable',
                   'p_baths' => 'sometimes|nullable',
                   'b_year_built' => 'sometimes|nullable',
                   'p_bedrooms' => 'sometimes|nullable',
                   'p_listing_status' => 'required',
                   'p_demo_video' => 'sometimes|nullable',
                   'p_map_location_markup' => 'sometimes|nullable',
                   'p_price' => 'required|numeric',                      
                   'p_short_description' => 'required',
                   'p_description' => 'required',
                  ];


        $validatedData = $request->validate($Rules , $messages , $attributes);



        /*Upload the Image file*/
        if($request->hasFile('p_banner_image'))
        {
        
            $image = $request->file('p_banner_image');
            $size = getimagesize($image);

            list($width, $height, $type, $attr) = $size;
            $file_mime = $size['mime'];
            $ml_width = $size['0'];
            $ml_height = $size['1'];

            $extension = $image->getClientOriginalExtension();
            $p_banner_image = Str::slug($request->p_title.'-'.env("APP_NAME"),'-').'-'.rand(0,99999).'.'.$extension;
            $destinationPath = 'resources/files/dynamic';
            $image->move($destinationPath,$p_banner_image);
        
        }
        else
        {
            $p_banner_image = NULL;
        }
 

        $new_property = new Property;
        $new_property->p_title = $request->p_title;
        $new_property->p_banner_image = $p_banner_image;
        $new_property->p_address = $request->p_address;
        $new_property->p_area = $request->p_area;
        $new_property->p_rooms = $request->p_rooms;
        $new_property->p_baths = $request->p_baths;
        $new_property->b_year_built = $request->b_year_built;
        $new_property->p_bedrooms = $request->p_bedrooms;
        $new_property->p_listing_status = $request->p_listing_status;
        $new_property->p_demo_video = $request->p_demo_video;
        $new_property->p_map_location_markup = $request->p_map_location_markup;
        $new_property->p_price = $request->p_price;
        $new_property->p_short_description = $request->p_short_description;
        $new_property->p_description = $request->p_description;
        $new_property->save();
        $new_property_id = $new_property->property_id;
 
        /*Upload Property Images*/
        $sider_files_Count = count($_FILES['fileUpload']['name']);

        $collect_PropertyImage =  array();
        for($i = 0; $i < $sider_files_Count-1; $i++)
        {

            $image = $request->file('fileUpload')[$i];
            $size = getimagesize($image);

            list($width, $height, $type, $attr) = $size;
            $file_mime = $size['mime'];
            $ml_width = $size['0'];
            $ml_height = $size['1'];

            $extension = $image->getClientOriginalExtension();
            $fileUpload = Str::slug($request->p_title.'-'.env("APP_NAME"),'-').'-'.rand(0,99999).'.'.$extension;
            $destinationPath = 'resources/files/dynamic';
            $image->move($destinationPath,$fileUpload);

             $image_data = array(
                              'pi_property_id' => $new_property_id,
                              'pi_image_name' => $fileUpload,
                              );
            $collect_PropertyImage[] = $image_data;

        }

        if(!empty($collect_PropertyImage))
        {
           PropertyImage::insert($collect_PropertyImage);
        }




        /*Upload pruct images and desctiption*/
        $pa_title = $request->pa_title;
        $total_pa_title = count($request->pa_title);
        $collect_PropertyAmenity =  array();

        for($i = 0; $i < $total_pa_title-1; $i++)
        {
            $image_data = array(
                              'pa_property_id' => $new_property_id,
                              'pa_title' => $pa_title[$i],
                              );
            $collect_PropertyAmenity[] = $image_data;
        }

        if(!empty($collect_PropertyAmenity))
        {
            PropertyAmenity::insert($collect_PropertyAmenity);
        }


        if ($new_property_id) {
            return response()->json([
                'success' => true,
                'message' => 'New Property Added',
                'redirect_url' => url('accounts/properties'), // Optional if you need a redirect
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again',
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($property_id)
    {

        $db_data['Property'] = Property::find($property_id);

        if($db_data['Property'])
        {

            $db_data['PropertyImage'] = PropertyImage::where('pi_property_id' , $db_data['Property']->property_id)->get();
            $db_data['PropertyAmenity'] = PropertyAmenity::where('pa_property_id' , $db_data['Property']->property_id)->get();

            $page_meta_data = array(
                                    'page_title'=>'Edit Property | '.env('APP_NAME').' Admin',
                                    ); 

            return view('Account.properties.edit',compact('db_data'))->with($page_meta_data); 

        }   
        else
        {
            return redirect('accounts/properties' )->with('failure','No data found!');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $property_id)
    {

        $db_data['Property'] = Property::find($property_id);

        if(!$db_data['Property'])
        {
            return redirect('accounts/properties' )->with('failure','No data found!');
        }   
        else
        {

            $messages = [ 
                        ];


            $attributes = [
                           'p_title' => 'Title',
                           'p_banner_image' => 'Banner Image',
                           'p_address' => 'Address',
                           'p_area' => 'Area',
                           'p_rooms' => '# of Rooms',
                           'p_baths' => '# of Bathrooms',
                           'b_year_built' => 'Year Built',
                           'p_bedrooms' => '# of Bedrooms',
                           'p_listing_status' => 'Listing status',
                           'p_demo_video' => 'Demo video',
                           'p_map_location_markup' => 'Map Location Markup',
                           'p_price' => 'Price',
                            'p_short_description' => 'Property Short Description',
                            'p_description' => 'Property Details Description',

                            ];

            $Rules  = [
                       'p_title' => 'required',
                       'p_banner_image' => 'sometimes|nullable|image',
                       'p_address' => 'required',
                       'p_area' => 'sometimes|nullable',
                       'p_rooms' => 'sometimes|nullable',
                       'p_baths' => 'sometimes|nullable',
                       'b_year_built' => 'sometimes|nullable',
                       'p_bedrooms' => 'sometimes|nullable',
                       'p_listing_status' => 'required',
                       'p_demo_video' => 'sometimes|nullable',
                       'p_map_location_markup' => 'sometimes|nullable',
                       'p_price' => 'required|numeric',
                        'p_short_description' => 'required',
                        'p_description' => 'required',
                      ];

            $validatedData = $request->validate($Rules , $messages , $attributes);

            /*Upload the Image file*/
            if($request->hasFile('p_banner_image'))
            {
            
                $image = $request->file('p_banner_image');
                $size = getimagesize($image);

                list($width, $height, $type, $attr) = $size;
                $file_mime = $size['mime'];
                $ml_width = $size['0'];
                $ml_height = $size['1'];

                $extension = $image->getClientOriginalExtension();
                $p_banner_image = Str::slug($request->p_title.'-'.env("APP_NAME"),'-').'-'.rand(0,99999).'.'.$extension;
                $destinationPath = 'resources/files/dynamic';
                $image->move($destinationPath,$p_banner_image);
            
            }
            else
            {
                $p_banner_image = $db_data['Property']->p_banner_image;
            }


            $property_to_update = Property::find($property_id);
            $property_to_update->p_title = $request->p_title;
            $property_to_update->p_banner_image = $p_banner_image;
            $property_to_update->p_address = $request->p_address;
            $property_to_update->p_area = $request->p_area;
            $property_to_update->p_rooms = $request->p_rooms;
            $property_to_update->p_baths = $request->p_baths;
            $property_to_update->b_year_built = $request->b_year_built;
            $property_to_update->p_bedrooms = $request->p_bedrooms;
            $property_to_update->p_listing_status = $request->p_listing_status;
            $property_to_update->p_demo_video = $request->p_demo_video;
            $property_to_update->p_map_location_markup = $request->p_map_location_markup;
            $property_to_update->p_price = $request->p_price;
            $property_to_update->p_short_description = $request->p_short_description;
            $property_to_update->p_description = $request->p_description;
            $property_to_update->save();
            $property_to_update_id = $property_to_update->property_id;



            /**
            * @see Delet the selected Slider Images
            */
            $images_to_delete = $request->images_to_delete;

            if(!empty($images_to_delete))
            {
                $total_to_be_deleted = count($images_to_delete);
                for($i = 0; $i < $total_to_be_deleted; $i++)
                {
                    $image_id =  $images_to_delete[$i];

                    $ProductSliderImage = PropertyImage::find($image_id);
                    if($ProductSliderImage)
                    {
                        File::delete(asset('resources/files/dynamic/'.$ProductSliderImage->psi_picture));
                        $ProductSliderImage->delete();
                    }
                }
            }



            /*Upload Property Images*/
            $sider_files_Count = count($_FILES['fileUpload']['name']);

            $collect_PropertyImage =  array();
            for($i = 0; $i < $sider_files_Count-1; $i++)
            {

                $image = $request->file('fileUpload')[$i];
                $size = getimagesize($image);

                list($width, $height, $type, $attr) = $size;
                $file_mime = $size['mime'];
                $ml_width = $size['0'];
                $ml_height = $size['1'];

                $extension = $image->getClientOriginalExtension();
                $fileUpload = Str::slug($request->p_title.'-'.env("APP_NAME"),'-').'-'.rand(0,99999).'.'.$extension;
                $destinationPath = 'resources/files/dynamic';
                $image->move($destinationPath,$fileUpload);

                 $image_data = array(
                                  'pi_property_id' => $property_id,
                                  'pi_image_name' => $fileUpload,
                                  );
                $collect_PropertyImage[] = $image_data;

            }

            if(!empty($collect_PropertyImage))
            {
               PropertyImage::insert($collect_PropertyImage);
            }





            /**
            * @see Update Current Product Additional Images with text description
            */

            $property_amenties_to_update = $request->property_amenties_to_update;
            $current_pa_title = $request->current_pa_title;
            $total_additional_images_updated = 0;
            
            if(!empty($property_amenties_to_update))
            {
                for($i = 0; $i < count($property_amenties_to_update); $i++)
                {
                    $GetPropertyAmenity = PropertyAmenity::find($property_amenties_to_update[$i]);
                    if($GetPropertyAmenity)
                    {
     
                        $pa_title = $current_pa_title[$i];
                        
                        $rows_affected = DB::table('property_amenities')
                                        ->where('property_amenity_id', $property_amenties_to_update[$i])
                                        ->update(
                                                 [
                                                  'pa_title' => $pa_title
                                                 ]
                                               );
    
                        $total_additional_images_updated = $rows_affected  + $total_additional_images_updated;
                    }
                }
            }


            /*Delete the Selected additiona images with Text*/
            $addtional_amenities_to_delete = $request->addtional_amenities_to_delete;
            $total_amenities_deleted  = 0;
            if(!empty($addtional_amenities_to_delete))
            {
                for($i = 0; $i < count($addtional_amenities_to_delete); $i++)
                {

                    $delete_afffected =  DB::table('property_amenities')
                                         ->where('property_amenity_id', $addtional_amenities_to_delete[$i])
                                         ->delete();
                
                    $total_amenities_deleted = $total_amenities_deleted + $delete_afffected;                     

                }
            }




            /*Upload pruct images and desctiption*/
            $pa_title = $request->pa_title;
            $total_pa_title = count($request->pa_title);
            $collect_PropertyAmenity =  array();

            for($i = 0; $i < $total_pa_title-1; $i++)
            {
                if($pa_title[$i] !="" && $pa_title[$i] != NULL)
                {
                    $image_data = array(
                                      'pa_property_id' => $property_id,
                                      'pa_title' => $pa_title[$i],
                                      );
                    $collect_PropertyAmenity[] = $image_data;
                }
 
            }

            if(!empty($collect_PropertyAmenity))
            {
                PropertyAmenity::insert($collect_PropertyAmenity);
            }


            session()->flash('success', 'Changes saved');
            
            return response()->json([
                'success' => true,
                'message' => 'Changes saved',
                'redirect_url' => url('accounts/properties'), // Optional if you need a redirect
            ]);
 

            return redirect('accounts/properties')->with('success','Property details updated');
            
            if($new_property_id)
            {
            
            } 
            else
            {
                return redirect('accounts/properties')->with('failure','Something went wrong. Please try again');
            }




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
    public function change_activate_status($property_id = "" , $approval_status = "")
    {
  
        $property_details = Property::find($property_id);

        if($property_details) 
        {
           
          if($approval_status == "active")
          {
                $rec_to_update = Property::find($property_id);
                $rec_to_update->p_active_status = 'active';
                $rec_to_update->save();
                return redirect()->back()->with('success','Property marked as Active!');
          }
          elseif($approval_status == "inactive")
          {
                /*Move the Contact to archives*/
                $rec_to_update = Property::find($property_id);
                $rec_to_update->p_active_status = 'inactive';
                $rec_to_update->save();
                return redirect()->back()->with('success','Property marked as InActive. Record Will no longer apear in front end records.');
          }
          else
          {
              return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');
          }

        }
        else
        { 
            return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');
        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function application_listings()
    {

        $db_data['PropertyApplication'] = PropertyApplication::join('properties', 'property_applications.pa_property_id', '=', 'properties.property_id')
                                                                ->where('pa_record_type','applicant')
                                                                ->orderBy('property_application_id','desc')
                                                               ->paginate(50);

        $page_meta_data = array(
                                'page_title'=>'Manage all Property Application | '.env('APP_NAME').' Admin',
                                ); 


        return view('Account.properties.application_listings' , compact('db_data'))->with($page_meta_data); 
    
    }



    public function application_details($property_application_id)
    {

        $db_data['PropertyApplication'] = PropertyApplication::join('properties', 'property_applications.pa_property_id', '=', 'properties.property_id')
                                                                ->where('property_application_id' , $property_application_id)
                                                               ->first();

        $db_data['Property'] = Property::all();
        
        if($db_data['PropertyApplication'])
        {
    
            $page_meta_data = array(
                                    'page_title'=>'Manage all Property Application | '.env('APP_NAME').' Admin',
                                    ); 


            return view('Account.properties.application_details' , compact('db_data'))->with($page_meta_data); 

        }
        else
        {
            return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');

        }
    
    }



    public function print_application_details($property_application_id)
    {

        $db_data['PropertyApplication'] = PropertyApplication::join('properties', 'property_applications.pa_property_id', '=', 'properties.property_id')
                                                                ->where('property_application_id' , $property_application_id)
                                                               ->first();

        $db_data['Property'] = Property::all();
        
        if($db_data['PropertyApplication'])
        {
    
            $page_meta_data = array(
                                    'page_title'=>'Manage all Property Application | '.env('APP_NAME').' Admin',
                                    ); 


            return view('Account.properties.print_application_details' , compact('db_data'))->with($page_meta_data); 

        }
        else
        {
            return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');

        }
    
    }



    public function delete_property_permanently($property_id = "")
    {
  
        $property_details = Property::find($property_id);
        if($property_details) 
        {

            $PropertyAmenity =  PropertyAmenity::where('pa_property_id' ,$property_details->property_id)->delete();
            $PropertyImage =  PropertyImage::where('pi_property_id' ,$property_details->property_id)->delete();
            $property_details->delete();
 
            return redirect()->back()->with('success','Property deleted.');
        }
        else
        {
            return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');
        }

    }



    public function delete_application_permanently($property_application_id = "")
    {
  
        $application_details = PropertyApplication::find($property_application_id);
        if($application_details) 
        {
        
            $application_details->delete();
            return redirect()->back()->with('success','Application deleted.');
        
        }
        else
        {
        
            return redirect()->back()->with('failure','No data was found against the given Parameters. Please try again');
        
        }

    }    




}
