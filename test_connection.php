<?php
$dbhost = 'localhost';
$dbname = 'u_230185247_treaker';
$dbusername = 'u-230185247';
$dbpassword = 'z3mlfs8WdS1hxvH';

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
