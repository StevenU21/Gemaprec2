<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatedActivityTypeNotification extends Notification
{
    use Queueable;

    protected $activityType;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($activityType, $user)
    {
        $this->activityType = $activityType;
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
        $url = route('activity-types.show', $this->activityType->id);

        return [
            'type' => 'updated',
            'user_name' => $this->user->name,
            'message' => 'El tipo de Actividad ' . $this->activityType->name . ' ha sido actualizado por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
