document.addEventListener('DOMContentLoaded', function () {
    function validateForm(event, form) {
        let isValid = true;

        // Validando usuário responsável
        const bookUserInput = form.querySelector('input[name="user_id"]');
        const bookUserError = form.querySelector('#user_id-error');
        if (bookUserInput && !bookUserInput.value) {
            bookUserError.textContent = 'O campo de usuario responsável deve ser preenchido.';
            isValid = false;
        } else {
            bookUserError.textContent = '';
        }

        // Validando descrição
        const descriptionInput = form.querySelector('textarea[name="description"]');
        const descriptionError = form.querySelector('#description-error');
        if (descriptionInput && !descriptionInput.value) {
            descriptionError.textContent = 'O campo de descrição deve ser preenchido.';
            isValid = false;
        } else {
            descriptionError.textContent = '';
        }

        // Validando título
        const nameInput = form.querySelector('input[name="title"]');
        const nameError = form.querySelector('#title-error');
        if (nameInput && nameInput.value.trim().length < 3) {
            nameError.textContent = 'O titulo deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        // Validando data de início
        const startInput = form.querySelector('input[name="start"]');
        const startError = form.querySelector('#start-error');
        if (startInput && !startInput.value) {
            startError.textContent = 'O campo de data de inicio deve ser preenchido.';
            isValid = false;
        } else {
            startError.textContent = '';
        }

        // Validando data de fim
        const endInput = form.querySelector('input[name="end"]');
        const endError = form.querySelector('#end-error');
        if (endInput && !endInput.value) {
            endError.textContent = 'O campo de data de fim deve ser preenchido.';
            isValid = false;
        } else {
            endError.textContent = '';
        }

        //valida que a hora inicial tem que ser preenchida
        const startHourInput = form.querySelector('input[name="start_time"]');
        const startHourError = form.querySelector('#start_time-error');
        if (startHourInput && !startHourInput.value) {
            startHourError.textContent = 'O campo de hora de inicio deve ser preenchido.';
            isValid = false;
        } else {
            startHourError.textContent = '';
        }

        //valida que a hora final tem que ser preenchida
        const endHourInput = form.querySelector('input[name="end_time"]');
        const endHourError = form.querySelector('#end_time-error');
        if (endHourInput && !endHourInput.value) {
            endHourError.textContent = 'O campo de hora de fim deve ser preenchido.';
            isValid = false;
        } else {
            endHourError.textContent = '';
        }

        // Validando sala
        const rentalItemInput = form.querySelector('select[name="rental_item_id"]');
        const rentalItemError = form.querySelector('#rental_item_id-error');
        if (rentalItemInput && !rentalItemInput.value) {
            rentalItemError.textContent = 'O campo de sala deve ser preenchido.';
            isValid = false;
        } else {
            rentalItemError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    }

    // Adiciona evento de escuta para o formulário de criação de reserva
    const createReserveForm = document.getElementById('create-reserve-form');
    if (createReserveForm) {
        createReserveForm.addEventListener('submit', function (event) {
            validateForm(event, createReserveForm);
        });
    }

    // Adiciona evento de escuta para o formulário de edição de reserva
    const editReserveForm = document.getElementById('edit-reserve-form');
    if (editReserveForm) {
        editReserveForm.addEventListener('submit', function (event) {
            validateForm(event, editReserveForm);
        });
    }

    const editCalendarReserveForm = document.getElementById('editfullcalendar-reserve-form');
    if (editCalendarReserveForm) {
        editCalendarReserveForm.addEventListener('submit', function (event) {
            validateForm(event, editCalendarReserveForm);
        });
    }


    // Adiciona evento de escuta para o formulário de criação de reserva de convidado
    const guestCreateReserveForm = document.getElementById('guest-create-reserve-form');
    if (guestCreateReserveForm) {
        guestCreateReserveForm.addEventListener('submit', function (event) {
            validateForm(event, guestCreateReserveForm);
        });
    }

});
