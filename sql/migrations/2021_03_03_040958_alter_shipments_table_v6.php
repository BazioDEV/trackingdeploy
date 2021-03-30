<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterShipmentsTableV6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->integer('from_country_id')->unsigned();
            $table->integer('from_state_id')->unsigned();
            $table->integer('from_area_id')->unsigned()->nullable();
            $table->integer('to_country_id')->unsigned();
            $table->integer('to_state_id')->unsigned();
            $table->integer('to_area_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            //
        });
    }
}
