<?php

$dbhost = 'localhost';
$dbname = 'treakers';
$dbusername = 'root';
$dbpassword = '';

$mysqli = new mysqli("localhost", "root", "", "treakers");
$conn = mysqli_connect("localhost", "root", "", "treakers");

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