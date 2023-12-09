<?php

include("connectdb.php");

// Fetch basket items from the database
$basketItemsQuery = $mysqli->query("SELECT * FROM basket");
if (!$basketItemsQuery) {
    die('Error in SQL query: ' . $mysqli->error);
}

$basketItems = $basketItemsQuery->fetch_all(MYSQLI_ASSOC);

// Function to calculate the total price
function calculateTotal($basketItems) {
    $total = 0;
    foreach ($basketItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Basket</title>
    <link rel="stylesheet" href="basket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">
                <img src="Images/Treakers%20Logo.png" alt="Your Logo">
            </div>
        </div>
        <div class="navbar-center">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li class="center"><a href="#">Products</a></li>
                <li class="upward"><a href="#">About</a></li>
                <li class="forward"><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="buttons">
                <button class="basket">
                    <i class="fas fa-shopping-basket"></i> Basket
                </button>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <button class="search-button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </nav>

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

       
        <?php
        foreach ($basketItems as $item) {
            echo '<div class="basket-item" data-id="' . $item['id'] . '">';
            echo '<span class="item-name">' . $item['name'] . '</span>';
            echo '<input type="number" min="1" value="' . $item['quantity'] . '" class="quantity-input" data-price="' . $item['price'] . '"/>';
            echo '<span class="price">$' . ($item['price'] * $item['quantity']) . '</span>';
            echo '<span class="remove-button" onclick="removeItemFromBasket(' . $item['id'] . ')"><i class="fas fa-trash"></i></span>';
            echo '</div>';
        }
        ?>

        <div class="total-price">Total Price: £<?= number_format(calculateTotal($basketItems), 2) ?></div>

        <form action="payment.php" method="post">
            <button type="submit">Pay Now</button>
        </form>
    </div>

    <script>
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