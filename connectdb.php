<?php

$dbhost = '';
$dbname = '';
$dbusername = '';
$dbpassword = '';

$mysqli = new mysqli("", "", "", "");
$conn = mysqli_connect("", "", "", "");

if(!$conn){
    echo "Connection Error";
}

try {
    $db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbusername, $dbpassword); 
} catch(PDOException $ex) {
    echo("Failed to connect to the database.");
    echo($ex->getMessage());
    exit;
}

?>