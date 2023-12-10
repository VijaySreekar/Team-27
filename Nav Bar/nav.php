<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../nav.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <nav class="navbar navbar-fixed-top">
            <div class="navbar-left">
                <div class="logo">
                    <img src="../Images/Treakers%20Logo.png" alt="Company Logo">
                </div>
            </div>
            <div class="navbar-center">
                <ul class="nav-links">
                    <li><a href="../HomePage/HomePage.php">Home</a></li>
                    <li class="center"><a href="../ProductPage/products-page.php">Products</a></li>
                    <li class="upward"><a href="../../aboutus.php">About</a></li>
                    <li class="forward"><a href="../../contacatus.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="navbar-right">
                <div class="buttons">
                    <?php
                    // Check if the user is logged in and has a valid session
                    if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
                        // Display the username with a class
                        echo '<span class="username"><i class="fas fa-user"></i> ' . $_SESSION['name'] . '</span>';
                    } else {
                        // Display the "Login/Signup" button with a class
                        echo '<button class="login-signup-btn"><i class="fas fa-user"></i> Login/Signup</button>';
                    }
                    ?>
                    <button class="basket">
                        <i class="fas fa-shopping-basket"></i>
                    </button>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <button class="search-button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </nav>
    </body>
</html>