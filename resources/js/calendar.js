import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import ptBrLocale from '@fullcalendar/core/locales/pt-br';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new Calendar(calendarEl, {
        locale:  ptBrLocale,
        timeZone: 'local',
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: '/reserves/json',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },

        editable : true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,

        eventDrop: async function( info ) {
             const response = await axios.put('/reserves/' + info.event.id, {
                 user_id: info.event.extendedProps.user_id,
                 title: info.event.title,
                 rental_item_id: info.event.extendedProps.rental_item_id,
                 start: info.event.startStr,
                 end: info.event.endStr,
                 price: info.event.extendedProps.price,
                 description: info.event.extendedProps.description,
                 status: info.event.extendedProps.status,
                 payment_type: info.event.extendedProps.payment_type,

                 _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            });
        },

        dateClick: function(info) {

            const modal = document.getElementById('create-crud-modal');
            const closeButton = document.getElementById('close-modal-button');

            modal.classList.remove('hidden');

            closeButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            const startInput = document.getElementById('start');
            const endInput = document.getElementById('end');

            endInput.value = info.dateStr + 'T00:00:00';
            startInput.value = info.dateStr + 'T00:00:00';

            //data-modal-target="create-crud-modal" data-modal-toggle="create-crud-modal"
        },


        eventClick: function(info) {
            alert('Descrição: ' + info.event.extendedProps.description + '\nHora: ' + info.event.start + ' - ' +
                info.event.end + '\nID: ' + info.event.id);

        }

    });


    calendar.render();
});
