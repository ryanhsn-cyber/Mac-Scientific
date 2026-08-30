@extends('master.back')

@section('content')
<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('System Backup & Restore') }}</b></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
            
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('System Backup') }}</h4>
                </div>
                <div class="card-body">
                    <p>{{ __('Download a full backup of the system database.') }}</p>
                    <a href="{{ route('back.system.backup') }}" class="btn btn-primary">
                        <i class="fas fa-download"></i> {{ __('Download Backup') }}
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('System Restore') }}</h4>
                </div>
                <div class="card-body">
                    <p class="text-danger">
                        <strong>{{ __('Warning:') }}</strong> {{ __('Restoring the system will overwrite the current database. Make sure you have a recent backup before proceeding.') }}
                    </p>
                    <form action="{{ route('back.system.restore') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('{{ __('Are you sure you want to restore the system? This action cannot be undone and will overwrite current data.') }}');">
                        @csrf
                        <div class="form-group">
                            <label for="backup_file">{{ __('Upload SQL Backup File') }} *</label>
                            <input type="file" name="backup_file" id="backup_file" class="form-control" accept=".sql" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-upload"></i> {{ __('Restore System') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
