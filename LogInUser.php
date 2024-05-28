<?php
if (isset($_POST['username'])) {
    $username = trim($_POST['username']);

    $db = new PDO('sqlite:phpliteadmin/Forum.db');
    $stmt = $db->prepare('SELECT UserName FROM User WHERE UserName = ? COLLATE NOCASE');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        setcookie('CookieUser', $username, time() + 3600, '/');
        setcookie('CookieMessage', 'Welcome back, ' . $username, time() + 3600, '/');
        header('Location: https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/');
    } else {
        setcookie('CookieMessage', 'Username does not exist', time() + 3600, '/');
        header('Location: SignIn.php');
    }
} else {
    echo "Username is required.";
}
?>
