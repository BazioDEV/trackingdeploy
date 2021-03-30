<?php

use Illuminate\Database\Seeder;

class CreateShipmentWidgetsClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wedgitCount = ["title"=>"Counter","value"=>'{"table":"shipments","operation":"count","where":{"status_id":"APPROVED_STATUS"}}',"link"=>"#","class"=>"OrderCount"];
        $resultWidget = app('App\Http\Controllers\AdminWidgetController')->store($wedgitCount);
        $wedgitLatest = ["title"=>"Latest Posts","value"=>'{"table":"shipments","operation":"latest","limit":20}',"link"=>"#","class"=>"LatestShipments"];
        $resultWidget2 = app('App\Http\Controllers\AdminWidgetController')->store($wedgitLatest);
      
    }
}
