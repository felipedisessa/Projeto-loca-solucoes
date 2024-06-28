document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('create-reserve-form').addEventListener('submit', function (event) {
        let isValid = true;

        //validando usuario responsavel
        const bookUserInput = document.getElementById('user_id');
        const bookUserError = document.getElementById('user_id-error');
        if (!bookUserInput.value) {
            bookUserError.textContent = 'O campo de usuario responsável deve ser preenchido.';
            isValid = false;
        } else {
            bookUserError.textContent = '';
        }

        // Validando o campo nome
        const nameInput = document.getElementById('title');
        const nameError = document.getElementById('title-error');
        if (nameInput.value.trim().length < 3) {
            nameError.textContent = 'O titulo deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        //validando o campo de start
        const startInput = document.getElementById('start');
        const startError = document.getElementById('start-error');
        if (!startInput.value) {
            startError.textContent = 'O campo de data de inicio deve ser preenchido.';
            isValid = false;
        } else {
            startError.textContent = '';
        }

        //validando o campo de end
        const endInput = document.getElementById('end');
        const endError = document.getElementById('end-error');
        if (!endInput.value) {
            endError.textContent = 'O campo de data de fim deve ser preenchido.';
            isValid = false;
        } else {
            endError.textContent = '';
        }

        //validando o campo de sala
        const rentalItemInput = document.getElementById('rental_item_id');
        const rentalItemError = document.getElementById('rental_item_id-error');
        if (!rentalItemInput.value) {
            rentalItemError.textContent = 'O campo de sala deve ser preenchido.';
            isValid = false;
        } else {
            rentalItemError.textContent = '';
        }

        //validando o campo de preço
        const priceInput = document.getElementById('price');
        const priceError = document.getElementById('price-error');
        const pricePattern = /^[0-9]+$/;
        if (!pricePattern.test(priceInput.value)) {
            priceError.textContent = 'O campo de preco deve conter apenas números.';
            isValid = false;
        } else {
            priceError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
})
