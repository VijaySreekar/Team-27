<?php
session_start(); // Start the session

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_db";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a SQL query to retrieve user data
    $sql = "SELECT id, name, email, password FROM accounts WHERE email = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the email parameter
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $id, $name, $retrieved_email, $plain_password);

    // Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        // Verify the password
        if ($password === $plain_password) {
            // Password is correct, user is authenticated
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $retrieved_email;

            // Redirect to a logged-in page or dashboard
            header("Location: login_page.php");
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // Email not found
        echo "Email not found";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
