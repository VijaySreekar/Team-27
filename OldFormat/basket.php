<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or any other appropriate action
    header("Location: login.php"); // Replace "login.php" with your login page URL
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Basket</title>
    <link rel="stylesheet" href="basket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="Nav%20Bar/nav.css">
</head>

<body>
<?php
include("Nav Bar/nav.php");
?>
<div class="basket-container">
    <div class="basket-heading">
        <h2>Your Basket</h2>
    </div>
    <div class="basket-item-heading">
        <h3>Item</h3>
        <h3>Quantity</h3>
        <h3>Total</h3>
        <h3>Remove</h3>
    </div>

    <!-- Display cart items and subtotal here -->
    <?php
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $item) {
            // Fetch product details based on $productId and display them
            // You need to implement this part
            echo '<div class="basket-item">';
            echo '<span class="item-name">' . $productId . '</span>';
            echo '<input type="number" min="1" value="' . $item['quantity'] . '" class="quantity-input"/>';
            // Display the item total (price * quantity)
            echo '<span class="price">$' . (getProductPriceFromDatabase($productId) * $item['quantity']) . '</span>';
            echo '<span class="remove-button"><i class="fas fa-trash"></i></span>';
            echo '</div>';
        }
    }
    ?>

    <!-- Display cart subtotal -->
    <div class="total-price">Total Price: £<?= number_format(calculateCartSubtotal(), 2) ?></div>

    <form action="payment.php" method="post">
        <button type="submit">Pay Now</button>
    </form>
</div>

<script>
    // JavaScript code for handling cart interactions (e.g., updating quantity and removing items)
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInputs = document.querySelectorAll('.quantity-input');
        var removeButtons = document.querySelectorAll('.remove-button');
        var totalPriceElement = document.querySelector('.total-price');

        quantityInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                updateTotalPrice(input);
            });
        });

        removeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var itemId = button.closest('.basket-item').dataset.id;
                removeItemFromBasket(itemId);
            });
        });

        function updateTotalPrice(input) {
            var quantity = input.value;
            var price = input.dataset.price;
            var itemTotal = parseFloat(price) * quantity;
            var priceElement = input.closest('.basket-item').querySelector('.price');
            priceElement.textContent = '£' + itemTotal.toFixed(2);

            calculateAndDisplayTotalPrice();
        }

        function removeItemFromBasket(itemId) {
            var itemElement = document.querySelector('[data-id="' + itemId + '"]');
            itemElement.remove();

            calculateAndDisplayTotalPrice();
        }

        function calculateAndDisplayTotalPrice() {
            var allPrices = document.querySelectorAll('.price');
            var totalPrice = Array.from(allPrices).reduce(function (sum, priceElement) {
                return sum + parseFloat(priceElement.textContent.replace('£', ''));
            }, 0);

            totalPriceElement.textContent = 'Total Price: £' + totalPrice.toFixed(2);
        }
    });
</script>
</body>
</html>
