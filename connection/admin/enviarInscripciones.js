document.addEventListener('DOMContentLoaded', () => {
    const updateButtons = document.querySelectorAll('.btn-success');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.closest('tr').querySelector('th').innerText;
            document.getElementById('user_id').value = userId;
        });
    });
});