<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
        <div class="logo">
            <img src="../Images/Treakers%20Logo.png" alt="Company Logo">
        </div>
    </div>
    <div class="navbar-center">
        <ul class="nav-links">
            <li><a href="../HomePage/HomePage.php">Home</a></li>
            <li><a href="../ProductPage/products-page.php">Products</a></li>
            <li><a href="../../aboutus.php">About</a></li>
            <li><a href="../../contacatus.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="navbar-right">
        <div class="buttons">
            <?php
            // Check if the user is logged in and has a valid session
            if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
                // Display the user-signed buttons with the same style as basket and search buttons
                echo '<button class="navbar-button"><i class="fas fa-user"></i> ' . $_SESSION['name'] . '</button>';
            } else {
                // Display the "Login/Signup" button with a class
                echo '<button class="navbar-button"><i class="fas fa-user"></i> Login/Signup</button>';
            }
            ?>
            <a href="../Products%20Page/basket.php">
                <button class="navbar-button">
                    <i class="fas fa-shopping-basket"></i>
                </button>
            </a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button class="search-button"><i class="fas fa-search"></i></button>
        </div>
    </div>
</nav>
</body>
</html>
