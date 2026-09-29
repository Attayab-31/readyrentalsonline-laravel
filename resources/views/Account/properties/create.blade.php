@extends('layouts.accounts')

@section("styles")
@endsection

@section('content')
 
    <div class="row">
        <div class="col-xxl-12">
 


			<form class="form" action="{{ url('accounts/properties') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="card">
					<div class="card-header align-items-center d-flex">
						<h4 class="card-title mb-0 flex-grow-1">Add new Property!</h4>
					</div>
			
					
					<div class="card-body">
						<div class="row mt-1 mb-2">
							<div class="col-lg-12 bg-warning-subtle py-3">
								<div class="d-flex align-items-center">
									<div class="fw-bold">Property General Details
										<small class="text-muted fw-normal d-block">Leave unwanted fields as blank and they won't appear on the front end</small>
									</div>
								</div>
							</div>
						</div>
			
						<div class="form-group row">
							<div class="col-lg-4 mb-3">
								<label for="p_title" class="form-label">Title</label>
								<input type="text" class="form-control" id="p_title" name="p_title" value="{{ old('p_title') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_title">{{ $errors->first('p_title') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_listing_status" class="form-label">Status?</label>
								<select class="form-control" name="p_listing_status" id="p_listing_status">
									<option selected>--Select--</option>
									<option value="for-rent" @if(old('p_listing_status') == "for-rent") selected @endif>For Rent</option>
									<option value="for-sell" @if(old('p_listing_status') == "for-sell") selected @endif>For Sell</option>
								</select>
								<span class="form-text text-danger font-weight-bold" id="error_p_listing_status">{{ $errors->first('p_listing_status') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_price" class="form-label">Price</label>
								<input type="text" class="form-control" id="p_price" name="p_price" value="{{ old('p_price') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_price">{{ $errors->first('p_price') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_banner_image" class="form-label">Banner Image</label>
								<input type="file" class="form-control" id="p_banner_image" name="p_banner_image" value="{{ old('p_banner_image') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_banner_image">{{ $errors->first('p_banner_image') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_address" class="form-label">Address</label>
								<input type="text" class="form-control" id="p_address" name="p_address" value="{{ old('p_address') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_address">{{ $errors->first('p_address') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_area" class="form-label">Area</label>
								<input type="text" class="form-control" id="p_area" name="p_area" value="{{ old('p_area') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_area">{{ $errors->first('p_area') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_rooms" class="form-label"># of Rooms</label>
								<input type="text" class="form-control" id="p_rooms" name="p_rooms" value="{{ old('p_rooms') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_rooms">{{ $errors->first('p_rooms') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_bedrooms" class="form-label"># of Bedrooms</label>
								<input type="text" class="form-control" id="p_bedrooms" name="p_bedrooms" value="{{ old('p_bedrooms') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_bedrooms">{{ $errors->first('p_bedrooms') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="p_baths" class="form-label"># of Bathrooms</label>
								<input type="text" class="form-control" id="p_baths" name="p_baths" value="{{ old('p_baths') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_p_baths">{{ $errors->first('p_baths') }}</span>
							</div>
							<div class="col-lg-4 mb-3">
								<label for="b_year_built" class="form-label">Year Built</label>
								<input type="text" class="form-control" id="b_year_built" name="b_year_built" value="{{ old('b_year_built') }}" />
								<span class="form-text text-danger font-weight-bold" id="error_b_year_built">{{ $errors->first('b_year_built') }}</span>
							</div>
							<div class="col-lg-12 mb-3">
								<label for="p_map_location_markup" class="form-label">Location on Map <a href="https://www.embedgooglemap.net/" target="_blank">Genrate Code here</a></label>
								<textarea class="form-control" id="p_map_location_markup" name="p_map_location_markup">{{ old('p_map_location_markup') }}</textarea>
								<span class="form-text text-danger font-weight-bold" id="error_p_map_location_markup">{{ $errors->first('p_map_location_markup') }}</span>
							</div>
						</div>
			
						<div class="form-group row">
							<div class="col-lg-12 mb-3">
								<label for="p_short_description" class="form-label">Property Short Description</label>
								<textarea class="form-control" rows="5" id="p_short_description" name="p_short_description">{{ old('p_short_description') }}</textarea>
								<span class="form-text text-danger font-weight-bold" id="error_p_short_description">{{ $errors->first('p_short_description') }}</span>
							</div>
							<div class="col-lg-12 mb-3">
								<label for="p_description" class="form-label">Property Detailed Description</label>
								<textarea name="p_description" class="tinymceEditor form-control" id="p_description">{{ old('p_description') }}</textarea>
								<span class="form-text text-danger font-weight-bold" id="error_p_description">{{ $errors->first('p_description') }}</span>
							</div>
						</div>
					


					<div class="row mt-1 mb-2 ">
						<div class="col-lg-12 bg-warning-subtle py-3">
							<div class="d-flex align-items-center">
								<div class="fw-bold">Add Property Images <small class="text-danger">Recommended Image Size: 1904 X 1006</small>
								<small class="text-muted fw-normal d-block">You can upload multiple images </small>
								</div>
							</div>
						</div>
					</div>					

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="pa_title"><span class="form-error">{{$errors->first('pa_title')}}</span></label>  
								<div id="coba" class="row">
								</div>
							</div>
						</div>
					</div>
  
					<div class="row mt-1 mb-2 ">
						<div class="col-lg-12 bg-warning-subtle py-3">
							<div class="d-flex align-items-center">
								<div class="fw-bold">Add Property Features (Amenities)
								<small class="text-muted fw-normal d-block">Click + Button to add multiple records </small>
								</div>
							</div>
						</div>
					 </div>
					 
					 
					
					
					 <div class="row">
						<div class="col-md-12">
							<!--begin::Table container-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table align-middle gs-0 gy-4 table-bordered">
								<!--begin::Table head-->
								<thead>
									<tr class="fw-bolder text-muted bg-light">
										<th class="min-w-400px rounded-start">Amenity Title </th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody id="TextBoxContainer">
									<tr class="customer_records customer_records_dynamic">
										<td class="min-w-400px rounded-start">
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
						<div class="col-lg-12">
							<div class="text-end">
								<button type="submit" class="btn btn-primary" id="formSubmitBTN">Submit</button>
							</div>
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
      
 
		$('#formSubmitBTN').on('click', function (e) {
			e.preventDefault(); // Prevent default form submission

			// Clear all previous error messages
			$('span[id^="error_"]').text('');


			// Manually update the textarea with TinyMCE content
			tinymce.triggerSave();

			// Get the form element
			let form = $('.form')[0];
			let formData = new FormData(form);

			// Send the AJAX request
			$.ajax({
				url: form.action,
				type: form.method,
				data: formData,
				processData: false, // Prevent jQuery from automatically transforming the FormData object
				contentType: false, // Prevent jQuery from overriding the Content-Type header
				beforeSend: function () {
					$('#formSubmitBTN').attr('disabled', true).text('Submitting...');
				},
				success: function (response) {
					// Handle success response
					$('#formSubmitBTN').attr('disabled', false).text('Submit');
					$('html, body').animate({ scrollTop: 0 }, 'slow');
					if(response.success)
					{	
						showAjaxAlert('success', 'Success', 'Property added successfully!');
					}
					else
					{
						showAjaxAlert('warning', 'Warning', 'Something went wrong. Please try again.');
					}
				},
				error: function (xhr) {
					$('#formSubmitBTN').attr('disabled', false).text('Submit');

					if (xhr.status === 422) {
						// Validation error
						let errors = xhr.responseJSON.errors;
						for (let field in errors) {
							// Display each error in its corresponding span
							let errorSpan = $('#error_' + field);
							if (errorSpan.length) {
								errorSpan.text(errors[field][0]); // Show the first error message
							}
						}

						// Scroll to the top of the form
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