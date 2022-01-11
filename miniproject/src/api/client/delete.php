<?php
// headers
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
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if(!$id) {
        $response['message'] = 'Invalid or empty parameter $id';
        $response['status'] = 422;
    }

    // process data
    if(!$response['status']) {
        if($client->delete($id)) {
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