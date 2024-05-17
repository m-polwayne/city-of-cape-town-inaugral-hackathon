<?php
// Establish database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "chatforum";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save comment or reply if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["comment"])) {
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $parent_comment_id = isset($_POST["parent_comment_id"]) ? $_POST["parent_comment_id"] : NULL;
    $audioData = isset($_POST["audioData"]) ? $_POST["audioData"] : NULL;

    // Prepare SQL statement to insert comment or reply into database
    $sql = "INSERT INTO comments2 (name, comment, parent_comment_id, audio_data) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $comment, $parent_comment_id, $audioData);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Comment saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Retrieve comments and replies from database
$sql = "SELECT c1.id, c1.name, c1.comment, c1.audio_data, c2.name AS parent_name, c2.comment AS parent_comment, c1.parent_comment_id FROM comments2 c1 LEFT JOIN comments2 c2 ON c1.parent_comment_id = c2.id WHERE c1.parent_comment_id IS NOT NULL";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Headlines</title>
    <style>
        /* CSS styles remain the same */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('image.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        li strong {
            color: #4CAF50;
        }
        /* Your existing CSS styles here */

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
    <div class="container">
        <h1>City Headlines</h1>

        <!-- Topic selection -->
        <div class="section" style="flex-basis: 100%;">
        <h2>Current Events</h2>
        <div class="article">
        <img src="https://resource.capetown.gov.za/cityassets/Media%20Images%202/20240508_140912.jpg?RenditionID=19" alt="Article Image">
        <h2>More than 10 000 items of water and sanitation infrastructure vandalised</h2>
        <p>For this financial year, the Water and Sanitation Directorate has spent over R12 million repairing and replacing vandalised and stolen equipment:
In informal areas, about R1,18 million went towards replacing 89 manhole covers, 80 rodding eyes, 1 034 stolen taps, 257 vandalised and missing toilet parts.
In formal areas, it cost R10,8 million to replace 3 666 missing manhole covers, 2 809 stolen water meters, 649 meter covers, 1 204 hydrant covers, and 275 missing valve covers.

These replacements strain the financial resources and cause delays in addressing service issues. Each act of vandalism diverts precious time and resources away from maintaining and enhancing the quality of services.

 Beyond the financial burden, vandalism puts the public's health and safety at risk as well as the inconvenience they have to endure. Damage to the water network or pipelines can compromise water quality, and disruptions in sanitation services can contribute to sewer overflows, posing risks to public health.<a> read more....</a></p>
    </div>
        
        <!-- Comment form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Your Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="comment">Your Comment:</label><br>
            <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
            <input type="hidden" name="parent_comment_id" value="">
            <!-- Voice note recording -->
            <button id="recordButton">Start Recording</button>
            <button id="stopButton" disabled>Stop Recording</button>
            <input type="hidden" id="audioData" name="audioData">
            <input type="submit" value="Submit">
        </form>
        
        <!-- Display comments -->
        <h2>Comments</h2>
        <ul>
            <?php
            if ($result !== null && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display main comment or reply
                    echo "<li><strong>" . $row["name"] . ":</strong> " . $row["comment"];
                    if (isset($row["audio_data"]) && $row["audio_data"]) {
                        echo "<br><audio controls><source src='" . $row["audio_data"] . "' type='audio/wav'>Your browser does not support the audio element.</audio>";
                    }
                    if (isset($row["parent_comment_id"]) && $row["parent_comment_id"] !== NULL) {
                        echo "<br><em>In reply to <strong>" . $row["parent_name"] . ":</strong> " . $row["parent_comment"] . "</em>";
                    }
                    // Reply form
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='parent_comment_id' value='" . $row["id"] . "'>";
                    echo "<label for='reply'>Reply:</label><br>";
                    echo "<input type='text' id='reply' name='comment'><br>";
                    echo "<input type='text' id='name' name='name' placeholder='Your Name'><br>";
                    echo "<input type='submit' value='Reply'>";
                    echo "</form>";
                    echo "</li>";
                }
            } else {
                echo "<li>No comments yet.</li>";
            }
            ?>
        </ul>
    </div>

    <!-- Include required JavaScript libraries -->
    <script src="recorder.js"></script>
    <script>
        // Initialize recorder
        var recorder = new Recorder();

        // Handle recording button click
        document.getElementById('recordButton').onclick = function() {
            recorder.start();
            document.getElementById('recordButton').setAttribute('disabled', true);
            document.getElementById('stopButton').removeAttribute('disabled');
        };

        // Handle stop button click
        document.getElementById('stopButton').onclick = function() {
            recorder.stop();
            document.getElementById('recordButton').removeAttribute('disabled');
            document.getElementById('stopButton').setAttribute('disabled', true);
        };

        // Handle when recording is finished
        recorder.onRecordingFinished = function(audioBlob) {
            var reader = new FileReader();
            reader.readAsDataURL(audioBlob);
            reader.onloadend = function() {
                var audioData = reader.result;
                document.getElementById('audioData').value = audioData;
            };
        };

        // Function to select topic
        function selectTopic() {
            var selectedTopic = document.getElementById("topics").value;
            // You can perform further actions based on the selected topic
            alert("Selected topic: " + selectedTopic);
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
