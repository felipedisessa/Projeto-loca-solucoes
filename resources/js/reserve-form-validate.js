document.addEventListener('DOMContentLoaded', function () {
    function validateForm(event, form) {
        let isValid = true;

        //validando usuario responsavel
        const bookUserInput = form.querySelector('select[name="user_id"]');
        const bookUserError = form.querySelector('#user_id-error');
        if (!bookUserInput.value) {
            bookUserError.textContent = 'O campo de usuario responsável deve ser preenchido.';
            isValid = false;
        } else {
            bookUserError.textContent = '';
        }

        //validando descricao
        const descriptionInput = form.querySelector('textarea[name="description"]');
        const descriptionError = form.querySelector('#description-error');
        if (!descriptionInput.value) {
            descriptionError.textContent = 'O campo de descrição deve ser preenchido.';
            isValid = false;
        } else {
            descriptionError.textContent = '';
        }

        // Validando o campo nome
        const nameInput = form.querySelector('input[name="title"]');
        const nameError = form.querySelector('#title-error');
        if (nameInput.value.trim().length < 3) {
            nameError.textContent = 'O titulo deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        //validando o campo de start
        const startInput = form.querySelector('input[name="start"]');
        const startError = form.querySelector('#start-error');
        if (!startInput.value) {
            startError.textContent = 'O campo de data de inicio deve ser preenchido.';
            isValid = false;
        } else {
            startError.textContent = '';
        }

        //validando o campo de end
        const endInput = form.querySelector('input[name="end"]');
        const endError = form.querySelector('#end-error');
        if (!endInput.value) {
            endError.textContent = 'O campo de data de fim deve ser preenchido.';
            isValid = false;
        } else {
            endError.textContent = '';
        }

        //validando o campo de sala
        const rentalItemInput = form.querySelector('select[name="rental_item_id"]');
        const rentalItemError = form.querySelector('#rental_item_id-error');
        if (!rentalItemInput.value) {
            rentalItemError.textContent = 'O campo de sala deve ser preenchido.';
            isValid = false;
        } else {
            rentalItemError.textContent = '';
        }

        //validando o campo de preço
        const priceInput = form.querySelector('input[name="price"]');
        const priceError = form.querySelector('#price-error');
        if (priceInput.value.trim() === '') {
            priceError.textContent = 'O campo de preço deve ser preenchido.';
            isValid = false;
        } else {
            priceError.textContent = '';
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
});
