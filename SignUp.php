<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="header">CSE4IFU - Sign Up</div>
    <div id="nav">
        <a href="https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/">Home</a>
        <a href="Topics.php">Topics</a>
    </div>
    <div id="content">
        <h2>Sign Up</h2>
        <form action="AddUser.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="surname" placeholder="Surname" required>
            <input type="text" name="tag" placeholder="Tag">
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div id="footer">Krupa Soni, 21288985, CSE4IFU-2023 Sem 1</div>
</body>
</html>
