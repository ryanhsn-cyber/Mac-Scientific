<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacebookCapiColumnsToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'facebook_pixel_id')) {
                $table->string('facebook_pixel_id')->nullable();
            }
            if (!Schema::hasColumn('settings', 'facebook_capi_token')) {
                $table->text('facebook_capi_token')->nullable();
            }
            if (!Schema::hasColumn('settings', 'facebook_capi_test_code')) {
                $table->string('facebook_capi_test_code')->nullable();
            }
            if (!Schema::hasColumn('settings', 'is_facebook_capi')) {
                $table->tinyInteger('is_facebook_capi')->default(0);
            }
            if (!Schema::hasColumn('settings', 'is_facebook_capi_view_content')) {
                $table->tinyInteger('is_facebook_capi_view_content')->default(0);
            }
            if (!Schema::hasColumn('settings', 'is_facebook_capi_add_to_cart')) {
                $table->tinyInteger('is_facebook_capi_add_to_cart')->default(0);
            }
            if (!Schema::hasColumn('settings', 'is_facebook_capi_purchase')) {
                $table->tinyInteger('is_facebook_capi_purchase')->default(0);
            }
            if (!Schema::hasColumn('settings', 'is_facebook_capi_initiate_checkout')) {
                $table->tinyInteger('is_facebook_capi_initiate_checkout')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_pixel_id', 
                'facebook_capi_token', 
                'facebook_capi_test_code', 
                'is_facebook_capi',
                'is_facebook_capi_view_content',
                'is_facebook_capi_add_to_cart',
                'is_facebook_capi_purchase',
                'is_facebook_capi_initiate_checkout'
            ]);
        });
    }
}
