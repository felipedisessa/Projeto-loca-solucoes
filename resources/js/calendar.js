import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import ptBrLocale from '@fullcalendar/core/locales/pt-br';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let filteredRoom = null;

    if (calendarEl) {
        let calendar = new Calendar(calendarEl, {
            locale: ptBrLocale,
            timeZone: 'local',
            plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
            initialView: 'dayGridMonth',
            views: {
                timeGridWeek: {
                    firstDay: 1,
                    weekends: false,
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false,
                        hour12: false,
                        separator: ' - '
                    }
                }
            },
            slotLabelInterval: '00:30:00',
            slotMinTime: '08:00:00',
            slotMaxTime: '18:00:00',
            expandRows: true,
            events: fetchEvents,

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridDay,timeGridWeek'
            },

            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },

            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,

            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false,
                hour12: false,
                separator: ' - '
            },

            eventStartEditable: window.userRole !== 'visitor' && window.userRole !== 'tenant',
            eventDurationEditable: window.userRole !== 'visitor' && window.userRole !== 'tenant',

            dateClick: function (info) {
                if (window.userRole === 'visitor' || window.userRole === 'tenant') {
                    const modalElement = document.getElementById('guest-create-crud-modal');
                    const modal = new Modal(modalElement);
                    modal.show();

                    const closeButton = document.getElementById('guest-close-modal-button');
                    closeButton.addEventListener('click', function () {
                        modal.hide();
                    });

                    const startInput = modalElement.querySelector('.guest-start');
                    const endInput = modalElement.querySelector('.guest-end');
                    const startTimeInput = document.getElementById('guest-start_time');
                    const endTimeInput = document.getElementById('guest-end_time');

                    const formattedDate = formatDate(info.date);
                    startInput.value = formattedDate.date;
                    endInput.value = formattedDate.date;
                    startTimeInput.value = formattedDate.time;
                    endTimeInput.value = formattedDate.time;

                    if (filteredRoom) {
                        const roomSelect = document.getElementById('guest-rental_item_id');
                        roomSelect.value = filteredRoom;
                    }

                    return;
                }

                const modalElement = document.getElementById('create-crud-modal');
                const modal = new Modal(modalElement);
                modal.show();

                const closeButton = document.getElementById('close-modal-button');
                closeButton.addEventListener('click', function () {
                    modal.hide();
                });

                const startInput = document.getElementById('start');
                const endInput = document.getElementById('end');
                const startTimeInput = document.getElementById('start_time');
                const endTimeInput = document.getElementById('end_time');

                const formattedDate = formatDate(info.date);

                startInput.value = formattedDate.date;
                endInput.value = formattedDate.date;
                startTimeInput.value = formattedDate.time;
                endTimeInput.value = formattedDate.time;

                if (filteredRoom) {
                    const roomSelect = document.getElementById('rental_item_id');
                    roomSelect.value = filteredRoom;
                }
            },

            eventDrop: async function (info) {
                const response = await axios.put(`/reserves/${info.event.id}/update-date`, {
                    start: info.event.start.toISOString(),
                    end: info.event.end.toISOString()
                });
            },

            eventClick: async function (info) {
                const response = await axios.get('/reservas/' + info.event.id + '/editar');
                const reserve = response.data;

                document.getElementById('reserve_id').value = reserve.id;
                document.getElementById('editfullcalendar-reserve-form').action = `/reservas/${reserve.id}`;
                document.getElementById('update-user_id').value = reserve.user_id;
                document.getElementById('update-title').value = reserve.title;
                document.getElementById('update-description').value = reserve.description;
                document.getElementById('update-start').value = new Date(reserve.start).toLocaleDateString('pt-BR');
                document.getElementById('update-end').value = new Date(reserve.end).toLocaleDateString('pt-BR');
                document.getElementById('update-start_time').value = new Date(reserve.start).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('update-end_time').value = new Date(reserve.end).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('update-rental_item_id').value = reserve.rental_item_id;
                document.getElementById('update-price').value = reserve.price ? reserve.formatted_price : '';
                document.getElementById('update-payment_type').value = reserve.payment_type;
                document.getElementById('update-paid_at').value = reserve.paid_at ? new Date(reserve.paid_at).toLocaleDateString('pt-BR') : 'Não foi efetuado';
                document.getElementById('update-status').value = reserve.status;

                document.getElementById('update-paid-checkbox').checked = !!reserve.paid_at;

                const paidCheckbox = document.getElementById('update-paid-checkbox');
                const paidAtField = document.getElementById('update-paid_at');

                paidCheckbox.addEventListener('change', () => {
                    if (paidCheckbox.checked) {
                        const currentDate = new Date();
                        paidAtField.value = currentDate.toLocaleDateString('pt-BR');
                    } else {
                        paidAtField.value = null;
                    }
                });

                const modalElement = document.getElementById('edit-crud-modal');
                const modal = new Modal(modalElement);
                modal.show();

                const closeButton = document.getElementById('close-edit-crud-modal');
                closeButton.addEventListener('click', function () {
                    modal.hide();
                });
            },

            eventMouseEnter: function (info) {
                const startDateTime = info.event.start.toLocaleString('pt-BR').slice(0, -3);
                const endDateTime = info.event.end ? info.event.end.toLocaleString('pt-BR').slice(0, -3) : 'Indefinido';
                const tooltipContent = `Período: ${startDateTime}\n\nAté: ${endDateTime}`;

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
            },

            datesSet: fetchEvents
        });

        calendar.render();

        async function fetchEvents(fetchInfo) {
            const params = filteredRoom ? {rental_item_id: filteredRoom} : {};
            try {
                const response = await axios.get('/reserves/json', {params});
                const now = new Date();
                const events = response.data.map(event => {
                    const isPast = new Date(event.end) < now;
                    return {
                        ...event,
                        className: [event.status, isPast ? 'event-past' : ''].filter(Boolean).join(' ')
                    };
                });
                return events;
            } catch (error) {
                console.error('Erro ao buscar eventos:', error);
            }
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
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return {
            date: `${day}/${month}/${year}`,
            time: `${hours}:${minutes}`
        };
    }
});
