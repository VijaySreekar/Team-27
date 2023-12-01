<?php
// Sample basket items (you can replace this with your logic to fetch items from a database, for example)
$basketItems = [
    ['Product 1', 20.00, 2],
    ['Product 2', 15.00, 1],
];

// Function to calculate the total price
function calculateTotal($basketItems) {
    $total = 0;
    foreach ($basketItems as $item) {
        $total += $item[1] * $item[2];
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
                <img src="Images/YourLogo.png" alt="Your Logo">
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
            <h3>Price</h3>
            <h3>Quantity</h3>
            <h3>Total</h3>
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

        <!-- Total price -->
        <div class="total-price">Total Price: $<?= number_format(calculateTotal($basketItems), 2) ?></div>

        <!-- Pay Now button -->
        <form action="payment.php" method="post">
            <button type="submit">Pay Now</button>
        </form>
        
<!-- Footer -->
<footer class="footer">
    <p>&copy; 2023 Your Company. All rights reserved.</p>
</footer>
    </div>
</body>
</html>
