@extends('layouts.accounts')

@section('page_level_styles')
	<style type="text/css">
		.card .card-body 
		{
 		   padding: 0rem 1rem;
		}

		.col-md-3, .col-md-4
		{
			margin-bottom: 15px;
		}

		.title-2
		{
			margin-top: 5px;
			margin-bottom: 5px;
		}
	</style>
@endsection

@section('content')

	<style type="text/css">
		
	@media print
	{


		.col-print-1 {width:8%; !important;  float:left;}
		.col-print-2 {width:16% !important;; float:left;}
		.col-print-3 {width:25% !important;; float:left;}
		.col-print-4 {width:33% !important;; float:left;}
		.col-print-5 {width:42% !important;; float:left;}
		.col-print-6 {width:50% !important;; float:left;}
		.col-print-7 {width:58% !important;; float:left;}
		.col-print-8 {width:66% !important;; float:left;}
		.col-print-9 {width:75% !important;; float:left;}
		.col-print-10{width:83% !important;; float:left;}
		.col-print-11{width:92% !important;; float:left;}
		.col-print-12{width:100% !important; float:left;}

		.sec-title
		{
			background-color: black !important;
			color: white !important;
			font-weight: bold;
			-webkit-print-color-adjust: exact;
			padding: 5px 1px; 
		}
 

		.sssss
		{
    		border-bottom: 1px solid inherit;
    		font-size: 13px !important;
    		padding: 4px 0px;
		}
 		
		.print-row
		{
			display: flex;
		}

		.form-control:disabled, .form-control[readonly]
		{
		    background-color: none;
    		opacity: 1;
		}


		.row>* {
		    flex-shrink: 0;
		    width: 100%;
		    max-width: 100%;
		    padding-left: 3px;
		    margin-top: -1px;
		    margin-right: 0px;
		}


		@page  
		{ 
		    size: auto;   /* auto is the initial value */ 
		    /* this affects the margin in the printer settings */ 
		    margin: 0.5mm 0.5mm 0.5mm 0.5mm;  
		} 

		.agreement
		{
			font-size: 12px;
		}

		.alert-note
		{
			font-size: 15px;
			font-weight: bold;
		}
/*		.card-header
		{
			min-height: 35px !important;

		}
*/
	}




		.col-print-1 {width:8.33333333%; !important;  float:left;}
		.col-print-2 {width:16.66666667% !important;; float:left;}
		.col-print-3 {width:25% !important;; float:left;}
		.col-print-4 {width:33.33333333% !important;; float:left;}
		.col-print-5 {width:41.66666667% !important;; float:left;}
		.col-print-6 {width:50% !important;; float:left;}
		.col-print-7 {width:58.33333333% !important;; float:left;}
		.col-print-8 {width:66.66666667% !important;; float:left;}
		.col-print-9 {width:75% !important;; float:left;}
		.col-print-10{width:83.33333333% !important;; float:left;}
		.col-print-11{width:91.66666667% !important;; float:left;}
		.col-print-12{width:100% !important; float:left;}

		.sec-title
		{
			background-color: black !important;
			color: white !important;
			-webkit-print-color-adjust: exact; 
		}
 

		.col
		{
			border-color: inherit !important;
    		border-style: solid !important;
    		border-width: 1px !important;
		}
 		
		.print-row
		{
			display: flex;
		}



		.sssss
		{
			border-color: inherit !important;
    		border-style: solid !important;
    		border-width: 1px !important;
		}


		@media print {
		  .add-print-page 
		  {
		  	page-break-after: always;
		  }
		}



    
        @media print {
            .pipe {
                color: black; /* Set the color of the pipe */
                font-weight: bold; /* Make the pipe bold */
                font-size: 1.2em; /* Adjust the font size of the pipe */
                margin: 0 5px; /* Add some margin around the pipe for spacing */
            }
        }



	</style>

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
 
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<!--begin::Row-->

				<!--begin::Row-->
				<div class="row gy-5 g-xl-8">
 
					<!--begin::Col-->
					<div class="col-xl-12">
						<!--begin::Tables Widget 9-->
						<div class="card card-xl-stretch mb-1 mb-xl-8">
 

							<!--begin::Body-->
							<div class="card-body py-1">
 
								<div class="card-body">

									<div class="row align-items-center" style="margin-top: 25px; margin-bottom: 20px;">
		                                <div class="col-print-4">
											<img src="{{ asset('logo/ready_rentals_light.svg') }}" alt="Ready Rentals Online" style="max-height: 54px; width: auto;">
										</div>
		                                
		                                <div class="col-print-4 text-center">
											<span class="card-label fw-bolder fs-3 mb-1 d-block" style="color: #10253a;">Rental Application</span>
											<span class="text-muted fs-7">Official Tenant Application Record</span>
										</div>

		                                <div class="col-print-4 text-end">
	                                        <div><span class="label fw-bold">Date:</span> <span class="desc" style="text-decoration: underline;">{{ $db_data['PropertyApplication']->pa_created_at }}</span></div>
	                                        <div><span class="label fw-bold">Property:</span> <span class="desc" style="text-decoration: underline;">{{ $db_data['PropertyApplication']->p_title }}</span></div>
		                                </div>	

									</div>

									<div class="separator my-2"></div>
									
									<div class="row">
		                                <div class="col-print-12 sec-title">
		                        			<span>Applicant Information</span>
		                        		</div>
		                        	</div>
		                            
                                    <div class="row">
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Name:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_name}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>SS#:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_social_sec_num}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Dri Lic #:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_driv_lic_num}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>DOB:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_dob}}</span>
        
                                            <span class="label"><strong>Email:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_email}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Own/Rent Monthly Payment $:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_own_or_rent_monthly_payment}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Phone#:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_phone_num}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Address:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_current_add}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>City:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_current_city}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>State:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_current_state}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_current_zip}}</span>
 
                                            <span class="label"><strong>Prev Address:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_previous_add}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Prev City:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_previous_city}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Prev State:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_pevious_state}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Prev ZIP:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_previous_zip}}</span>
            
                                            <span class="label"><strong>Landlord name:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_landlord_name}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>phone #:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_landlord_phone}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Reason for leaving :</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_reason_for_leaving}}</span>
       
                                            <span class="label"><strong>Pets:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_have_pets}}<span class="pipe"> | </span> Type: {{ $db_data['PropertyApplication']->pa_applicant_pet_type}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Bankruptcy:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_bankruptcy}}<span class="pipe"> | </span> Year: {{ $db_data['PropertyApplication']->pa_applicant_bankruptcy_year}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Lawsuit:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_lawsuites}}<span class="pipe"> | </span> Year: {{ $db_data['PropertyApplication']->pa_applicant_lawsuites_year}}</span>
         
                                            <span class="label"><strong>Ever Been Evicted:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_ever_evicted}}<span class="pipe"> | </span> Year: {{ $db_data['PropertyApplication']->pa_applicant_felony_conviction}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Convicted of a felony?:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_felony_conviction}}<span class="pipe"> | </span> Year: {{ $db_data['PropertyApplication']->pa_applicant_felony_conviction_year}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Judgements/filings:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_applicant_judgments_or_fillings}}<span class="pipe"> | </span> Year: {{ $db_data['PropertyApplication']->pa_applicant_judgments_or_fillings_year}}</span>
                                        </div>
                                    </div>

		                            
		                            
		                            
									<div class="row">
		                                <div class="col-print-12 sec-title">
		                        			<span>Employment Information</span>
		                        		</div>
		                        	</div>
                                    
                                    <div class="row">
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Employer Name:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_name}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Employment Length:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employment_length}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_phone}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Position:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employment_position}}</span>
  
                                            <span class="label"><strong>Address:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_address}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>City:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_city}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>State:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_state}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_employer_zip}}</span>
                                        </div>
                                        
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Monthly income:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_monthly_income}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Supervisor Name:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_supervisor_name}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_supervisor_phone}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Fax:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_supervisor_fax}}</span>
 
                                            <span class="label"><strong>Email:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_supervisor_email}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Other Monthly Income:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_other_monthly_income}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Other Monthly Income Reason:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_other_monthly_income_reason}}</span>
                                        </div>
                                    </div>
                                    
                                    

									<div class="row">
		                                <div class="col-print-12 sec-title">
		                        			<span>Emergency Contact</span>
		                        		</div>
		                        	</div>
                                        
                                    <div class="row">
                                        <div class="sssss col-print-12">
                                            <span class="label"><strong>Emergency Contact Name:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_name}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_phone}}</span>
           
                                            <span class="label"><strong>Address:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_address}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>City:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_city}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>State:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_state}}</span><span class="pipe"> | </span>
                                            <span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $db_data['PropertyApplication']->pa_emergency_contact_zip}}</span>
                                        </div>

	                                 </div>

									<div class="row">
		                                <div class="col-print-12 sec-title">
		                        			<span>List all occupants with date of birth and relationship to applicant (list additional on back if needed)</span>
		                        		</div>
		                        	</div>	

									<div class="row">
		                                <div class="sssss col-print-12">
	                                        <span class="label">.</span>
		                                </div>	
	                            	</div>
 	                            	 


		                            <div class="row">

		                                <div class="sssss col-print-6">
	                                        <span class="label">Signature of applicant:</span><span class="desc"><img src="{{asset('resources/files/e-signs/'.$db_data['PropertyApplication']->e_sign)}}" style="max-width:30% !important"  /></span>
		                                </div>	
		                                <div class="sssss col-print-3">
	                                        <span class="label">Print Name:</span><span class="desc">{{$db_data['PropertyApplication']->pa_applicant_name}}</span>
		                                </div>	
                                        <div class="sssss col-print-3">
                                            <span class="label">Date:</span><span class="desc"><?php echo date('m/d/Y h:i A'); ?></span>
                                        </div>	
 		                                
		                            </div>
  

		                            <div class="row">
		                                <div class="sssss col-print-12">
	                                        <span class="agreement">
	                                            I hereby state and represent that the information in this application is complete and accurate.  I understand that in the event a lease is entered into it may be     cancelled by the Landlord if any of the information provided in the application is materially inaccurate or incomplete.  I hereby authorize the Landlord or Landlord’s agents to verify the information on the application and correspond any information including personal, financial  and confidential regarding my application, delinquency  and tenancy via any electronic transmission . Verification or re-verification of any information contained in the application will be retained by Landlord.  I hereby authorize landlord and or agent to obtain information about me, including, but not limited to, this application, my credit, my tenant history, my check writing history, any court records and/or my criminal record, and I hereby authorize & instruct any entity or person contacted by the Landlord or Landlord’s agents to release such information to them. Upon request, Landlord, Landlord’s agents, will provide the name & phone number of the source of the information used in the verification process.  If any of the above information changes during the lease you must notify us in writing and must obtain our confirmation in writing within 5 days. I hereby authorize any landlord or landlord agents to accept any electronic communication for all occupants ("Electronic Notice") shall be deemed written notice for purposes. If sent to the electronic mail address of text message specified by the receiving part specified in the application, lease or any other method obtained by landlord. Electronic notice shall be deemed received at the time the party sending electronic receives verification of the receipt by the receiving party. Any party receiving Electronic notice may request and shall be entitled to receive the notice on paper, in a ("non-electronic notice") which shall be sent to the requesting party within 10 days of receipt of the written request for the non-electronic notice via certified mail to address listed on the lease to landlord or written  acceptance from  landlord. These notices will include personal and confidential information such as but not limited to" Financial delinquency, Method to collect a debt, notice to vacate, notice to quit, notice to enter
	                                        </span>
		                                </div>	
		                            </div>	

								</div>

									{{-- Fetch the CoApplicants From the Database --}}
									@php 
									$db_data['CoApplicants'] = App\Models\PropertyApplication::where('pa_parent_application_id',$db_data['PropertyApplication']->property_application_id)
																						->orderBy('property_application_id','asc')
																						->get();
									@endphp 

									@foreach($db_data['CoApplicants'] as $coapplicant	)
                                    <div class="add-print-page"></div>

									<div class="card-body">

										<div class="row" style="margin-top: 40px;">
											<div class="col-print-3">
												<span class="card-label fw-bolder fs-3 mb-1">Rental Application</span>
											</div>
											
											<div class="col-print-3">
												<span class="label">Date:</span><span class="desc" style="text-decoration: underline;"> {{ $coapplicant->pa_created_at}}</span>
											</div>
	
											<div class="col-print-6">
												<span class="label">Property:</span><span class="desc" style="text-decoration: underline;"> {{ $db_data['PropertyApplication']->p_title}}</span>
											</div>	
	
										</div>
	
										<div class="separator my-2"></div>
										
										<div class="row">
											<div class="col-print-12 sec-title">
												<span>Applicant Information</span>
											</div>
										</div>
										
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label"><strong>Name:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_name}}</span><span class="pipe"> | </span>
												<span class="label"><strong>SS#:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_social_sec_num}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Dri Lic #:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_driv_lic_num}}</span><span class="pipe"> | </span>
												<span class="label"><strong>DOB:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_dob}}</span>
			
												<span class="label"><strong>Email:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_email}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Own/Rent Monthly Payment $:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_own_or_rent_monthly_payment}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Phone#:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_phone_num}}</span>
											</div>
										</div>
										
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label"><strong>Address:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_current_add}}</span><span class="pipe"> | </span>
												<span class="label"><strong>City:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_current_city}}</span><span class="pipe"> | </span>
												<span class="label"><strong>State:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_current_state}}</span><span class="pipe"> | </span>
												<span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_current_zip}}</span>
	 
												<span class="label"><strong>Prev Address:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_previous_add}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Prev City:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_previous_city}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Prev State:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_pevious_state}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Prev ZIP:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_previous_zip}}</span>
				
												<span class="label"><strong>Landlord name:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_landlord_name}}</span><span class="pipe"> | </span>
												<span class="label"><strong>phone #:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_landlord_phone}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Reason for leaving :</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_reason_for_leaving}}</span>
		   
												<span class="label"><strong>Pets:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_have_pets}}<span class="pipe"> | </span> Type: {{ $coapplicant->pa_applicant_pet_type}}</span>
											</div>
										</div>
										
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label"><strong>Bankruptcy:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_bankruptcy}}<span class="pipe"> | </span> Year: {{ $coapplicant->pa_applicant_bankruptcy_year}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Lawsuit:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_lawsuites}}<span class="pipe"> | </span> Year: {{ $coapplicant->pa_applicant_lawsuites_year}}</span>
			 
												<span class="label"><strong>Ever Been Evicted:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_ever_evicted}}<span class="pipe"> | </span> Year: {{ $coapplicant->pa_applicant_felony_conviction}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Convicted of a felony?:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_felony_conviction}}<span class="pipe"> | </span> Year: {{ $coapplicant->pa_applicant_felony_conviction_year}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Judgements/filings:</strong></span><span class="desc"> {{ $coapplicant->pa_applicant_judgments_or_fillings}}<span class="pipe"> | </span> Year: {{ $coapplicant->pa_applicant_judgments_or_fillings_year}}</span>
											</div>
										</div>
	
										
										
										
										<div class="row">
											<div class="col-print-12 sec-title">
												<span>Employment Information</span>
											</div>
										</div>
										
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label"><strong>Employer Name:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_name}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Employment Length:</strong></span><span class="desc"> {{ $coapplicant->pa_employment_length}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_phone}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Position:</strong></span><span class="desc"> {{ $coapplicant->pa_employment_position}}</span>
	  
												<span class="label"><strong>Address:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_address}}</span><span class="pipe"> | </span>
												<span class="label"><strong>City:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_city}}</span><span class="pipe"> | </span>
												<span class="label"><strong>State:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_state}}</span><span class="pipe"> | </span>
												<span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $coapplicant->pa_employer_zip}}</span>
											</div>
											
											<div class="sssss col-print-12">
												<span class="label"><strong>Monthly income:</strong></span><span class="desc"> {{ $coapplicant->pa_monthly_income}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Supervisor Name:</strong></span><span class="desc"> {{ $coapplicant->pa_supervisor_name}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $coapplicant->pa_supervisor_phone}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Fax:</strong></span><span class="desc"> {{ $coapplicant->pa_supervisor_fax}}</span>
	 
												<span class="label"><strong>Email:</strong></span><span class="desc"> {{ $coapplicant->pa_supervisor_email}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Other Monthly Income:</strong></span><span class="desc"> {{ $coapplicant->pa_other_monthly_income}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Other Monthly Income Reason:</strong></span><span class="desc"> {{ $coapplicant->pa_other_monthly_income_reason}}</span>
											</div>
										</div>
										
										
	
										<div class="row">
											<div class="col-print-12 sec-title">
												<span>Emergency Contact</span>
											</div>
										</div>
											
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label"><strong>Emergency Contact Name:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_name}}</span><span class="pipe"> | </span>
												<span class="label"><strong>Phone:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_phone}}</span>
			   
												<span class="label"><strong>Address:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_address}}</span><span class="pipe"> | </span>
												<span class="label"><strong>City:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_city}}</span><span class="pipe"> | </span>
												<span class="label"><strong>State:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_state}}</span><span class="pipe"> | </span>
												<span class="label"><strong>ZIP:</strong></span><span class="desc"> {{ $coapplicant->pa_emergency_contact_zip}}</span>
											</div>
	
										 </div>
	
										<div class="row">
											<div class="col-print-12 sec-title">
												<span>List all occupants with date of birth and relationship to applicant (list additional on back if needed)</span>
											</div>
										</div>	
	
										<div class="row">
											<div class="sssss col-print-12">
												<span class="label">.</span>
											</div>	
										</div>
										  
	
	
										<div class="row">
	
											<div class="sssss col-print-6">
												<span class="label">Signature of applicant:</span><span class="desc"><img src="{{asset('resources/files/e-signs/'.$coapplicant->e_sign)}}" style="max-width:30% !important"  /></span>
											</div>	
											<div class="sssss col-print-3">
												<span class="label">Print Name:</span><span class="desc">{{$coapplicant->pa_applicant_name}}</span>
											</div>	
											<div class="sssss col-print-3">
												<span class="label">Date:</span><span class="desc"><?php echo date('m/d/Y h:i A'); ?></span>
											</div>	
											 
										</div>
	  
	
										<div class="row">
											<div class="sssss col-print-12">
												<span class="agreement">
													I hereby state and represent that the information in this application is complete and accurate.  I understand that in the event a lease is entered into it may be     cancelled by the Landlord if any of the information provided in the application is materially inaccurate or incomplete.  I hereby authorize the Landlord or Landlord’s agents to verify the information on the application and correspond any information including personal, financial  and confidential regarding my application, delinquency  and tenancy via any electronic transmission . Verification or re-verification of any information contained in the application will be retained by Landlord.  I hereby authorize landlord and or agent to obtain information about me, including, but not limited to, this application, my credit, my tenant history, my check writing history, any court records and/or my criminal record, and I hereby authorize & instruct any entity or person contacted by the Landlord or Landlord’s agents to release such information to them. Upon request, Landlord, Landlord’s agents, will provide the name & phone number of the source of the information used in the verification process.  If any of the above information changes during the lease you must notify us in writing and must obtain our confirmation in writing within 5 days. I hereby authorize any landlord or landlord agents to accept any electronic communication for all occupants ("Electronic Notice") shall be deemed written notice for purposes. If sent to the electronic mail address of text message specified by the receiving part specified in the application, lease or any other method obtained by landlord. Electronic notice shall be deemed received at the time the party sending electronic receives verification of the receipt by the receiving party. Any party receiving Electronic notice may request and shall be entitled to receive the notice on paper, in a ("non-electronic notice") which shall be sent to the requesting party within 10 days of receipt of the written request for the non-electronic notice via certified mail to address listed on the lease to landlord or written  acceptance from  landlord. These notices will include personal and confidential information such as but not limited to" Financial delinquency, Method to collect a debt, notice to vacate, notice to quit, notice to enter
												</span>
											</div>	
										</div>	
	
									</div>


									@endforeach
                                     


								<div class="card-footer">
									<div class="row">
										<div class="col-lg-9"></div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Application</button>
										</div>
									</div>
								</div>

								 

							</div>
							<!--begin::Body-->
						</div>
						<!--end::Tables Widget 9-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->

			</div>
		</div>

	</div>

@endsection

@section('page_level_scripts')
 	
 <script type="text/javascript">
 	
 	// A $( document ).ready() block.
	// $(document).ready(function() 
	// {
 //    	window.print();
	// });
 </script>	

@endsection
