document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('edit-crud-modal');
    const editForm = document.getElementById('edit-reserve-form');

    document.querySelectorAll('a[data-modal-toggle="edit-crud-modal"]').forEach(button => {
        button.addEventListener('click', async () => {
            const reserveId = button.getAttribute('data-id');

            // Fetch reserve data from the server
            const response = await fetch(`/reserves/${reserveId}/edit`);
            const reserveData = await response.json();

            // Populate the form fields with the reserve data
            editForm.action = `/reserves/${reserveId}`;
            document.getElementById('update-user_id').value = reserveData.user_id;
            document.getElementById('update-title').value = reserveData.title;
            document.getElementById('update-description').value = reserveData.description;
            document.getElementById('update-start').value = reserveData.start;
            document.getElementById('update-end').value = reserveData.end;
            document.getElementById('update-price').value = reserveData.price;
            document.getElementById('update-status').value = reserveData.status;
            document.getElementById('update-payment_type').value = reserveData.payment_type;
            document.getElementById('update-rental_item_id').value = reserveData.rental_item_id;


            // Show the modal
            editModal.classList.remove('hidden');
        });
    });

    // Hide the modal when the close button is clicked
    editModal.querySelector('button[data-modal-toggle="edit-crud-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
});
