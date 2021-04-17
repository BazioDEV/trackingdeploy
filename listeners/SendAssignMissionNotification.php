<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AssignMission;
use App\Event;
use App\Mission;
use App\UserCaptain;

class SendAssignMissionNotification
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
    public function handle(AssignMission $event)
    {
        $missions = Mission::find($event->mission_ids ?? []);
        $captain = UserCaptain::where("captain_id",$event->captain_id ?? 0)->get()->first();

        $notification = new Event();
        $notification->name = "Assign Mission";
        $notification->type = "assign_mission";
        $notification->user_id = $captain->user_id ?? 0;
        $notification->data = $missions;
        $notification->save();

        // Notify function here 
    }
}
