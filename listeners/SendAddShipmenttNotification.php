<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddShipment;
use App\Event;
use App\Shipment;

class SendAddShipmenttNotification
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
    public function handle(AddShipment $event)
    {
        $shipment = $event->shipment;
        
        /*********************
         * Sample for using Notification
         * Params:
         *  id: the receiver id
         *  title: the notification, which will appear as email subject and full notification on system and also will be sent via SMS
         *  content: the message content which can be HTML and it will be used in the email
         *  type: [add_shipment, update_shipment, administration_message, general as default]
        */
        // TODO : Check which type of notification is activated
        // TODO : Check which one will receive the notification and foreach them
        
        // $data = array(
        //     'sender'    =>  \Auth::user(),
        //     'message'   =>  array(
        //             'subject'   =>  $request->title,
        //             'content'   =>  $request->content,
        //             'url'       =>  $request->url,
        //     ),
        //     'icon'      =>  'flaticon2-bell-4',
        //     'type'      =>  $request->type,
        // );
        // \App\User::find($request->id)->notify(new \App\Notifications\GlobalNotification($data, ['system', 'email', 'sms']));
    }
}
