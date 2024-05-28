<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="header">CSE4IFU - Forum</div>
    <div id="nav">
        <?php
        $cookieUser = isset($_COOKIE['CookieUser']) ? $_COOKIE['CookieUser'] : '';
        if ($cookieUser == "") {
            echo '<a href="SignUp.php">Sign Up</a>';
            echo '<a href="SignIn.php">Sign In</a>';
        } else {
            echo '<a href="LogOutUser.php">Sign Out (' . $cookieUser . ')</a>';
        }
        ?>
        <a href="https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/">Home</a>
        <a href="Topics.php">Topics</a>
    </div>
    <div id="content">
        <?php
        if (isset($_GET['topic'])) {
            $topic = $_GET['topic'];
            echo "<h2>" . htmlspecialchars($topic) . "</h2>";
            echo "<table><tr><th>Post</th><th>Author</th><th>Date</th></tr>";

            $db = new PDO('sqlite:phpliteadmin/Forum.db');
            $stmt = $db->prepare('SELECT TopicID FROM Topic WHERE Topic = ? COLLATE NOCASE');
            $stmt->execute([$topic]);
            $topicID = $stmt->fetchColumn();

            $stmt = $db->prepare('SELECT p.Post, u.UserName, p.DateTime FROM Post p JOIN User u ON p.UserID = u.UserID WHERE p.TopicID = ? ORDER BY p.PostID');
            $stmt->execute([$topicID]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['Post']) . "</td><td>" . htmlspecialchars($row['UserName']) . "</td><td>" . htmlspecialchars($row['DateTime']) . "</td></tr>";
            }

            echo "</table>";
            if ($cookieUser != "") {
                echo "<form action='AddPost.php' method='post'>
                        <input type='hidden' name='topic' value='" . htmlspecialchars($topic) . "'>
                        <textarea name='post' placeholder='Write your post here' required></textarea>
                        <button type='submit'>Add Post</button>
                      </form>";
            } else {
                echo "<p>You must be logged in to add a post.</p>";
            }
        } else {
            echo "Topic not found.";
        }
        ?>
    </div>
    <div id="footer">Krupa Soni, 21288985, CSE4IFU-2023 Sem 1</div>
</body>
</html>
