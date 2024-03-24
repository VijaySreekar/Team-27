<?php
session_start();

include '../../Assets/Functions/myfunctions.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login/Signup</title>

    <link rel="stylesheet" href="../../Assets/CSS/login.css">
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Truncleta:wght@400&display=swap">
    <link rel="stylesheet" href="../../Assets/CSS/nav.css">

    <!-- Nucleo Icons -->
    <link href="../../Assets/CSS/nucleo-icons.css" rel="stylesheet" />
    <link href="../../Assets/CSS/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../Assets/CSS/material-dashboard.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="../../Assets/CSS/nav.css">
    <link rel="stylesheet" href="../../Assets/CSS/login.css">
</head>
<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include("../../Includes/nav.php"); ?>

        <nav class="breadcrumbs">
            <a href="../../index.php" class="breadcrumbs__item"><i class="bi bi-house"></i> Home</a>
            <a href="#>" class="breadcrumbs__item is-active"><i class="bi bi-person"></i> Login</a>
        </nav>

        <div class="container mt-6 mb-6">
            <input type="checkbox" id="change" style="display: none;">
            <div class="cover">
                <div class="login">
                    <img class="backImg" src="../../Assets/Images/Shoe%201%20(Login).png" alt="" style="object-fit: cover; width: 100%; height: 100%;"></div>
                <div class="register" style="transform: rotateY(180deg); position: absolute; width: 100%; height: 100%;">
                    <img class="backImg" src="../../Assets/Images/Shoe%202%20(Registration).png" alt="" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
            </div>
            <div class="loginregister_form pt-6" style="background: rgba(251,254,249,0);">
                <div class="content" style="display: flex; justify-content: space-between;">
                    <div class="login_form">
                        <div class="title" style="font-size: 24px; font-weight: 500; color: #333;">Login</div>
                        <form id="login-form" action="VerifyUser.php" method="post">
                            <div class="input-boxes" style="margin-top: 30px;">
                                <div class="input-box" style="display: flex; align-items: center; position: relative;">
                                    <i class="fas fa-envelope" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="text" placeholder="Enter your email" name="login_email" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="password" name="login_password" placeholder="Enter your password" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <a href="forgot_password.php" class="forgot-password-link" style="text-decoration: none; font-size: 14px; font-weight: 500; color: #333;">Forgot Password?</a>
                                <div class="button input-box" style="margin-top: 40px;">
                                    <input type="submit" value="Login" name="login_button" style="color: #fff; background: #0c6291; border-radius: 6px; cursor: pointer;">
                                </div>
                                <div class="text sign-up-text" style="text-align: center; margin-top: 25px;">Don't have an account? <label for="change" style="color: #0c6291; cursor: pointer;">Signup now</label></div>
                            </div>
                        </form>
                        <div id="error-message" style="color:red;"></div>
                    </div>
                    <div class="signup_form">
                        <div class="title" style="font-size: 24px; font-weight: 500; color: #333;">Signup</div>
                        <form id="signup-form" action="RegisterUser.php" method="post">
                            <div class="input-boxes" style="margin-top: 30px;">
                                <div class="input-box">
                                    <i class="fas fa-user" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="text" name="reg_name" placeholder="Enter your Name" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-phone" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="number" name="reg_phone" placeholder="Enter your Phone Number" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-envelope" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="email" name="reg_email" placeholder="Enter your E-Mail" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="password" name="reg_password" placeholder="Enter your password" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock" style="position: absolute; color: #0c6291; font-size: 17px;"></i>
                                    <input type="password" name="reg_confirmpassword" placeholder="Confirm password" required style="padding-left: 30px; border-bottom: 2px solid rgba(0,0,0,0.2);">
                                </div>
                                <div class="button input-box" style="margin-top: 40px;">
                                    <input type="submit" value="Register" name="register_btn" style="color: #fff; background: #0c6291; border-radius: 6px; cursor: pointer;">
                                </div>
                                <div class="text sign-up-text" style="text-align: center; margin-top: 25px;">Already have an account? <label for="change" style="color: #0c6291; cursor: pointer;">Login now</label></div>
                            </div>
                        </form>
                        <div id="signup-error-message" style="color:red;"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../../Includes/footer.php"); ?>
    </main>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/login.js"></script>
</body>
</html>
