<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once(__DIR__ . '\..\config\config.php');
require_once(__DIR__ . '\..\config\Database.php');
require_once(__DIR__ . '\..\object\Client.php');

$conn = new Database($CFG->database);
$client = new Client($conn->getConnection());
$validation_date_regexp = "/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/";
$response = [
    'message' => '',
    'status' => null,
];

if($_POST) {
    $client->init();
    $client->firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $client->lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $client->middlename = filter_input(INPUT_POST, 'middlename', FILTER_SANITIZE_STRING);
    $client->birthday = filter_input(INPUT_POST, 'birthday', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $validation_date_regexp]]);
    $client->street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $client->city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $client->province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
    $client->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $client->store_id = filter_input(INPUT_POST, 'store_id', FILTER_VALIDATE_INT);

    if(!$client->firstname) {
        $response['message'] = 'First name is required.';
        $response['status'] = 422;
    }
    if(empty($client->birthday)) {
        $response['message'] = 'Invalid birth date format.';
        $response['status'] = 422;
    }
    // process request
    if(!$response['status']) {
        if($client->create()) {
            $response['message'] = $client->id;
            $response['status'] = 201;
        } else {
            $response['message'] = 'An error occured.';
            $response['status'] = 500;
        }
    }
} else {
    $response['status'] = 200;
    $response['message'] = 'You didn\'t submit any data.';
}

http_response_code($response['status']);
echo json_encode($response);