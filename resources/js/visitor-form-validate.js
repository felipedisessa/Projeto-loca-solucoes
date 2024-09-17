import axios from "axios";

document.addEventListener('DOMContentLoaded', function () {

    function validateNoAuthCreateReserveForm(event) {
        let isValid = true;

        const form = document.getElementById('noAuth-create-reserve-form');

        function isTruncated(value) {
            return value.startsWith('...');
        }

        const nameInput = form.querySelector('input[name="name"]');
        const nameError = form.querySelector('#name-error');
        if (nameInput && nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        const emailInput = form.querySelector('input[name="email"]');
        const emailError = form.querySelector('#email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput && !emailPattern.test(emailInput.value)) {
            emailError.textContent = 'O email deve ser um email válido.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        const phoneInput = form.querySelector('input[name="phone"]');
        const phoneError = form.querySelector('#phone-error');
        if (phoneInput && phoneInput.value.trim() === '') {
            phoneError.textContent = 'O campo de telefone deve ser preenchido.';
            isValid = false;
        } else {
            phoneError.textContent = '';
        }

        const cpfCnpjInput = form.querySelector('input[name="cpf_cnpj"]');
        const cpfCnpjError = form.querySelector('#cpf_cnpj-error');
        const cpfCnpjPattern = /^[0-9]+$/;
        const cpfCnpjValue = cpfCnpjInput.value.replace(/[^\d]/g, '');
        const isTruncatedValue = isTruncated(cpfCnpjInput.value);

        if (cpfCnpjInput && !isTruncatedValue) {
            if (!cpfCnpjPattern.test(cpfCnpjValue) || (cpfCnpjValue.length !== 11 && cpfCnpjValue.length !== 14)) {
                cpfCnpjError.textContent = 'O CPF deve ter 11 números ou o CNPJ deve ter 14 números.';
                isValid = false;
            } else {
                cpfCnpjError.textContent = '';
            }
        } else {
            cpfCnpjError.textContent = '';
        }

        const companyInput = form.querySelector('input[name="company"]');
        const companyError = form.querySelector('#company-error');
        if (companyInput && companyInput.value.trim().length < 3) {
            companyError.textContent = 'A empresa deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            companyError.textContent = '';
        }

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

    const button = document.getElementById('noAuth-search-button');

    button.addEventListener('click', function () {
        const email = document.querySelector('input[name="email"]').value;
        if (email) {
            checkUser(email);
        }
    });


    function truncateValue(value) {
        if (value && value.length > 4) {
            return '...' + value.slice(-4);
        }
        return value;
    }

    const checkUser = async (email) => {
        try {
            const {data} = await axios.get(`/check-user-exists/${email}`);
            const emailError = document.querySelector('#email-error');
            emailError.textContent = '';

            document.querySelector('input[name="name"]').value = truncateValue(data.name) || '';
            document.querySelector('input[name="phone"]').value = truncateValue(data.phone) || '';
            document.querySelector('input[name="cpf_cnpj"]').value = truncateValue(data.cpf_cnpj) || '';
            document.querySelector('input[name="company"]').value = truncateValue(data.company) || '';
            document.querySelector('input[name="street"]').value = truncateValue(data.address?.street) || '';
            document.querySelector('input[name="number"]').value = truncateValue(data.address?.number) || '';
            document.querySelector('input[name="complement"]').value = truncateValue(data.address?.complement) || '';
            document.querySelector('input[name="neighborhood"]').value = truncateValue(data.address?.neighborhood) || '';
            document.querySelector('input[name="city"]').value = truncateValue(data.address?.city) || '';
            document.querySelector('input[name="state"]').value = truncateValue(data.address?.state) || '';
            document.querySelector('input[name="zipcode"]').value = truncateValue(data.address?.zipcode) || '';
            document.querySelector('input[name="country"]').value = truncateValue(data.address?.country) || '';

            document.querySelectorAll('.hidden-fields').forEach(function (field) {
                field.classList.remove('hidden-fields');
            });
        } catch (error) {
            if (error.response && error.response.status === 403) {
                const emailError = document.querySelector('#email-error');
                if (emailError) {
                    emailError.textContent = 'O email informado não está disponível.';
                }
            }
        }
    }

    function formatCpfCnpj(value) {
        if (!value) return value;
        const cpfCnpj = value.replace(/[^\d]/g, '').slice(0, 14); // Limita o valor a 14 dígitos
        if (cpfCnpj.length <= 11) {
            return cpfCnpj.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }
        return cpfCnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    }

    const cpfCnpjInputs = document.querySelectorAll('input[name="cpf_cnpj"]');
    cpfCnpjInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            this.value = formatCpfCnpj(this.value);
        });
    });

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
});
