<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="header">CSE4IFU - Home</div>
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
        $message = isset($_COOKIE['CookieMessage']) ? $_COOKIE['CookieMessage'] : '';
        if ($message) {
            echo "<p>$message</p>";
            setcookie('CookieMessage', '', time() - 3600, '/');
        }
        ?>
        <h2>Welcome to the Forum</h2>
    </div>
    <div id="footer">Krupa Soni, 21288985, CSE4IFU-2023 Sem 1</div>
</body>
</html>
