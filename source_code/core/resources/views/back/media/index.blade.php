@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 pl-3"><b>{{ __('Media Gallery') }}</b></h3>
            </div>
        </div>
    </div>

    <!-- Upload Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">{{ __('Upload New Media') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('back.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="photo">{{ __('Select Image') }} *</label>
                            <input type="file" name="photo" class="form-control" id="photo" accept="image/*" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="title">{{ __('Title (Optional)') }}</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i> {{ __('Upload') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

	<!-- Gallery Grid -->
	<div class="card shadow mb-4">
		<div class="card-body">
			@include('alerts.alerts')
			
            <div class="row">
                @forelse($images as $image)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <a href="{{ asset('assets/images/'.$image->photo) }}" class="popup-link">
                            <img src="{{ asset('assets/images/'.$image->photo) }}" class="card-img-top" alt="{{ $image->title ?? 'Media Image' }}" style="height: 150px; object-fit: cover;">
                        </a>
                        <div class="card-body text-center p-2">
                            @if($image->title)
                                <p class="card-text text-truncate mb-2" title="{{ $image->title }}"><small>{{ $image->title }}</small></p>
                            @endif
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" value="{{ asset('assets/images/'.$image->photo) }}" id="media-url-{{ $image->id }}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary copy-btn" type="button" data-clipboard-target="#media-url-{{ $image->id }}" title="{{ __('Copy URL') }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <a class="btn btn-danger btn-sm btn-block text-white" data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('back.media.destroy', $image->id) }}">
                                <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('No media files found. Upload some images to get started.') }}</p>
                </div>
                @endforelse
            </div>

		</div>
	</div>

</div>
<!-- End of Main Content -->

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('You are going to delete this image from the gallery. It cannot be recovered.') }} {{ __('Do you want to delete it?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.copy-btn').click(function() {
            var target = $(this).data('clipboard-target');
            var copyText = $(target);
            copyText.select();
            document.execCommand("copy");
            
            var originalHtml = $(this).html();
            $(this).html('<i class="fas fa-check text-success"></i>');
            var btn = $(this);
            setTimeout(function() {
                btn.html(originalHtml);
            }, 2000);
        });

        // Initialize magnific popup for image preview
        $('.popup-link').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
</script>
@endsection
