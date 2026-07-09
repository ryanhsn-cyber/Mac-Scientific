<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSteadfastColumnsToSettingsAndOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'steadfast_api_key')) {
                $table->string('steadfast_api_key')->nullable();
            }
            if (!Schema::hasColumn('settings', 'steadfast_secret_key')) {
                $table->string('steadfast_secret_key')->nullable();
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'steadfast_consignment_id')) {
                $table->string('steadfast_consignment_id')->nullable();
            }
            if (!Schema::hasColumn('orders', 'steadfast_tracking_code')) {
                $table->string('steadfast_tracking_code')->nullable();
            }
            if (!Schema::hasColumn('orders', 'steadfast_status')) {
                $table->string('steadfast_status')->nullable();
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
            $table->dropColumn(['steadfast_api_key', 'steadfast_secret_key']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['steadfast_consignment_id', 'steadfast_tracking_code', 'steadfast_status']);
        });
    }
}
