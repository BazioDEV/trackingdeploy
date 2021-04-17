<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddClient;
use App\Event;

class SendClientNotification
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
    public function handle(AddClient $event)
    {
        $notification = new Event();
        $notification->name = "Add Client";
        $notification->type = "add_client";
        $notification->user_id = $event->client->userClient->user_id ?? 0;
        $notification->data = $event->client;
        $notification->save();
    }
}
