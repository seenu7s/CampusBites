// Handle quantity form submissions
document.addEventListener('DOMContentLoaded', function() {
    const quantityForms = document.querySelectorAll('.quantity-form');
    
    quantityForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const quantityInput = this.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value);
            
            if (isNaN(quantity) || quantity < 1) {
                e.preventDefault();
                alert('Please enter a valid quantity (minimum 1)');
                quantityInput.value = quantityInput.defaultValue;
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('.option-btn');
            submitBtn.value = 'Updating...';
            submitBtn.disabled = true;
        });
    });
    
    // Handle quantity input changes
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 1) {
                this.value = 1;
            }
        });
    });
}); 