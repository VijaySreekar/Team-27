<?php

// Define a list of admin pages
$adminPages = [
    'view_order_admin.php', 'stock.php', 'edit-category.php',
    'edit-product.php', 'edituser.php', 'order_history.php',
    'allorders.php', 'add_products.php', 'category.php',
    'allproducts.php', 'add_category.php', 'add_category_code.php',
    'allusers.php', 'adminpage.php'
];

$currentFile = basename($_SERVER['PHP_SELF']);

// Check if the current file is in the list of admin pages
if (in_array($currentFile, $adminPages)) {
    // Check if the user is authenticated and has the admin role
    if (isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
        // User is an admin and can access the page
        // No action required, the script continues
    } else {
        // User is not an admin, or not logged in, redirect to login page
        header("Location: ../LoginPage/login_page.php");
        exit(); // Important to prevent further script execution
    }
} else {
    // If the file is not in the admin pages list, you can add additional logic here if needed
    // For non-admin pages, or public pages, no action might be required
}
?>
