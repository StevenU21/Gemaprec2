@extends('adminlte::page')

@section('template_title')
    Notificaciones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('Notificaciones') }}</h3>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm me-2" onclick="markAllAsRead()">
                                <i class="fas fa-envelope-open-text"></i> Marcar todas como leídas
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteAllNotifications()">
                                <i class="fas fa-trash-alt"></i> Borrar todas
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        @forelse ($notifications as $notification)
                            <div id="notification-{{ $notification->id }}"
                                class="notification-item border rounded p-3 mb-3 d-flex justify-content-between align-items-start">
                                <div class="notification-content">
                                    <strong>{{ $notification->data['type'] ?? 'Notificación' }}</strong>
                                    @if (is_null($notification->read_at))
                                        <span class="badge bg-warning text-dark ms-2">No leído</span>
                                    @else
                                        <span class="badge bg-secondary ms-2">Leído</span>
                                    @endif
                                    <p class="text-muted mb-2">
                                        {{ $notification->data['message'] ?? 'Detalles de la notificación.' }}</p>
                                    <small
                                        class="text-secondary">{{ $notification->data['notification_created_at'] ?? $notification->created_at->diffForHumans() }}</small>
                                    @if (isset($notification->data['notification_url']))
                                        <br>
                                        <a href="{{ $notification->data['notification_url'] }}" class="text-info">Ver más
                                            detalles</a>
                                    @endif
                                </div>

                                @if ($notification->data['type'] !== 'deleted')
                                    <div class="notification-actions">
                                        <button class="btn btn-info btn-sm me-1"
                                            onclick="showNotificationDetails('{{ $notification->id }}')">
                                            <i class="fas fa-eye"></i> Mostrar
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteNotification('{{ $notification->id }}')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p>No hay notificaciones.</p>
                        @endforelse
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.notificationjs')
