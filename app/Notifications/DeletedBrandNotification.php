<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeletedBrandNotification extends Notification
{
    use Queueable;

    protected $brand;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($brand, $user)
    {
        $this->brand = $brand;
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
            'message' => 'La marca ' . $this->brand->name . ' ha sido eliminada por ' . $this->user->name,
        ];
    }
}
