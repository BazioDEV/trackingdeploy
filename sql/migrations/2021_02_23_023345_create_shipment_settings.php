<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });


        $items = array(
            [
                "key"       =>  "def_tax",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_shipping_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_tax_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost_gram",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "latest_shipment_count",
                "value"      =>  "10",
            ],
            [
                "key"       =>  "is_date_required",
                "value"      =>  "1",
            ],
            [
                "key"       =>  "def_shipping_date",
                "value"      =>  "0",
            ],
            [
                "key"       =>  "shipment_prefix",
                "value"      =>  "SH",
            ],
            [
                "key"       =>  "shipment_code_count",
                "value"      =>  "5",
            ],
            [
                "key"       =>  "mission_prefix",
                "value"      =>  "MI",
            ],
            [
                "key"       =>  "mission_code_count",
                "value"      =>  "7",
            ],
            
        );
        DB::table('shipment_settings')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_settings');
    }
}
