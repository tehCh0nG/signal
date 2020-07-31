<?php

namespace NotificationChannels\Signal;

use Illuminate\Support\Arr;

class SignalMessage
{
    /**
    * The phone number messages will be sent from.
    * Must include prefix ("+") and country code.
    *
    * @var string
    **/
    public $username;

    /**
    * The message content.
    *
    * @var string
    **/
    public $message;

    /**
    *
    * The phone number of the recipient.
    * Must include prefix ("+") and country code.
    *
    * @var string
    **/
    public $recipient;
}
