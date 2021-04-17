<?php

use Illuminate\Database\Seeder;

class CreateNotificationSettingsClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            "type"      =>  "notifications",
            "key"       =>  "new_shipment",
            "Name"      =>  "New Shipment",
        ];
        $results = app('App\Http\Controllers\BusinessSettingsController')->updateNotificationsSettings($items);
    }
}
