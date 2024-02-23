<?php
    session_start(); // Start the session
    include("../../connectdb.php");
    include("../../edit_user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave A Review</title>
    <link rel="stylesheet" href="review.css">
    <link rel="stylesheet" href="../NavBar/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <?php 
        include '../NavBar/nav.php';
    ?>
</body>