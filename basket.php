<?php
// Sample basket items (you can replace this with your logic to fetch items from a database, for example)
$basketItems = [
    ['Product 1', 20.00, 2],
    ['Product 2', 15.00, 1],
    ['id' => 1, 'name' => 'Nike AirForce', 'price' => 70, 'quantity' => 2],
    ['id' => 2, 'name' => 'New Balance', 'price' => 30, 'quantity' => 1],
    
];

// Function to calculate the total price
function calculateTotal($basketItems) {
    $total = 0;
    foreach ($basketItems as $item) {
        $total += $item[1] * $item[2];
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

@@ -17,17 +18,19 @@ function calculateTotal($basketItems) {

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
                <img src="Images/YourLogo.png" alt="Your Logo">
                <img src="Images/Treakers%20Logo.png" alt="Your Logo">
            </div>
        </div>
        <div class="navbar-center">


@@ -57,33 +60,79 @@ function calculateTotal($basketItems) {
        </div>
        <div class="basket-item-heading">
            <h3>Item</h3>
            <h3>Price</h3>
            <h3>Quantity</h3>
            <h3>Total</h3>
            <h3>Remove</h3>
        </div>

        <!-- Dynamically generate basket items -->
        <?php foreach ($basketItems as $item): ?>
            <div class="basket-item">
                <div class="basket-item-detail"><?= $item[0] ?></div>
                <div class="basket-item-detail">$<?= number_format($item[1], 2) ?></div>
                <div class="basket-item-detail"><?= $item[2] ?></div>
                <div class="basket-item-detail">$<?= number_format($item[1] * $item[2], 2) ?></div>
            </div>
        <?php endforeach; ?>
       
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

        <!-- Total price -->
        <div class="total-price">Total Price: $<?= number_format(calculateTotal($basketItems), 2) ?></div>
        <div class="total-price">Total Price: £<?= number_format(calculateTotal($basketItems), 2) ?></div>

        <!-- Pay Now button -->
        <form action="payment.php" method="post">
            <button type="submit">Pay Now</button>
        </form>
        
<!-- Footer -->
<footer class="footer">
    <p>&copy; 2023 Your Company. All rights reserved.</p>
</footer>
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

</html>