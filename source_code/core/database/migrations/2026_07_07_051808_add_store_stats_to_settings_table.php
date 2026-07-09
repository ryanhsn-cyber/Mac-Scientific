<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreStatsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'store_response_time')) {
                $table->string('store_response_time')->nullable()->default('&le;4h');
            }
            if (!Schema::hasColumn('settings', 'store_on_time_delivery')) {
                $table->string('store_on_time_delivery')->nullable()->default('&ge;90%');
            }
            if (!Schema::hasColumn('settings', 'store_reorder_rate')) {
                $table->string('store_reorder_rate')->nullable()->default('30%');
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
            $table->dropColumn(['store_response_time', 'store_on_time_delivery', 'store_reorder_rate']);
        });
    }
}
