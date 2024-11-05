<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedMaintenanceNotification extends Notification
{
    use Queueable;

    protected $maintenance;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($maintenance, $user)
    {
        $this->maintenance = $maintenance;
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
        $url = route('maintenances.show', $this->maintenance->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'El mantenimiento ' . $this->maintenance->code . ' ha sido creado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
