<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UpdatedPcModelNotification extends Notification
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
            'type' => 'updated',
            'user_name' => $this->user->name,
            'message' => 'El modelo de PC ' . $this->pcModel->name . ' ha sido actualizado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
