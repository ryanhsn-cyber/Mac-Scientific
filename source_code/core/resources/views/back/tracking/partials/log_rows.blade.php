@forelse($logs as $log)
<tr id="log-row-{{ $log->id }}">
    <td>
        <span class="text-dark small font-weight-bold">{{ $log->created_at->format('Y-m-d H:i:s') }}</span>
        <small class="d-block text-muted">{{ $log->created_at->diffForHumans() }}</small>
    </td>
    <td>
        <span class="font-weight-bold text-dark">{{ $log->event_name }}</span>
    </td>
    <td>
        <code class="text-primary font-weight-bold">{{ $log->event_id }}</code>
    </td>
    <td>
        @if($log->channel === 'meta_capi')
            <span class="badge badge-primary px-2 py-1"><i class="fab fa-facebook mr-1"></i> Meta CAPI</span>
        @elseif($log->channel === 'ga4_measurement_protocol')
            <span class="badge badge-danger px-2 py-1"><i class="fab fa-google mr-1"></i> GA4 Server</span>
        @else
            <span class="badge badge-secondary px-2 py-1">{{ $log->channel }}</span>
        @endif
    </td>
    <td>
        @if($log->http_status >= 200 && $log->http_status < 300)
            <span class="badge badge-success px-2 py-1">{{ $log->http_status }} OK</span>
        @elseif($log->http_status == 400)
            <span class="badge badge-warning text-dark px-2 py-1">400 Bad Request</span>
        @elseif($log->http_status == 401 || $log->http_status == 403)
            <span class="badge badge-danger px-2 py-1">{{ $log->http_status }} Unauthorized</span>
        @elseif($log->http_status >= 500)
            <span class="badge badge-danger px-2 py-1">{{ $log->http_status }} Error</span>
        @else
            <span class="badge badge-secondary px-2 py-1">{{ $log->http_status ?: 'N/A' }}</span>
        @endif
    </td>
    <td class="text-center">
        <span class="badge badge-light border">{{ $log->attempts }}</span>
    </td>
    <td style="text-align: right;">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-info" onclick="inspectLog({{ $log->id }})">
                <i class="fas fa-search mr-1"></i> {{ __('Inspect') }}
            </button>
            @if(!$log->isSuccess())
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="retryLog({{ $log->id }})">
                <i class="fas fa-redo mr-1"></i> {{ __('Retry') }}
            </button>
            @endif
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center py-5 text-muted">
        <i class="fas fa-history fa-3x mb-3 text-muted d-block"></i>
        <p class="mb-0 font-weight-bold">{{ __('No Event Logs Recorded') }}</p>
        <small>{{ __('Logs will automatically record here when server-side events are dispatched.') }}</small>
    </td>
</tr>
@endforelse
