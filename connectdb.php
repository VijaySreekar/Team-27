<?php

$dbhost = 'localhost';
$dbname = 'treakers';
$dbusername = 'u-230185247';
$dbpassword = 'z3mlfs8WdS1hxvH';

$mysqli = new mysqli("localhost", "u-230185247", "z3mlfs8WdS1hxvH", "treakers");
$conn = mysqli_connect("localhost", "u-230185247", "z3mlfs8WdS1hxvH", "treakers");

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