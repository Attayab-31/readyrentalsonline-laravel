@extends('layouts.accounts')
@section("styles")




@endsection
@section('content')



<style type="text/css">
	.card .card-body 
	{
		padding: 0rem 1rem;
	}

	.pro-image
	{
	  height: 150px; 
	  width: 200px;
	}
</style>
<div class="row">
   <div class="col-xxl-12">
 


	<form class="form" id="editPropertyForm" action="{{ url('accounts/properties/'.$db_data['Property']->property_id) }}" method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PATCH">
		@csrf


		<div class="card">
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Update Property!</h4>
			</div><!-- end card header -->

		<div class="card-body">
			
			
			<div class="row mt-1 mb-2 ">
				<div class="col-lg-12 bg-warning-subtle py-3">
					<div class="d-flex align-items-center">
						<div class="fw-bold">Property General Details
						<small class="text-muted fw-normal d-block">Leave unwanted fields as blank and they wont apear on the front end </small>
						</div>
					</div>
				</div>
			</div>

		   <div class="form-group row">
			  <div class="col-lg-4 mb-3">
				 <label for="p_title" class="form-label">Title</label>
				 <input type="text" class="form-control" id="p_title" name="p_title" value="{{ $db_data['Property']->p_title }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_title">{{ $errors->first('p_title') }}</span>
			  </div>
			  
			  <div class="col-lg-4 mb-3">
				 <label for="p_listing_status" class="form-label">Status?</label>
				 <select class="form-control" name="p_listing_status" id="p_listing_status" aria-label="Default select example">
					<option selected>--Select--</option>
					<option value="for-rent" @if($db_data['Property']->p_listing_status == "for-rent") selected @endif>For Rent</option>
					<option value="for-sell" @if($db_data['Property']->p_listing_status == "for-sell") selected @endif>For Sell</option>
				 </select>
				 <span class="form-text text-danger font-weight-bold" id="error_p_listing_status">{{ $errors->first('p_listing_status') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3">
				 <label for="p_price" class="form-label">Price</label>
				 <input type="text" class="form-control" id="p_price" name="p_price" value="{{ $db_data['Property']->p_price }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_price">{{ $errors->first('p_price') }}</span>
			  </div>
			  <div class="col-lg-2 mb-7"> 
				 <label for="p_banner_image" class="form-label">Current Banner Image</label>
				 <img src="{{ asset('resources/files/dynamic/'.$db_data['Property']->p_banner_image) }}"  style="max-width: 100px;">
				 <span class="form-text text-danger font-weight-bold" id="error_p_banner_image">{{ $errors->first('p_banner_image') }}</span>
			  </div>
			  <div class="col-lg-2 mb-7"> 
				 <label for="p_banner_image" class="form-label">Banner Image</label>
				 <input type="file" class="form-control" id="p_banner_image" name="p_banner_image" value="{{ $db_data['Property']->p_banner_image }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_banner_image">{{ $errors->first('p_banner_image') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3">
				 <label for="p_address" class="form-label">Address</label>
				 <input type="text" class="form-control" id="p_address" name="p_address" value="{{ $db_data['Property']->p_address }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_address">{{ $errors->first('p_address') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3"> 
				 <label for="p_area" class="form-label">Area</label>
				 <input type="text" class="form-control" id="p_area" name="p_area" value="{{ $db_data['Property']->p_area }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_area">{{ $errors->first('p_area') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3"> 
				 <label for="p_rooms" class="form-label"># of Rooms</label>
				 <input type="text" class="form-control" id="p_rooms" name="p_rooms" value="{{ $db_data['Property']->p_rooms }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_rooms">{{ $errors->first('p_rooms') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3">
				 <label for="p_bedrooms" class="form-label"># of Bedrooms</label>
				 <input type="text" class="form-control" id="p_bedrooms" name="p_bedrooms" value="{{ $db_data['Property']->p_bedrooms }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_bedrooms">{{ $errors->first('p_bedrooms') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3">
				 <label for="p_baths" class="form-label"># of Bathrooms</label>
				 <input type="text" class="form-control" id="p_baths" name="p_baths" value="{{ $db_data['Property']->p_baths }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_p_baths">{{ $errors->first('p_baths') }}</span>
			  </div>
			  <div class="col-lg-4 mb-3">
				 <label for="b_year_built" class="form-label">Year Built</label>
				 <input type="text" class="form-control" id="b_year_built" name="b_year_built" value="{{ $db_data['Property']->b_year_built }}"  />
				 <span class="form-text text-danger font-weight-bold" id="error_b_year_built">{{ $errors->first('b_year_built') }}</span>
			  </div>
			  <div class="col-lg-12 mb-3">
				 <label for="p_map_location_markup" class="form-label">Location on Map (Paste Code)</label> <a href="https://www.embedgooglemap.net/" target="_blank">Genrate Code here</a>
				 <textarea class="form-control" id="p_map_location_markup" name="p_map_location_markup">{{ $db_data['Property']->p_map_location_markup }}</textarea>
				 <span class="form-text text-danger font-weight-bold" id="error_p_map_location_markup">{{ $errors->first('p_map_location_markup') }}</span>
			  </div>
		   </div>
		   <div class="py-2 mt-2 mb-2">
			  <div class="d-flex align-items-center rounded py-3 px-3 bg-light-info">
				 <div class="symbol symbol-50px w-35px bg-light">
					<i class="fas fa-exclamation-circle fs-1"></i>
				 </div>
				 <div class="text-gray-700 fw-bold fs-6 ">Property Details
				 </div>
			  </div>
		   </div>



		   <div class="form-group row">
			<div class="col-lg-12 mb-7"> 
				<label for="p_short_description" class="form-label">Property Short Description <small>Will apear on property listings Grid </small> <span class="form-text text-danger font-weight-bold" id="error_p_short_description">{{ $errors->first('p_short_description') }}</span></label>
				<textarea class="form-control" rows="5" id="p_short_description" name="p_short_description">{{ $db_data['Property']->p_short_description }}</textarea>
				
			</div>
			<div class="col-lg-12 mb-7">
				<!--begin::Block-->
				<div class="py-5">
					<label for="p_description" class="form-label">Property Detailed Description <small>(Will apear on property details page)</small> <span class="form-text text-danger font-weight-bold" id="error_p_description">{{ $errors->first('p_description') }}</span></label>
					<textarea name="p_description" class="tinymceEditor form-control" id="p_description">{{$db_data['Property']->p_description}}</textarea>
				</div>
				<!--end::Block-->
			</div>
		</div>


 
		   <div class="py-2 mt-10 mb-2">
			  <div class="d-flex align-items-center rounded py-3 px-3 bg-light-info">
				 <div class="symbol symbol-50px w-35px bg-light">
					<i class="fas fa-exclamation-circle fs-1"></i>
				 </div>
				 <div class="text-gray-700 fw-bold fs-6">Add Property Images <small class="text-danger">Recommended Image Size: 1904 X 1006</small>
					<small class="text-muted fw-normal d-block">You can upload multiple images</small>
				 </div>
			  </div>
		   </div>
		   <div class="row mb-5">
			  <div class="col-md-12 mb-5">
				 <b>Previosuly added images.</b> <small>Select those you want to delete</small>
				 <br>
			  </div>
			  <?php
				 $image_counter = 0;
				 foreach ($db_data['PropertyImage'] as $image)
				 {
				   $image_counter++;
				   $image_path = asset('resources/files/dynamic/'.$image->pi_image_name);
				 ?>  
			  <div class="col-md-3 mb-2">
				 <div class="form-group">
					<label class="container"><img class="pro-image" src="<?php echo $image_path ?>">
					<input type="checkbox" name="images_to_delete[]" value="<?php echo $image->property_image_id  ?>">
					<span class="checkmark"></span>
					</label>
				 </div>
			  </div>
			  <?php 
				 }
				 ?>	
		   </div>
		   <div class="row">
			  <div class="col-md-12 mb-1">
				 <b>Upload new Images.</b>
				 <br>
			  </div>
			  <div class="col-md-12">
				 <div class="form-group">
					<label for="pa_title"><span class="form-error">{{$errors->first('pa_title')}}</span></label>  
					<div id="coba" class="row">
					</div>
				 </div>
			  </div>
		   </div>
		   <div class="py-2 mt-10 mb-2">
			  <div class="d-flex align-items-center rounded py-3 px-3 bg-light-info">
				 <div class="symbol symbol-50px w-35px bg-light">
					<i class="fas fa-exclamation-circle fs-1"></i>
				 </div>
				 <div class="text-gray-700 fw-bold fs-6 ">Add Property Features (Amenites)
					<small class="text-muted fw-normal d-block">Click + Button to add multiple records</small>
				 </div>
			  </div>
		   </div>
		   <div class="col-md-12 mb-5">
			  <b>Previosuly added Amenities.</b> <small>Select those you want to delete or update</small>
			  <br>
		   </div>
		   <div class="row">
			  <div class="col-md-12">
				 <div class="table-responsive">
					<table class="table align-middle gs-0 gy-4 table-bordered">
					   <tr>
						  <th>Amenity Title</th>
						  <th>Select to Delete</th>
					   </tr>
					   <tbody>
						  <?php 
							 if($db_data['PropertyAmenity']->count() > 0)
							 {
							 
							   foreach ($db_data['PropertyAmenity'] as $amenty)
							   {
							   ?>  
						  <tr class="customer_records">
							 <input type="hidden" name="property_amenties_to_update[]" value="<?php echo $amenty->property_amenity_id ?>"> 
							 <td><input type="text" placeholder="Type... "  class="form-control example1" name="current_pa_title[]"  value="<?php echo $amenty->pa_title ?>" ></td>
							 <td><input type="checkbox" name="addtional_amenities_to_delete[]" value="<?php echo $amenty->property_amenity_id ?>"></td>
						  </tr>
						  <?php 
							 }
							 }
							 else
							 {
							 ?>
						  <tr>
							 <td colspan="4" style="text-align: center;">You have not uploaded any images </td>
						  </tr>
						  <?php 
							 }
							 ?>    
					   </tbody>
					</table>
				 </div>
			  </div>
		   </div>
		   <div class="col-md-12 mb-5">
			  <b>Add New Amenities</b>
			  <br>
		   </div>
		   <div class="row">
			  <div class="col-md-12">
				 <div class="table table-respondsive">
					<table class="table table-responssive table-bordered">
					   <tr>
						  <th>Amenity Title</th>
						  <th class="text-end">Action</th>
					   </tr>
					   <tbody id="TextBoxContainer">
						  <tr class="customer_records customer_records_dynamic">
							 <td>
								<input type="text"  placeholder="Example: Air Conditioning"  class="form-control example1"  name="pa_title[]"  value="{{ old('pa_title[]') }}" >
							 </td>
							 <td class="text-end">
								<button id="btnAdd" type="button" class="btn btn-primary"><i class="bx bx-plus-medical"></i></button>
							 </td>
						  </tr>
					   </tbody>
					</table>
				 </div>
			  </div>
		   </div>
		</div>
		<div class="card-footer">
		   <div class="row">
			  <div class="col-lg-9"></div>
			  <div class="col-lg-3">
				 <button type="submit" class="btn btn-primary mr-2" id="editFormSubmitBTN">Submit</button>
				 {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
			  </div>
		   </div>
		</div>
	 </form>
  

   </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   $( document ).ready(function() {
   
        $("#btnAdd").bind("click", function () {
            var div = $("<tr />");
            div.html(GetDynamicTextBox(""));
            $("#TextBoxContainer").append(div);
        });
   
        $("body").on("click", ".remove", function () 
        {
            $(this).closest("tr").remove();
        });
         
   
        function GetDynamicTextBox(value)
        {
          return '<td><input type="text"  placeholder="Example: Air Conditioning"  class="form-control example1"  name="pa_title[]"  value="{{ old('pa_title[]') }}" ></td><td class="text-end"><button type="button" class="btn btn-danger remove"><i class="bx bx-trash"></i></button></td>';
        }
   
        $("#coba").spartanMultiImagePicker({
			fieldName:        'fileUpload[]',
			maxCount:         15,
			rowHeight:        '200px',
			groupClassName:   'col-md-3 col-sm-3 col-xs-6',
			maxFileSize:      '',
			placeholderImage: {
				image: '{{ asset('controlPanel/multi-img-picker/placeholder.png') }}',
						width : '100%'
			},
			dropFileLabel : "Drop Here",
			onAddRow:       function(index){
				console.log(index);
				console.log('add new row');
			},
			onRenderedPreview : function(index){
				console.log(index);
				console.log('preview rendered');
			},
			onRemoveRow : function(index){
				console.log(index);
			},
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
			});
    
			


			$('#editPropertyForm').submit(function(e) {
				
			e.preventDefault(); // Prevent default form submission

			// Clear all previous error messages
			$('span[id^="error_"]').text('');

			// Get the form element
			let form = $('#editPropertyForm')[0];
			let formData = new FormData(form);

			// Manually update TinyMCE content (if used)
			tinymce.triggerSave();

			// Send the AJAX request
			$.ajax({
				url: form.action,
				type: form.method,
				data: formData,
				processData: false, // Prevent jQuery from transforming FormData
				contentType: false, // Prevent jQuery from overriding Content-Type
				beforeSend: function () {
					$('#editFormSubmitBTN').attr('disabled', true).text('Submitting...');
				},
				success: function (response) {
					$('#editFormSubmitBTN').attr('disabled', false).text('Submit');

					if (response.success) {
						// Show success alert
						showAjaxAlert('success', 'Success', response.message);

						// Optional redirect
						if (response.redirect_url) {
							setTimeout(function () {
								window.location.href = response.redirect_url;
							}, 2000);
						}
					} else {
						showAjaxAlert('warning', 'Warning', response.message);
					}
				},
				error: function (xhr) {
					$('#editFormSubmitBTN').attr('disabled', false).text('Submit');

					if (xhr.status === 422) {
						// Handle validation errors
						let errors = xhr.responseJSON.errors;
						for (let field in errors) {
							let errorSpan = $('#error_' + field);
							if (errorSpan.length) {
								errorSpan.text(errors[field][0]); // Show the first error
							}
						}

						showAjaxAlert('error', 'Validation Error', 'Please fix the errors in the form and try again.');
						$('html, body').animate({ scrollTop: 0 }, 'slow');
					} else {
						showAjaxAlert('error', 'Error', 'An unexpected error occurred. Please try again.');
					}
				},
			});

		});





	});
    
</script>
@endsection