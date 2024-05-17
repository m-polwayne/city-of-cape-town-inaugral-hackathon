

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

        /*article */
        .article {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .article img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .article h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .article p {
            line-height: 1.6;
        }
    </style>
</head>
<body>

<nav>     
<h1 style="text-align: left;">e-Digital Participation Platform</h1>
<img src="C:\xampp\htdocs\Tigerthons\coclogo.png" alt="Logo" style="height: 20px;">
   
    <a href="dashboard.php"><button>Home</button></a>
    <a href="login.php"><button>Login</button></a>
    <a href="register.php"><button>Register</button></a>
    
</nav>
<div class="container">
 
    <div class="section blue">
        <h2>IDP</h2>
        <p>Integrated Development Plan</p>
    </div>
    <div class="section black">
        <h2>Current Events</h2>
        <p>What's happening in my city</p>
    </div>
    <div class="section orange">
        <h2>Chatroom</h2>
        <a href="login.php"> Real-time chat with members</a>
    </div>
    <div class="section dark-pink">
        <h2>Polls</h2>
        <p>Participate in polls and surveys</p>
    </div>
 
    <div class="section" style="flex-basis: 100%;">
        <h2>Current Events</h2>
        <div class="article">
        <img src="https://resource.capetown.gov.za/cityassets/Media%20Images%202/20240508_140912.jpg?RenditionID=19" alt="Article Image">
        <h2>mitigating winter challenges</h2>
        <p>Winter is coming, and the Recreation and Parks Department is working hard to mitigate the challenges that come with the colder months. Two key focus areas are tree maintenance, and mitigating impacts on cemeteries.<a href="articleComment.php"> read more....</a></p>
    </div>

    <div class="article">
        <img src="https://resource.capetown.gov.za/cityassets/Media%20Images%202/Vandalism.jpg?RenditionID=19" alt="Article Image">
        <h2>vandalisation causing problems</h2>
        <p>More than 10 000 items of water and sanitation infrastructure vandalised or stolen costing residents R12m <a href="articleComment2.php"> read more ....</a></p>
    </div>
    </div>
</div>

</body>
</html>
