<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Success!</title>
        <link rel="stylesheet" href="../ProfilePage/profile.css"/>
    </head>
    <body>
        <?php include "nav.php"?>
        <div class="container">
            <h3>Successfully logged out!</h3>
            <button><a href="../../index.php">Home</a></button>
        </body>
</html>
