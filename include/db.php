<?php
$servername = "localhost";
$username = "root";  // Default MySQL username
$password = "";  // Default MySQL password (empty by default)
$dbname = "together";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
