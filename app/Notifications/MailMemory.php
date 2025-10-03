<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailMemory extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $sharinguser;
    public function __construct()
    {
        $this->sharinguser = auth()->user()->name;;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('anders@webbsallad.se', 'Ankhemmet')
            ->subject('Ett minne är delat till dig i Ankhemmet')
            ->line($this->sharinguser. ' har delat ett minne med dig.')
            ->line('Logga in på Ankhemmet och kolla!')
            ->action('Ankhemmet', url('https://ank.webbsallad.se'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
