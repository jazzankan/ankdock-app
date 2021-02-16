<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Project;

class NewProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $project;
    public $myname;
    public function __construct()
    {
        $this->project = Project::latest()->first();
        $this->myname = auth()->user()->name;
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
            ->from('anders@webbsallad.se', 'Ankhemmet')
            ->subject('Projektet "' .  $this->project->title . '"  har skapats av ' . $this->myname)
            ->line($this->myname . ' vill dela ett projekt med dig!')
            ->line('Hoppas du vill medverka!')
            ->action('Till projektet', url('https://ank.webbsallad.se/projects/' . $this->project->id));
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
