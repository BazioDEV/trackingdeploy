<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterShipmentsTableV16 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('barcode')->nullable();
        });

        $items = array(
            [
                "type"      =>  "notifications",
                "key"       =>  "new_shipment",
                "Name"      =>  "New Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "aprroved_shipment",
                "Name"      =>  "Approved Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "assigned_shipment",
                "Name"      =>  "Assigned Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "received_shipment",
                "Name"      =>  "Received Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "deliverd_shipment",
                "Name"      =>  "Deliverd Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "supplied_shipment",
                "Name"      =>  "Supplied Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_shipment",
                "Name"      =>  "Returned Shipment",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_to_stock_shipment",
                "Name"      =>  "Returned To Stock",
            ],
            [
                "type"      =>  "notifications",
                "key"       =>  "returned_to_sender_shipment",
                "Name"      =>  "Returned To Sender",
            ],
        );
        DB::table('business_settings')->insert($items);
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
