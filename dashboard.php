

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Common styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
        }
        .container {
            background-image: url('image.jpg');
            position: absolute;
            background-color: rgba(0, 0, 0, 0);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .section {
            flex: 1;
            min-width: 200px;
            margin: 10px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section-black{
            background-color: #0FB5CE;
            color: #fff;
        }

    
        /* Green theme */
        .green {
            background-color: #C7E20B;
            color: #fff;
        }
        /* Blue theme */
        .blue {
            background-color: #C7E20B;
            color: #fff;
        }
        /* Orange theme */
        .orange {
            background-color: #0FB5CE;
            color: #fff;
        }
        /* Dark pink theme */
        .dark-pink {
            background-color: #C60076;
            color: #fff;
        }
    </style>
</head>
<body>

<nav>     
<h1 style="text-align: left;">e-Digital Participation Platform</h1>
<img src="coclogo.png" alt="Logo" align = left style="height: 40px;">
   
    <a href="dashboard.php"><button>Home</button></a>
    <a href="login.php"><button>Login</button></a>
    <a href="register.php"><button>Register</button></a>
    
</nav>
<div class="container">
 
    <div class="section blue">
        <h2>IDP</h2>
        <a href = "idp.php">Integrated Development Plan</a>
    </div>
    <div class="section dark-pink">
        <h2>Current Events</h2>
        <a href="currentevents.php">What's happening in my city</a>
    </div>
    <div class="section orange">
        <h2>Chatroom</h2>
        <a href="comment.php"> Real-time chat with members</a>
    </div>
    <div class="section dark-pink">
        <h2>Polls</h2>
        <a href="polls.php">Participate in polls and surveys</a>
    </div>
 
    <div class="section" style="flex-basis: 100%;">
        <h2>Trending Events</h2>
    
        <a class="twitter-timeline" href="https://twitter.com/CityofCT?ref_src=twsrc%5Etfw">Tweets by CityofCT</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
</div>

</body>
</html>
