<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Topics</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="header">CSE4IFU - Topics</div>
    <div id="nav">
        <?php
        $cookieUser = isset($_COOKIE['CookieUser']) ? $_COOKIE['CookieUser'] : '';
        if ($cookieUser == "") {
            echo '<a href="SignUp.php">Sign Up</a>';
            echo '<a href="SignIn.php">Sign In</a>';
        } else {
            echo '<a href="LogOutUser.php">Sign Out (' . htmlspecialchars($cookieUser) . ')</a>';
        }
        ?>
        <a href="https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/">Home</a>
        <a href="Topics.php">Topics</a>
    </div>
    <div id="content">
        <h2>Topics</h2>
        <table>
            <tr>
                <th>Topic</th>
                <th>Author</th>
                <th>Date</th>
                <th>Likes</th>
                <th>Action</th>
            </tr>
            <?php
            try {
                $db = new PDO('sqlite:phpliteadmin/Forum.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare('
                    SELECT t.TopicID, t.Topic, u.UserName, t.DateTime, 
                           COALESCE(SUM(p.Likes), 0) AS Likes 
                    FROM Topic t 
                    JOIN User u ON t.UserID = u.UserID 
                    LEFT JOIN Post p ON t.TopicID = p.TopicID 
                    GROUP BY t.TopicID, t.Topic, u.UserName, t.DateTime 
                    ORDER BY Likes DESC
                ');
                $stmt->execute();

                $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($topics)) {
                    echo "<tr><td colspan='5'>No topics available.</td></tr>";
                } else {
                    foreach ($topics as $row) {
                        echo "<tr><td><a href='Forum.php?topic=" . urlencode($row['Topic']) . "'>" . htmlspecialchars($row['Topic']) . "</a></td><td>" . htmlspecialchars($row['UserName']) . "</td><td>" . htmlspecialchars($row['DateTime']) . "</td><td>" . htmlspecialchars($row['Likes']) . "</td><td><a href='like.php?topicID=" . $row['TopicID'] . "'>Like</a></td></tr>";
                    }
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='5'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
            }
            ?>
        </table>
        <h2>Create a New Topic</h2>
        <?php if ($cookieUser == ""): ?>
            <p>You must be logged in to create a topic.</p>
        <?php else: ?>
            <form action="AddTopic.php" method="post">
                <input type="text" name="topic" placeholder="Topic" required>
                <button type="submit">Add Topic</button>
            </form>
        <?php endif; ?>
    </div>
    <div id="footer">Krupa Soni, 21288985, CSE4IFU-2023 Sem 1</div>
</body>
</html>
