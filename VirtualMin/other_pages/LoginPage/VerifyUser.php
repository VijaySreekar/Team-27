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
    echo json_encode(["success" => false, "message" => "Connection failed: " . mysqli_connect_error()]);
    exit; // Exit the script if connection failed
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_email"]) && isset($_POST["login_password"])) {
    $login_email = mysqli_real_escape_string($conn, $_POST["login_email"]);
    $login_password = mysqli_real_escape_string($conn, $_POST["login_password"]);

    // Validate user credentials
    $stmt = $conn->prepare("SELECT user_id, passwordhash, email FROM user WHERE email = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error in preparing statement: " . $conn->error]);
        $conn->close();
        exit;
    }

    $stmt->bind_param("s", $login_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["passwordhash"];
        $user_id = $row["user_id"];

        // Verify the provided password against the stored hash
        if (password_verify($login_password, $stored_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $login_email; // Assuming username is the email

            echo json_encode(["success" => true, "message" => "Login successful"]);
            // Perform other actions or redirect
            // header("Location: dashboard.php");
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password. Please try again."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found. Please check your email."]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
?>
