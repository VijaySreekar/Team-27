$(document).ready(function() {
    // Function to perform search
    function performSearch() {
        var searchQuery = $('.search-input').val();
        if (searchQuery.length > 2) {
            $.ajax({
                url: '../../Assets/Functions/search_handler.php', // Or the URL where your PHP search handling code is
                type: 'POST',
                dataType: 'json',
                data: {searchQuery: searchQuery},
                success: function(products) {
                    var suggestions = products.map(product =>
                        `<div class='suggestion-item' data-slug='${product.slug}'>
            <img src='../../Assets/Images/Product_Images/${product.image}' class='suggestion-image'>
            <div class='suggestion-details'>
                <span class='suggestion-name'>${product.name}</span>
                <span class='suggestion-price'>£: ${product.discounted_price}</span>
            </div>
        </div>`
                    ).join('');
                    $('.search-suggestions').html(suggestions).show();
                },
            });
        } else {
            $('.search-suggestions').hide();
        }
    }

    // Event listener for search input
    $('.search-input').on('input', function() {
        performSearch();
    });

    // Event listener for search button
    $('.search-button').on('click', function(e) {
        e.preventDefault(); // Prevent the form from submitting through the browser
        performSearch();
    });

    // Event listener for clicking on a suggestion
    $(document).on('click', '.suggestion-item', function() {
        var slug = $(this).data('slug');
        window.location.href = `other_pages/ProductPage/view_product.php?product=${slug}`;
    });
});