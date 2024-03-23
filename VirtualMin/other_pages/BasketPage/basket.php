<?php
session_start();
include("../ProductPage/fetch_product_details.php"); // Assuming this includes necessary functions

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../LoginPage/login_page.php"); // Replace with your login page URL
    exit();
}

function getProductDetails($productId) {
    // Database connection details
    $host = "localhost";
    $username = "u-230185247";
    $password = "z3mlfs8WdS1hxvH";
    $dbname = "u_230185247_treaker";

    // Create database connection
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch product details
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $productDetails = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $productDetails;
    } else {
        $stmt->close();
        $conn->close();
        return null; // Or handle the case where no product is found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Basket</title>
    <link rel="stylesheet" href="basket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../NavBar_Footer/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php include("../NavBar_Footer/nav.php"); ?>

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
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $productId => $item) {
            // Assuming you have a function to fetch product details
            $productDetails = getProductDetails($productId);
            echo '<div class="basket-item" data-id="' . $productId . '">';
            echo '<span class="item-name">' . htmlspecialchars($productDetails['name']) . '</span>';
            echo '<input type="number" min="1" value="' . $item['quantity'] . '" class="quantity-input" data-price="' . $productDetails['price'] . '"/>';
            echo '<span class="price">£' . ($productDetails['price'] * $item['quantity']) . '</span>';
            echo '<span class="remove-button" onclick="removeItemFromBasket(' . $productId . ')"><i class="fas fa-trash"></i></span>';
            echo '</div>';
        }
    } else {
        echo "<p>Your basket is empty.</p>";
    }
    ?>

    <div class="total-price">Total Price: £<?= number_format(calculateCartSubtotal(), 2) ?></div>

    <form action="payment.php" method="post">
        <button type="submit">Pay Now</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Update quantities in the cart
        var quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                var productId = this.closest('.basket-item').dataset.id;
                updateItemQuantity(productId, this.value);
            });
        });

        // Update total price based on quantity changes
        function updateItemQuantity(productId, quantity) {
            $.ajax({
                url: 'update_cart.php', // Handle quantity update in update_cart.php
                type: 'POST',
                data: { product_id: productId, quantity: quantity },
                success: function(response) {
                    location.reload(); // Reload to reflect updated cart
                }
            });
        }

        // Remove item from the basket
        window.removeItemFromBasket = function(productId) {
            $.ajax({
                url: 'remove_from_cart.php', // Handle item removal in remove_from_cart.php
                type: 'POST',
                data: { product_id: productId },
                success: function(response) {
                    location.reload(); // Reload to reflect updated cart
                }
            });
        };
    });
</script>
</body>
<footer class="footer">
    <div class="fcontainer">
        <div class="row">
            <div class="footer-col">
                <h4>Treakers</h4>
                <ul>
                    <li><a href="../AboutUsPage/aboutus.php">about us</a></li>
                    <li><a href="../ProductPage/products-page.php">our products</a></li>
                    <li><a href="#">privacy policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="../BasketPage/basket.php">Basket</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>online shop</h4>
                <ul>
                    <li><a href="../../index.php">Sneakers</a></li>
                    <li><a href="../../index.php">Trainers</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>
