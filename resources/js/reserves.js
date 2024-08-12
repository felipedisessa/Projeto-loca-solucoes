document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('edit-crud-modal');
    const editForm = document.getElementById('edit-reserve-form');
    const confirmModal = document.getElementById('confirm-popup-modal');
    const confirmForm = document.getElementById('reserveConfirmForm');

    document.querySelectorAll('a[data-modal-toggle="confirm-popup-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const reserveId = button.getAttribute('data-id');
            confirmForm.action = `/reserves/${reserveId}/confirm`;
            confirmModal.classList.remove('hidden');
        });
    });

    confirmModal.querySelector('button[data-modal-hide="confirm-popup-modal"]').addEventListener('click', () => {
        confirmModal.classList.add('hidden');
    });

    document.querySelectorAll('a[data-modal-toggle="edit-crud-modal"]').forEach(button => {
        button.addEventListener('click', async () => {
            const reserveId = button.getAttribute('data-id');

            const response = await fetch(`/reservas/${reserveId}/editar`);
            const reserveData = await response.json();

            editForm.action = `/reservas/${reserveId}`;
            document.getElementById('update-user_id').value = reserveData.user_id;
            document.getElementById('update-title').value = reserveData.title;
            document.getElementById('update-description').value = reserveData.description;
            document.getElementById('update-start').value = new Date(reserveData.start).toLocaleDateString('pt-BR');
            document.getElementById('update-end').value = new Date(reserveData.end).toLocaleDateString('pt-BR');
            document.getElementById('update-start_time').value = new Date(reserveData.start).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('update-end_time').value = new Date(reserveData.end).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('update-price').value = reserveData.price ? reserveData.formatted_price : '';
            document.getElementById('update-status').value = reserveData.status;
            document.getElementById('update-payment_type').value = reserveData.payment_type;
            document.getElementById('update-paid_at').value = reserveData.paid_at ? new Date(reserveData.paid_at).toLocaleDateString('pt-BR') : 'Não foi efetuado';
            document.getElementById('update-rental_item_id').value = reserveData.rental_item_id;

            reserveData.paid_at ? paidCheckbox.checked = true : paidCheckbox.checked = false;
            editModal.classList.remove('hidden');
        });
    });

    // Fechar modal de edição
    editModal.querySelector('button[data-modal-toggle="edit-crud-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

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
});
