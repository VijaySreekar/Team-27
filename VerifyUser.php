<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

$host = "localhost";
$username = "vijay";
$password = "1234";
$dbname = "login";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connected successfully<br>";
}

if (isset($_POST['login'])) {
    if (!isset($_POST['username'], $_POST['password'])) {
        echo 'Please fill both the username and password fields!';
    } else {
        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();
                if (password_verify($_POST['password'], $hashed_password)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    // Redirect to the dashboard or another authenticated page
                    header("location: dashboard.php");
                    exit;
                } else {
                    echo 'You have entered an incorrect password!';
                }
            } else {
                echo 'You have entered an incorrect username';
            }
            $stmt->close();
        }
    }
}

if (isset($_POST['register'])) {
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        echo 'Please fill all the registration fields!';
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Insert user data into the database
        if ($stmt = $conn->prepare('INSERT INTO accounts (name, email, password) VALUES (?, ?, ?)')) {
            $stmt->bind_param('sss', $name, $email, $password);
            if ($stmt->execute()) {
                echo 'Registration successful! You can now login.';
            } else {
                echo 'Registration failed. Please try again.';
            }
            $stmt->close();
        }
    }
}


