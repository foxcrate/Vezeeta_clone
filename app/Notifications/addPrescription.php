<?php

namespace App\Notifications;

use App\models\patient_analzes;
use App\models\patient_rays;
use App\models\Raoucheh;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class addPrescription extends Notification
{
    use Queueable;
    private $rocata;
    private $test;
    private $ray;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rocata,$test,$ray,$user)
    {
        $this->rocata = $rocata;
        $this->test = $test;
        $this->ray = $ray;
        $this->user = $user;
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
            'rocata_prescrption'=> $this->rocata->prescription,
            'test_name' => $this->test->test_name,
            'ray_name'  => $this->ray->ray_name,
            'title'=>'Doctor Add Prescription :',
            'user'  => $this->user->name,
            // 'user'=> auth()->guard('patien')->user()->name,
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
