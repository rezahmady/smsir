<?php

namespace Rezahmady\Smsir;

use Rezahmady\Smsir\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Rezahmady\Smsir\Facades\Smsir;

class SmsirChannel
{

    public function __construct()
    {
        // Initialisation code here
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \Rezahmady\Smsir\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {

        if(! $to = $notifiable->routeNotificationFor('smsir')) {
            return;
        }
        
        $message = $notification->toSmsir($notifiable);

        return $message->setTo($to)->trigger();
    }
}
