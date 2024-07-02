import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let filteredRoom = null; // Variável para armazenar o filtro atual

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

        eventDrop: async function (info) {
            const originalStartTime = info.oldEvent.start.toTimeString().split(' ')[0];
            const originalEndTime = info.oldEvent.end ? info.oldEvent.end.toTimeString().split(' ')[0] : null;

            const newStart = info.event.start.toISOString().split('T')[0] + 'T' + originalStartTime;
            const newEnd = originalEndTime ? info.event.end.toISOString().split('T')[0] + 'T' + originalEndTime : null;

            const response = await axios.put('/reserves/' + info.event.id, {
                user_id: info.event.extendedProps.user_id,
                title: info.event.title,
                rental_item_id: info.event.extendedProps.rental_item_id,
                start: newStart,
                end: newEnd,
                price: info.event.extendedProps.price,
                description: info.event.extendedProps.description,
                status: info.event.extendedProps.status,
                payment_type: info.event.extendedProps.payment_type,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            });
        },

        dateClick: function (info) {
            if (window.userRole === 'visitor' || window.userRole === 'tenant') {
                const modal = document.getElementById('guest-create-crud-modal');
                const closeButton = document.getElementById('guest-close-modal-button');

                modal.classList.remove('hidden');

                closeButton.addEventListener('click', function () {
                    modal.classList.add('hidden');
                });

                const startInput = modal.querySelector('#guest-start');
                const endInput = modal.querySelector('#guest-end');

                endInput.value = info.dateStr + 'T00:00';
                startInput.value = info.dateStr + 'T00:00';

                return;
            }

            const modal = document.getElementById('create-crud-modal');
            const closeButton = document.getElementById('close-modal-button');

            modal.classList.remove('hidden');

            closeButton.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            const startInput = document.getElementById('start');
            const endInput = document.getElementById('end');

            endInput.value = info.dateStr + 'T00:00';
            startInput.value = info.dateStr + 'T00:00';
        },

        eventClick: async function (info) {
            if (window.userRole === 'visitor' || window.userRole === 'tenant') {
                alert('Horario indisponível: ' + info.event.start + ' - ' + info.event.end);
                return;
            }

            const response = await axios.get('/reserves/' + info.event.id + '/edit');
            const reserve = response.data;

            document.getElementById('reserve_id').value = reserve.id;
            document.getElementById('editfullcalendar-reserve-form').action = `/reserves/${reserve.id}`;
            document.getElementById('update-user_id').value = reserve.user_id;
            document.getElementById('update-title').value = reserve.title;
            document.getElementById('update-description').value = reserve.description;
            document.getElementById('update-start').value = reserve.start;
            document.getElementById('update-end').value = reserve.end;
            document.getElementById('update-rental_item_id').value = reserve.rental_item_id;
            document.getElementById('update-price').value = reserve.price;
            document.getElementById('update-payment_type').value = reserve.payment_type;
            document.getElementById('update-status').value = reserve.status;

            const closeButton = document.getElementById('close-edit-crud-modal');
            closeButton.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            const modal = document.getElementById('edit-crud-modal');
            modal.classList.remove('hidden');
        },

        datesSet: fetchEvents // Adiciona a função de buscar eventos quando a visualização muda
    });

    calendar.render();

    async function fetchEvents(fetchInfo, successCallback, failureCallback) {
        try {
            const params = filteredRoom ? {rental_item_id: filteredRoom} : {};
            const response = await axios.get('/reserves/json', {params});
            successCallback(response.data);
        } catch (error) {
            console.error("Sem eventos");
            failureCallback(error);
        }
    }

    document.getElementById('room-filter').addEventListener('change', function () {
        filteredRoom = this.value;
        calendar.refetchEvents(); // Recarrega os eventos ao mudar o filtro
    });
});
