document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.zipcode-input').forEach(cepInput => {
        cepInput.addEventListener('input', async (event) => {
            const cep = event.target.value.replace(/\D/g, '');
            if (cep.length === 8) {
                const parentElement = event.target.closest('form') || document;
                const addressInput = parentElement.querySelector('.street-input');
                const numberInput = parentElement.querySelector('.number-input');
                const complementInput = parentElement.querySelector('.complement-input');
                const cityInput = parentElement.querySelector('.city-input');
                const stateInput = parentElement.querySelector('.state-input');
                const neighborhoodInput = parentElement.querySelector('.neighborhood-input');
                const countryInput = parentElement.querySelector('.country-input');

                try {
                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const data = await response.json();
                    if (!data.erro) {
                        addressInput.value = data.logradouro;
                        cityInput.value = data.localidade;
                        stateInput.value = data.uf;
                        neighborhoodInput.value = data.bairro;
                        countryInput.value = 'Brasil';
                    } else {
                        clearAddressFields(parentElement);
                    }
                } catch (error) {
                    clearAddressFields(parentElement);
                }
            }
        });
    });

    function clearAddressFields(parentElement) {
        parentElement.querySelector('.street-input').value = '';
        parentElement.querySelector('.city-input').value = '';
        parentElement.querySelector('.state-input').value = '';
        parentElement.querySelector('.neighborhood-input').value = '';
        parentElement.querySelector('.country-input').value = '';
    }
});
