@extends('layouts.accounts')

@section("styles")
<link rel="stylesheet" href="{{ asset('controlPanel/libs/leaflet/leaflet.css') }}">
<style>
.rr-add-property-form .card-body { padding: clamp(1rem, 2vw, 1.75rem); }
.rr-add-property-form .rr-form-section { margin: 1.75rem 0 1.15rem; padding: 0 0 .75rem; border-bottom: 1px solid var(--rr-border, #dce4eb); }
.rr-add-property-form .rr-form-section:first-child { margin-top: 0; }
.rr-add-property-form .rr-form-section h2 { margin: 0; font-size: 1.1rem; font-weight: 700; letter-spacing: -.01em; }
.rr-add-property-form .rr-form-section p { margin: .3rem 0 0; color: var(--rr-text-secondary, #627487); font-size: .875rem; }
.rr-add-property-form .rr-form-grid { row-gap: .65rem; }
.rr-add-property-form .form-label { font-weight: 600; }
.rr-add-property-form .rr-required { color: #dc3545; margin-left: .2rem; }
.rr-add-property-form .rr-upload-zone { position: relative; display: grid; min-height: 150px; place-items: center; padding: 1.25rem; border: 1.5px dashed #9aabba; border-radius: 12px; background: var(--rr-surface-subtle, #f8fafc); text-align: center; transition: border-color .18s ease, background-color .18s ease, box-shadow .18s ease; }
.rr-add-property-form .rr-upload-zone:hover,
.rr-add-property-form .rr-upload-zone.is-dragover,
.rr-add-property-form .rr-upload-zone:focus-within { border-color: var(--rr-slate-500, #2b5f8e); background: rgba(43, 95, 142, .06); box-shadow: 0 0 0 3px rgba(43, 95, 142, .12); }
.rr-add-property-form .rr-upload-input { position: absolute; width: 1px; height: 1px; padding: 0; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; clip-path: inset(50%); }
.rr-add-property-form .rr-upload-label { display: grid; justify-items: center; gap: .35rem; margin: 0; cursor: pointer; }
.rr-add-property-form .rr-upload-icon { color: var(--rr-slate-600, #2b5f8e); font-size: 1.8rem; }
.rr-add-property-form .rr-upload-title { font-weight: 700; }
.rr-add-property-form .rr-upload-help, .rr-add-property-form .rr-upload-filename { color: var(--rr-text-secondary, #627487); font-size: .85rem; }
.rr-add-property-form .rr-image-preview-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: .75rem; margin-top: .75rem; }
.rr-add-property-form .rr-image-preview-card { position: relative; min-width: 0; overflow: hidden; border: 1px solid var(--rr-border, #dce4eb); border-radius: 10px; background: #fff; }
.rr-add-property-form .rr-image-preview-card img { display: block; width: 100%; aspect-ratio: 16 / 10; object-fit: cover; }
.rr-add-property-form .rr-image-preview-name { overflow: hidden; padding: .45rem .55rem; color: var(--rr-text-secondary, #627487); font-size: .75rem; text-overflow: ellipsis; white-space: nowrap; }
.rr-add-property-form .rr-image-preview-remove { position: absolute; top: .4rem; right: .4rem; display: grid; width: 30px; height: 30px; place-items: center; padding: 0; border: 0; border-radius: 50%; background: rgba(15, 31, 46, .82); color: #fff; }
.rr-add-property-form .rr-image-preview-remove:hover { background: #b42318; color: #fff; }
html[data-bs-theme="dark"] .rr-add-property-form .rr-image-preview-card { background: #142333; border-color: #42576a; }
.rr-add-property-form .rr-map-field { min-width: 0; overflow: hidden; }
.rr-add-property-form .rr-map-frame { position: relative; isolation: isolate; width: 100%; max-width: 100%; min-width: 0; overflow: hidden; border: 1px solid var(--rr-border, #dce4eb); border-radius: 12px; background: #e9f0f5; }
.rr-add-property-form .rr-map-picker { position: relative; width: 100%; max-width: 100%; height: clamp(280px, 45vh, 420px); min-width: 0; box-sizing: border-box; overflow: hidden; }
.rr-add-property-form .rr-map-picker.leaflet-container { width: 100%; max-width: 100%; height: clamp(280px, 45vh, 420px); }
.rr-add-property-form .rr-map-picker .leaflet-control-container { max-width: 100%; }
.rr-add-property-form .tox-tinymce { border-radius: 10px; }
html[data-bs-theme="dark"] .rr-add-property-form .rr-upload-zone { background: #142333; border-color: #42576a; }
html[data-bs-theme="dark"] .rr-add-property-form .rr-form-section { border-color: #34485b; }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <form class="form rr-add-property-form" action="{{ url('accounts/properties') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h1 class="card-title mb-0 flex-grow-1 h4">Add New Property</h1>
                </div>

                <div class="card-body">
                    <section class="rr-form-section" aria-labelledby="property-general-heading">
                        <h2 id="property-general-heading">Property General Details</h2>
                        <p>Fields marked with <span class="rr-required" aria-hidden="true">*</span> are required. Optional details may be left blank.</p>
                    </section>

                    <div class="form-group row rr-form-grid">
                        <div class="col-lg-4 mb-3">
                            <label for="p_title" class="form-label">Title<span class="rr-required" aria-hidden="true">*</span></label>
                            <input type="text" class="form-control" id="p_title" name="p_title" value="{{ old('p_title') }}" required aria-required="true" aria-describedby="error_p_title">
                            <span class="form-text text-danger font-weight-bold" id="error_p_title">{{ $errors->first('p_title') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_listing_status" class="form-label">Status<span class="rr-required" aria-hidden="true">*</span></label>
                            <select class="form-control" name="p_listing_status" id="p_listing_status" required aria-required="true" aria-describedby="error_p_listing_status">
                                <option value="" disabled @if(!old('p_listing_status')) selected @endif>Choose a listing status</option>
                                <option value="for-rent" @if(old('p_listing_status') == 'for-rent') selected @endif>For Rent</option>
                                <option value="for-sell" @if(old('p_listing_status') == 'for-sell') selected @endif>For Sale</option>
                            </select>
                            <span class="form-text text-danger font-weight-bold" id="error_p_listing_status">{{ $errors->first('p_listing_status') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_price" class="form-label">Price<span class="rr-required" aria-hidden="true">*</span></label>
                            <input type="number" min="0" step="0.01" class="form-control" id="p_price" name="p_price" value="{{ old('p_price') }}" required aria-required="true" aria-describedby="error_p_price">
                            <span class="form-text text-danger font-weight-bold" id="error_p_price">{{ $errors->first('p_price') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_address" class="form-label">Address<span class="rr-required" aria-hidden="true">*</span></label>
                            <input type="text" class="form-control" id="p_address" name="p_address" value="{{ old('p_address') }}" required aria-required="true" aria-describedby="error_p_address" autocomplete="street-address">
                            <span class="form-text text-danger font-weight-bold" id="error_p_address">{{ $errors->first('p_address') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_area" class="form-label">Area</label>
                            <input type="text" class="form-control" id="p_area" name="p_area" value="{{ old('p_area') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_p_area">{{ $errors->first('p_area') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_rooms" class="form-label">Rooms</label>
                            <input type="number" min="0" step="1" class="form-control" id="p_rooms" name="p_rooms" value="{{ old('p_rooms') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_p_rooms">{{ $errors->first('p_rooms') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_bedrooms" class="form-label">Bedrooms</label>
                            <input type="number" min="0" step="1" class="form-control" id="p_bedrooms" name="p_bedrooms" value="{{ old('p_bedrooms') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_p_bedrooms">{{ $errors->first('p_bedrooms') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="p_baths" class="form-label">Bathrooms</label>
                            <input type="number" min="0" step="1" class="form-control" id="p_baths" name="p_baths" value="{{ old('p_baths') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_p_baths">{{ $errors->first('p_baths') }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="b_year_built" class="form-label">Year Built</label>
                            <input type="number" min="1700" max="2100" step="1" class="form-control" id="b_year_built" name="b_year_built" value="{{ old('b_year_built') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_b_year_built">{{ $errors->first('b_year_built') }}</span>
                        </div>
                        <div class="col-12 mb-3 rr-map-field">
                            <div class="form-label" id="location-map-label">Location on Map</div>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <button type="button" class="btn btn-outline-primary" id="locate-property-address"><i class="ri-search-line me-1" aria-hidden="true"></i>Find address on map</button>
                                <span class="small align-self-center text-muted">or click the map to place the pin</span>
                            </div>
                            <div class="rr-map-frame">
                                <div class="rr-map-picker" id="property-location-map" data-tile-url="{{ config('services.openstreetmap.tile_url', 'https://tile.openstreetmap.org/{z}/{x}/{y}.png') }}" role="region" aria-labelledby="location-map-label"></div>
                            </div>
                            <p class="small mb-0" id="property-map-status" aria-live="polite"></p>
                            <input type="hidden" id="p_map_location_markup" name="p_map_location_markup" value="{{ old('p_map_location_markup') }}">
                            <span class="form-text text-danger font-weight-bold" id="error_p_map_location_markup">{{ $errors->first('p_map_location_markup') }}</span>
                        </div>
                    </div>

                    <section class="rr-form-section" aria-labelledby="property-banner-heading">
                        <h2 id="property-banner-heading">Banner Image<span class="rr-required" aria-hidden="true">*</span></h2>
                        <p>Upload the primary property photo. PNG, JPG, GIF, or WebP.</p>
                    </section>
                    <div class="mb-4">
                        <div class="rr-upload-zone" id="banner-upload-zone">
                            <input type="file" class="rr-upload-input" id="p_banner_image" name="p_banner_image" accept="image/png,image/jpeg,image/gif,image/webp" required aria-required="true" aria-describedby="banner-upload-help banner-upload-filename error_p_banner_image">
                            <label class="rr-upload-label" for="p_banner_image">
                                <i class="ri-upload-cloud-2-line rr-upload-icon" aria-hidden="true"></i>
                                <span class="rr-upload-title">Choose an image or drag it here</span>
                                <span class="rr-upload-help" id="banner-upload-help">Select one banner image</span>
                            </label>
                            <span class="rr-upload-filename" id="banner-upload-filename" aria-live="polite">No image selected</span>
                        </div>
                        <div class="rr-image-preview-grid" id="banner-image-preview" aria-live="polite"></div>
                        <span class="form-text text-danger font-weight-bold" id="error_p_banner_image">{{ $errors->first('p_banner_image') }}</span>
                    </div>

                    <div class="form-group row rr-form-grid">
                        <div class="col-12 mb-3">
                            <label for="p_short_description" class="form-label">Short Description<span class="rr-required" aria-hidden="true">*</span></label>
                            <textarea class="form-control" rows="3" id="p_short_description" name="p_short_description" required aria-required="true" aria-describedby="error_p_short_description">{{ old('p_short_description') }}</textarea>
                            <span class="form-text text-danger font-weight-bold" id="error_p_short_description">{{ $errors->first('p_short_description') }}</span>
                        </div>
                        <div class="col-12 mb-4 property-description-field">
                            <label for="p_description" class="form-label fw-semibold">Property Detailed Description<span class="rr-required" aria-hidden="true">*</span></label>
                            <textarea name="p_description" rows="14" placeholder="Describe the property, its layout, features, and nearby amenities." class="tinymceEditor form-control" id="p_description" aria-required="true" aria-describedby="error_p_description">{{ old('p_description') }}</textarea>
                            <span class="form-text text-danger font-weight-bold" id="error_p_description">{{ $errors->first('p_description') }}</span>
                        </div>
                    </div>

                    <section class="rr-form-section" aria-labelledby="property-images-heading">
                        <h2 id="property-images-heading">Add Property Images</h2>
                        <p>Upload up to 15 gallery images. Recommended image size: 1904 × 1006.</p>
                    </section>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="rr-upload-zone" id="gallery-upload-zone">
                                    <input type="file" class="rr-upload-input" id="property-gallery-input" name="fileUpload[]" accept="image/png,image/jpeg,image/gif,image/webp" multiple aria-describedby="gallery-upload-help gallery-upload-status error_fileUpload">
                                    <label class="rr-upload-label" for="property-gallery-input">
                                        <i class="ri-upload-cloud-2-line rr-upload-icon" aria-hidden="true"></i>
                                        <span class="rr-upload-title">Choose images or drag them here</span>
                                        <span class="rr-upload-help" id="gallery-upload-help">PNG, JPG, GIF, or WebP · Up to 15 images</span>
                                    </label>
                                    <span class="rr-upload-filename" id="gallery-upload-status" aria-live="polite">No gallery images selected</span>
                                </div>
                                <div class="rr-image-preview-grid" id="gallery-image-previews" aria-live="polite"></div>
                                <span class="form-text text-danger font-weight-bold" id="error_fileUpload">{{ $errors->first('fileUpload') }}</span>
                            </div>
                        </div>
                    </div>

                    <section class="rr-form-section" aria-labelledby="property-features-heading">
                        <h2 id="property-features-heading">Property Features</h2>
                        <p>Add amenities to help renters understand what the property offers.</p>
                    </section>
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th scope="col">Amenity Title</th>
                                    <th scope="col" class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="TextBoxContainer">
                                <tr class="customer_records customer_records_dynamic">
                                    <td><input type="text" placeholder="Example: Air Conditioning" class="form-control example1" name="pa_title[]" value="{{ old('pa_title.0') }}" aria-label="Amenity title"></td>
                                    <td class="text-end"><button id="btnAdd" type="button" class="btn btn-primary" aria-label="Add amenity"><i class="bx bx-plus-medical" aria-hidden="true"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="formSubmitBTN">Save Property</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('controlPanel/libs/leaflet/leaflet.js') }}"></script>
<script type="text/javascript">

	$( document ).ready(function() {

		function isSupportedImage(file) {
			return /^image\/(png|jpe?g|gif|webp)$/i.test(file.type) || /\.(png|jpe?g|gif|webp)$/i.test(file.name);
		}
		function makeImagePreview(file, onRemove) {
			var card = document.createElement('div');
			card.className = 'rr-image-preview-card';
			var imageUrl = URL.createObjectURL(file);
			var image = document.createElement('img');
			image.src = imageUrl;
			image.alt = file.name;
			var remove = document.createElement('button');
			remove.type = 'button';
			remove.className = 'rr-image-preview-remove';
			remove.setAttribute('aria-label', 'Remove ' + file.name);
			remove.innerHTML = '<i class="ri-close-line" aria-hidden="true"></i>';
			remove.addEventListener('click', function () { URL.revokeObjectURL(imageUrl); onRemove(); });
			var name = document.createElement('div');
			name.className = 'rr-image-preview-name';
			name.title = file.name;
			name.textContent = file.name;
			card.appendChild(image);
			card.appendChild(remove);
			card.appendChild(name);
			return { element: card, url: imageUrl };
		}

		var uploadZone = document.getElementById('banner-upload-zone');
		var bannerInput = document.getElementById('p_banner_image');
		var uploadFilename = document.getElementById('banner-upload-filename');
		var bannerPreview = document.getElementById('banner-image-preview');
		var bannerPreviewUrl = null;
		if (uploadZone && bannerInput && uploadFilename && bannerPreview) {
			bannerInput.addEventListener('change', function () {
				var file = bannerInput.files.length ? bannerInput.files[0] : null;
				uploadFilename.textContent = file ? file.name : 'No image selected';
				if (bannerPreviewUrl) URL.revokeObjectURL(bannerPreviewUrl);
				bannerPreviewUrl = null;
				bannerPreview.replaceChildren();
				if (file && isSupportedImage(file)) {
					var preview = makeImagePreview(file, function () {
						bannerInput.value = '';
						bannerInput.dispatchEvent(new Event('change', { bubbles: true }));
					});
					bannerPreviewUrl = preview.url;
					bannerPreview.appendChild(preview.element);
				}
			});
			['dragenter', 'dragover'].forEach(function (eventName) {
				uploadZone.addEventListener(eventName, function (event) {
					event.preventDefault();
					uploadZone.classList.add('is-dragover');
				});
			});
			['dragleave', 'dragend', 'drop'].forEach(function (eventName) {
				uploadZone.addEventListener(eventName, function (event) {
					event.preventDefault();
					uploadZone.classList.remove('is-dragover');
				});
			});
			uploadZone.addEventListener('drop', function (event) {
				var files = event.dataTransfer && event.dataTransfer.files;
				if (!files || !files.length) return;
				var transfer = new DataTransfer();
				transfer.items.add(files[0]);
				bannerInput.files = transfer.files;
				bannerInput.dispatchEvent(new Event('change', { bubbles: true }));
			});
		}

		var galleryZone = document.getElementById('gallery-upload-zone');
		var galleryInput = document.getElementById('property-gallery-input');
		var galleryStatus = document.getElementById('gallery-upload-status');
		var galleryPreviews = document.getElementById('gallery-image-previews');
		if (galleryZone && galleryInput && galleryStatus && galleryPreviews) {
			var galleryFiles = [];
			var galleryPreviewUrls = [];
			function syncGalleryInput() {
				var transfer = new DataTransfer();
				galleryFiles.forEach(function (file) { transfer.items.add(file); });
				galleryInput.files = transfer.files;
			}
			function renderGalleryPreviews() {
				galleryPreviewUrls.forEach(function (url) { URL.revokeObjectURL(url); });
				galleryPreviewUrls = [];
				galleryPreviews.replaceChildren();
				galleryFiles.forEach(function (file, index) {
					var preview = makeImagePreview(file, function () {
						galleryFiles.splice(index, 1);
						syncGalleryInput();
						renderGalleryPreviews();
					});
					galleryPreviewUrls.push(preview.url);
					galleryPreviews.appendChild(preview.element);
				});
				galleryStatus.textContent = galleryFiles.length ? galleryFiles.length + ' of 15 images selected' : 'No gallery images selected';
			}
			function addGalleryFiles(files) {
				var skipped = false;
				Array.from(files || []).forEach(function (file) {
					if (!isSupportedImage(file)) { skipped = true; return; }
					var duplicate = galleryFiles.some(function (existing) {
						return existing.name === file.name && existing.size === file.size && existing.lastModified === file.lastModified;
					});
					if (!duplicate && galleryFiles.length < 15) galleryFiles.push(file);
					else if (!duplicate) skipped = true;
				});
				syncGalleryInput();
				renderGalleryPreviews();
				if (skipped) galleryStatus.textContent = galleryFiles.length + ' of 15 images selected. Unsupported images or images over the limit were skipped.';
			}
			galleryInput.addEventListener('change', function () { addGalleryFiles(galleryInput.files); });
			['dragenter', 'dragover'].forEach(function (eventName) {
				galleryZone.addEventListener(eventName, function (event) {
					event.preventDefault();
					galleryZone.classList.add('is-dragover');
				});
			});
			['dragleave', 'dragend', 'drop'].forEach(function (eventName) {
				galleryZone.addEventListener(eventName, function (event) {
					event.preventDefault();
					galleryZone.classList.remove('is-dragover');
				});
			});
			galleryZone.addEventListener('drop', function (event) {
				addGalleryFiles(event.dataTransfer && event.dataTransfer.files);
			});
		}

		var mapElement = document.getElementById('property-location-map');
		var mapMarkupField = document.getElementById('p_map_location_markup');
		var locateButton = document.getElementById('locate-property-address');
		var addressField = document.getElementById('p_address');
		var mapStatus = document.getElementById('property-map-status');
		if (window.L && mapElement && mapMarkupField) {
			var propertyMap = L.map(mapElement, { scrollWheelZoom: false }).setView([39.7357, -75.1312], 12);
			var propertyPinIcon = L.icon({
				iconUrl: @json(asset('controlPanel/libs/leaflet/images/marker-icon.png')),
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowUrl: null
			});
			L.tileLayer(mapElement.getAttribute('data-tile-url'), {
				maxZoom: 19,
				attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap contributors</a>'
			}).addTo(propertyMap);

			var propertyMarker = null;
			function saveMapLocation(latlng) {
				if (!Number.isFinite(latlng.lat) || !Number.isFinite(latlng.lng)) return;
				if (!propertyMarker) {
					propertyMarker = L.marker(latlng, { icon: propertyPinIcon, draggable: true }).addTo(propertyMap);
					propertyMarker.on('dragend', function () { saveMapLocation(propertyMarker.getLatLng()); });
				} else {
					propertyMarker.setLatLng(latlng);
				}

				var lat = Number(latlng.lat.toFixed(6));
				var lng = Number(latlng.lng.toFixed(6));
				var bbox = [lng - 0.01, lat - 0.007, lng + 0.01, lat + 0.007].map(function (coordinate) {
					return coordinate.toFixed(6);
				}).join(',');
				var embedUrl = new URL('https://www.openstreetmap.org/export/embed.html');
				embedUrl.searchParams.set('bbox', bbox);
				embedUrl.searchParams.set('layer', 'mapnik');
				embedUrl.searchParams.set('marker', lat + ',' + lng);
				mapMarkupField.value = embedUrl.toString();
			}

			propertyMap.on('click', function (event) { saveMapLocation(event.latlng); });
			var oldMapLocation = mapMarkupField.value;
			if (oldMapLocation) {
				try {
					var oldMapUrl = new URL(oldMapLocation);
					var oldMarker = (oldMapUrl.searchParams.get('marker') || '').split(',').map(Number);
					if (oldMapUrl.hostname === 'www.openstreetmap.org' && oldMarker.length === 2 && oldMarker.every(Number.isFinite)) {
						propertyMap.setView(oldMarker, 16);
						saveMapLocation({ lat: oldMarker[0], lng: oldMarker[1] });
					}
				} catch (error) { /* Ignore legacy map HTML and start with the map centered on South Jersey. */ }
			}
			window.setTimeout(function () { propertyMap.invalidateSize(); }, 0);

			var lastAddressLookup = 0;
			if (locateButton && addressField) {
				locateButton.addEventListener('click', function () {
					var address = addressField.value.trim();
					if (!address) {
						if (mapStatus) mapStatus.textContent = 'Enter an address before searching the map.';
						addressField.focus();
						return;
					}
					if (Date.now() - lastAddressLookup < 1000) {
						if (mapStatus) mapStatus.textContent = 'Please wait a moment before trying another address.';
						return;
					}
					lastAddressLookup = Date.now();
					locateButton.disabled = true;
					if (mapStatus) mapStatus.textContent = 'Looking up the address…';
					fetch('https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&q=' + encodeURIComponent(address), {
						headers: { 'Accept': 'application/json' }
					}).then(function (response) {
						if (!response.ok) throw new Error('Address lookup failed');
						return response.json();
					}).then(function (results) {
						if (!results.length) {
							if (mapStatus) mapStatus.textContent = 'No matching address found. You can place the pin on the map instead.';
							return;
						}
						var location = { lat: Number(results[0].lat), lng: Number(results[0].lon) };
						propertyMap.setView(location, 16);
						saveMapLocation(location);
					}).catch(function () {
						if (mapStatus) mapStatus.textContent = 'Address lookup is unavailable right now. You can place the pin on the map instead.';
					}).finally(function () {
						locateButton.disabled = false;
					});
				});
			}
		}

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

		$('.form').on('submit', function (e) {
			e.preventDefault(); // Handle button clicks and keyboard submission.

			// Clear all previous error messages
			$('span[id^="error_"]').text('');


			// Preserve editor content when TinyMCE is available; the textarea remains usable without it.
			if (window.tinymce && typeof window.tinymce.triggerSave === 'function') {
				window.tinymce.triggerSave();
			}

			// Get the form element
			let form = this;
			let formData = new FormData(form);
			let submitButton = document.getElementById('formSubmitBTN');
			RRButtonLoading.start(submitButton, 'Adding propertyâ€¦');

			// Send the AJAX request
			$.ajax({
				url: form.action,
				type: form.method,
				data: formData,
				processData: false, // Prevent jQuery from automatically transforming the FormData object
				contentType: false, // Prevent jQuery from overriding the Content-Type header

				success: function (response) {
					if (response.success && response.redirect_url) {
						window.location.assign(response.redirect_url);
						return;
					}

					RRButtonLoading.stop(submitButton);
					$('html, body').animate({ scrollTop: 0 }, 'slow');
					if (response.success) {
						showAjaxAlert('success', 'Success', response.message || 'Property added successfully!');
					} else {
						showAjaxAlert('warning', 'Warning', response.message || 'Something went wrong. Please try again.');
					}
				},
				error: function (xhr) {
					RRButtonLoading.stop(submitButton);

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
