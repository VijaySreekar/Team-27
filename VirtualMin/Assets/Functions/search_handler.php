<?php
session_start();
include '../../Assets/Database/connectdb.php';

// Check if search query is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchQuery'])) {
    $searchQuery = $mysqli->real_escape_string($_POST['searchQuery']);

    // Prepare statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT product_id, name, slug, image, discounted_price FROM product WHERE name LIKE CONCAT('%', ?, '%') AND status = 1 LIMIT 10");
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Return results as JSON and exit script to prevent further HTML rendering
    echo json_encode($products);
    exit;
}
