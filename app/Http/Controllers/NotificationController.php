<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Mostrar todas las notificaciones
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(5); // Paginar con 10 notificaciones por página
        return view('notifications.index', compact('notifications'));
    }

    // Marcar todas las notificaciones como leídas
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'Todas las notificaciones han sido marcadas como leídas']);
    }

    // Mostrar detalles de una notificación específica
    public function show($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            return response()->json(['notification' => $notification->data]);
        }
        return response()->json(['message' => 'Notificación no encontrada'], 404);
    }

    // Eliminar una notificación específica
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Notificación eliminada']);
        }
        return response()->json(['message' => 'Notificación no encontrada'], 404);
    }

    //borrar todas las notificaciones
    public function destroyAll()
    {
        Auth::user()->notifications()->delete();
        return response()->json(['message' => 'Todas las notificaciones han sido eliminadas']);
    }
}
