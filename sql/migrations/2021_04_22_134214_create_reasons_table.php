<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('key');
            $table->string('name');
            $table->timestamps();
        });

        $items = array(
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "sender_request",
                "name"      =>  "Sender Request",
            ],
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "receiver_request",
                "name"      =>  "Receiver Request",
            ],
            [
                "type"      =>  "remove_shipment_from_mission",
                "key"       =>  "receiver_didn't_answer",
                "name"      =>  "Receiver Didn't Answer",
            ]
        );
        DB::table('reasons')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reasons');
    }
}
