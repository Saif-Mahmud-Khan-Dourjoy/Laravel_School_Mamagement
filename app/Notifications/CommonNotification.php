<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommonNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $markdown, $user, $subject, $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $subject, $markdown, $details = null)
    {
        $this->markdown = $markdown;
        $this->subject = $subject;
        $this->user = $user;
        $this->details = $details;
        $this->delay(now()->addSecond(10));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->markdown($this->markdown, ['user' => $this->user, 'details' => $this->details]);
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
