<?php
$_SESSION['login'] = false;
session_unset();
session_destroy();

// Delete the 'id' cookie
setcookie('id', '', time() - 3600);

// Delets the 'key' cookie
setcookie('key', '', time() - 3600);

// Redirect user to the login page
header('Location: login.php');
exit;