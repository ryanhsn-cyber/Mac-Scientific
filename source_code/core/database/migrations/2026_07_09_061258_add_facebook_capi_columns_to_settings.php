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
            $table->string('facebook_pixel_id')->nullable();
            $table->text('facebook_capi_token')->nullable();
            $table->string('facebook_capi_test_code')->nullable();
            $table->tinyInteger('is_facebook_capi')->default(0);
            $table->tinyInteger('is_facebook_capi_view_content')->default(0);
            $table->tinyInteger('is_facebook_capi_add_to_cart')->default(0);
            $table->tinyInteger('is_facebook_capi_purchase')->default(0);
            $table->tinyInteger('is_facebook_capi_initiate_checkout')->default(0);
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
