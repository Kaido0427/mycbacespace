<?php

namespace App\Notifications;

use App\Models\procedure;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class myNotifs extends Notification
{
    use Queueable;

    public $procedure;

    /**
     * Create a new notification instance.
     */
    public function __construct(procedure $procedure)
    {
        $this->procedure = $procedure;
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
            'message' => 'Votre document pour le ' . $this->procedure->tache->nom_tache . ' a été traité avec succès!Merci d\'acceder a votre panel TACHES pour le télecharger',
            'procedure_id' => $this->procedure->id,
        ];
    }
}
