<?php
session_start();

$host = "localhost";
$username = "u-230185247";
$password = "z3mlfs8WdS1hxvH";
$dbname = "u_230185247_treaker";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_email"]) && isset($_POST["login_password"])) {
        $login_email = mysqli_real_escape_string($conn, $_POST["login_email"]);
        $login_password = $_POST["login_password"];

        // Validate user credentials
        // Add username in the SELECT clause
        $sql = "SELECT user_id, passwordhash, email, username FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row["passwordhash"];
            $user_id = $row["user_id"];
            // Use the actual username from the database
            $username = $row["username"];

            // Verify the provided password against the stored hash
            if (password_verify($login_password, $stored_password)) {
                echo json_encode(["success" => true, "message" => "Login successful"]);

                // Set session variables for user_id and username
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username; // This now uses the username from the database

                // Redirect or perform other actions
            } else {
                echo json_encode(["success" => false, "message" => "Incorrect password. Please try again."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "User not found. Please check your username."]);
        }
        $stmt->close();
    }
}
?>
