<?php
setcookie('CookieUser', '', time() - 3600, '/');
setcookie('CookieMessage', 'You have been logged out', time() + 3600, '/');
header('Location: https://webprog.cs.latrobe.edu.au/~21288985/IFU/Lab04/');
?>
