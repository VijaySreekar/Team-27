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

        echo "<div class='product-details-container'>";
        echo "<div class='product-details-left'>";
//        echo "<img src='" . $product['image_link'] . "' alt='" . htmlspecialchars($product['name']) . "' class='product-detail-img'>";
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
        echo "<button onclick='addToCart(" . $product['product_id'] . ")' class='product-detail-button'>Add to Cart</button>";
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




