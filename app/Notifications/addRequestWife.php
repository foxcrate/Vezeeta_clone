<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class addRequestWife extends Notification
{
    use Queueable;
    private $patientAccept_id;
    private $patientRequest_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($patientAccept_id,$patientRequest_id)
    {
        $this->patientAccept_id = $patientAccept_id;
        $this->patientRequest_id = $patientRequest_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'patientAccept_id'=> $this->patientAccept_id,
            'patientRequest_id' => $this->patientRequest_id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
