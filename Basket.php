<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Basket</title>
 
</head>
<body>
    <header id="main-header">
        <nav>
           
        </nav>
    </header>
    <main>
        <h2>Basket</h2>
        <div class="basket-container">
            <div class="basket-item-heading">
                <h3>Item</h3>
            </div>
            <div class="basket-item-heading">
                <h3>Price</h3>
            </div>
            <div class="basket-item-heading">
                <h3>Quantity</h3>
            </div>
            <div class="basket-item-heading">
                <h3>Total</h3>
            
            <?php
            session_start();
            include("connectdb.php");

            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                // Retrieve the user's basket information from the database
                $userId = $_SESSION['id'];
                $query = "SELECT b.product_id, p.product_name, p.price, b.quantity 
                          FROM basket b
                          INNER JOIN products p ON b.product_id = p.product_id
                          WHERE b.user_id = $userId";
                $result = mysqli_query($conn, $query);

                // Display basket items
                $totalPrice = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $productName = $row['product_name'];
                    $productPrice = $row['price'] * $row['quantity'];
                    $totalPrice += $productPrice;

                    echo '<div class="basket-item">';
                    echo "<div class='basket-item-detail'>$productName</div>";
                    echo "<div class='basket-item-detail'>$productPrice</div>";
                    echo "<div class='basket-item-detail'>{$row['quantity']}</div>";
                    echo '</div>';
                }

                // Display total price
                echo "<div class='total-price'>Total Price: $totalPrice</div>";

                // "Pay Now" button
                echo '<form action="payment.php" method="post">';
                echo '<button type="submit">Pay Now</button>';
                echo '</form>';
            } else {
                echo "<h3>You aren't logged in.</h3>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </main>
    
</body>
</html>
