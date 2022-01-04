<?php
require_once('lib.php');

if(is_loggedin()) {
    header('Location: ' . 'index.php');
    die();
} elseif(isset($_POST['submitted'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    // authenticate the user
    list($auth, $error) = authenticate($username, $password);

    if($auth) {
        header('Location: ' . 'index.php');
        die();
    }
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
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div>
            <label for="username">Username</l1abel>
            <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div>
            <label for="password">Password</l1abel>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div>
            <button type="submit" name="submitted" value="1">Submit</button>
        </div>
    </form>
    <?php if($error): ?>
    <div>
        <p><?php echo $error['message']; ?></p>
    </div>
    <?php endif; ?>
</body>
</html>