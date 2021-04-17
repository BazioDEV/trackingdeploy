<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateShipment;
use App\Event;
use App\Shipment;

class SendUpdateShipmentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateShipment $event)
    {
        $notification = new Event();
        $notification->name = "Update Shipment";
        $notification->type = "update_shipment";
        $notification->user_id = $event->shipment->userCaptain->user_id ?? 0;
        $notification->data = $event->shipment;
        $notification->save();

        // Notify function here 
    }
}
