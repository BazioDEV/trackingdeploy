<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreateMission;
use App\Event;

class SendCreateMissionNotification
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
    public function handle(CreateMission $event)
    {
        $notification = new Event();
        $notification->name = "Create Mission";
        $notification->type = "create_mission";
        $notification->user_id = $event->mission->userClient->user_id ?? 0;
        $notification->data = $event->mission;
        $notification->save();

        // Notify function here 
    }
}
