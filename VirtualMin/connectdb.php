<?php

$dbhost = 'localhost';
$dbname = 'u_230185247_treaker';
$dbusername = 'u-230185247';
$dbpassword = 'z3mlfs8WdS1hxvH';

$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

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