<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-5 mb-2 mb-md-0">
                <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-satellite-dish text-primary mr-2"></i> {{ __('Event Logs, History & Monitoring Engine') }}</h5>
                <small class="text-muted">{{ __('Inspect server-side API payloads, verify deduplication keys, and retry failed calls.') }}</small>
            </div>
            <div class="col-md-7">
                <form id="logs-filter-form" class="form-inline justify-content-md-end">
                    <select name="channel" id="filter_channel" class="form-control form-control-sm mr-2 mb-2 mb-sm-0" onchange="fetchLogs()">
                        <option value="all">{{ __('Filter by: All Channels') }}</option>
                        <option value="meta_capi">{{ __('Meta CAPI') }}</option>
                        <option value="ga4_measurement_protocol">{{ __('GA4 Server MP') }}</option>
                    </select>

                    <select name="status" id="filter_status" class="form-control form-control-sm mr-2 mb-2 mb-sm-0" onchange="fetchLogs()">
                        <option value="all">{{ __('Status: All') }}</option>
                        <option value="success">{{ __('Status: 200 Success') }}</option>
                        <option value="failed">{{ __('Status: Failed (4xx/5xx)') }}</option>
                    </select>

                    <div class="input-group input-group-sm mb-2 mb-sm-0">
                        <input type="text" name="search" id="filter_search" class="form-control" placeholder="{{ __('Search Event / ID...') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="fetchLogs()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary ml-2" onclick="fetchLogs()" title="Refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 15%;">{{ __('Timestamp') }}</th>
                        <th style="width: 15%;">{{ __('Event Name') }}</th>
                        <th style="width: 25%;">{{ __('Event ID (Deduplication)') }}</th>
                        <th style="width: 15%;">{{ __('Channel') }}</th>
                        <th style="width: 10%;">{{ __('Status') }}</th>
                        <th style="width: 8%; text-align: center;">{{ __('Retries') }}</th>
                        <th style="width: 12%; text-align: right;">{{ __('Details') }}</th>
                    </tr>
                </thead>
                <tbody id="logs-tbody">
                    @include('back.tracking.partials.log_rows')
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
        <div id="logs-pagination-container">
            {{ $logs->links() }}
        </div>

        {{-- Auto Pruning Settings --}}
        <form action="{{ route('back.tracking.logs.prune') }}" method="POST" class="form-inline" onsubmit="return confirm('{{ __('Are you sure you want to prune older logs?') }}')">
            @csrf
            <span class="text-muted small mr-2">{{ __('Log Retention:') }}</span>
            <select name="days" class="form-control form-control-sm mr-2">
                <option value="7" {{ ($settings['log_retention_days'] ?? 30) == 7 ? 'selected' : '' }}>7 {{ __('Days') }}</option>
                <option value="14" {{ ($settings['log_retention_days'] ?? 30) == 14 ? 'selected' : '' }}>14 {{ __('Days') }}</option>
                <option value="30" {{ ($settings['log_retention_days'] ?? 30) == 30 ? 'selected' : '' }}>30 {{ __('Days') }}</option>
                <option value="60" {{ ($settings['log_retention_days'] ?? 30) == 60 ? 'selected' : '' }}>60 {{ __('Days') }}</option>
            </select>
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-trash-alt mr-1"></i> {{ __('Prune Now') }}
            </button>
        </form>
    </div>
</div>

{{-- Raw Payload Inspector Modal --}}
<div class="modal fade" id="logInspectorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-microchip mr-2 text-info"></i> {{ __('Raw Payload & Response Inspector') }}
                </h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 bg-light">
                {{-- Metadata Banner --}}
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body py-2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <span class="text-muted small d-block">{{ __('Event Name:') }}</span>
                                <strong id="inspect-event-name" class="h6 mb-0 text-dark">--</strong>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small d-block">{{ __('Deduplication Event ID:') }}</span>
                                <code id="inspect-event-id" class="font-weight-bold text-primary">--</code>
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted small d-block">{{ __('Channel:') }}</span>
                                <span id="inspect-channel" class="badge badge-primary">--</span>
                            </div>
                            <div class="col-md-3 text-md-right">
                                <span class="text-muted small d-block">{{ __('HTTP Response:') }}</span>
                                <span id="inspect-status" class="badge badge-success">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- JSON Viewers --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-2 font-weight-bold d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-file-export text-primary mr-1"></i> {{ __('Exact JSON Request Sent') }}</span>
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="copyJson('inspect-payload')"><i class="fas fa-copy"></i> {{ __('Copy') }}</button>
                            </div>
                            <div class="card-body p-0">
                                <pre id="inspect-payload" class="bg-dark text-light p-3 mb-0 small" style="max-height: 400px; overflow: auto; font-family: monospace;"></pre>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-2 font-weight-bold d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-file-import text-success mr-1"></i> {{ __('API Response Received') }}</span>
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="copyJson('inspect-response')"><i class="fas fa-copy"></i> {{ __('Copy') }}</button>
                            </div>
                            <div class="card-body p-0">
                                <pre id="inspect-response" class="bg-dark text-light p-3 mb-0 small" style="max-height: 400px; overflow: auto; font-family: monospace;"></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-danger" id="modal-retry-btn" onclick="retryInspectedLog()">
                    <i class="fas fa-redo mr-1"></i> {{ __('Retry This Event Now') }}
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
