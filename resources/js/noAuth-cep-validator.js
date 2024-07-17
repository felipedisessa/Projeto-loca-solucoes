document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('noAuth-zipcode');
    const addressInput = document.getElementById('noAuth-street');
    const numberInput = document.getElementById('noAuth-number');
    const complementInput = document.getElementById('noAuth-complement');
    const cityInput = document.getElementById('noAuth-city');
    const stateInput = document.getElementById('noAuth-state');
    const neighborhoodInput = document.getElementById('noAuth-neighborhood');
    const countryInput = document.getElementById('noAuth-country');

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
                    alert('CEP não encontrado.');
                }
            } catch (error) {
                clearAddressFields();
                alert('Erro ao buscar o CEP.');
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
