<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';
include_once '../../models/Patient.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate User object
$user = new User($db);

// Instantiate also Patient object
$patient = new Patient($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Assign values for tuser
$user->Email = $data->Email;
$user->FirstName = $data->FirstName;
$user->LastName = $data->LastName;
$user->Age = $data->Age;

// Assign values for the patient
$patient->data_to_sent = 1;
$patient->Email = $data->Email;


// Create user
if($user->create()) {
    echo json_encode(
        array('messAge'=> 'Post created')
    );
} else {
    echo json_encode(
        array('messAge'=> 'Post NOT created')
    );
}

if ($patient->create()) {
    echo json_encode(
        array('messAge'=> 'User added to the patient')
    );
} else {
    echo json_encode(
        array('messAge'=> 'User could not be added to the patient')
    );
}