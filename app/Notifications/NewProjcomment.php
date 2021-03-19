<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Projcomment;
use App\Models\Project;

class NewProjcomment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->projcomment = Projcomment::latest()->first();
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
        $project = Project::where('id', $this->projcomment->project_id)->first();
        return (new MailMessage)
            ->from('anders@webbsallad.se', 'Ankhemmet')
            ->subject('Ny projektkommentar!')
            ->line('Det har skapats en ny kommentar till projektet '.$project->title)
            ->line('Text: '.$this->projcomment->body)
            ->action('Besvara', url('/projects/'.$this->projcomment->project_id));
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
