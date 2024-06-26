document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('edit-crud-modal');
    const editForm = document.getElementById('edit-user-form');

    document.querySelectorAll('a[data-modal-toggle="edit-crud-modal"]').forEach(button => {
        button.addEventListener('click', async () => {
            const userId = button.getAttribute('data-id');

            // Fetch user data from the server
            const response = await fetch(`/usuarios/${userId}/edit`);
            const userData = await response.json();

            // Populate the form fields with the user data
            editForm.action = `/usuarios/${userId}`;
            document.getElementById('update-name').value = userData.name;
            document.getElementById('update-email').value = userData.email;
            document.getElementById('update-company').value = userData.company;
            document.getElementById('update-password').value = userData.password;
            document.getElementById('update-phone').value = userData.phone;
            document.getElementById('update-mobile').value = userData.mobile;
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

            // Show the modal
            editModal.classList.remove('hidden');
        });
    });

    // Hide the modal when the close button is clicked
    editModal.querySelector('button[data-modal-toggle="edit-crud-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
});
