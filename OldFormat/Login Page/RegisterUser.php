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
    exit; // Exit the script
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["reg_name"];
    $email = $_POST["reg_email"];
    $password = password_hash($_POST["reg_password"], PASSWORD_BCRYPT); // Hash the password

    // Prepare the SQL statement
    $sql = "INSERT INTO user (username, passwordhash, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error in preparing statement: " . $conn->error]);
        $conn->close();
        exit;
    }

    $stmt->bind_param("sss", $name, $password, $email);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User registered successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
