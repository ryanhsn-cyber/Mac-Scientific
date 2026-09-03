@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-1 font-weight-bold text-dark">
                        <i class="fas fa-file-upload text-primary mr-2"></i>{{ __('Bulk Product Upload') }}
                    </h3>
                    <p class="text-muted small mb-0">{{ __('Import new products or update existing inventory in bulk via CSV spreadsheet.') }}</p>
                </div>
                <div class="mt-3 mt-sm-0">
                    <a class="btn btn-outline-info btn-sm mr-2 shadow-sm" href="{{ route('back.csv.export') }}">
                        <i class="fas fa-file-export mr-1"></i> {{ __('Export Current Products') }}
                    </a>
                    <a class="btn btn-outline-primary btn-sm shadow-sm" href="{{ route('back.item.index') }}">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('All Products') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    {{-- Import Statistics Breakdown --}}
    @if(session('import_stats'))
    @php $stats = session('import_stats'); @endphp
    <div class="card mb-4 border-left-primary shadow-sm">
        <div class="card-body">
            <h5 class="font-weight-bold mb-3"><i class="fas fa-clipboard-check text-success mr-2"></i>{{ __('Import Execution Summary') }}</h5>
            <div class="row text-center mb-3">
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light rounded border">
                        <span class="text-muted small text-uppercase font-weight-bold d-block">{{ __('New Products Created') }}</span>
                        <span class="h3 font-weight-bold text-success mb-0">{{ $stats['success'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light rounded border">
                        <span class="text-muted small text-uppercase font-weight-bold d-block">{{ __('Existing Products Updated') }}</span>
                        <span class="h3 font-weight-bold text-primary mb-0">{{ $stats['updated'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light rounded border">
                        <span class="text-muted small text-uppercase font-weight-bold d-block">{{ __('Rows Skipped / Failed') }}</span>
                        <span class="h3 font-weight-bold text-danger mb-0">{{ $stats['failed'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            @if(!empty($stats['errors']))
            <div class="alert alert-warning mb-0 p-3">
                <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-exclamation-triangle text-warning mr-1"></i> {{ __('Row Issues Encountered:') }}</h6>
                <ul class="mb-0 small text-danger pl-3">
                    @foreach($stats['errors'] as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Left Column: 3-Step Import Workflow -->
        <div class="col-xl-8 col-lg-7">

            <!-- Step 1: Download Template -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <span class="badge badge-primary rounded-circle mr-2 px-2 py-1">1</span>
                        {{ __('Download Official Template') }}
                    </h6>
                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> {{ __('Formatted for Mac Scientific') }}</span>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        {{ __('Download the pre-configured CSV template containing all required product fields (Name, Category, Price, Stock, Specifications, Images, etc.) and sample test rows.') }}
                    </p>
                    <a href="{{ route('back.csv.template') }}" class="btn btn-success shadow-sm">
                        <i class="fas fa-download mr-1"></i> {{ __('Download CSV Template (.csv)') }}
                    </a>
                </div>
            </div>

            <!-- Step 2: Upload CSV File -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <span class="badge badge-primary rounded-circle mr-2 px-2 py-1">2</span>
                        {{ __('Upload Your Completed CSV File') }}
                    </h6>
                </div>
                <div class="card-body">
                    <form id="bulkUploadForm" action="{{ route('back.csv.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="item_type" value="normal">

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">{{ __('Select CSV File') }} <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="csv" class="custom-file-input" id="csvFileInput" accept=".csv,text/csv,text/plain" required>
                                <label class="custom-file-label text-truncate" for="csvFileInput" id="fileLabel">{{ __('Choose CSV file or drag & drop here...') }}</label>
                            </div>
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle mr-1 text-info"></i> {{ __('Maximum file size: 20MB. Format: UTF-8 Encoded .CSV') }}
                            </small>
                        </div>

                        <!-- Import Settings -->
                        <div class="bg-light p-3 rounded border mb-4">
                            <h6 class="font-weight-bold text-dark mb-2">{{ __('Import Options') }}</h6>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="update_existing" name="update_existing" value="1" checked>
                                <label class="custom-control-label font-weight-bold text-dark" for="update_existing">
                                    {{ __('Update existing products if matching SKU or Slug is found') }}
                                </label>
                                <small class="d-block text-muted">{{ __('If unchecked, duplicates with the same slug will be created with a unique slug suffix.') }}</small>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" id="btnUploadSubmit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm">
                                <i class="fas fa-cloud-upload-alt mr-1"></i> {{ __('Start Bulk Upload') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Right Column: Taxonomy Reference & Instructions -->
        <div class="col-xl-4 col-lg-5">

            <!-- Field Instructions Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-table text-primary mr-1"></i> {{ __('CSV Column Requirements') }}
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 360px; overflow-y: auto;">
                        <table class="table table-sm table-striped mb-0 font-size-12">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('Column') }}</th>
                                    <th>{{ __('Required?') }}</th>
                                    <th>{{ __('Description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>name</code></td>
                                    <td><span class="badge badge-danger">Required</span></td>
                                    <td>{{ __('Full product name/title') }}</td>
                                </tr>
                                <tr>
                                    <td><code>category</code></td>
                                    <td><span class="badge badge-danger">Required</span></td>
                                    <td>{{ __('Category name (auto-created if new)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>current_price</code></td>
                                    <td><span class="badge badge-danger">Required</span></td>
                                    <td>{{ __('Selling price (numbers only)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>previous_price</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Original / Strikethrough price') }}</td>
                                </tr>
                                <tr>
                                    <td><code>stock</code></td>
                                    <td><span class="badge badge-danger">Required</span></td>
                                    <td>{{ __('Units in inventory (default: 10)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>sku</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Unique SKU (auto-generated if empty)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>subcategory</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Subcategory name under category') }}</td>
                                </tr>
                                <tr>
                                    <td><code>brand</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Brand name (auto-created if new)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>short_description</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Short highlight text') }}</td>
                                </tr>
                                <tr>
                                    <td><code>description</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Detailed product specification / description') }}</td>
                                </tr>
                                <tr>
                                    <td><code>photo_url</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Public image URL (auto-downloaded as WebP)') }}</td>
                                </tr>
                                <tr>
                                    <td><code>how_to_use</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Usage instructions') }}</td>
                                </tr>
                                <tr>
                                    <td><code>specifications</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Technical specs text') }}</td>
                                </tr>
                                <tr>
                                    <td><code>features</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Comma-separated highlights') }}</td>
                                </tr>
                                <tr>
                                    <td><code>tags</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('Search tags comma-separated') }}</td>
                                </tr>
                                <tr>
                                    <td><code>status</code></td>
                                    <td><span class="badge badge-secondary">Optional</span></td>
                                    <td>{{ __('1 for Active, 0 for Draft') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Live Taxonomy Reference -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-sitemap text-info mr-1"></i> {{ __('Active Store Taxonomy') }}
                    </h6>
                    <button class="btn btn-xs btn-outline-secondary" type="button" data-toggle="collapse" data-target="#taxonomyCollapse" aria-expanded="false">
                        {{ __('Toggle') }}
                    </button>
                </div>
                <div class="collapse show" id="taxonomyCollapse">
                    <div class="card-body p-3">
                        <div class="mb-3">
                            <h6 class="font-weight-bold small text-uppercase text-muted mb-2">{{ __('Available Categories:') }}</h6>
                            <div class="d-flex flex-wrap" style="gap: 4px; max-height: 140px; overflow-y: auto;">
                                @forelse($categories as $cat)
                                <span class="badge badge-light border text-dark p-1" title="Subcategories: {{ $cat->subcategory->pluck('name')->implode(', ') ?: 'None' }}">
                                    {{ $cat->name }}
                                </span>
                                @empty
                                <span class="text-muted small">{{ __('No categories found.') }}</span>
                                @endforelse
                            </div>
                        </div>

                        <div>
                            <h6 class="font-weight-bold small text-uppercase text-muted mb-2">{{ __('Available Brands:') }}</h6>
                            <div class="d-flex flex-wrap" style="gap: 4px; max-height: 120px; overflow-y: auto;">
                                @forelse($brands as $brand)
                                <span class="badge badge-light border text-dark p-1">
                                    {{ $brand->name }}
                                </span>
                                @empty
                                <span class="text-muted small">{{ __('No brands found.') }}</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Dynamic file name label update on file choose
        $('#csvFileInput').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#fileLabel').text(fileName).addClass('text-dark font-weight-bold');
            } else {
                $('#fileLabel').text("{{ __('Choose CSV file or drag & drop here...') }}").removeClass('text-dark font-weight-bold');
            }
        });

        // Show loading spinner when form is submitting
        $('#bulkUploadForm').on('submit', function() {
            var btn = $('#btnUploadSubmit');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{ __("Importing Products... Please wait") }}');
        });
    });
</script>
@endsection
