document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('create-rental-item-form').addEventListener('submit', function (event) {
        let isValid = true;

        // Validando o campo nome
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('name-error');
        if (nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        //validnado descricao
        const descriptionInput = document.getElementById('description');
        const descriptionError = document.getElementById('description-error');
        if (!descriptionInput.value) {
            descriptionError.textContent = 'O campo de descrição deve ser preenchido.';
            isValid = false;
        } else {
            descriptionError.textContent = '';
        }

        //validando o campo de status
        const statusInput = document.getElementById('status');
        const statusError = document.getElementById('status-error');
        if (!statusInput.value) {
            statusError.textContent = 'O campo de status deve ser preenchido.';
            isValid = false;
        } else {
            statusError.textContent = '';
        }

        //validando os campos de enderecos
        const streetInput = document.getElementById('street');
        const streetError = document.getElementById('street-error');
        if (!streetInput.value) {
            streetError.textContent = 'O campo de rua deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            streetError.textContent = '';
        }

        const cityInput = document.getElementById('city');
        const cityError = document.getElementById('city-error');
        if (!cityInput.value) {
            cityError.textContent = 'O campo de cidade deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            cityError.textContent = '';
        }

        const stateInput = document.getElementById('state');
        const stateError = document.getElementById('state-error');
        if (!stateInput.value) {
            stateError.textContent = 'O campo de estado deve ter pelo menos 2 letras.';
            isValid = false;
        } else {
            stateError.textContent = '';
        }

        const countryInput = document.getElementById('country');
        const countryError = document.getElementById('country-error');
        if (!countryInput.value) {
            countryError.textContent = 'O campo de pais deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            countryError.textContent = '';
        }


        // Validando campos de preço
        const pricePerHourInput = document.getElementById('price_per_hour');
        const pricePerHourError = document.getElementById('price_per_hour-error');
        const pricePerDayInput = document.getElementById('price_per_day');
        const pricePerDayError = document.getElementById('price_per_day-error');
        const pricePerMonthInput = document.getElementById('price_per_month');
        const pricePerMonthError = document.getElementById('price_per_month-error');

        const pricePattern = /^[0-9]+(\.[0-9]{1,2})?$/;

        let isAnyPriceFieldFilled = false;

        if (!pricePattern.test(pricePerHourInput.value) && pricePerHourInput.value.trim() !== '') {
            pricePerHourError.textContent = 'O valor deve conter apenas números.';
            isValid = false;
        } else {
            pricePerHourError.textContent = '';
            if (pricePerHourInput.value.trim() !== '') {
                isAnyPriceFieldFilled = true;
            }
        }

        if (!pricePattern.test(pricePerDayInput.value) && pricePerDayInput.value.trim() !== '') {
            pricePerDayError.textContent = 'O valor deve conter apenas números.';
            isValid = false;
        } else {
            pricePerDayError.textContent = '';
            if (pricePerDayInput.value.trim() !== '') {
                isAnyPriceFieldFilled = true;
            }
        }

        if (!pricePattern.test(pricePerMonthInput.value) && pricePerMonthInput.value.trim() !== '') {
            pricePerMonthError.textContent = 'O valor deve conter apenas números.';
            isValid = false;
        } else {
            pricePerMonthError.textContent = '';
            if (pricePerMonthInput.value.trim() !== '') {
                isAnyPriceFieldFilled = true;
            }
        }

        if (!isAnyPriceFieldFilled) {
            pricePerHourError.textContent = 'Preencha pelo menos um dos campos de preço (Somente números).';
            pricePerDayError.textContent = 'Preencha pelo menos um dos campos de preço (Somente números).';
            pricePerMonthError.textContent = 'Preencha pelo menos um dos campos de preço (Somente números).';
            isValid = false;
        }

        // validando o campo de zipcode
        const zipcodeInput = document.getElementById('zipcode');
        const zipcodeError = document.getElementById('zipcode-error');
        const zipcodePattern = /^[0-9]+$/;
        if (!zipcodePattern.test(zipcodeInput.value)) {
            zipcodeError.textContent = 'O cep deve conter apenas números.';
            isValid = false;
        } else {
            zipcodeError.textContent = '';
        }

        //validando o campo de number
        const numberInput = document.getElementById('number');
        const numberError = document.getElementById('number-error');
        const numberPattern = /^[0-9]+$/;
        if (!numberPattern.test(numberInput.value)) {
            numberError.textContent = 'O numero deve conter apenas números.';
            isValid = false;
        } else {
            numberError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
