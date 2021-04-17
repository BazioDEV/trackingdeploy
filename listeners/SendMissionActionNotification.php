<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\MissionAction;
use App\Event;
use App\Mission;

class SendMissionActionNotification
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
    public function handle(MissionAction $event)
    {
        $missions = Mission::find($event->mission_ids ?? []);
        
        $notification = new Event();
        $notification->name = "Action Mission To " . Mission::getStatusByStatusId($event->status_id);
        $notification->type = "action_mission_to_" . Mission::getStatusByStatusId($event->status_id);
        $notification->user_id = $event->missions[0]->userCaptain->user_id ?? 0;
        $notification->data = $missions;
        $notification->save();

        // Notify function here 
    }
}
