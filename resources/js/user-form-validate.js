document.addEventListener('DOMContentLoaded', function () {
    const allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
    const maxImageSize = 2048 * 1024; // 2048KB

    function validateForm(form) {
        let isValid = true;

        const nameInput = form.querySelector('input[name="name"]');
        const nameError = form.querySelector('#name-error');
        if (nameInput && nameInput.value.trim().length < 3) {
            nameError.textContent = 'O nome deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (nameError) {
            nameError.textContent = '';
        }

        const emailInput = form.querySelector('input[name="email"]');
        const emailError = form.querySelector('#email-error');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput && !emailPattern.test(emailInput.value)) {
            emailError.textContent = 'O email deve ser um email válido.';
            isValid = false;
        } else if (emailError) {
            emailError.textContent = '';
        }

        const passwordInput = form.querySelector('input[name="password"]');
        const passwordError = form.querySelector('#password-error');
        if (passwordInput && passwordInput.value.trim().length < 8) {
            passwordError.textContent = 'A senha deve ter pelo menos 8 dígitos.';
            isValid = false;
        } else if (passwordError) {
            passwordError.textContent = '';
        }

        const companyInput = form.querySelector('input[name="company"]');
        const companyError = form.querySelector('#company-error');
        if (companyInput && companyInput.value.trim().length < 3) {
            companyError.textContent = 'A empresa deve ter pelo menos 3 letras.';
            isValid = false;
        } else if (companyError) {
            companyError.textContent = '';
        }

        const phoneInput = form.querySelector('input[name="phone"]');
        const phoneError = form.querySelector('#phone-error');
        if (phoneInput && phoneInput.value.trim().length < 10) {
            phoneError.textContent = 'O telefone deve ter pelo menos 10 dígitos.';
            isValid = false;
        } else if (phoneError) {
            phoneError.textContent = '';
        }

        const cpfCnpjInput = form.querySelector('input[name="cpf_cnpj"]');
        const cpfCnpjError = form.querySelector('#cpf_cnpj-error');
        const cpfCnpjPattern = /^[0-9]+$/;
        const cpfCnpjValue = cpfCnpjInput.value.replace(/[^\d]/g, '');
        if (cpfCnpjInput && (!cpfCnpjPattern.test(cpfCnpjValue) || (cpfCnpjValue.length !== 11 && cpfCnpjValue.length !== 14))) {
            cpfCnpjError.textContent = 'O CPF deve ter 11 números ou o CNPJ deve ter 14 números.';
            isValid = false;
        } else if (cpfCnpjError) {
            cpfCnpjError.textContent = '';
        }

        const cepInput = form.querySelector('input[name="zipcode"]');
        const cepError = form.querySelector('#zipcode-error');
        const cepPattern = /^[0-9]+$/;
        if (cepInput && !cepPattern.test(cepInput.value)) {
            cepError.textContent = 'O CEP deve conter apenas números.';
            isValid = false;
        } else if (cepError) {
            cepError.textContent = '';
        }

        // Validando o campo número
        const numeroInput = form.querySelector('input[name="number"]');
        const numeroError = form.querySelector('#number-error');
        const numeroPattern = /^[0-9]+$/;
        if (numeroInput && !numeroPattern.test(numeroInput.value)) {
            numeroError.textContent = 'O número deve conter apenas números.';
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

        const imageInput = form.querySelector('input[name="profile_image"]');
        const imageError = form.querySelector('#profile_image-error');
        if (imageInput && imageInput.files.length > 0) {
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
        } else if (imageError) {
            imageError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault(); // Impede a submissão do formulário
        }

        return isValid;
    }

    const createUserForm = document.getElementById('user-form');
    if (createUserForm) {
        createUserForm.addEventListener('submit', function (event) {
            if (!validateForm(createUserForm)) {
                event.preventDefault();
            }
        });
    }

    const editUserForm = document.getElementById('edit-user-form');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function (event) {
            if (!validateForm(editUserForm)) {
                event.preventDefault();
            }
        });
    }

    // Função de formatação de CPF/CNPJ
    function formatCpfCnpj(value) {
        if (!value) return value;
        const cpfCnpj = value.replace(/[^\d]/g, '').slice(0, 14); // Limita o valor a 14 dígitos
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
