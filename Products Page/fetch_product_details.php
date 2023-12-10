<?php
session_start();

// Function to add an item to the cart
function addToCart($productId, $quantity) {
    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Sanitize the input
    $productId = intval($productId);
    $quantity = intval($quantity);

    // Add the item to the cart
    if (isset($_SESSION['cart'][$productId])) {
        // If the item is already in the cart, update the quantity
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        // If the item is not in the cart, add it with the quantity
        $_SESSION['cart'][$productId] = ['quantity' => $quantity];
    }

    // Return updated cart as JSON
    echo json_encode($_SESSION['cart']);
}

if (isset($_GET['action']) && $_GET['action'] === 'add_to_cart' && isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $quantity = $_GET['quantity'] ?? 1; // Default quantity to 1 if not specified

    // Call the addToCart function
    addToCart($productId, $quantity);
    exit(); // Important to prevent further script execution
}

function getProductPriceFromDatabase($productId) {
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

    // Query to fetch product price
    $query = "SELECT price FROM product WHERE product_id = '$productId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['price'];
    } else {
        $price = 0; // Default price if product not found
    }

    $conn->close();

    return $price;
}

function calculateCartSubtotal(): float|int
{
    $subtotal = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $item) {
            // Fetch the product price from the database
            $productPrice = getProductPriceFromDatabase($productId);

            // Calculate the item subtotal (price * quantity)
            $itemSubtotal = $productPrice * $item['quantity'];

            // Add the item subtotal to the overall subtotal
            $subtotal += $itemSubtotal;
        }
    }

    return $subtotal;
}

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

if (isset($_GET['product_id'])) {
    $productId = $conn->real_escape_string($_GET['product_id']);

    // Query to fetch product details
    $query = "SELECT * FROM product WHERE product_id = '$productId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        echo "<div class='product-details-container'>";
        echo "<div class='product-details-left'>";
        echo "<img src='" . $product['image_link'] . "' alt='" . htmlspecialchars($product['name']) . "' style='width:500px; height:auto;'>";
        echo "</div>";
        echo "</div>";

        echo "<div class='product-details-right'>";
        echo "<h3 class='product-detail-title'>" . htmlspecialchars($product['name']) . "</h3>";
        echo "<p class='product-detail-description'>Description: " . htmlspecialchars($product['description']) . "</p>";

        // Size dropdown
        echo "<label for='size-select' class='product-detail-label'>Select Size:</label>";
        echo "<select id='size-select' class='product-detail-select'>";
        // Populate sizes here (You need to retrieve the available sizes from your database)
        echo "<option value='size1'>Size 1</option>";
        echo "<option value='size2'>Size 2</option>";
        echo "<option value='size3'>Size 3</option>";
        echo "</select>";

        echo "<p class='product-detail-price'>Price: £" . htmlspecialchars($product['price']) . "</p>";

        // Add to cart button
        echo "<button onclick='addToCart(" . $product['product_id'] . ", 1)' class='product-detail-button'>Add to Cart</button>";

        // Display cart subtotal
        if (isset($_SESSION['cart'])) {
            echo "<p class='cart-subtotal'>Cart Subtotal: £" . number_format(calculateCartSubtotal(), 2) . "</p>";
        }

        echo "</div>";

        echo "</div>";
    } else {
        echo "Product not found.";
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
