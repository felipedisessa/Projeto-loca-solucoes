document.addEventListener('DOMContentLoaded', function () {
    // Formatar números de telefone nos campos de exibição
    const phoneDisplayFields = document.querySelectorAll('.phone-display');
    phoneDisplayFields.forEach(field => {
        field.textContent = formatToBrazilianPhone(field.textContent);
    });

    // Formatar números de telefone nos campos de entrada
    const phoneInputFields = document.querySelectorAll('input[type="tel"], input[name="phone"], input[name="mobile"]');
    phoneInputFields.forEach(field => {
        field.addEventListener('input', formatPhoneNumber);
        // Formatação inicial para valores existentes
        field.value = formatToBrazilianPhone(field.value);
    });

    function formatPhoneNumber(event) {
        let input = event.target;
        input.value = formatToBrazilianPhone(input.value);
    }

    function formatToBrazilianPhone(value) {
        value = value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

        // Verifica se é um número de celular (começa com 9 após o código de área)
        let isMobile = value.length > 2 && value[2] === '9';

        if (isMobile && value.length === 11) {
            // Formatar como (XX) XXXXX-XXXX
            return value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        } else if (value.length === 10) {
            // Formatar como (XX) XXXX-XXXX
            return value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
        }
        return value;
    }
});
