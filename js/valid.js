(function() {
    'use strict';
    let forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
            }
        }, false);
    });
})();
document.addEventListener('DOMContentLoaded', function() {
    const expirationInput = document.getElementById('cc-expiration');
    expirationInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2);
        }
        this.value = value.slice(0, 5);
    });
});