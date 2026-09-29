<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Email_functions;

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;

use PHPMailer\PHPMailer;

class PageController extends Controller
{

    public function terms_and_conditions_for_applications()
    {   
             
        $page_meta_data = array(
                                'page_title'=>'Explore our Terms and Conditions for Applications |  '.env('APP_NAME'),
                                ); 

        return view('pages.terms_and_conditions_for_applications')->with($page_meta_data);
    }





}