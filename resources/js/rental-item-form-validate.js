document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('create-rental-item-form').addEventListener('submit', function(event) {
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
