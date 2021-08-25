<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Project;
use App\Models\Todo;

class DelArchProjTodo extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $project;
    public $todo;
    public $myname;
    public $deleted;

    public function __construct($projid, $deleted = false, $todoid = null)
    {
        $this->project = Project::where('id', $projid)->firstOrFail();
        if($todoid != null) {
            $this->todo = Todo::where('id', $todoid)->firstOrFail();
        }
        $this->myname = auth()->user()->name;
        $this->deleted = $deleted;
        $this->todoid = $todoid;
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
        if($this->deleted === true && $this->todoid === null) {
            return (new MailMessage)
                ->from('anders@webbsallad.se', 'Ankhemmet')
                ->subject('Projektet "'.$this->project->title.'" har raderats.')
                ->line('Projektet "'.$this->project->title.'" har raderats av '.$this->myname.'.');
        }
        elseif($this->deleted === false && $this->todoid === null) {
            return (new MailMessage)
                ->from('anders@webbsallad.se', 'Ankhemmet')
                ->subject('Projektet "'.$this->project->title.'" har arkiverats.')
                ->line('Projektet "'.$this->project->title.'" har arkiverats av '.$this->myname.'.');
        }
        elseif($this->todoid != null){
            return (new MailMessage)
            ->from('anders@webbsallad.se', 'Ankhemmet')
                ->subject('Arbetsuppgiften ' . $this->todo->title . ' har ändrats.')
                ->line( 'Arbetsuppgiften "' . $this->todo->title. '" tillhörande projektet "' . $this->project->title . '" har tagits bort')
                ->line('Kanske var det något som inte behövde göras?')
                ->action('Till projektet', url('https://ank.webbsallad.se/projects/'.$this->project->id));
        }
        else{
            return (new MailMessage)
                ->from('anders@webbsallad.se', 'Ankhemmet')
                ->subject('Mailutskick misslyckades')
                ->line('Något gick snett');
        }
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
