<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedActivityNotification extends Notification
{
    use Queueable;

    protected $activity;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($activity, $user)
    {
        $this->activity = $activity;
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
        $url = route('activities.show', $this->activity->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'La actividad ' . $this->activity->description . ' ha sido creada por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
