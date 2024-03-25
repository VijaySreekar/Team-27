<?php
session_start();
include 'connectdb.php';

// Check if search query is set
if(isset($_POST['searchQuery'])) {
    $searchQuery = $_POST['searchQuery'];

    // Prepare statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT product_id, name, slug FROM product WHERE name LIKE CONCAT('%', ?, '%') AND active = 1 LIMIT 10");
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Return results as JSON
    echo json_encode($products);
} else {
    echo json_encode([]);
}
?>
