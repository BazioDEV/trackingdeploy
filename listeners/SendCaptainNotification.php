<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddCaptain;
use App\Event;

class SendCaptainNotification
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
    public function handle(AddCaptain $event)
    {
        $notification = new Event();
        $notification->name = "Add Captain";
        $notification->type = "add_captain";
        $notification->user_id = $event->captain->userCaptain->user_id ?? 0;
        $notification->data = $event->captain;
        $notification->save();
    }
}
