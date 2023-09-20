function showEditConfirmationPopup() {
    document.getElementById('editPopup').classList.remove('hidden');
}

function hideEditConfirmationPopup() {
    document.getElementById('editPopup').classList.add('hidden');
}

document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault();
    hideConfirmationPopup();
    this.submit();
});
