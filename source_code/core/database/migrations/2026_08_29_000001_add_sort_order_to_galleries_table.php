<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortOrderToGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('galleries') && !Schema::hasColumn('galleries', 'sort_order')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->integer('sort_order')->default(0)->after('photo');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('galleries') && Schema::hasColumn('galleries', 'sort_order')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
}
