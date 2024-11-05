<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletedComputerNotification extends Notification
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
        return [
            'type' => 'deleted',
            'user_name' => $this->user->name,
            'message' => 'La computadora ' . $this->computer->name . ' ha sido eliminada por ' . $this->user->name,
        ];
    }
}
