<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingLog extends Model
{
    protected $table = 'tracking_logs';

    protected $fillable = [
        'channel',
        'event_name',
        'event_id',
        'payload',
        'response_data',
        'http_status',
        'attempts',
    ];

    protected $casts = [
        'payload' => 'array',
        'response_data' => 'array',
        'http_status' => 'integer',
        'attempts' => 'integer',
    ];

    /**
     * Scope query by channel.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $channel
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChannel($query, $channel)
    {
        if ($channel && $channel !== 'all') {
            return $query->where('channel', $channel);
        }
        return $query;
    }

    /**
     * Scope query by status filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        if ($status === 'success') {
            return $query->whereBetween('http_status', [200, 299]);
        } elseif ($status === 'failed') {
            return $query->where(function($q) {
                $q->where('http_status', '>=', 400)
                  ->orWhereNull('http_status');
            });
        }
        return $query;
    }

    /**
     * Check if the event was successful.
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->http_status >= 200 && $this->http_status < 300;
    }
}
