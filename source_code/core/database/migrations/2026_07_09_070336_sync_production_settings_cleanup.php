<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SyncProductionSettingsCleanup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Payment Settings Cleanup
        DB::table('payment_settings')->whereNotIn('unique_keyword', ['cod', 'sslcommerz', 'bank'])->update(['status' => 0]);
        DB::table('payment_settings')->where('unique_keyword', 'sslcommerz')->update([
            'status' => 0, 
            'information' => '{"store_id":"","store_password":"","check_sandbox":0}'
        ]);
        DB::table('payment_settings')->where('unique_keyword', 'bank')->update([
            'status' => 0, 
            'text' => ''
        ]);

        // 2. Social Login Cleanup
        DB::table('settings')->update([
            'facebook_check' => 0,
            'facebook_client_id' => '',
            'facebook_client_secret' => '',
            'facebook_redirect' => '',
            'google_check' => 0,
            'google_client_id' => '',
            'google_client_secret' => '',
            'google_redirect' => ''
        ]);

        // 3. Email Settings Cleanup
        DB::table('settings')->update([
            'smtp_check' => 0,
            'email_host' => '',
            'email_port' => '',
            'email_encryption' => '',
            'email_user' => '',
            'email_pass' => '',
            'email_from' => '',
            'email_from_name' => '',
            'contact_email' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No down needed
    }
}
