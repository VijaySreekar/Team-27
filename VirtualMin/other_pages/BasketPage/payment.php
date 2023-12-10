<?php 
    include "../../connectdb.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Your Profile</title>
        <link rel="stylesheet" href="../ProfilePage/profile.css">
        <link rel="stylesheet" href="../NavBar/nav.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php 
            include("../NavBar/navbar.php");
            
            $sql="INSERT INTO order_history (user_id, product_id, date) VALUES ('')";
            $result = mysqli_query($mysqli, $sql);

        ?>
        <div class="container">
            Your order has been placed. Thank you!
        </div>
    </body>
</html>