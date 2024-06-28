document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('user-form').addEventListener('submit', function (event) {
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


        // Validando o campo email
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            emailError.textContent = 'O email deve ser um email valido.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validando o campo telefone
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');
        const phonePattern = /^[0-9]+$/;
        if (!phonePattern.test(phoneInput.value)) {
            phoneError.textContent = 'O telefone deve conter apenas números.';
            isValid = false;
        } else {
            phoneError.textContent = '';
        }


        // Validando o campo cpf_cnpj
        const cpfCnpjInput = document.getElementById('cpf_cnpj');
        const cpfCnpjError = document.getElementById('cpf_cnpj-error');
        const cpfCnpjPattern = /^[0-9]+$/;
        if (!cpfCnpjPattern.test(cpfCnpjInput.value)) {
            cpfCnpjError.textContent = 'O cpf_cnpj deve conter apenas números.';
            isValid = false;
        } else {
            cpfCnpjError.textContent = '';
        }


        // Validando o campo cep
        const cepInput = document.getElementById('zipcode');
        const cepError = document.getElementById('zipcode-error');
        const cepPattern = /^[0-9]+$/;
        if (!cepPattern.test(cepInput.value)) {
            cepError.textContent = 'O cep deve conter apenas números.';
            isValid = false;
        } else {
            cepError.textContent = '';
        }


        // Validando o campo numero
        const numeroInput = document.getElementById('number');
        const numeroError = document.getElementById('number-error');
        const numeroPattern = /^[0-9]+$/;
        if (!numeroPattern.test(numeroInput.value)) {
            numeroError.textContent = 'O numero deve conter apenas números.';
            isValid = false;
        } else {
            numeroError.textContent = '';
        }


        // Validando o campo celular
        const mobileInput = document.getElementById('mobile');
        const mobileError = document.getElementById('mobile-error');
        const mobilePattern = /^[0-9]+$/;
        if (!mobilePattern.test(mobileInput.value)) {
            mobileError.textContent = 'O celular deve conter apenas números.';
            isValid = false;
        } else {
            mobileError.textContent = '';
        }

        //validando dados de enderecos obrigatorios
        const streetInput = document.getElementById('street');
        const streetError = document.getElementById('street-error');
        if (streetInput.value.trim().length < 3) {
            streetError.textContent = 'O nome da rua deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            streetError.textContent = '';
        }


        const cityInput = document.getElementById('city');
        const cityError = document.getElementById('city-error');
        if (cityInput.value.trim().length < 3) {
            cityError.textContent = 'O nome da cidade deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            cityError.textContent = '';
        }


        const stateInput = document.getElementById('state');
        const stateError = document.getElementById('state-error');
        if (stateInput.value.trim().length < 3) {
            stateError.textContent = 'O nome do estado deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            stateError.textContent = '';
        }


        const countryInput = document.getElementById('country');
        const countryError = document.getElementById('country-error');
        if (countryInput.value.trim().length < 3) {
            countryError.textContent = 'O nome do pais deve ter pelo menos 3 letras.';
            isValid = false;
        } else {
            countryError.textContent = '';
        }


        if (!isValid) {
            event.preventDefault(); // Impede a submissão do formulário
        }
    });
});
