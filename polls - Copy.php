<?php
$servername = "localhost";
$username = "root";
$password = "Password";
$dbname = "pollsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for votes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'], $_POST['poll_id'], $_POST['name'], $_POST['comment'])) {
    $poll_id = $_POST['poll_id'];
    $vote = $_POST['vote'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    // Sanitize input to prevent SQL injection
    $poll_id = intval($poll_id);
    $vote = $conn->real_escape_string($vote);
    $name = $conn->real_escape_string($name);
    $comment = $conn->real_escape_string($comment);

    if ($vote === 'agree' || $vote === 'disagree') {
        // Update poll vote count
        $query = "UPDATE polls SET $vote = $vote + 1 WHERE id = $poll_id";
        $conn->query($query);

        // Insert comment
        $query = "INSERT INTO polls_comments (poll_id, vote, name, comment) VALUES ('$poll_id', '$vote', '$name', '$comment')";
        $conn->query($query);
    }
}

// Fetch poll topics for the dropdown
$query = "SELECT id, title FROM polls";
$poll_titles_result = $conn->query($query);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .poll-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .poll-container h2, .poll-container select {
            margin-bottom: 20px;
        }
        .poll-container button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
        }
        .poll-container button.disagree {
            background-color: #f44336;
        }
        .results {
            margin-top: 20px;
        }
        .comment-section {
            margin-top: 20px;
            text-align: left;
        }
        .comment {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .comment h4 {
            margin: 0;
        }
        .comment p {
            margin: 5px 0;
        }
        form input, form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        form button.submit {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleComments() {
            const comments = document.querySelectorAll('.comment.hidden');
            const button = document.getElementById('toggle-button');

            comments.forEach(comment => {
                if (comment.style.display === 'none' || comment.style.display === '') {
                    comment.style.display = 'block';
                } else {
                    comment.style.display = 'none';
                }
            });

            if (button.innerText === 'View more') {
                button.innerText = 'View less';
            } else {
                button.innerText = 'View more';
            }
        }
    </script>
</head>
<body>
    <div class="poll-container">
        <form method="post" action="">
            <select name="poll_id" onchange="this.form.submit()">
                <option value="">Select a topic to vote on</option>
                <?php while ($row = $poll_titles_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] === $selected_poll_id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($row['title']); ?>
                    </option>
                <?php endwhile; ?>
                <option value=""><?php echo htmlspecialchars("The City is increasing the budget for the current year"); ?></option>
                <option value=""><?php echo htmlspecialchars("The City is building new schools"); ?></option>
                <option value=""><?php echo htmlspecialchars("The City is building new hospitals"); ?></option>
            </select>
        </form>
        <h2><?php echo isset($poll['title']) ? htmlspecialchars($poll['title']) : ''; ?></h2>
        <form method="post" action="">
            <input type="hidden" name="poll_id" value="<?php echo $poll['id']; ?>">
            <label for="name">Name:</label><br>
            <input type="text" name="name" required><br>
            <label for="comment">Comment:</label><br>
            <textarea name="comment" rows="4" required></textarea><br>
            <button type="submit" name="vote" value="agree">Agree</button>
            <button type="submit" name="vote" value="disagree" class="disagree">Disagree</button>
        </form>
        <div class="results">
            <p>Agree: <?php echo htmlspecialchars($poll['agree'] ?? 0); ?></p>
            <p>Disagree: <?php echo htmlspecialchars($poll['disagree'] ?? 0); ?></p>
        </div>
        <div class="comment-section">
            <h3>Comments:</h3>
            <p>No comments available.</p>
        </div>
    </div>
</body>
</html>
