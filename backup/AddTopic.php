<?php
        $cookieUser = isset($_COOKIE['CookieUser']) ? $_COOKIE['CookieUser'] : '';
       

if (isset($_POST['topic'])) {
    $topic = trim($_POST['topic']);
    $db = new PDO('sqlite:phpliteadmin/Forum.db');

    $stmt = $db->prepare('SELECT Topic FROM Topic WHERE Topic = ? COLLATE NOCASE');
    $stmt->execute([$topic]);
    if ($stmt->fetch()) {
        setcookie('CookieMessage', 'Topic already exists', time() + 3600, '/');
        header('Location: Topics.php');
    } else {
        $stmt = $db->prepare('SELECT UserID FROM User WHERE UserName = ? COLLATE NOCASE');
        $stmt->execute([$cookieUser]);
        $userID = $stmt->fetchColumn();

        $dateTime = new DateTime('now', new DateTimeZone('Australia/Melbourne'));
        $stmt = $db->prepare('INSERT INTO Topic (UserID, DateTime, Topic) VALUES (?, ?, ?)');
        $stmt->execute([$userID, $dateTime->format('Y-m-d H:i:s'), $topic]);

        header('Location: Topics.php');
    }
} else {
    echo "Topic is required.";
}
?>
