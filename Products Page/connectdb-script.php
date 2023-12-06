<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teamprojectproducttable";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, ProductName, Category, Price, InStock FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<section id=" . $row["ID"] . "'>";
        echo "<h2>" . $row["ProductName"] . "</h2>";
        echo "<p>Category: " . $row["Category"] . "</p>";
        echo "<p>Price: £" . $row["Price"] . "</p>";
        echo "<p>In Stock: " . ($row["InStock"] ? 'Yes' : 'No') . "</p>";
        echo "</section>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>