<?php
$servername = "localhost";
$username = "root";          // MySQL username
$password = "yourpassword";  // MySQL password
$dbname = "cosmetics_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
