document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('create-reserve-form').addEventListener('submit', function(event) {
        let isValid = true;

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

        if (!isValid) {
            event.preventDefault();
        }});
})
