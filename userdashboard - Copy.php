<?php
session_start();

if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location: login.php");
    exit();
}

// Retrieve user's points from the database based on their username
$servername = "localhost";
$db_username = "root";
$db_password = "Password";
$dbname = "cityusersdb";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION["username"];
$sql = "SELECT points FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $points = $row["points"];
} else {
    $points = "N/A";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body>
    <!-- Dashboard content -->
    <h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
    <p>Your points: <?php echo $points; ?></p>
    <!-- Add links to IDP and chatroom -->
    <a href="idp.php">IDP</a>
    <a href="chatroom.php">Chatroom</a>
</body>
</html>
