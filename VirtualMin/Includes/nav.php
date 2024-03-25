<nav class="navbar bg-gradient-light ">
    <div class="navbar-left">
        <div class="logo">
            <img src="../../Assets/Images/Treakers%20Logo.png" alt="Company Logo" class="logo-img" width="70px">
        </div>
        <div class="navbar-center ml-5">
            <ul class="nav-links">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../ProductPage/category_page.php">Categories</a></li>
                <li><a href="../ProductPage/allproductsuser.php">Products</a></li>
                <li><a href="../AboutUsPage/aboutus.php">About</a></li>
                <li><a href="../ContactUsPage/contactus.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-right ml-3">
        <div class="login_buttons">
            <?php
            if(isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                ?>
                <div class="dropdown bg-gradient-secondary rounded">
                    <button class="logged-button btn bg-gradient-primary rounded fs-5 mr-3">
                        <a href="#" class="nav-link text-white">
                            <span class="text-white"><i class="bi bi-person-check fs-5"></i><?php echo $_SESSION['username']; ?></span>
                        </a>
                    </button>
                    <div class="dropdown-content">
                        <a href="../ProfilePage/profile.php">Your Profile</a>
                        <a href="../LoginPage/logout.php">Log out</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <button class="btn logged-button bg-gradient-primary rounded fs-5 mr-3 mt-3">
                    <a class="nav-link text-white" href="../LoginPage/login_page.php">
                        <i class="bi bi-person fs-5 mr-1"></i>Login/Signup
                    </a>
                </button>
                <?php
            }
            ?>
        </div>
        <div class="basket-icon">
            <button class="btn basket-button bg-gradient-primary rounded fs-5 mr-3 mt-3">
                <a href="../BasketPage/cart.php"><i class="bi bi-cart4 text-white"></i></a>
            </button>
        </div>
        <div class="search-bar">
            <input type="text" class="form-control search-input" placeholder="Search">
            <button class="btn search-button bg-gradient-primary"><i class="bi bi-search"></i></button>
            <div class="search-suggestions"></div> <!-- Container for search suggestions -->
        </div>
    </div>
</nav>