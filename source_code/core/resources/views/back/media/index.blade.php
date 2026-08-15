@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h3 class="mb-0 pl-3 mr-4"><b>{{ __('Media Gallery') }}</b></h3>
                    <div class="custom-control custom-checkbox mr-3 mt-1">
                        <input type="checkbox" class="custom-control-input bulk_all_delete" id="selectAll" data-target="media-bulk-delete">
                        <label class="custom-control-label" for="selectAll" style="cursor: pointer;">{{ __('Select All') }}</label>
                    </div>
                    <form class="d-inline-block" action="{{route('back.bulk.delete')}}" method="get">
                        <input type="hidden" value="" name="ids[]" id="bulk_delete">
                        <input type="hidden" value="media_managers" name="table">
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> {{__('Bulk Delete')}}</button>
                    </form>
                </div>
                <a class="btn btn-primary btn-sm" href="{{ route('back.media.sync') }}"><i class="fas fa-sync"></i> {{ __('Sync Existing Images') }}</a>
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
	<div class="card shadow mb-4" id="media-bulk-delete">
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
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <input type="checkbox" class="bulk-item" value="{{$image->id}}">
                                @if($image->title)
                                    <p class="card-text text-truncate mb-0 ml-2" title="{{ $image->title }}" style="flex-grow: 1; text-align: left;"><small>{{ $image->title }}</small></p>
                                @else
                                    <div style="flex-grow: 1;"></div>
                                @endif
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" value="{{ asset('assets/images/'.$image->photo) }}" id="media-url-{{ $image->id }}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary copy-btn" type="button" data-clipboard-target="#media-url-{{ $image->id }}" title="{{ __('Copy URL') }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <a class="btn btn-danger btn-sm btn-block text-white" href="javascript:;" data-toggle="modal" data-target="#confirm-media-delete-{{ $image->id }}">
                                <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- DELETE MODAL FOR THIS ITEM --}}
                <div class="modal fade" id="confirm-media-delete-{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel-{{ $image->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirm-deleteModalLabel-{{ $image->id }}">{{ __('Confirm Delete?') }}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ __('You are going to delete this image from the gallery. It cannot be recovered.') }} {{ __('Do you want to delete it?') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                                <form action="{{ route('back.media.destroy', $image->id) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- DELETE MODAL ENDS --}}
                
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
