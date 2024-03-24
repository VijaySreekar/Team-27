<?php
session_start();

include '../../Assets/Database/connectdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or any other appropriate action
    header("Location: login.php"); // Replace "login.php" with your login page URL
    exit();
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file

    // Collect and sanitize input data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Email exists, proceed with updating the password

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_sql = "UPDATE user SET passwordhash = '$hashed_password' WHERE email = '$email'";
        if (mysqli_query($conn, $update_sql)) {
            echo "Password successfully changed.";
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    } else {
        // Email does not exist
        echo "No account found with that email address.";
    }

    // Close database connection
    mysqli_close($conn);
}
?>