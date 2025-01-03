<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreatedClientNotification extends Notification
{
    use Queueable;

    protected $client;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($client, $user)
    {
        $this->client = $client;
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
        $url = route('clients.show', $this->client->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'El cliente ' . $this->client->name . ' ha sido creado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
