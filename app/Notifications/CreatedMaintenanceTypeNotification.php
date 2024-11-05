<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedMaintenanceTypeNotification extends Notification
{
    use Queueable;

    protected $maintenanceType;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($maintenanceType, $user)
    {
        $this->maintenanceType = $maintenanceType;
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
        $url = route('maintenance-types.show', $this->maintenanceType->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'El tipo de Mantenimiento ' . $this->maintenanceType->name . ' ha sido creado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
