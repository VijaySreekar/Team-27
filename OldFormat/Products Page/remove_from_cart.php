<?php
session_start();

// Function to remove an item from the cart
function removeCartItem($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        return true;
    }
    return false;
}

// Check if product_id is set
if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    if (removeCartItem($productId)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
