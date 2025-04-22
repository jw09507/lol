<?php
$servername = "localhost"; // XAMPP default server
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP (empty)
$dbname = "esp"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error); // Log the error
    die("An error occurred while connecting to the database. Please try again later.");
}
?>