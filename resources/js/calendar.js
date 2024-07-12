import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let filteredRoom = null; // Variável para armazenar o filtro atual

    if (calendarEl) { // Verifica se o elemento #calendar existe
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

                    const formattedDate = formatDate(new Date(info.dateStr + ' 00:00:00'));
                    startInput.value = formattedDate;
                    endInput.value = formattedDate;
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

                startInput.value = formatDate(new Date(info.dateStr + ' 00:00:00'));
                endInput.value = formatDate(new Date(info.dateStr + ' 00:00:00'));
            },
            eventDrop: async function (info) {
                const response = await axios.post(`/reserves/${info.event.id}/update-date`, {
                    start: info.event.start.toISOString(),
                    end: info.event.end.toISOString()
                });
            },

            eventClick: async function (info) {
                if (window.userRole === 'visitor' || window.userRole === 'tenant') {
                    alert('Horário indisponível: ' + info.event.start + ' - ' + info.event.end);
                    return;
                }

                const response = await axios.get('/reserves/' + info.event.id + '/edit');
                const reserve = response.data;

                console.log(reserve);

                document.getElementById('reserve_id').value = reserve.id;
                document.getElementById('editfullcalendar-reserve-form').action = `/reserves/${reserve.id}`;
                document.getElementById('update-user_id').value = reserve.user_id;
                document.getElementById('update-title').value = reserve.title;
                document.getElementById('update-description').value = reserve.description;
                document.getElementById('update-start').value = new Date(reserve.start).toLocaleDateString('pt-BR');
                document.getElementById('update-end').value = new Date(reserve.end).toLocaleDateString('pt-BR');
                document.getElementById('update-start_time').value = new Date(reserve.start).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                })
                document.getElementById('update-end_time').value = new Date(reserve.end).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                })
                document.getElementById('update-rental_item_id').value = reserve.rental_item_id;
                document.getElementById('update-price').value = reserve.price;
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

            datesSet: fetchEvents // Adiciona a função de buscar eventos quando a visualização muda
        });

        calendar.render();

        async function fetchEvents(fetchInfo) {
            const params = filteredRoom ? {rental_item_id: filteredRoom} : {};
            const response = await axios.get('/reserves/json', {params});
            return response.data;
        }

        document.getElementById('room-filter').addEventListener('change', function () {
            filteredRoom = this.value;
            calendar.refetchEvents(); // Recarrega os eventos ao mudar o filtro
        });
    }

    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
});
