<?php
session_start(); // Start the session
include("../../connectdb.php");
include("Nav Bar\\nav.php"); 
?>
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
        echo '<div class="basket-item" data-id="' . $item['basket_item_id'] . '">';
            echo '<div class="basket-item" data-id="' . $item['id'] . '">';
            echo '<span class="item-name">' . $item['product_id'] . '</span>';
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