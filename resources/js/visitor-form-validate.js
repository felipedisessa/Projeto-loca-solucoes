document.addEventListener('DOMContentLoaded', function () {
    function validateNoAuthCreateReserveForm(event) {
        let isValid = true;

        const form = document.getElementById('noAuth-create-reserve-form');

        // Validando o campo nome
        const nameInput = form.querySelector('input[name="name"]');
        const nameError = form.querySelector('#name-error');
        if (nameInput && nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        // Validando o campo email
        const emailInput = form.querySelector('input[name="email"]');
        const emailError = form.querySelector('#email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput && !emailPattern.test(emailInput.value)) {
            emailError.textContent = 'O email deve ser um email válido.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validando o campo telefone
        const phoneInput = form.querySelector('input[name="phone"]');
        const phoneError = form.querySelector('#phone-error');
        if (phoneInput && phoneInput.value.trim() === '') {
            phoneError.textContent = 'O campo de telefone deve ser preenchido.';
            isValid = false;
        } else {
            phoneError.textContent = '';
        }

        // Validando o campo celular
        const mobileInput = form.querySelector('input[name="mobile"]');
        const mobileError = form.querySelector('#mobile-error');
        if (mobileInput && mobileInput.value.trim() === '') {
            mobileError.textContent = 'O campo de celular deve ser preenchido.';
            isValid = false;
        } else {
            mobileError.textContent = '';
        }

        // Validando o campo cpf_cnpj
        const cpfCnpjInput = form.querySelector('input[name="cpf_cnpj"]');
        const cpfCnpjError = form.querySelector('#cpf_cnpj-error');
        const cpfCnpjPattern = /^[0-9]+$/;
        if (cpfCnpjInput && !cpfCnpjPattern.test(cpfCnpjInput.value.replace(/[^\d]/g, ''))) {
            cpfCnpjError.textContent = 'O CPF/CNPJ deve conter apenas números.';
            isValid = false;
        } else {
            cpfCnpjError.textContent = '';
        }

        // Validando o campo empresa
        const companyInput = form.querySelector('input[name="company"]');
        const companyError = form.querySelector('#company-error');
        if (companyInput && companyInput.value.trim().length < 3) {
            companyError.textContent = 'A empresa deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            companyError.textContent = '';
        }

        // Validando dados de endereços obrigatórios
        const streetInput = form.querySelector('input[name="street"]');
        const streetError = form.querySelector('#street-error');
        if (streetInput && streetInput.value.trim().length < 3) {
            streetError.textContent = 'O nome da rua deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            streetError.textContent = '';
        }

        const numberInput = form.querySelector('input[name="number"]');
        const numberError = form.querySelector('#number-error');
        if (numberInput && numberInput.value.trim() === '') {
            numberError.textContent = 'O campo número deve ser preenchido.';
            isValid = false;
        } else {
            numberError.textContent = '';
        }

        const neighborhoodInput = form.querySelector('input[name="neighborhood"]');
        const neighborhoodError = form.querySelector('#neighborhood-error');
        if (neighborhoodInput && neighborhoodInput.value.trim().length < 3) {
            neighborhoodError.textContent = 'O nome do bairro deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            neighborhoodError.textContent = '';
        }

        const cityInput = form.querySelector('input[name="city"]');
        const cityError = form.querySelector('#city-error');
        if (cityInput && cityInput.value.trim().length < 3) {
            cityError.textContent = 'O nome da cidade deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            cityError.textContent = '';
        }

        const stateInput = form.querySelector('input[name="state"]');
        const stateError = form.querySelector('#state-error');
        if (stateInput && stateInput.value.trim().length < 2) {
            stateError.textContent = 'O nome do estado deve ter pelo menos 2 letras.';
            isValid = false;
        } else {
            stateError.textContent = '';
        }

        const zipcodeInput = form.querySelector('input[name="zipcode"]');
        const zipcodeError = form.querySelector('#zipcode-error');
        if (zipcodeInput && zipcodeInput.value.trim() === '') {
            zipcodeError.textContent = 'O campo CEP deve ser preenchido.';
            isValid = false;
        } else {
            zipcodeError.textContent = '';
        }

        const countryInput = form.querySelector('input[name="country"]');
        const countryError = form.querySelector('#country-error');
        if (countryInput && countryInput.value.trim().length < 3) {
            countryError.textContent = 'O nome do país deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            countryError.textContent = '';
        }

        // Validando campos da reserva
        const titleInput = form.querySelector('input[name="title"]');
        const titleError = form.querySelector('#title-error');
        if (titleInput && titleInput.value.trim().length < 3) {
            titleError.textContent = 'O título deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            titleError.textContent = '';
        }

        const descriptionInput = form.querySelector('textarea[name="description"]');
        const descriptionError = form.querySelector('#description-error');
        if (descriptionInput && descriptionInput.value.trim() === '') {
            descriptionError.textContent = 'O campo de descrição deve ser preenchido.';
            isValid = false;
        } else {
            descriptionError.textContent = '';
        }

        const startInput = form.querySelector('input[name="start"]');
        const startError = form.querySelector('#noAuth-start-error');
        if (startInput && startInput.value.trim() === '') {
            startError.textContent = 'O campo de data de início deve ser preenchido.';
            isValid = false;
        } else {
            startError.textContent = '';
        }

        const endInput = form.querySelector('input[name="end"]');
        const endError = form.querySelector('#noAuth-end-error');
        if (endInput && endInput.value.trim() === '') {
            endError.textContent = 'O campo de data de fim deve ser preenchido.';
            isValid = false;
        } else {
            endError.textContent = '';
        }

        const startTimeInput = form.querySelector('input[name="start_time"]');
        const startTimeError = form.querySelector('#start_time-error');
        if (startTimeInput && startTimeInput.value.trim() === '') {
            startTimeError.textContent = 'O campo de hora de início deve ser preenchido.';
            isValid = false;
        } else {
            startTimeError.textContent = '';
        }

        const endTimeInput = form.querySelector('input[name="end_time"]');
        const endTimeError = form.querySelector('#end_time-error');
        if (endTimeInput && endTimeInput.value.trim() === '') {
            endTimeError.textContent = 'O campo de hora de fim deve ser preenchido.';
            isValid = false;
        } else {
            endTimeError.textContent = '';
        }

        const rentalItemIdInput = form.querySelector('select[name="rental_item_id"]');
        const rentalItemIdError = form.querySelector('#rental_item_id-error');
        if (rentalItemIdInput && rentalItemIdInput.value === '') {
            rentalItemIdError.textContent = 'O campo de sala deve ser preenchido.';
            isValid = false;
        } else {
            rentalItemIdError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    }

    const noAuthCreateReserveForm = document.getElementById('noAuth-create-reserve-form');
    if (noAuthCreateReserveForm) {
        noAuthCreateReserveForm.addEventListener('submit', validateNoAuthCreateReserveForm);
    }

    const errorMessage = document.querySelector('.error-message');
    if (errorMessage) {
        const modalElement = document.getElementById('noAuth-create-crud-modal');
        if (modalElement) {
            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex');

            const closeButton = document.getElementById('noAuth-close-modal-button');
            closeButton.addEventListener('click', function () {
                modalElement.classList.remove('flex');
                modalElement.classList.add('hidden');
            });
        }
    }

    // Função de formatação de CPF/CNPJ
    function formatCpfCnpj(value) {
        if (!value) return value;
        const cpfCnpj = value.replace(/[^\d]/g, '');
        if (cpfCnpj.length <= 11) {
            return cpfCnpj.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }
        return cpfCnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    }

    // Formatação de CPF/CNPJ
    const cpfCnpjInputs = document.querySelectorAll('input[name="cpf_cnpj"]');
    cpfCnpjInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            this.value = formatCpfCnpj(this.value);
        });
    });

    // Validando e formatando os campos número e CEP para aceitar apenas números
    const numberInputs = document.querySelectorAll('input[name="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
    const zipcodeInputs = document.querySelectorAll('input[name="zipcode"]');
    zipcodeInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
});
