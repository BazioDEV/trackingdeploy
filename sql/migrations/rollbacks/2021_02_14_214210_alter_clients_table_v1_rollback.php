<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientsTableV1Rollback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('clients', function (Blueprint $table) {
        //     $table->dropColumn('pickup_cost');
        // });
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('shipment_log');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('package_shipment');
        Schema::dropIfExists('shipment_settings');
        Schema::dropIfExists('shipment_mission');
        Schema::dropIfExists('costs');
        Schema::dropIfExists('areas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('pickup_cost');
            $table->dropColumn('supply_cost');
        });
    }
}
