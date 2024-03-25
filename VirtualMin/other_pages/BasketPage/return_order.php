<?php
session_start();
include '../../Assets/Database/connectdb.php';

if (isset($_POST['return_button']) && isset($_POST['id'])) {
    $order_id = $_POST['id'];
    $tracking_no = $_POST['tracking_no'];

    $orderItemsQuery = "SELECT product_id, quantity FROM order_items WHERE order_id = ?";
    $orderItemsStmt = $conn->prepare($orderItemsQuery);
    if (!$orderItemsStmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $orderItemsStmt->bind_param('i', $order_id);
    $orderItemsStmt->execute();
    $orderItemsResult = $orderItemsStmt->get_result();

    if ($orderItemsResult->num_rows > 0) {
        while ($orderItem = $orderItemsResult->fetch_assoc()) {
            $product_id = $orderItem['product_id'];
            $return_quantity = $orderItem['quantity'];


            $updateProductQuery = "UPDATE product SET quantity = quantity + ? WHERE product_id = ?";
            $updateProductStmt = $conn->prepare($updateProductQuery);
            if (!$updateProductStmt) {
                echo "Error preparing product update statement: " . $conn->error;
                continue;
            }

            $updateProductStmt->bind_param('ii', $return_quantity, $product_id);
            $updateProductStmt->execute();
        }
    } else {
        echo "Order items not found for this order.";
        exit;
    }

    $updateOrderQuery = "UPDATE orders SET status = 4 WHERE id = ?";
    $updateOrderStmt = $conn->prepare($updateOrderQuery);
    if (!$updateOrderStmt) {
        echo "Error preparing order update statement: " . $conn->error;
        exit;
    }

    $updateOrderStmt->bind_param('i', $order_id);
    if ($updateOrderStmt->execute()) {
        header("Location: view_order.php?t=$tracking_no");
        exit();
    } else {
        echo "Error updating order status: " . $conn->error;
    }
} else {
    echo "No order specified or return button not clicked.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Order</title>
    <!-- Include any additional CSS files here -->
</head>
<body>
<div class="return-form">
    <h2>Order Return Form</h2>
    <form action="return_order.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($order_id ?? ''); ?>">
        <button type="submit" name="return_button">Return Order</button>
    </form>
</div>
</body>
</html>

