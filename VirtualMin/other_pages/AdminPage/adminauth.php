<?php
session_start();


if(isset($_SESSION['role'])) {
    if($_SESSION['role'] == "admin") {
        header("Location: adminpage.php");
    } else {
        header("Location: ../../index.php");
    }
    exit();
} else {
    // If not authenticated, redirect to login page
    header("Location: ../LoginPage/login_page.php");
    exit();
}
?>
?>