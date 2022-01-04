<?php
require_once('lib.php');

if(is_loggedin()) {
    $destroy = filter_input(INPUT_GET, 'destroy', FILTER_VALIDATE_INT);

    if($destroy === 1) {
        mysession_destroy();
    } else {
        logout();
    }
    header('Location: ' . 'login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 206 Practical Exam 1</title>
</head>
<body>
    <h1>Logout</h1>
    <p>You are already logged out.</p>
    <a href="login.php" title="Login again">Login again</a>
</body>
</html>