<?php
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
        // Display product details
        echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
        echo "<img src='" . $product['image_link'] . "' alt='" . htmlspecialchars($product['name']) . "' style='width:300px; height:auto;'>";
        echo "<p>Price: £" . htmlspecialchars($product['price']) . "</p>";
        // Size dropdown and add to cart button
        echo "<select id='size-select'>";
        // Populate sizes here
        echo "</select>";
        echo "<button onclick='addToCart(" . $product['product_id'] . ")'>Add to Cart</button>";
    } else {
        echo "Product not found.";
    }
    $conn->close();
}


?>
