

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;

      color: #231F20; /* Dark Gray text */
      position: relative;
    }
    .login-container {
      width: 350px; /* Adjust width as needed */
      margin: 100px auto;
      padding: 20px;
      background-color: #0FB5CE; /* Turquoise background */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    .login-container h2 {
      text-align: center;
      color: #FFFFFF; /* White text */
    }
    .login-form {
      margin-top: 20px;
    }
    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: calc(100% - 24px); /* Adjust width as needed */
      padding: 10px; /* Adjust padding as needed */
      margin-bottom: 10px;
      border: none;
      border-radius: 5px;
    }
    .login-form input[type="submit"] {
      width: 100%;
      padding: 12px; /* Adjust padding as needed */
      border: none;
      border-radius: 5px;
      background-color: #C7E20B; /* Bright Green button */
      color: #231F20; /* Dark Gray text */
      cursor: pointer;
    }
    .login-form input[type="submit"]:hover {
      background-color: #F7BC07; /* Yellow hover */
    }
    .login-form p {
      text-align: center;
      margin-top: 10px;
      color: #040000; /* Dark red text */
    }
        .background-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    /*opacity: 0.2; /* Adjust opacity as needed */
    }

  </style>
</head>
<body>

<img class="background-image" src="https://i.natgeofe.com/n/af4b0e11-9348-4a14-b3dc-708d19f3bc73/south-africa-tourism-48-hours-cape-town-3_16x9.jpg?w=2520&h=1418" alt="Background Image">

<div class="login-container">
  <h2>Login</h2>
  <form class="login-form" action="" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    
  </form> 
  <p>Login <a href="dashboard.php" style="color: #C60076;">Click to Login</a></p>
  <p>Don't have an account? <a href="register.php" style="color: #C60076;">Create one</a></p>
</div>

</body>
</html>
