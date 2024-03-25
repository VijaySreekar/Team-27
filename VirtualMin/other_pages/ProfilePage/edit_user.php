<?php
session_start();
     include("../../Assets/Database/connectdb.php");
     $id = $_GET['updateid'];

     $sql="SELECT * FROM user WHERE user_id=$id";
     $result=mysqli_query($mysqli, $sql);
     $row=mysqli_fetch_assoc($result);
     $username=$row['username'];
     $email=$row['email'];
     $phone=$row['phone'];
     $password=$row['passwordhash'];

    //if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST['submit'])){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $password=password_hash($_POST["password"], PASSWORD_BCRYPT);
        $sql="UPDATE user SET username='$username', email='$email', phone='$phone', passwordhash='$password'
        WHERE user_id=$id";
        $result= mysqli_query($mysqli, $sql);

        header("Location:profile.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Categories</title>

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
</head>
    <body>
    <?php 
    include '../../Includes/nav.php';
    ?>
        <div class="container">
            <form id="update" method="POST">
                <h3>Edit Your Details</h3>
                <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username?>">
                <br/>
                <label>Email</label>
                <input type="text" name="email" id="email" value="<?php echo $email?>">
                <br/>
                <label>Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone?>">
                <br/>
                <label>Password</label>
                <input type="text" name="password" id="password">
                <button type="submit" class="button" name="submit">Update</button>
            </form>
        </div>
    <?php include("../../Includes/footer.php"); ?>
}
    </body>
</html>