<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tracking & Integrations Routes (Admin)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/tracking', 'Back\TrackingController@index')->name('back.tracking.index');
    Route::post('/tracking/settings', 'Back\TrackingController@updateSettings')->name('back.tracking.settings.update');
    
    // Custom Event Builder
    Route::post('/tracking/custom-event', 'Back\TrackingController@saveCustomEvent')->name('back.tracking.custom_event.save');
    Route::delete('/tracking/custom-event/{id}', 'Back\TrackingController@deleteCustomEvent')->name('back.tracking.custom_event.delete');
    Route::post('/tracking/custom-event/{id}/toggle', 'Back\TrackingController@toggleCustomEvent')->name('back.tracking.custom_event.toggle');

    // Live Connection Health Checks
    Route::post('/tracking/test/meta', 'Back\TrackingController@testMetaConnection')->name('back.tracking.test.meta');
    Route::post('/tracking/test/ga4', 'Back\TrackingController@testGA4Connection')->name('back.tracking.test.ga4');

    // Event Logs & Monitoring
    Route::get('/tracking/logs', 'Back\TrackingController@getLogs')->name('back.tracking.logs');
    Route::get('/tracking/logs/{id}', 'Back\TrackingController@getLogDetails')->name('back.tracking.logs.show');
    Route::post('/tracking/logs/{id}/retry', 'Back\TrackingController@retryLog')->name('back.tracking.logs.retry');
    Route::post('/tracking/logs/prune', 'Back\TrackingController@pruneLogs')->name('back.tracking.logs.prune');
});
