<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrackingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. tracking_settings table
        if (!Schema::hasTable('tracking_settings')) {
            Schema::create('tracking_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('key', 191)->unique();
                $table->longText('value')->nullable();
                $table->boolean('is_encrypted')->default(false);
                $table->timestamps();
            });
        }

        // 2. custom_tracking_events table
        if (!Schema::hasTable('custom_tracking_events')) {
            Schema::create('custom_tracking_events', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('event_name', 191);
                $table->string('trigger_type', 100); // 'client_click', 'url_match', 'js_dispatch', 'server_event', 'route_visit'
                $table->string('trigger_target', 255); // selector, route name, or event class
                $table->json('destinations')->nullable(); // ["meta_capi", "ga4", "gtm"]
                $table->json('payload_schema')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. tracking_logs table
        if (!Schema::hasTable('tracking_logs')) {
            Schema::create('tracking_logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('channel', 50); // 'meta_capi', 'ga4_measurement_protocol'
                $table->string('event_name', 100);
                $table->string('event_id', 191)->index();
                $table->json('payload');
                $table->json('response_data')->nullable();
                $table->smallInteger('http_status')->nullable();
                $table->tinyInteger('attempts')->default(1);
                $table->timestamps();
            });
        }

        // Migrate existing settings if present in settings table
        $this->seedInitialTrackingSettings();
    }

    /**
     * Seed initial tracking settings from existing settings table.
     */
    private function seedInitialTrackingSettings()
    {
        try {
            $setting = DB::table('settings')->first();
            if ($setting) {
                $initialSettings = [
                    'enable_gtm' => '0',
                    'gtm_container_id' => '',
                    'gtm_server_url' => '',
                    'enable_ga4_direct' => $setting->is_google_analytics ?? '0',
                    'ga4_measurement_id' => '',
                    'ga4_api_secret' => '',
                    'gads_conversion_id' => '',
                    'gads_purchase_label' => '',
                    'gads_add_to_cart_label' => '',
                    'auto_push_datalayer' => '1',

                    'enable_meta_pixel' => $setting->is_facebook_pixel ?? '0',
                    'enable_meta_capi' => $setting->is_facebook_capi ?? '0',
                    'meta_pixel_id' => $setting->facebook_pixel_id ?? '',
                    'meta_capi_token' => $setting->facebook_capi_token ?? '',
                    'meta_capi_test_code' => $setting->facebook_capi_test_code ?? '',
                    'meta_advanced_matching_em' => '1',
                    'meta_advanced_matching_ph' => '1',
                    'meta_advanced_matching_fn' => '1',
                    'meta_advanced_matching_ln' => '1',
                    'meta_advanced_matching_ct' => '1',
                    'meta_advanced_matching_zp' => '1',

                    // Event Matrix Settings (Browser / Server)
                    'track_browser_pageview' => '1',
                    'track_server_pageview' => '0',
                    'track_browser_view_content' => '1',
                    'track_server_view_content' => $setting->is_facebook_capi_view_content ?? '1',
                    'track_browser_add_to_cart' => '1',
                    'track_server_add_to_cart' => $setting->is_facebook_capi_add_to_cart ?? '1',
                    'track_browser_initiate_checkout' => '1',
                    'track_server_initiate_checkout' => $setting->is_facebook_capi_initiate_checkout ?? '1',
                    'track_browser_add_payment_info' => '1',
                    'track_server_add_payment_info' => '1',
                    'track_browser_purchase' => '1',
                    'track_server_purchase' => $setting->is_facebook_capi_purchase ?? '1',
                    'track_browser_lead' => '1',
                    'track_server_lead' => '1',

                    'log_retention_days' => '30',
                ];

                foreach ($initialSettings as $key => $val) {
                    DB::table('tracking_settings')->updateOrInsert(
                        ['key' => $key],
                        ['value' => (string)$val, 'is_encrypted' => false, 'created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        } catch (\Exception $e) {
            // Ignore if settings table doesn't exist during migration
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_logs');
        Schema::dropIfExists('custom_tracking_events');
        Schema::dropIfExists('tracking_settings');
    }
}
