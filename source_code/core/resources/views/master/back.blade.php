<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ $setting->title }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon"  type="image/x-icon" href="{{ asset('assets/images/'.$setting->favicon) }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/back/js/plugin/webfont/webfont.min.js') }}"></script>
	<script id="setFont" data-src="{{ asset("assets/back/css/fonts.css") }}" src="{{ asset('assets/back/js/plugin/webfont/setfont.js') }}"></script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/back/css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap-iconpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/magnific-popup.css') }}">

	<!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/custom.css') }}">


    @if(DB::table('languages')->where('type', 'Dashboard')->where('is_default',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{ asset('assets/back/css/rtl.css') }}">
    @endif

    @yield('styles')

    <style>
        .note-editable, .note-editable * {
            line-height: 2 !important;
            margin-bottom: 10px !important;
        }
        .note-editable ul, .note-editable ol {
            margin-left: 20px !important;
        }
        .note-editable p {
            margin-bottom: 15px !important;
        }
    </style>

</head>
<body>
	<div class="wrapper">
		<div class="main-header " >
			<!-- Logo Header -->
			<div class="logo-header">

				<a href="{{route('back.dashboard')}}" class="logo">
					<img src="{{ $setting->logo ? asset('assets/images/'.$setting->logo) : asset('assets/images/placeholder.png') }}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize ">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item mr-4">
							<a class="btn btn-sm btn-primary py-1 text-white" title="website" href="{{route('front.index')}}" target="_blank">
							<b> {{ __('View Website') }}</b>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="{{route('back.dashboard')}}" aria-expanded="false">
								<div class="avatar-sm avatar avatar-sm">
									<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="image profile" class="avatar-img rounded"></div>

										<div class="u-text">
											<h4>{{ Auth::guard('admin')->user()->name }}</h4>
											<p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p><a href="{{ route('back.profile') }}" class="btn  btn-secondary btn-sm">{{ __('Update Profile') }}</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.profile') }}">{{ __('Update Profile') }}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.password') }}">{{ __('Change Password') }}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.logout') }}">{{ __('Logout') }}</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">

			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::guard('admin')->user()->name }}
									<span class="user-level">{{ __('Administrator') }}</span>
								</span>
							</a>
						</div>
					</div>

					@if (Auth::guard('admin')->user()->IsSuper())
					@include('master.inc.super')
					@else
					@include('master.inc.normal')
					@endif

                    <div class="sidebar-footer text-primary d-block text-center pt-3">
                        <span class="d-inline-block"><b>Version 4.7</b></span>
                    </div>

				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
                    @yield('content')
				</div>
			</div>
        </div>

    </div>
    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp

    {{-- GLOBAL MEDIA GALLERY MODAL --}}
    <div class="modal fade" id="mediaGalleryModal" tabindex="-1" role="dialog" aria-labelledby="mediaGalleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="mediaGalleryModalLabel">{{ __('Choose from Media Gallery') }}</h5>
                    <div class="ml-3">
                        <label class="btn btn-sm btn-primary mb-0" style="cursor: pointer;">
                            <i class="fas fa-upload"></i> {{ __('Upload New') }}
                            <input type="file" id="mediaGalleryUploadInput" class="d-none" accept="image/*" multiple>
                        </label>
                    </div>
                    <button class="close ml-auto" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        @php
                            $allMedia = \App\Models\MediaManager::orderBy('id', 'desc')->get();
                        @endphp
                        @forelse($allMedia as $media)
                        <div class="col-md-2 col-sm-4 mb-3">
                            <div class="card h-100 cursor-pointer media-picker-item" data-url="{{ asset('assets/images/'.$media->photo) }}">
                                <img src="{{ asset('assets/images/'.$media->photo) }}" class="card-img-top" style="height: 100px; object-fit: cover; cursor: pointer;">
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">{{ __('No media found. Upload in the Media Gallery first.') }}</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var mainbs = {!! $mainbs !!};
        var admin_url = '/admin';
        var currentMediaTargetId = null;

        function setMediaTarget(inputId) {
            currentMediaTargetId = inputId;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Replace standard file inputs with dropdowns for image selection
            $('.upload-photo, #gallery_file').each(function() {
                let input = $(this);
                if(!input.attr('id')) {
                    input.attr('id', 'file_' + Math.random().toString(36).substr(2, 9));
                }
                let inputId = input.attr('id');
                let label = input.closest('label.file');
                let labelText = label.find('.file-custom').text() || 'Upload Image...';
                
                // Hide the original label (keep in DOM so input works and is submitted)
                label.addClass('d-none');
                
                let dropdownHtml = `
                <div class="dropdown w-100 mb-2" style="position: relative; height: 2.5rem;">
                    <div class="file-custom text-left dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer; border: 1px solid #ebedf2; border-radius: 0.25rem; display: block; width: 100%; height: 100%; padding: 0.5rem 1rem;">
                        <span class="text-muted" style="display: inline-block;">${labelText}</span>
                    </div>
                    <div class="dropdown-menu w-100 shadow-sm" style="margin-top: 5px;">
                        <a class="dropdown-item py-2" href="javascript:void(0)" onclick="$('#${inputId}').click();"><i class="fas fa-desktop mr-2"></i> {{ __('Upload from Computer') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item py-2" href="javascript:void(0)" onclick="setMediaTarget('${inputId}'); $('#mediaGalleryModal').modal('show');"><i class="fas fa-images mr-2"></i> {{ __('Choose from Gallery') }}</a>
                    </div>
                </div>
                `;
                label.after(dropdownHtml);
            });

            $('.media-picker-item').click(async function() {
                if(!currentMediaTargetId) return;
                let url = $(this).data('url');
                let input = document.getElementById(currentMediaTargetId);
                
                try {
                    let response = await fetch(url);
                    let blob = await response.blob();
                    let filename = url.split('/').pop();
                    let file = new File([blob], filename, {type: blob.type});
                    let dataTransfer = new DataTransfer();
                    
                    if(input.multiple) {
                        for(let i=0; i<input.files.length; i++) {
                            dataTransfer.items.add(input.files[i]);
                        }
                    }
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                    $(input).trigger('change');
                    $('#mediaGalleryModal').modal('hide');
                } catch (e) {
                    alert('Error loading image from gallery.');
                    console.error(e);
                }
            });

            $('#mediaGalleryUploadInput').on('change', function() {
                if(this.files.length === 0) return;
                
                let formData = new FormData();
                formData.append('photo', this.files[0]);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                
                let btnLabel = $(this).parent();
                let originalHtml = btnLabel.html();
                btnLabel.html('<i class="fas fa-spinner fa-spin"></i> Uploading...');
                
                $.ajax({
                    url: admin_url + '/media',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(err) {
                        alert('Upload failed.');
                        btnLabel.html(originalHtml);
                    }
                });
            });
        });
    </script>
	<!--   Core JS Files   -->
	<script src="{{ asset('assets/back/js/core/jquery.3.6.0.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Moment JS -->
	<script src="{{ asset('assets/back/js/plugin/moment/moment.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('assets/back/js/plugin/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/plugin/datatables/dataTables.bootstrap4.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Chartjs -->
	<script src="{{ asset('assets/back/js/plugin/chart.min.js') }}"></script>

	<!-- Editor -->
	<script src="{{ asset('assets/back/js/plugin/editor.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Tagify -->
    <script src="{{ asset('assets/back/js/tagify.js') }}"></script>

    <!-- JS Color -->
    <script src="{{ asset('assets/back/js/jscolor.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('assets/back/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Sortable -->
    <script src="{{ asset('assets/back/js/sortable.js') }}"></script>

    <!-- Icon Picker -->
    <script src="{{ asset('assets/back/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

	<!-- Azzara JS -->
    <script src="{{ asset('assets/back/js/ready.min.js') }}"></script>

	<!-- Custom JS -->

    @yield('scripts')
	<script src="{{ asset('assets/back/js/custom.js?v=' . time()) }}"></script>

</body>
</html>
