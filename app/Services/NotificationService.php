<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public function notifyAdminsAndEmployees($notification)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todos los usuarios con rol admin y employee, excluyendo al usuario autenticado
        $usersToNotify = User::adminsAndEmployeesExcept($user->id)->get();

        // Enviar la notificación a los usuarios seleccionados
        Notification::send($usersToNotify, $notification);
    }

    public function notifyAdminsAndEmployeesAndClients($notification)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todos los usuarios con rol admin y employee, excluyendo al usuario autenticado
        $usersToNotify = User::AdminsAndEmployeesAndClientsExcept($user->id)->get();

        // Enviar la notificación a los usuarios seleccionados
        Notification::send($usersToNotify, $notification);
    }
}
