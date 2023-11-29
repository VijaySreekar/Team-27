<?php

$dbhost = 'localhost';
$dbname = 'u_230185247_treakers';
$dbusername = 'u-230185247@localhost';
$dbpassword = 'z3mlfs8WdS1hxvH';

$mysqli = new mysqli("localhost", "u-230185247@localhost", "z3mlfs8WdS1hxvH", "u_230185247_treakers");
$conn = mysqli_connect("localhost", "u-230185247@localhost", "z3mlfs8WdS1hxvH", "u_230185247_treakers");

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