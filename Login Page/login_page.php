<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login/Register</title>
    <link rel="stylesheet" href="../login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <li><a href="#">Home</a></li>
            <li class="center"><a href="#">Products</a></li>
            <li class="upward"><a href="#">About</a></li>
            <li class="forward"><a href="#">Contact Us</a></li>
        </ul>
    </div>
    <div class="navbar-right">
        <div class="buttons">
            <button class="login-signup"><i class="fas fa-user"></i> Login/Signup</button>
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

<div class="container">
    <input type="checkbox" id="change">
    <div class="cover">
        <div class="login">
            <img class="backImg" src="../Images/Shoe%201%20(Login).png" alt="">
            <div class="text">
                <span class="slogan-1">Start your Adventure <br> Here</span>
                <span class="slogan-2">Login and Discover!</span>
            </div>
        </div>
        <div class="register">
            <img class="backImg" src="../Images/Shoe%202%20(Registration).png" alt="">
        </div>
    </div>
    <div class="loginregister_form">
        <div class="content">
            <div class="login_form">
                <div class="title">Login</div>
                <form action="VerifyUser.php" method="post">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" placeholder="Enter your email" name="email" id="email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" value="Login">
                        </div>
                        <div class="text sign-up-text">Don't have an account? <label for="change">Signup now</label></div>
                    </div>
                </form>
            </div>
            <div class="signup_form">
                <div class="title">Signup</div>
                <form action="RegisterUser.php" method="post">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" id="name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Register">
                        </div>
                        <div class="text sign-up-text">Already have an account? <label for="change">Login now</label></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="fcontainer">
        <div class="row">
            <div class="footer-col">
                <h4>Treakers</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our products</a></li>
                    <li><a href="#">privacy policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="#">Basket</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>online shop</h4>
                <ul>
                    <li><a href="#">Sneakers</a></li>
                    <li><a href="#">Trainers</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
