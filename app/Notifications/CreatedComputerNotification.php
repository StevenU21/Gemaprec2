<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedComputerNotification extends Notification
{
    use Queueable;

    protected $computer;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($computer, $user)
    {
        $this->computer = $computer;
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
        $url = route('computers.show', $this->computer->id);

        return [
            'type' => 'created',
            'user_name' => $this->user->name,
            'message' => 'La computadora ' . $this->computer->name . ' ha sido creada por ' . $this->user->name,
            'notification_url' => $url,
        ];
    }
}
