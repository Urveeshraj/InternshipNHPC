
document.addEventListener('DOMContentLoaded', function() {

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const courseId = button.dataset.courseId;
            const quantity = prompt('Enter quantity:', '1');

            if (quantity !== null && !isNaN(quantity) && quantity > 0) {
                addToCart(courseId, quantity);
            } else {
                alert('Invalid quantity! Please enter a valid number.');
            }
        });
    });

    function addToCart(courseId, quantity) {
        const formData = new FormData();
        formData.append('course_id', courseId);
        formData.append('quantity', quantity);

        fetch('cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Course added to cart successfully!');
            } else {
                alert('Failed to add course to cart. Please try again later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    }


    const updateCartButtons = document.querySelectorAll('.update-cart-btn');

    updateCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const courseId = button.dataset.courseId;
            const quantity = prompt('Enter new quantity:', '1');

            if (quantity !== null && !isNaN(quantity) && quantity > 0) {
                updateCart(courseId, quantity);
            } else {
                alert('Invalid quantity! Please enter a valid number.');
            }
        });
    });

    function updateCart(courseId, quantity) {
        const formData = new FormData();
        formData.append('course_id', courseId);
        formData.append('quantity', quantity);

        fetch('update_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cart updated successfully!');

            } else {
                alert('Failed to update cart. Please try again later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    }

    const removeCartButtons = document.querySelectorAll('.remove-cart-btn');

    removeCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const courseId = button.dataset.courseId;

            if (confirm('Are you sure you want to remove this course from cart?')) {
                removeFromCart(courseId);
            }
        });
    });

    function removeFromCart(courseId) {
        const formData = new FormData();
        formData.append('course_id', courseId);

        fetch('remove_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Course removed from cart successfully!');
  
            } else {
                alert('Failed to remove course from cart. Please try again later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    }
});
