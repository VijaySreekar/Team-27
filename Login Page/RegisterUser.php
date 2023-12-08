<?php


session_start();

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Check if the email already exists in the database
    $check_sql = "SELECT user_id FROM accounts WHERE email = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        // Insert the new user data into the database
        $insert_sql = "INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "sss", $name, $email, $password);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo "Registration successful! You can now login.";
        } else {
            echo "Registration failed. Please try again.";
        }
    }

    // Close the statement
    mysqli_stmt_close($check_stmt);
    mysqli_stmt_close($insert_stmt);
}

// Close the database connection
mysqli_close($conn);

