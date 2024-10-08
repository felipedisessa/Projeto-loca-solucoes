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
            events: fetchEvents,

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

                if (filteredRoom) {
                    const rentalItemIdInput = modalElement.querySelector('select[name="rental_item_id"]');
                    rentalItemIdInput.value = filteredRoom;
                }

                const startInput = modalElement.querySelector('#noAuth-start');
                const endInput = modalElement.querySelector('#noAuth-end');

                const formattedDate = formatDate(new Date(info.dateStr + ' 00:00:00'));
                startInput.value = formattedDate;
                endInput.value = formattedDate;
            },

            eventMouseEnter: function (info) {
                const startDateTime = info.event.start.toLocaleString('pt-BR').slice(0, -3);
                const endDateTime = info.event.end ? info.event.end.toLocaleString('pt-BR').slice(0, -3) : 'Indefinido';
                const tooltipContent = `Periodo: ${startDateTime}\n\naté: ${endDateTime}`;

                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = tooltipContent;

                document.body.appendChild(tooltip);

                info.el.addEventListener('mousemove', function (event) {
                    tooltip.style.left = event.pageX + 10 + 'px';
                    tooltip.style.top = event.pageY + 10 + 'px';
                });

                info.el.addEventListener('mouseleave', function () {
                    tooltip.remove();
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
            calendar.refetchEvents();
        });

    }

    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
});
