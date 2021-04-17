<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ApproveMission;
use App\Event;
use App\Mission;

class SendApproveMissionNotification
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
    public function handle(ApproveMission $event)
    {
        $missions = Mission::find($event->mission_ids ?? []);
        
        $notification = new Event();
        $notification->name = "Approve Mission";
        $notification->type = "approve_mission";
        $notification->user_id = $event->mission->userCaptain->user_id ?? 0;
        $notification->data = $missions;
        $notification->save();

        // Notify function here 
    }
}
