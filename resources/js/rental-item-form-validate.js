document.addEventListener('DOMContentLoaded', function () {
    function validateForm(event, form) {
        let isValid = true;

        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        const maxImageSize = 2048 * 1024; // 2048KB

        const ownerInput = form.querySelector('select[name="user_id"]');
        const ownerError = form.querySelector('#owner-error');
        if (!ownerInput.value) {
            ownerError.textContent = 'O campo de proprietário deve ser preenchido.';
            isValid = false;
        } else {
            ownerError.textContent = '';
        }

        // Validando o campo nome
        const nameInput = form.querySelector('input[name="name"]');
        const nameError = form.querySelector('#name-error');
        if (nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        // Validando o campo descrição
        const descriptionInput = form.querySelector('textarea[name="description"]');
        const descriptionError = form.querySelector('#description-error');
        if (!descriptionInput.value) {
            descriptionError.textContent = 'O campo de descrição deve ser preenchido.';
            isValid = false;
        } else {
            descriptionError.textContent = '';
        }

        // Validando o campo status
        const statusInput = form.querySelector('select[name="status"]');
        const statusError = form.querySelector('#status-error');
        if (!statusInput.value) {
            statusError.textContent = 'O campo de status deve ser preenchido.';
            isValid = false;
        } else {
            statusError.textContent = '';
        }

        // Validando os campos de endereço
        const streetInput = form.querySelector('input[name="street"]');
        const streetError = form.querySelector('#street-error');
        if (!streetInput.value) {
            streetError.textContent = 'O campo de rua deve ser preenchido.';
            isValid = false;
        } else {
            streetError.textContent = '';
        }

        //validando bairro para ter pelo menos 3 letras
        const neighborhoodInput = form.querySelector('input[name="neighborhood"]');
        const neighborhoodError = form.querySelector('#neighborhood-error');
        if (neighborhoodInput.value.trim().length < 3) {
            neighborhoodError.textContent = 'O campo de bairro deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            neighborhoodError.textContent = '';
        }

        const cityInput = form.querySelector('input[name="city"]');
        const cityError = form.querySelector('#city-error');
        if (!cityInput.value) {
            cityError.textContent = 'O campo de cidade deve ser preenchido.';
            isValid = false;
        } else {
            cityError.textContent = '';
        }

        const stateInput = form.querySelector('input[name="state"]');
        const stateError = form.querySelector('#state-error');
        if (!stateInput.value) {
            stateError.textContent = 'O campo de estado deve ser preenchido.';
            isValid = false;
        } else {
            stateError.textContent = '';
        }

        const countryInput = form.querySelector('input[name="country"]');
        const countryError = form.querySelector('#country-error');
        if (!countryInput.value) {
            countryError.textContent = 'O campo de país deve ser preenchido.';
            isValid = false;
        } else {
            countryError.textContent = '';
        }

        // Validando campos de preço para que pelo menos um deles esteja preenchido
        const pricePerHourInput = form.querySelector('input[name="price_per_hour"]');
        const pricePerHourError = form.querySelector('#price_per_hour-error');
        const pricePerDayInput = form.querySelector('input[name="price_per_day"]');
        const pricePerDayError = form.querySelector('#price_per_day-error');
        const pricePerMonthInput = form.querySelector('input[name="price_per_month"]');
        const pricePerMonthError = form.querySelector('#price_per_month-error');

        let isAnyPriceFieldFilled = false;

        if (pricePerHourInput.value.trim() !== '') {
            pricePerHourError.textContent = '';
            isAnyPriceFieldFilled = true;
        } else {
            pricePerHourError.textContent = 'Preencha pelo menos um dos campos de preço.';
        }

        if (pricePerDayInput.value.trim() !== '') {
            pricePerDayError.textContent = '';
            isAnyPriceFieldFilled = true;
        } else {
            pricePerDayError.textContent = 'Preencha pelo menos um dos campos de preço.';
        }

        if (pricePerMonthInput.value.trim() !== '') {
            pricePerMonthError.textContent = '';
            isAnyPriceFieldFilled = true;
        } else {
            pricePerMonthError.textContent = 'Preencha pelo menos um dos campos de preço.';
        }

        if (!isAnyPriceFieldFilled) {
            pricePerHourError.textContent = 'Preencha pelo menos um dos campos de preço.';
            pricePerDayError.textContent = 'Preencha pelo menos um dos campos de preço.';
            pricePerMonthError.textContent = 'Preencha pelo menos um dos campos de preço.';
            isValid = false;
        }

        // Validando o campo de CEP
        const zipcodeInput = form.querySelector('input[name="zipcode"]');
        const zipcodeError = form.querySelector('#zipcode-error');
        const zipcodePattern = /^[0-9]+$/;
        if (!zipcodePattern.test(zipcodeInput.value)) {
            zipcodeError.textContent = 'O CEP deve conter apenas números.';
            isValid = false;
        } else {
            zipcodeError.textContent = '';
        }

        // Validando o campo de número
        const numberInput = form.querySelector('input[name="number"]');
        const numberError = form.querySelector('#number-error');
        const numberPattern = /^[0-9]+$/;
        if (!numberPattern.test(numberInput.value)) {
            numberError.textContent = 'O número deve conter apenas números.';
            isValid = false;
        } else {
            numberError.textContent = '';
        }

        // Validando o campo de imagem
        const imageInput = form.querySelector('input[name="rental_item_image"]');
        const imageError = form.querySelector('#rental_item_image-error');
        if (imageInput.files.length > 0) {
            const imageFile = imageInput.files[0];
            if (!allowedImageTypes.includes(imageFile.type)) {
                imageError.textContent = 'Apenas arquivos JPEG, PNG, JPG, GIF e SVG são permitidos.';
                isValid = false;
            } else if (imageFile.size > maxImageSize) {
                imageError.textContent = 'O tamanho do arquivo não deve exceder 2048KB.';
                isValid = false;
            } else {
                imageError.textContent = '';
            }
        } else {
            imageError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    }

    // Adiciona evento de escuta para o formulário de criação de item de locação
    const createRentalItemForm = document.getElementById('create-rental-item-form');
    if (createRentalItemForm) {
        createRentalItemForm.addEventListener('submit', function (event) {
            validateForm(event, createRentalItemForm);
        });
    }

    // Adiciona evento de escuta para o formulário de edição de item de locação
    const editRentalItemForm = document.getElementById('edit-rental-item-form');
    if (editRentalItemForm) {
        editRentalItemForm.addEventListener('submit', function (event) {
            validateForm(event, editRentalItemForm);
        });
    }
});
