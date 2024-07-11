document.addEventListener('DOMContentLoaded', function () {
    function validateForm(form) {
        let isValid = true;

        // Validando o campo nome
        const nameInput = form.querySelector('input[name="name"]');
        const nameError = form.querySelector('#name-error');
        if (nameInput && nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (nameError) {
            nameError.textContent = '';
        }

        // Validando o campo email
        const emailInput = form.querySelector('input[name="email"]');
        const emailError = form.querySelector('#email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput && !emailPattern.test(emailInput.value)) {
            emailError.textContent = 'O email deve ser um email valido.';
            isValid = false;
        } else if (emailError) {
            emailError.textContent = '';
        }

        // Validando o campo senha para que tenha pelo menos 8 dígitos
        const passwordInput = form.querySelector('input[name="password"]');
        const passwordError = form.querySelector('#password-error');
        if (passwordInput && passwordInput.value.trim().length < 8) {
            passwordError.textContent = 'A senha deve ter pelo menos 8 dígitos.';
            isValid = false;
        } else if (passwordError) {
            passwordError.textContent = '';
        }

        // Validando o campo empresa (company)
        const companyInput = form.querySelector('input[name="company"]');
        const companyError = form.querySelector('#company-error');
        if (companyInput && companyInput.value.trim().length < 3) {
            companyError.textContent = 'A empresa deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (companyError) {
            companyError.textContent = '';
        }

        // Validando o campo telefone
        const phoneInput = form.querySelector('input[name="phone"]');
        const phoneError = form.querySelector('#phone-error');
        if (phoneInput && phoneInput.value.trim() === '') {
            phoneError.textContent = 'O campo de telefone deve ser preenchido.';
            isValid = false;
        } else if (phoneError) {
            phoneError.textContent = '';
        }

        // Validando o campo cpf_cnpj
        const cpfCnpjInput = form.querySelector('input[name="cpf_cnpj"]');
        const cpfCnpjError = form.querySelector('#cpf_cnpj-error');
        const cpfCnpjPattern = /^[0-9]+$/;
        if (cpfCnpjInput && !cpfCnpjPattern.test(cpfCnpjInput.value)) {
            cpfCnpjError.textContent = 'O cpf_cnpj deve conter apenas números.';
            isValid = false;
        } else if (cpfCnpjError) {
            cpfCnpjError.textContent = '';
        }

        // Validando o campo cep
        const cepInput = form.querySelector('input[name="zipcode"]');
        const cepError = form.querySelector('#zipcode-error');
        const cepPattern = /^[0-9]+$/;
        if (cepInput && !cepPattern.test(cepInput.value)) {
            cepError.textContent = 'O cep deve conter apenas números.';
            isValid = false;
        } else if (cepError) {
            cepError.textContent = '';
        }

        // Validando o campo numero
        const numeroInput = form.querySelector('input[name="number"]');
        const numeroError = form.querySelector('#number-error');
        const numeroPattern = /^[0-9]+$/;
        if (numeroInput && !numeroPattern.test(numeroInput.value)) {
            numeroError.textContent = 'O numero deve conter apenas números.';
            isValid = false;
        } else if (numeroError) {
            numeroError.textContent = '';
        }

        // Validando dados de endereços obrigatórios
        const streetInput = form.querySelector('input[name="street"]');
        const streetError = form.querySelector('#street-error');
        if (streetInput && streetInput.value.trim().length < 3) {
            streetError.textContent = 'O nome da rua deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (streetError) {
            streetError.textContent = '';
        }

        const cityInput = form.querySelector('input[name="city"]');
        const cityError = form.querySelector('#city-error');
        if (cityInput && cityInput.value.trim().length < 3) {
            cityError.textContent = 'O nome da cidade deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (cityError) {
            cityError.textContent = '';
        }

        const neighborhoodInput = form.querySelector('input[name="neighborhood"]');
        const neighborhoodError = form.querySelector('#neighborhood-error');
        if (neighborhoodInput && neighborhoodInput.value.trim().length < 3) {
            neighborhoodError.textContent = 'O nome do bairro deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (neighborhoodError) {
            neighborhoodError.textContent = '';
        }

        const stateInput = form.querySelector('input[name="state"]');
        const stateError = form.querySelector('#state-error');
        if (stateInput && stateInput.value.trim().length < 2) {
            stateError.textContent = 'O nome do estado deve ter pelo menos 2 letras.';
            isValid = false;
        } else if (stateError) {
            stateError.textContent = '';
        }

        const countryInput = form.querySelector('input[name="country"]');
        const countryError = form.querySelector('#country-error');
        if (countryInput && countryInput.value.trim().length < 3) {
            countryError.textContent = 'O nome do país deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (countryError) {
            countryError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault(); // Impede a submissão do formulário
        }

        return isValid;
    }

    // Adiciona evento de escuta para o formulário de criação de usuário
    const createUserForm = document.getElementById('user-form');
    if (createUserForm) {
        createUserForm.addEventListener('submit', function (event) {
            if (!validateForm(createUserForm)) {
                event.preventDefault();
            }
        });
    }

    // Adiciona evento de escuta para o formulário de edição de usuário
    const editUserForm = document.getElementById('edit-user-form');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function (event) {
            if (!validateForm(editUserForm)) {
                event.preventDefault();
            }
        });
    }

    // Função de formatação de telefone
    function formatPhone(value) {
        if (!value) return value;
        const phoneNumber = value.replace(/[^\d]/g, '');
        const phoneNumberLength = phoneNumber.length;
        if (phoneNumberLength <= 10) {
            return phoneNumber.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        return phoneNumber.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }

    // Formatação de telefone
    const phoneInputs = document.querySelectorAll('input[name="phone"], input[name="mobile"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            this.value = formatPhone(this.value);
        });
    });

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
});
