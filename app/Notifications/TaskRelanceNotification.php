<?php

namespace App\Notifications;

use App\Models\tache;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskRelanceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $tache;

    public function __construct(tache $tache)
    {
        $this->tache = $tache;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toArray(object $notifiable): array
    {
        return [
            'tache_id' => $this->tache->id,
            'tache_nom' => $this->tache->nom_tache,
            'message' => "Vous avez une tâche en attente : " . $this->tache->nom_tache,
        ];
    }
}
