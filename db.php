<?php
$host = "localhost";
$username = "root"; // Default XAMPP username
$password = "";     // Default XAMPP password 
$dbname = "authentication_db"; // Name ng database

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>