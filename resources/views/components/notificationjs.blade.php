@section('js')
    <script>
        // Marcar todas las notificaciones como leídas
        function markAllAsRead() {
            fetch("{{ route('notifications.markAllAsRead') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    // Actualizar visualmente todas las notificaciones como leídas
                    document.querySelectorAll('.notification-item').forEach(item => {
                        const badge = item.querySelector('.badge');
                        badge.classList.remove('bg-warning', 'text-dark');
                        badge.classList.add('bg-secondary');
                        badge.textContent = 'Leído';
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Mostrar detalles de una notificación específica
        function showNotificationDetails(id) {
            fetch(`{{ route('notifications.show', '') }}/${id}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Muestra los detalles en un modal o alerta
                    alert(`Detalles: ${data.notification.message}`);
                })
                .catch(error => console.error('Error:', error));
        }

        // Eliminar una notificación específica
        function deleteNotification(id) {
            fetch(`{{ route('notifications.destroy', '') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    // Eliminar visualmente la notificación de la lista
                    const notificationItem = document.getElementById(`notification-${id}`);
                    if (notificationItem) {
                        notificationItem.remove();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un problema al eliminar la notificación.');
                });
        }

        // Eliminar todas las notificaciones
        function deleteAllNotifications() {
            fetch("{{ route('notifications.destroyAll') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    // Eliminar visualmente todas las notificaciones de la lista
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.remove();
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un problema al eliminar todas las notificaciones.');
                });
        }
    </script>
@endsection
