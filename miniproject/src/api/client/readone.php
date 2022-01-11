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
require_once(__DIR__ . '\..\object\Store.php');

$conn = new Database($CFG->database);
$client = new Client($conn->getConnection());
$store = new Store($conn->getConnection());
$validation_date_regexp = "/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/";
$response = [
    'message' => '',
    'status' => null,
];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $response['message'] = 'Missing or invalid required parameter $id';
    $response['status'] = 422;
}

if (!$response['status']) {
    $client->getRecordById($id);

    if ($client->id) {
        if ($client->store_id) {
            // get the store name
            $client->storeName = $store->getStoreName($client->store_id);
        }
        $response['data'] = get_object_vars($client);
    } else {
        $response['message'] = 'Record not found';
    }
    $response['status'] = 200;
}

http_response_code($response['status']);
echo json_encode($response);