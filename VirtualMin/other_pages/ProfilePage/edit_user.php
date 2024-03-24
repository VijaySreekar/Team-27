<?php
     include("../../connectdb.php");
     $id = $_GET['updateid'];

     $sql="SELECT * FROM user WHERE user_id=$id";
     $result=mysqli_query($mysqli, $sql);
     $row=mysqli_fetch_assoc($result);
     $username=$row['username'];
     $email=$row['email'];
     $phone=$row['phone'];
     $password=$row['password'];

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
        <link rel="stylesheet" href="../../Assets/CSS/profile.css">
        <link rel="stylesheet" href="../../Assets/CSS/nav.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
    <?php 
    include '../NavBar_Footer/nav.php';
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
    </body>
</html>