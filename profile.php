<?php
session_start(); // Start the session
include("../../connectdb.php");
include("../../edit_user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../NavBar/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
  <body>
    <?php 
    include '../NavBar/nav.php';
    ?>
    <div class="user-info">
      <?php 
        $id=$_SESSION['user_id'];
        $sql ="SELECT * FROM user WHERE user_id=$id";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
       
        $username=$row['username'];
        $email=$row['email'];
        $password=$row['passwordhash'];
        $phone=$row['phone'];
        
        if(isset($username)){
          echo "<div class=\"container\">";
          echo "<h3> Hi there, ". $username .".</h3>";
          echo "<p><b>Your details:</b></p>";
          echo "Username: ".$username;
          echo "<br/>Email: ".$email;
          echo "<br/>Phone: ".$phone;
          // echo "<br/>Password: ".$password;
          echo "<br/><button><a href='edit_user.php?updateid={$row['user_id']}'>Edit Details</a></button>";
          echo "</div>";
        } else {
          echo "<p>Please log in to see this page.</p>";
          echo "<button><a href=\"../LoginPage/login_page.php\">Log In</a></button>";
        }
      ?>
    </div>
    <div class="container">
        previous orders here
    </div>
    </div>
  </body>
</html>