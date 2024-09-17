document.addEventListener('DOMContentLoaded', function () {

    const phoneDisplayFields = document.querySelectorAll('.phone-display');
    phoneDisplayFields.forEach(field => {
        field.textContent = formatToBrazilianPhone(field.textContent);
    });

    const phoneInputFields = document.querySelectorAll('input[type="tel"], input[name="phone"], input[name="mobile"]');
    phoneInputFields.forEach(field => {
        field.addEventListener('input', formatPhoneNumber);

        field.value = formatToBrazilianPhone(field.value);
    });

    function formatPhoneNumber(event) {
        let input = event.target;
        let value = input.value.replace(/\D/g, '');


        if (value.length > 11) {
            value = value.slice(0, 11);
        }

        input.value = formatToBrazilianPhone(value);
    }

    function formatToBrazilianPhone(value) {
        value = value.replace(/\D/g, '');

        let isMobile = value.length === 11 && value[2] === '9';

        if (isMobile) {
            return value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        } else if (value.length === 10) {
            return value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
        }
        return value;
    }
});
