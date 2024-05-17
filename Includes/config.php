<?php

// Database configuration
$dbHost = 'localhost'; // Host name
$dbUsername = 'root'; // MySQL username
$dbPassword = 'Password'; // MySQL password
$dbName = 'cityusersdb'; // Database name

// Attempt to connect to MySQL database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


mysqli_set_charset($conn, "utf8");

?>
