<?php

namespace NotificationChannels\Signal;

use Illuminate\Notifications\Notification;
use NotificationChannels\Signal\Exceptions\CouldNotSendNotification;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SignalChannel
{
    /**
    * Signal instance
    * @var Signal
    **/
    protected $signal;

    /**
    * Send the given notification.
    *
    * @param mixed $notifiable
    * @param \Illuminate\Notifications\Notification $notification
    *
    * @throws \NotificationChannels\Signal\Exceptions\CouldNotSendNotification
    */

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSignal($notifiable);

        $message = new SignalMessage($message);

        //Run signal-cli via Symfony Process.
        $result = new Process(
            ['../signal-cli-0.6.8/bin/signal-cli', '--username',$username,'send','--message',$message,$recipient],
            //Pass JAVA_HOME to Symfony so signal-cli can run.
            null,
            ['JAVA_HOME' => '/path/to/java']
        );

        if (!$result->isSuccessful()) {
            $symfonyerror = new ProcessFailedException($result);
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $send->getOutput();
    }
}
