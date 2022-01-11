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

if ($_POST) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        $response['message'] = 'Missing or invalid required parameter $id';
        $response['status'] = 422;
    }
    // get the record
    $client->getRecordById($id);

    if ($client->id) {
        // get the new values
        $input_firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $input_lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $input_middlename = filter_input(INPUT_POST, 'middlename', FILTER_SANITIZE_STRING);
        $input_birthday = filter_input(INPUT_POST, 'birthday', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $validation_date_regexp]]);
        $input_date_visited = filter_input(INPUT_POST, 'date_visited', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $validation_date_regexp]]);
        $input_street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
        $input_city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $input_province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
        $input_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $input_store_id = filter_input(INPUT_POST, 'store_id', FILTER_VALIDATE_INT);

        if (empty($client->birthday)) {
            $response['message'] = 'Invalid birth date format.';
            $response['status'] = 422;
        }
        if (empty($client->date_visited)) {
            $response['message'] = 'Invalid date visited format.';
            $response['status'] = 422;
        }
        if(!$response['status']) {
            if ($input_firstname) {
                $client->firstname = $input_firstname;
            }
            if ($input_lastname) {
                $client->lastname = $input_lastname;
            }
            if ($input_middlename) {
                $client->middlename = $input_middlename;
            }
            if($input_birthday) {
                $client->birthday = $input_birthday;
            }
            if ($input_email) {
                $client->email = $input_email;
            }
            if ($input_street) {
                $client->street = $input_street;
            }
            if ($input_city) {
                $client->city = $input_city;
            }
            if ($input_province) {
                $client->province = $input_province;
            }
            if ($input_store_id) {
                $client->store_id = $input_store_id;
            }
            if($input_date_visited) {
                $client->date_visited = $input_date_visited;
            }
        }
    } else {
        $response['message'] = 'Record not found';
        $response['status'] = 200;
    }


    // process request
    if (!$response['status']) {
        if ($client->update()) {
            $response['status'] = 200;
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