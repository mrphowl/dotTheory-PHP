<?php
require_once('lib.php');

if(!is_loggedin()) {
    header('Location: ' . 'login.php');
    die();
} else {
    $_SESSION['page_visited'] += 1;
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
    <h1>Welcome, <?php echo $_SESSION['username']?>!</h1>
    <p>Page visits: <?php echo $_SESSION['page_visited']; ?></p>
    <a href="logout.php" title="Logout">Logout</a>
    <a href="logout.php?destroy=1" title="Logout">Destroy</a>
</body>
</html>