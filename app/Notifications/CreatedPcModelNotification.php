<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedPcModelNotification extends Notification
{
    use Queueable;

    protected $pcModel;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($pcModel, $user)
    {
        $this->pcModel = $pcModel;
        $this->user = $user;
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
     * Get the database representation of the notification.
     */

    public function toDatabase(object $notifiable): array
    {
        $url = route('pc-models.show', $this->pcModel->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'El modelo de PC ' . $this->pcModel->name . ' ha sido creado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
