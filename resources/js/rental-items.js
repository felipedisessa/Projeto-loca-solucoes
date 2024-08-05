document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('edit-crud-modal');
    const editForm = document.getElementById('edit-rental-item-form');

    document.querySelectorAll('a[data-modal-toggle="edit-crud-modal"]').forEach(button => {
        button.addEventListener('click', async () => {
            const rentalItemId = button.getAttribute('data-id');

            const response = await fetch(`/salas/${rentalItemId}/editar`);
            const rentalItemData = await response.json();

            editForm.action = `/salas/${rentalItemId}`;
            document.getElementById('update-user_id').value = rentalItemData.user_id;
            document.getElementById('update-name').value = rentalItemData.name;
            document.getElementById('update-description').value = rentalItemData.description;
            document.getElementById('update-price_per_day').value = rentalItemData.price_per_day ? rentalItemData.formatted_price_per_day : '';
            document.getElementById('update-price_per_hour').value = rentalItemData.price_per_hour ? rentalItemData.formatted_price_per_hour : '';
            document.getElementById('update-price_per_month').value = rentalItemData.price_per_month ? rentalItemData.formatted_price_per_month : '';
            document.getElementById('update-status').value = rentalItemData.status;
            document.getElementById('update-rental_item_notes').value = rentalItemData.rental_item_notes;
            document.getElementById('update-street').value = rentalItemData.address.street;
            document.getElementById('update-number').value = rentalItemData.address.number;
            document.getElementById('update-complement').value = rentalItemData.address.complement;
            document.getElementById('update-city').value = rentalItemData.address.city;
            document.getElementById('update-state').value = rentalItemData.address.state;
            document.getElementById('update-zipcode').value = rentalItemData.address.zipcode;
            document.getElementById('update-country').value = rentalItemData.address.country;
            document.getElementById('update-neighborhood').value = rentalItemData.address.neighborhood;

            if (rentalItemData.uploads && rentalItemData.uploads.length > 0) {
                document.getElementById('update-image-preview').src = `/storage/${rentalItemData.uploads[0].file_path}`;
                document.getElementById('update-placeholder-image').style.display = 'none';
                document.getElementById('update-image-preview').style.display = 'block';
            } else {
                document.getElementById('update-placeholder-image').style.display = 'block';
                document.getElementById('update-image-preview').style.display = 'none';
            }

            editModal.classList.remove('hidden');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const formImage = document.getElementById('delete-image-form');
        formImage.addEventListener('submit', (event) => {
            event.preventDefault();
            const button = document.getElementById('delete-image-button');
            const itemId = button.getAttribute('data-id');
            formImage.action = `/rental-items/${itemId}/delete-image`;
            formImage.submit();
        });
    });


    editModal.querySelector('button[data-modal-toggle="edit-crud-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
});
