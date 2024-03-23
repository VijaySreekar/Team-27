<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<section id="navigation">
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">
                <img src="../../Images/Treakers%20Logo.png" alt="Company Logo">
            </div>
        </div>
        <div class="navbar-center">
            <ul class="nav-links">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../ProductPage/products-page.php">Products</a></li>
                <li><a href="../AboutUsPage/aboutus.php">About</a></li>
                <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <div class="buttons">
                <?php
                if(isset($_SESSION['authentication']))
                {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['authentication_user']['name']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../ProfilePage/profile.php">Your Profile</a></li>
                            <li><a class="dropdown-item" href="../LoginPage/logout.php">Log out</a></li>
                        </ul>
                    </li>
                    }
                    else
                    {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../LoginPage/login_page.php"><i class="fas fa-user"></i> Login/Signup</a>
                    </li>
                    <?php
                }
                ?>
                <a href="../BasketPage/basket.php">
                    <button class="navbar-button">
                        <i class="fas fa-shopping-basket"></i>
                    </button>
                </a>
        </div>
            <div class="search-bar">
                <form action="../other_pages/ProductPage/products-page.php" method="GET">
                    <input type="text" name="search" placeholder="Search" required>
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
</section>
</body>
</html>




