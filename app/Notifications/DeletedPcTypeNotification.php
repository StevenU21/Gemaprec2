<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeletedPcTypeNotification extends Notification
{
    use Queueable;

    protected $pcType;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($pcType, $user)
    {
        $this->pcType = $pcType;
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
        $url = route('pc-types.show', $this->pcType->id);

        return [
            'type' => 'deleted',
            'user_name' => $this->user->name,
            'message' => 'El tipo de PC ' . $this->pcType->name . ' ha sido eliminado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
