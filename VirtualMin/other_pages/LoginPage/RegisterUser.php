<?php
session_start();

include '../../Assets/Database/connectdb.php';

if (isset($_POST['register_btn'])) {
    // Assuming $conn is your database connection established earlier in your script
    $name = mysqli_real_escape_string($conn, $_POST['reg_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['reg_phone']);
    $email = mysqli_real_escape_string($conn, $_POST['reg_email']);
    $password = mysqli_real_escape_string($conn, $_POST['reg_password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['reg_confirmpassword']);

    if ($password === $confirmpassword) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists
        $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(["success" => false, "message" => "Email already exists!"]);
            $stmt->close();
            $conn->close();
            exit;
        }

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO user (username, phone, email, passwordhash) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Error in preparing statement: " . $conn->error]);
            $conn->close();
            exit;
        }

        // Bind the parameters and execute
        $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "User registered successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error executing statement: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Password and Confirm Password do not match!"]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

?>
