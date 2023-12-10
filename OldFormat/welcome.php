<?php
    session_start();
    include("connectdb.php");

    if(isset($_SESSION['username'])){
        echo "<p>Welcome, ". $_SESSION['username']. "!</p>";
    } else {
        echo "<p>You are not logged in.</p>";
    }
?>