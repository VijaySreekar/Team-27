<?php
session_start();
include("../../Assets/Database/connectdb.php");

// Check if updateid is set in the URL
if(isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($mysqli, $id);

    $sql="SELECT * FROM user WHERE user_id=$id";
    $result=mysqli_query($mysqli, $sql);

    // Check if user with given ID exists
    if(mysqli_num_rows($result) > 0) {
        $row=mysqli_fetch_assoc($result);
        $username=$row['username'];
        $email=$row['email'];
        $phone=$row['phone'];
        $password=$row['passwordhash'];

        if(isset($_POST['submit'])){
            $username=mysqli_real_escape_string($mysqli, $_POST["username"]);
            $email=mysqli_real_escape_string($mysqli, $_POST["email"]);
            $phone=mysqli_real_escape_string($mysqli, $_POST["phone"]);
            $password=password_hash(mysqli_real_escape_string($mysqli, $_POST["password"]), PASSWORD_BCRYPT);

            $sql="UPDATE user SET username='$username', email='$email', phone='$phone', passwordhash='$password' WHERE user_id=$id";
            $result= mysqli_query($mysqli, $sql);

            if($result) {
                header("Location:profile.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }
        }
    } else {
        echo "User with ID $id does not exist.";
    }
} else {
    echo "No user ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Your Details</title>

    <link rel="icon" type="image/png" sizes="76x76" href="../../Assets/Images/Treakersfavicon.png">
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Edit Your Details</h3>
                    </div>
                    <div class="card-body">
                        <form id="update" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../../Includes/footer.php"); ?>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Assets/JS/smooth-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Assets/JS/custom.js"></script>
    <script src="../../Assets/JS/searchbar.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/65ff54951ec1082f04da7f5c/1hpmm4q27';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
</body>
</html>