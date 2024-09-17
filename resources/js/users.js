document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('edit-crud-modal');
    const editForm = document.getElementById('edit-user-form');

    const modalReactivate = document.getElementById('reactivate-popup-modal');
    const formReactivate = document.getElementById('userActiveForm');

    if (modalReactivate && formReactivate) {
        document.querySelectorAll('button[data-modal-toggle="reactivate-popup-modal"]').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelector('#reactivate').value = button.getAttribute('data-id');
                console.log(button.getAttribute('data-id'));
                formReactivate.action = `/usuarios`;

            });
        });
    }

    if (editModal && editForm) {
        document.querySelectorAll('a[data-modal-toggle="edit-crud-modal"]').forEach(button => {
            button.addEventListener('click', async () => {
                const userId = button.getAttribute('data-id');

                const response = await fetch(`/usuarios/${userId}/editar`);
                const userData = await response.json();

                editForm.action = `/usuarios/${userId}`;
                document.getElementById('update-name').value = userData.name;
                document.getElementById('update-email').value = userData.email;
                document.getElementById('update-company').value = userData.company;
                document.getElementById('update-phone').value = userData.phone;
                document.getElementById('update-role').value = userData.role;
                document.getElementById('update-cpf_cnpj').value = userData.cpf_cnpj;
                document.getElementById('update-street').value = userData.address.street;
                document.getElementById('update-number').value = userData.address.number;
                document.getElementById('update-neighborhood').value = userData.address.neighborhood;
                document.getElementById('update-city').value = userData.address.city;
                document.getElementById('update-state').value = userData.address.state;
                document.getElementById('update-zipcode').value = userData.address.zipcode;
                document.getElementById('update-country').value = userData.address.country;
                document.getElementById('update-complement').value = userData.address.complement;
                document.getElementById('update-user_notes').value = userData.user_notes;

                if (userData.uploads && userData.uploads.length > 0) {
                    document.getElementById('update-image-preview').src = `/storage/${userData.uploads[0].file_path}`;
                    document.getElementById('update-placeholder-image').style.display = 'none';
                    document.getElementById('update-image-preview').style.display = 'block';
                } else {
                    document.getElementById('update-placeholder-image').style.display = 'block';
                    document.getElementById('update-image-preview').style.display = 'none';
                }


                editModal.classList.remove('hidden');
            });
        });

        const closeButton = editModal.querySelector('button[data-modal-toggle="edit-crud-modal"]');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                editModal.classList.add('hidden');
            });
        }
    }

});
