<?php
if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['surname'])) {
    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $surname = trim($_POST['surname']);
    $tag = trim($_POST['tag']);

    $db = new PDO('sqlite:phpliteadmin/Forum.db');
    $stmt = $db->prepare('SELECT UserName FROM User WHERE UserName = ? COLLATE NOCASE');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "Username already exists.";
    } else {
        $stmt = $db->prepare('INSERT INTO User (UserName, FirstName, SurName, Tag) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $firstname, $surname, $tag]);
        setcookie('CookieMessage', 'User added successfully', time() + 3600, '/');
        header('Location: https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/');
    }
} else {
    echo "All fields are required.";
}
?>
