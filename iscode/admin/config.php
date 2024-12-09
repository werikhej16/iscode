<?php
// Database configuration
$servername = "localhost";
$username = "root";
$port = "3306";
$password = ""; // Replace with your MySQL password if necessary
$dbname = "healthconnect";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

