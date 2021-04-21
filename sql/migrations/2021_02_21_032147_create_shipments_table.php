<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('status_id');
            $table->tinyInteger('type');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('shipping_date');
            $table->integer('client_id')->unsigned()->nullable();
            $table->text('client_address')->nullable();
            $table->tinyInteger('payment_type')->nullable();
            
            $table->tinyInteger('paid')->default(0);
            $table->text('payment_integration_id')->default("");

            $table->integer('payment_method_id')->nullable();
            $table->double('tax')->default(0);
            $table->double('insurance')->default(0);
            $table->string('delivery_time')->nullable();
            $table->double('shipping_cost')->default(0);
            $table->double('total_weight')->default(0);
            $table->integer('employee_user_id')->unsigned()->nullable();

            $table->text('client_street_address_map')->nullable();
            $table->text('client_lat')->nullable();
            $table->text('client_lng')->nullable();
            $table->text('client_url')->nullable();
            $table->text('reciver_street_address_map')->nullable();
            $table->text('reciver_lat')->nullable();
            $table->text('reciver_lng')->nullable();
            $table->text('reciver_url')->nullable();
            
            $table->text('attachments_before_shipping')->nullable();
            $table->text('attachments_after_shipping')->nullable();

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
        Schema::dropIfExists('shipments');
    }
}
