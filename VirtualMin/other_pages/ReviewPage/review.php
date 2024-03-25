<?php
session_start();
include "../../Assets/Database/connectdb.php";

$order_id = $_GET['orderId'] ?? null;

if (!$order_id) {
    echo "Order ID is required.";
    exit;
}

// Fetch products in the order
$sql = "SELECT p.product_id, p.name FROM order_items oi JOIN product p ON oi.product_id = p.product_id WHERE oi.order_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    // Insert review into the database
    $sql = "INSERT INTO user_review (user_id, product_id, order_id, rating, comment) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iiiis", $user_id, $product_id, $order_id, $rating, $comment);
    $stmt->execute();

    // Redirect or display a success message
    echo "Review submitted successfully!";
}

?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave A Review</title>
    <!-- Include your CSS here (e.g., Bootstrap) -->
</head>
<body>
<div class="container">
    <h2>Leave a Review</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="product">Select Product:</label>
            <select name="product_id" id="product" class="form-control" required>
                <option value="">--Select a Product--</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= htmlspecialchars($product['product_id']) ?>">
                        <?= htmlspecialchars($product['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>

<!-- Include your JS here (e.g., jQuery, Bootstrap) -->
</body>
</html>
