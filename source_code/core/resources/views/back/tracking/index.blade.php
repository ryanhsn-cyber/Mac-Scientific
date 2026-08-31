@extends('master.back')

@section('content')
<div class="container-fluid">
    {{-- Page Header --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0 font-weight-bold text-dark"><i class="fas fa-chart-line text-primary mr-2"></i> {{ __('Tracking & Integrations') }}</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a href="{{ route('back.dashboard') }}">{{ __('Admin') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Tracking & Integrations') }}</li>
                        </ol>
                    </nav>
                </div>

                {{-- Persistent Platform Status Indicators --}}
                <div class="d-flex flex-wrap align-items-center mt-3 mt-sm-0">
                    @foreach($platformStatuses as $key => $status)
                        <div class="badge badge-light border mr-2 mb-1 px-3 py-2 text-dark font-weight-normal shadow-sm">
                            <span class="mr-1 font-weight-bold">{{ $status['name'] }}:</span>
                            <span class="badge badge-{{ $status['color'] }} px-2">{{ $status['badge'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- System Alerts --}}
    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
        </div>
    </div>

    {{-- Connection Verification & Health Checks Component --}}
    @include('back.tracking.partials.verification')

    {{-- 4-Tab Navigation Dashboard --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 pb-0">
            <ul class="nav nav-tabs card-header-tabs" id="trackingTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-dark active" id="tab-google-link" data-toggle="tab" href="#tab-google" role="tab" aria-controls="tab-google" aria-selected="true">
                        <i class="fab fa-google text-danger mr-2"></i> {{ __('Google Suite & GTM') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-dark" id="tab-meta-link" data-toggle="tab" href="#tab-meta" role="tab" aria-controls="tab-meta" aria-selected="false">
                        <i class="fab fa-facebook text-primary mr-2"></i> {{ __('Meta (Facebook) Suite') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-dark" id="tab-builder-link" data-toggle="tab" href="#tab-builder" role="tab" aria-controls="tab-builder" aria-selected="false">
                        <i class="fas fa-magic text-warning mr-2"></i> {{ __('Custom Event Builder') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-dark" id="tab-logs-link" data-toggle="tab" href="#tab-logs" role="tab" aria-controls="tab-logs" aria-selected="false">
                        <i class="fas fa-history text-info mr-2"></i> {{ __('Event Logs & Monitor') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body p-4">
            <div class="tab-content" id="trackingTabsContent">
                {{-- Tab 1: Google Suite & GTM --}}
                <div class="tab-pane fade show active" id="tab-google" role="tabpanel" aria-labelledby="tab-google-link">
                    @include('back.tracking.tabs.google')
                </div>

                {{-- Tab 2: Meta (Facebook) Suite --}}
                <div class="tab-pane fade" id="tab-meta" role="tabpanel" aria-labelledby="tab-meta-link">
                    @include('back.tracking.tabs.meta')
                </div>

                {{-- Tab 3: Custom Event Builder --}}
                <div class="tab-pane fade" id="tab-builder" role="tabpanel" aria-labelledby="tab-builder-link">
                    @include('back.tracking.tabs.event_builder')
                </div>

                {{-- Tab 4: Event Logs & Monitor --}}
                <div class="tab-pane fade" id="tab-logs" role="tabpanel" aria-labelledby="tab-logs-link">
                    @include('back.tracking.tabs.logs')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dynamic JavaScript Handlers --}}
<script>
    var currentInspectedLogId = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password show/hide
        $('.toggle-password').on('click', function() {
            var targetInput = $($(this).data('target'));
            var icon = $(this).find('i');
            if (targetInput.attr('type') === 'password') {
                targetInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                targetInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Tab URL parameter support (e.g. ?tab=meta)
        var urlParams = new URLSearchParams(window.location.search);
        var activeTab = urlParams.get('tab');
        if (activeTab) {
            if (activeTab === 'meta') $('#tab-meta-link').tab('show');
            if (activeTab === 'event_builder') $('#tab-builder-link').tab('show');
            if (activeTab === 'logs') $('#tab-logs-link').tab('show');
            if (activeTab === 'google') $('#tab-google-link').tab('show');
        }

        // Keep tab state on hash change
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var tabId = $(e.target).attr('href').replace('#tab-', '');
            var newUrl = window.location.pathname + '?tab=' + (tabId === 'builder' ? 'event_builder' : tabId);
            window.history.replaceState(null, null, newUrl);
        });
    });

    // 1. Connection Verification: Meta CAPI Ping
    function runMetaTest() {
        var btn = $('#btn-test-meta');
        var originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Testing...').prop('disabled', true);

        $('#meta-test-status').html('<span class="badge badge-warning px-2 py-1"><i class="fas fa-spinner fa-spin mr-1"></i> PINGING</span>');

        $.ajax({
            url: "{{ route('back.tracking.test.meta') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function(res) {
                btn.html(originalText).prop('disabled', false);
                $('#meta-test-latency').html('<strong class="text-dark">' + (res.latency_ms || 0) + ' ms</strong>');
                $('#meta-test-time').html('<span class="text-muted small">Just now</span>');

                if (res.success && res.status >= 200 && res.status < 300) {
                    $('#meta-test-status').html('<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> 200 VALID (' + res.status + ')</span>');
                } else if (res.status === 401 || res.status === 403) {
                    $('#meta-test-status').html('<span class="badge badge-danger px-2 py-1" title="' + JSON.stringify(res.response) + '"><i class="fas fa-times-circle mr-1"></i> ' + res.status + ' UNAUTHORIZED</span>');
                } else {
                    $('#meta-test-status').html('<span class="badge badge-danger px-2 py-1" title="' + JSON.stringify(res.response) + '"><i class="fas fa-times-circle mr-1"></i> ' + res.status + ' ERROR</span>');
                }
            },
            error: function(err) {
                btn.html(originalText).prop('disabled', false);
                $('#meta-test-status').html('<span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> FAILED</span>');
            }
        });
    }

    // 2. Connection Verification: GA4 Measurement Protocol Ping
    function runGA4Test() {
        var btn = $('#btn-test-ga4');
        var originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Testing...').prop('disabled', true);

        $('#ga4-test-status').html('<span class="badge badge-warning px-2 py-1"><i class="fas fa-spinner fa-spin mr-1"></i> PINGING</span>');

        $.ajax({
            url: "{{ route('back.tracking.test.ga4') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function(res) {
                btn.html(originalText).prop('disabled', false);
                $('#ga4-test-latency').html('<strong class="text-dark">' + (res.latency_ms || 0) + ' ms</strong>');
                $('#ga4-test-time').html('<span class="text-muted small">Just now</span>');

                if (res.success && res.status >= 200 && res.status < 300) {
                    $('#ga4-test-status').html('<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> 200 VALID (' + res.status + ')</span>');
                } else if (res.status === 401 || res.status === 403) {
                    $('#ga4-test-status').html('<span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> ' + res.status + ' UNAUTHORIZED</span>');
                } else {
                    $('#ga4-test-status').html('<span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> ' + res.status + ' ERROR</span>');
                }
            },
            error: function(err) {
                btn.html(originalText).prop('disabled', false);
                $('#ga4-test-status').html('<span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> FAILED</span>');
            }
        });
    }

    // 3. Custom Event Builder Modal Handlers
    function openNewEventModal() {
        $('#customEventForm')[0].reset();
        $('#modal_event_rule_id').val('');
        $('#eventRuleModalTitle').html('<i class="fas fa-plus-circle text-primary mr-2"></i> Add New Event Rule');
        $('#payload-rows-container').empty();
        addPayloadRow();
        updateTriggerHelper();
        $('#eventRuleModal').modal('show');
    }

    function editEventRule(event) {
        $('#customEventForm')[0].reset();
        $('#modal_event_rule_id').val(event.id);
        $('#modal_event_name').val(event.event_name);
        $('#modal_trigger_type').val(event.trigger_type);
        $('#modal_trigger_target').val(event.trigger_target);

        // Destinations
        $('#dest_meta').prop('checked', event.destinations && event.destinations.includes('meta_capi'));
        $('#dest_ga4').prop('checked', event.destinations && event.destinations.includes('ga4'));
        $('#dest_gtm').prop('checked', event.destinations && event.destinations.includes('gtm'));

        // Payload Schema
        $('#payload-rows-container').empty();
        if (event.payload_schema && event.payload_schema.length > 0) {
            event.payload_schema.forEach(function(item) {
                addPayloadRow(item.key, item.source);
            });
        } else {
            addPayloadRow();
        }

        $('#eventRuleModalTitle').html('<i class="fas fa-edit text-primary mr-2"></i> Edit Event Rule: ' + event.event_name);
        updateTriggerHelper();
        $('#eventRuleModal').modal('show');
    }

    function addPayloadRow(key = '', source = '') {
        var rowHtml = `
            <div class="row mb-2 payload-row align-items-center">
                <div class="col-5">
                    <input type="text" name="payload_keys[]" class="form-control form-control-sm" placeholder="Parameter Key (e.g. ref_id)" value="${key}" required>
                </div>
                <div class="col-6">
                    <input type="text" name="payload_sources[]" class="form-control form-control-sm" placeholder="Source (e.g. order.total, user.email, or static value)" value="${source}" required>
                </div>
                <div class="col-1 text-right">
                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="$(this).closest('.payload-row').remove()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        $('#payload-rows-container').append(rowHtml);
    }

    function updateTriggerHelper() {
        var type = $('#modal_trigger_type').val();
        var helper = $('#trigger_helper_text');
        var targetInput = $('#modal_trigger_target');

        if (type === 'client_click') {
            helper.text('CSS selector of the element clicked (e.g. #download-brochure, .buy-now-btn)');
            targetInput.attr('placeholder', '#download-brochure');
        } else if (type === 'url_match') {
            helper.text('URL path or query parameter substring to match (e.g. /thank-you, ?ref=affiliate)');
            targetInput.attr('placeholder', '/thank-you');
        } else if (type === 'js_dispatch') {
            helper.text('Custom window event name to listen for (e.g. onCustomSignupComplete)');
            targetInput.attr('placeholder', 'onCustomSignupComplete');
        } else if (type === 'server_event') {
            helper.text('Laravel Eloquent or Event class to hook (e.g. App\\Events\\OrderPlaced)');
            targetInput.attr('placeholder', 'App\\Events\\OrderPlaced');
        } else if (type === 'route_visit') {
            helper.text('Route name or URI path hit (e.g. front.checkout.billing or /api/lead)');
            targetInput.attr('placeholder', 'front.checkout.billing');
        }
    }

    function toggleEventStatus(id) {
        $.ajax({
            url: "/admin/tracking/custom-event/" + id + "/toggle",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function(res) {
                window.location.reload();
            }
        });
    }

    function deleteEventRule(id) {
        if (!confirm('Are you sure you want to delete this event rule?')) return;
        $.ajax({
            url: "/admin/tracking/custom-event/" + id,
            type: "DELETE",
            data: { _token: "{{ csrf_token() }}" },
            success: function(res) {
                $('#event-row-' + id).remove();
            }
        });
    }

    // 4. Event Logs Filtering, Inspector & Retries
    function fetchLogs() {
        var channel = $('#filter_channel').val();
        var status = $('#filter_status').val();
        var search = $('#filter_search').val();

        $('#logs-tbody').html('<tr><td colspan="7" class="text-center py-4"><i class="fas fa-spinner fa-spin mr-2"></i> Loading logs...</td></tr>');

        $.ajax({
            url: "{{ route('back.tracking.logs') }}",
            type: "GET",
            data: { channel: channel, status: status, search: search },
            success: function(res) {
                $('#logs-tbody').html(res.html);
                $('#logs-pagination-container').html(res.pagination);
            }
        });
    }

    function inspectLog(id) {
        currentInspectedLogId = id;
        $('#inspect-event-name').text('Loading...');
        $('#inspect-payload').text('{}');
        $('#inspect-response').text('{}');

        $.ajax({
            url: "/admin/tracking/logs/" + id,
            type: "GET",
            success: function(data) {
                $('#inspect-event-name').text(data.event_name);
                $('#inspect-event-id').text(data.event_id);
                $('#inspect-channel').text(data.channel);
                $('#inspect-status').text(data.http_status ? data.http_status + ' Status' : 'Pending');

                $('#inspect-payload').text(JSON.stringify(data.payload, null, 2));
                $('#inspect-response').text(JSON.stringify(data.response_data, null, 2));

                $('#logInspectorModal').modal('show');
            }
        });
    }

    function copyJson(elementId) {
        var text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(function() {
            alert('JSON copied to clipboard!');
        });
    }

    function retryLog(id) {
        if (!confirm('Re-dispatch this event to the server queue?')) return;
        $.ajax({
            url: "/admin/tracking/logs/" + id + "/retry",
            type: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function(res) {
                alert(res.message);
                fetchLogs();
            }
        });
    }

    function retryInspectedLog() {
        if (currentInspectedLogId) {
            retryLog(currentInspectedLogId);
            $('#logInspectorModal').modal('hide');
        }
    }
</script>
@endsection
