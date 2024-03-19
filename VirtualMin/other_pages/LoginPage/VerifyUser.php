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

        // Prepare the SQL statement
        $sql = "SELECT user_id, passwordhash, email, username, role FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row["passwordhash"];
            $user_id = $row["user_id"];
            $username = $row["username"];
            $role = $row["role"];

            if (password_verify($login_password, $stored_password)) {
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $role;

                // Send JSON response indicating success along with role and username
                echo json_encode(["success" => true, "message" => "Login successful", "role" => $role, "username" => $username]);
            } else {
                // Send JSON response for incorrect password
                echo json_encode(["success" => false, "message" => "Incorrect password. Please try again."]);
            }
        } else {
            // Send JSON response for user not found
            echo json_encode(["success" => false, "message" => "User not found. Please check your email."]);
        }
        $stmt->close();
    }
}

?>
