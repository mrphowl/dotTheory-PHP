<?php
define('ERROR_FIELDSREQUIRED', 'Please fill both fields.');
define('ERROR_INVALIDLOGIN', 'Invalid username or password.');

$USERS = [
    'CookieAdmin' => [
        'username' => 'CookieAdmin',
        'password' => 'CookiePassword'
    ]
];

function validate_password($username, $password) {
    global $USERS;
    if(isset($USERS[$username])) {
        $user = $USERS[$username];

        if(trim($password) === $user['password']) {
            return true;
        }
    }

    return false;
}

if(isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == 1) {
    header('Location: ' . 'index.php');
    die();
} elseif(isset($_POST['submitted'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if(!$username || !$password) {
        $error = ['message'=> ERROR_FIELDSREQUIRED];    
    }

    if(validate_password($username, $password)) {
        setcookie('username', $username, time() + 300);
        setcookie('loggedin', 1, time() + 300);
        header('Location: ' . 'index.php');
        die();
    }

    $error = ['message'=> ERROR_INVALIDLOGIN];
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
    <?php if(isset($error)): ?>
    <div>
        <p><?php echo $error['message']; ?></p>
    </div>
    <?php endif; ?>
</body>
</html>