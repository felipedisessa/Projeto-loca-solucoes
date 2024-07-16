import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let filteredRoom = null;

    if (calendarEl) {
        let calendar = new Calendar(calendarEl, {
            locale: 'pt-br',
            timeZone: 'local',
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: fetchEvents, // Função para buscar eventos

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },

            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },

            editable: false,
            selectable: false,
            dayMaxEvents: true,

            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false,
                hour12: false,
                separator: ' - '
            },

            dateClick: function (info) {
                const modalElement = document.getElementById('noAuth-create-crud-modal');
                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');

                const closeButton = document.getElementById('noAuth-close-modal-button');
                closeButton.addEventListener('click', function () {
                    modalElement.classList.remove('flex');
                    modalElement.classList.add('hidden');
                });
            }
        });

        calendar.render();

        async function fetchEvents(fetchInfo, successCallback, failureCallback) {
            const params = filteredRoom ? {rental_item_id: filteredRoom} : {};

            const response = await fetch('/visitorCalendar/json?' + new URLSearchParams(params), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const events = await response.json();
            successCallback(events);
        }

        document.getElementById('room-filter').addEventListener('change', function () {
            filteredRoom = this.value;
            calendar.refetchEvents(); // Recarrega os eventos ao mudar o filtro
        });

    }
});
