<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('from_country_id')->unsigned();
            $table->integer('from_state_id')->unsigned();
            $table->integer('from_area_id')->unsigned()->nullable();
            $table->integer('to_country_id')->unsigned();
            $table->integer('to_state_id')->unsigned();
            $table->integer('to_area_id')->unsigned()->nullable();
            $table->double('shipping_cost')->default(0);
            $table->double('return_cost')->default(0);
            $table->double('tax')->default(0);
            $table->double('insurance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
