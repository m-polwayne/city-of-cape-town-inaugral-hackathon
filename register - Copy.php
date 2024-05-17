<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $location = $_POST["location"];

    // Validate form data (e.g., check if passwords match)
    if ($password != $confirm_password) {
        // Passwords do not match
        $registration_error = "Error: Passwords do not match.";
    } else {
        // Passwords match, proceed to update the database
        $servername = "localhost";
        $db_username = "root";
        $db_password = "Password";
        $dbname = "cityusersdb";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password, location, points) VALUES ('$username', '$email', '$password', '$location', 2)";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["registration_success"] = true;
            header("Location: login.php");
            exit();
        } else {
            $registration_error = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      color: #231F20; /* Dark Gray text */
      position: relative;
      background-image: url('https://i.natgeofe.com/n/af4b0e11-9348-4a14-b3dc-708d19f3bc73/south-africa-tourism-48-hours-cape-town-3_16x9.jpg?w=2520&h=1418');
      background-size: cover;
      background-position: center;
    }
    .create-account-container {
      width: 350px; /* Adjust width as needed */
      margin: 100px auto;
      padding: 20px;
      background-color: #0FB5CE; /* Turquoise background */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    .create-account-container h2 {
      text-align: center;
      color: #FFFFFF; /* White text */
    }
    .create-account-form {
      margin-top: 20px;
    }
    .create-account-form input[type="text"],
    .create-account-form input[type="email"],
    .create-account-form input[type="password"] {
      width: calc(100% - 24px); /* Adjust width as needed */
      padding: 10px; /* Adjust padding as needed */
      margin-bottom: 10px;
      border: none;
      border-radius: 5px;
      background-color: #FFFFFF; /* White background */
      color: #231F20; /* Dark Gray text */
    }
    .create-account-form input[type="text"]::placeholder,
    .create-account-form input[type="email"]::placeholder,
    .create-account-form input[type="password"]::placeholder {
      color: #231F20; /* Dark Gray text */
    }
    .create-account-form input[type="submit"] {
      width: 100%;
      padding: 12px; /* Adjust padding as needed */
      border: none;
      border-radius: 5px;
      background-color: #C7E20B; /* Bright Green button */
      color: #231F20; /* Dark Gray text */
      cursor: pointer;
    }
    .create-account-form input[type="submit"]:hover {
      background-color: #F7BC07; /* Yellow hover */
    }
    .create-account-form p {
      text-align: center;
      margin-top: 10px;
      color: #040000; /* Dark red text */
    }
  </style>
</head>
<body>

<div class="create-account-container">
  <h2>Create Account</h2>
  <form class="create-account-form" action="" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="submit" value="Create Account">
  </form>
  <p>Already have an account? <a href="login.php" style="color: #C60076;">Login here</a></p>
</div>

</body>
</html>
