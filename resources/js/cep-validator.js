document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('zipcode');
    const addressInput = document.getElementById('street');
    const numberInput = document.getElementById('number');
    const complementInput = document.getElementById('complement');
    const cityInput = document.getElementById('city');
    const stateInput = document.getElementById('state');
    const neighborhoodInput = document.getElementById('neighborhood');
    const countryInput = document.getElementById('country');

    cepInput.addEventListener('input', async (event) => {
        const cep = event.target.value.replace(/\D/g, '');
        if (cep.length === 8) {
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
                    clearAddressFields();
                }
            } catch (error) {
                clearAddressFields();
            }
        }
    });

    function clearAddressFields() {
        addressInput.value = '';
        cityInput.value = '';
        stateInput.value = '';
        neighborhoodInput.value = '';
        countryInput.value = '';
    }
});
