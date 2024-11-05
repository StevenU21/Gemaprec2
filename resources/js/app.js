import './bootstrap';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
        console.error('Elemento con id "calendar" no encontrado.');
        return;
    }

    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        locale: 'es', // Localización en español
        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
                console.log('Fetching events...');
                let response = await fetch('/calendars/events', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                let events = await response.json();
                console.log('Events fetched:', events);
                successCallback(events);
            } catch (error) {
                console.error('Error fetching events:', error);
                failureCallback(error);
                alert("Error cargando eventos");
            }
        },
        eventOrder: 'groupId,start,-duration,allDay,title', // Ordenar eventos por groupId y luego por fecha de inicio
        eventClick: function (info) {
            // Acción al hacer clic en un evento
            alert('Evento: ' + info.event.title + (info.event.extendedProps.maintenance ? '\nMantenimiento: ' + info.event.extendedProps.maintenance : ''));
        }
    });

    calendar.render();
    console.log('Calendar rendered');
});
