document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('user-form').addEventListener('submit', function(event) {
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



        if (!isValid) {
            event.preventDefault(); // Impede a submissão do formulário
        }
    });
});
