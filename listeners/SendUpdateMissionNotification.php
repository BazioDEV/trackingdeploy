<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateMission;
use App\Event;
use App\Mission;

class SendUpdateMissionNotification
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
    public function handle(UpdateMission $event)
    {
        $mission = Mission::find($event->mission_id ?? 0);
        
        $notification = new Event();
        $notification->name = "Update Mission";
        $notification->type = "update_mission";
        $notification->user_id = $event->mission->userCaptain->user_id ?? 0;
        $notification->data = $mission;
        $notification->save();

        // Notify function here 
    }
}
