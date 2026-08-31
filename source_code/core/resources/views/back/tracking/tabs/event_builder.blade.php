<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-0 font-weight-bold text-dark"><i class="fas fa-magic text-primary mr-2"></i> {{ __('Visual Event Builder (Custom & Dynamic Events)') }}</h5>
            <small class="text-muted">{{ __('Create, map, and dispatch custom tracking rules without redeploying code.') }}</small>
        </div>
        <button type="button" class="btn btn-primary btn-sm" onclick="openNewEventModal()">
            <i class="fas fa-plus mr-1"></i> {{ __('Add New Event Rule') }}
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0" id="custom-events-table">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 20%;">{{ __('Event Name') }}</th>
                        <th style="width: 20%;">{{ __('Trigger Condition') }}</th>
                        <th style="width: 20%;">{{ __('Destinations') }}</th>
                        <th style="width: 20%;">{{ __('Payload Mapping') }}</th>
                        <th style="width: 10%; text-align: center;">{{ __('Status') }}</th>
                        <th style="width: 10%; text-align: right;">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customEvents as $event)
                    <tr id="event-row-{{ $event->id }}">
                        <td>
                            <span class="font-weight-bold text-dark">{{ $event->event_name }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info text-uppercase mr-1">{{ str_replace('_', ' ', $event->trigger_type) }}</span>
                            <code class="text-dark">{{ $event->trigger_target }}</code>
                        </td>
                        <td>
                            @if(is_array($event->destinations))
                                @foreach($event->destinations as $dest)
                                    @if($dest === 'meta_capi')
                                        <span class="badge badge-primary px-2 py-1 mb-1"><i class="fab fa-facebook mr-1"></i> Meta CAPI</span>
                                    @elseif($dest === 'ga4')
                                        <span class="badge badge-danger px-2 py-1 mb-1"><i class="fab fa-google mr-1"></i> GA4 Server</span>
                                    @elseif($dest === 'gtm')
                                        <span class="badge badge-warning text-dark px-2 py-1 mb-1"><i class="fas fa-tags mr-1"></i> GTM DataLayer</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(!empty($event->payload_schema) && is_array($event->payload_schema))
                                <small class="d-block text-muted">
                                    @foreach($event->payload_schema as $mapping)
                                        <code>{{ $mapping['key'] ?? '' }}</code> &rarr; {{ $mapping['source'] ?? '' }}<br>
                                    @endforeach
                                </small>
                            @else
                                <span class="text-muted small">{{ __('Auto Payload') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs {{ $event->is_active ? 'btn-success' : 'btn-secondary' }}" onclick="toggleEventStatus({{ $event->id }})">
                                {{ $event->is_active ? __('Active') : __('Inactive') }}
                            </button>
                        </td>
                        <td style="text-align: right;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editEventRule({{ json_encode($event) }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEventRule({{ $event->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-cubes fa-3x mb-3 text-muted d-block"></i>
                            <p class="mb-2 font-weight-bold">{{ __('No Custom Event Rules Configured') }}</p>
                            <button type="button" class="btn btn-sm btn-primary" onclick="openNewEventModal()">
                                <i class="fas fa-plus mr-1"></i> {{ __('Create Your First Event Rule') }}
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal: Add / Edit Custom Event Rule --}}
<div class="modal fade" id="eventRuleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('back.tracking.custom_event.save') }}" method="POST" id="customEventForm">
            @csrf
            <input type="hidden" name="event_rule_id" id="modal_event_rule_id" value="">

            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title font-weight-bold" id="eventRuleModalTitle">
                        <i class="fas fa-plus-circle text-primary mr-2"></i> {{ __('Configure Event Rule') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_event_name" class="font-weight-bold">{{ __('Event Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="event_name" id="modal_event_name" class="form-control" placeholder="e.g. DownloadCatalog, AffiliateClick" required>
                                <small class="text-muted">{{ __('Standard or custom action identifier.') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_trigger_type" class="font-weight-bold">{{ __('Trigger Type') }} <span class="text-danger">*</span></label>
                                <select name="trigger_type" id="modal_trigger_type" class="form-control" required onchange="updateTriggerHelper()">
                                    <optgroup label="Client-Side (Storefront)">
                                        <option value="client_click">{{ __('CSS Selector Click (e.g. #download-pdf)') }}</option>
                                        <option value="url_match">{{ __('URL Path Match (e.g. /thank-you or ?ref=)') }}</option>
                                        <option value="js_dispatch">{{ __('JavaScript Custom Event Dispatch') }}</option>
                                    </optgroup>
                                    <optgroup label="Server-Side (Laravel)">
                                        <option value="server_event">{{ __('Laravel Event Hook (e.g. UserRegistered)') }}</option>
                                        <option value="route_visit">{{ __('Route Match (e.g. POST /api/lead)') }}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="modal_trigger_target" class="font-weight-bold">{{ __('Trigger Target') }} <span class="text-danger">*</span></label>
                        <input type="text" name="trigger_target" id="modal_trigger_target" class="form-control" placeholder="e.g. #download-brochure or ?ref=" required>
                        <small class="text-muted" id="trigger_helper_text">{{ __('CSS selector on which the click event will attach.') }}</small>
                    </div>

                    <hr>

                    {{-- Target Dispatchers --}}
                    <div class="form-group">
                        <label class="font-weight-bold d-block">{{ __('Target Dispatchers') }} <span class="text-danger">*</span></label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="dest_meta" name="destinations[]" value="meta_capi" checked>
                            <label class="custom-control-label font-weight-bold" for="dest_meta"><i class="fab fa-facebook text-primary mr-1"></i> Meta CAPI</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="dest_ga4" name="destinations[]" value="ga4" checked>
                            <label class="custom-control-label font-weight-bold" for="dest_ga4"><i class="fab fa-google text-danger mr-1"></i> GA4 Server MP</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="dest_gtm" name="destinations[]" value="gtm" checked>
                            <label class="custom-control-label font-weight-bold" for="dest_gtm"><i class="fas fa-tags text-warning mr-1"></i> GTM DataLayer</label>
                        </div>
                    </div>

                    <hr>

                    {{-- Payload Mapper --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="font-weight-bold mb-0"><i class="fas fa-sliders-h text-primary mr-1"></i> {{ __('Dynamic Payload Parameter Mapper') }}</label>
                        <button type="button" class="btn btn-xs btn-outline-primary" onclick="addPayloadRow()">
                            <i class="fas fa-plus mr-1"></i> {{ __('Add Parameter') }}
                        </button>
                    </div>
                    <p class="text-muted small mb-2">{{ __('Map system or contextual values to analytics payload keys.') }}</p>

                    <div id="payload-rows-container">
                        {{-- Rows appended dynamically via JS --}}
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">{{ __('Save Event Rule') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
