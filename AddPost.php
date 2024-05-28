<?php
if (isset($_POST['topic']) && isset($_POST['post'])) {
    $cookieUser = isset($_COOKIE['CookieUser']) ? $_COOKIE['CookieUser'] : '';
    $topic = $_POST['topic'];
    $post = trim($_POST['post']);
    $db = new PDO('sqlite:phpliteadmin/Forum.db');

    $stmt = $db->prepare('SELECT UserID FROM User WHERE UserName = ? COLLATE NOCASE');
    $stmt->execute([$cookieUser]);
   $userID = $stmt->fetchColumn();

    $stmt = $db->prepare('SELECT TopicID FROM Topic WHERE Topic = ? COLLATE NOCASE');
    $stmt->execute([$topic]);
    $topicID = $stmt->fetchColumn();

    $dateTime = new DateTime('now', new DateTimeZone('Australia/Melbourne'));
    $stmt = $db->prepare('INSERT INTO Post (UserID, TopicID, DateTime, Post) VALUES (?, ?, ?, ?)');
    $stmt->execute([$userID, $topicID, $dateTime->format('Y-m-d H:i:s'), $post]);

    header('Location: Forum.php?topic=' . urlencode($topic));
} else {
    echo "All fields are required.";
}
?>
