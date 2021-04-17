<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ShipmentAction;
use App\Event;
use App\Shipment;

class SendShipmentActionNotification
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
    public function handle(ShipmentAction $event)
    {
        $shipments = Shipment::find($event->shipment_ids ?? []);
        
        $notification = new Event();
        $notification->name = "Update Shipment To " . Shipment::getStatusByStatusId($event->status_id);
        $notification->type = "update_shipment_to_" . Shipment::getStatusByStatusId($event->status_id);
        $notification->user_id = $shipments[0]->userCaptain->user_id ?? 0;
        $notification->data = $shipments;
        $notification->save();

        // Notify function here 
    }
}
