<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTrackingEvent extends Model
{
    protected $table = 'custom_tracking_events';

    protected $fillable = [
        'event_name',
        'trigger_type',
        'trigger_target',
        'destinations',
        'payload_schema',
        'is_active',
    ];

    protected $casts = [
        'destinations' => 'array',
        'payload_schema' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for client-side events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClientSide($query)
    {
        return $query->whereIn('trigger_type', ['client_click', 'url_match', 'js_dispatch']);
    }

    /**
     * Scope for server-side events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeServerSide($query)
    {
        return $query->whereIn('trigger_type', ['server_event', 'route_visit']);
    }
}
