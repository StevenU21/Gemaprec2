<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatedUbicationNotification extends Notification
{
    use Queueable;

    protected $ubication;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($ubication, $user)
    {
        $this->ubication = $ubication;
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
        $url = route('ubications.show', $this->ubication->id);

        return [
            'type' => 'updated',
            'user_name' => $this->user->name,
            'message' => 'La ubicación ' . $this->ubication->name . ' ha sido actualizada por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
