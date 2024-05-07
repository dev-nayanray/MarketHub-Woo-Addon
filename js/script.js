document.addEventListener('DOMContentLoaded', function() {
    var element = document.getElementById('someElementId');
    if (element) {
        element.addEventListener('event', functionHandler);
    } else {
        console.error('Element not found!');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    var element = document.getElementById('someElementId');
    console.log('Element:', element);

    if (element) {
        element.addEventListener('event', functionHandler);
    } else {
        console.error('Element not found!');
    }
});

fetch('path/to/server').then(function(response) {
    return response.text();
}).then(function(html) {
    document.getElementById('ajax-content').innerHTML = html;
    var element = document.getElementById('someElementId');
    if (element) {
        element.addEventListener('event', functionHandler);
    } else {
        console.error('Element not found after AJAX load!');
    }
}).catch(function(err) {
    console.error('Failed to load page: ', err);
});

jQuery(document).ready(function($) {
    // Increment quantity
    $('.increment-button').click(function() {
        var cart_key = $(this).data('product-key');
        // Implement AJAX to increment quantity in the cart
    });

    // Decrement quantity
    $('.decrement-button').click(function() {
        var cart_key = $(this).data('product-key');
        // Implement AJAX to decrement quantity in the cart
    });

    // Remove item from cart
    $('.remove-item').click(function() {
        var cart_key = $(this).data('product-key');
        // Implement AJAX to remove item from the cart
    });
});
