import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import ptBrLocale from '@fullcalendar/core/locales/pt-br';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new Calendar(calendarEl, {
        locale: ptBrLocale,
        timeZone: 'local',
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: '/reserves/json',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },

        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,

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
            const modal = document.getElementById('create-crud-modal');
            const closeButton = document.getElementById('close-modal-button');

            modal.classList.remove('hidden');

            closeButton.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            const startInput = document.getElementById('start');
            const endInput = document.getElementById('end');

            endInput.value = info.dateStr + 'T00:00:00';
            startInput.value = info.dateStr + 'T00:00:00';
        },

        eventClick: async function (info) {
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
        }
    });

    calendar.setOption('locale', 'pt-br');
    calendar.render();
});
