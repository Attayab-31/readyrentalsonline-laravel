@if(session()->get('success'))
  
	<div class="alert alert-success alert-dismissible alert-additional fade show" role="alert">
		<div class="alert-content">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="d-flex">
				<div class="flex-shrink-0">
					<i class="ri-notification fs-16 align-middle"></i>
				</div>
				<div class="flex-grow-1">
					<h5 class="alert-heading"><i class="ri-check-double-line align-middle fs-16"></i> Success</h5>
					<p class="mb-0">{{ session()->get('success') }}</p>
				</div>
			</div>
		</div>
	</div>
 
@endif

@if(session()->get('failure'))
	<div class="alert alert-danger alert-dismissible alert-additional fade show" role="alert">
		<div class="alert-content">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="d-flex">
				<div class="flex-shrink-0">
					<i class="ri-notification fs-16 align-middle"></i>
				</div>
				<div class="flex-grow-1">
					<h5 class="alert-heading"><i class="ri-error-warning-line align-middle fs-16"></i> Error</h5>
					<p class="mb-0">{{ session()->get('failure') }}</p>
				</div>
			</div>
		</div>
	</div>
@endif				

@if(session()->get('warning'))
 
	<div class="alert alert-warning alert-dismissible alert-additional fade show" role="alert">
		<div class="alert-content">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="d-flex">
				<div class="flex-shrink-0">
					<i class="ri-notification fs-16 align-middle"></i>
				</div>
				<div class="flex-grow-1">
					<h5 class="alert-heading"><i class="ri-error-warning-line align-middle fs-16"></i> Warning</h5>
					<p class="mb-0">{{ session()->get('warning') }}</p>
				</div>
			</div>
		</div>
	</div>

@endif


@if($errors->any())
	<div class="alert alert-danger alert-dismissible alert-additional fade show" role="alert">
		<div class="alert-content">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<div class="d-flex">
				<div class="flex-shrink-0">
					<i class="ri-notification fs-16 align-middle"></i>
				</div>
				<div class="flex-grow-1">
					<h5 class="alert-heading"><i class="ri-error-warning-line align-middle fs-16"></i> Form submission error</h5>
					<p class="mb-0">Form contains following errors. Please correct and resubmit!</p>
					{{-- <ul class="mt-2">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul> --}}
				</div>
			</div>
		</div>
	</div>
 
@endif
 
 
<!-- Placeholder for AJAX alerts -->
<div id="ajax-alert" class="alert alert-dismissible alert-additional fade" role="alert" style="display: none;">
	<div class="alert-content">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<div class="d-flex">
			<div class="flex-shrink-0">
				<i class="ri-notification fs-16 align-middle"></i>
			</div>
			<div class="flex-grow-1">
				<h5 id="ajax-alert-heading" class="alert-heading"></h5>
				<p id="ajax-alert-message" class="mb-0"></p>
			</div>
		</div>
	</div>
</div>