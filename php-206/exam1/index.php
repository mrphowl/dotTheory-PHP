<?php
if(!isset($_COOKIE['loggedin'])) {
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
    <h1>Welcome, <?php echo $_COOKIE['username']?>!</h1>
    <a href="logout.php" title="Logout">Logout</a>
</body>
</html>