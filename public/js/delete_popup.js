function showConfirmationPopup() {
    document.getElementById('confirmationPopup').classList.remove('hidden');
}

function hideConfirmationPopup() {
    document.getElementById('confirmationPopup').classList.add('hidden');
}

document.getElementById('deleteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    hideConfirmationPopup();
    this.submit();
});
