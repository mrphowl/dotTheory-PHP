<?php
define('ERROR_FIELDSREQUIRED', 'Please fill both fields.');
define('ERROR_INVALIDLOGIN', 'Invalid username or password.');

session_start();

$USERS = [
    'SessionAdmin' => [
        'username' => 'SessionAdmin',
        'password' => 'SessionPassword'
    ],
];

/**
 * Checks if the user is logged in.
 * 
 * @return boolean
 */
function is_loggedin() {
    if(isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin'] == 1) {
            return true;
        }
    }
    return false;
}

/**
 * User authentication.
 * Creates user session upon successful password validation.
 * Returns an array containing the authentication result and array containing
 *  the error message, if the result is false.
 * 
 * @param string $username
 * @param string $password
 * @return array [boolean, array]
 */
function authenticate($username, $password) {
    $auth = false;
    $error = null;

    if(!$username || !$password) {
        $error = ['message'=> ERROR_FIELDSREQUIRED];
    }

    if(!validate_password($username, $password)) {
        $error = ['message'=> ERROR_INVALIDLOGIN];
    } else {
        $auth = true;
        
        // Set the session variables
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = 1;
        $_SESSION['page_visited'] += 0;
    }

    return [$auth, $error];
}

/**
 * Validate user password
 * 
 * @param string $username
 * @param string $password
 * @return boolean
 */
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

/**
 * Update user login status
 */
function logout() {
    $_SESSION['loggedin'] = 0;
}

/**
 * Destroy user session
 */
function mysession_destroy() {
    session_destroy();
}
