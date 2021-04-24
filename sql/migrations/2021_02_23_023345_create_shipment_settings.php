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
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_shipping_cost_gram",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_tax_gram",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_insurance_gram",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "def_return_cost_gram",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "latest_shipment_count",
                "Name"      =>  "10",
            ],
            [
                "key"       =>  "is_date_required",
                "Name"      =>  "1",
            ],
            [
                "key"       =>  "def_shipping_date",
                "Name"      =>  "0",
            ],
            [
                "key"       =>  "shipment_prefix",
                "Name"      =>  "SH",
            ],
            [
                "key"       =>  "shipment_code_count",
                "Name"      =>  "5",
            ],
            [
                "key"       =>  "mission_prefix",
                "Name"      =>  "MI",
            ],
            [
                "key"       =>  "mission_code_count",
                "Name"      =>  "7",
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
