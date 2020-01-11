<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Patient.php';

// Instantiate DB & connect
$database = new Database(); 
$db = $database->connect();

// Instantiate User object
$patient = new Patient($db);

// User post query
$result = $patient->read();

// Get row count
$num = $result->rowCount();

// Check if any users
if($num > 0) {
    // Post array
    $patient_arr = array();    // Initialize a blank array
    $patient_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $patient_item = array(
            'PatientId' => $PatientId,
            'DataToSent' => $DataToSent,
            'Email' => $Email
        );
        // Push to "data"
        array_push($patient_arr['data'], $patient_item);
    }
           // Turn to JSON & output
           echo json_encode($patient_arr);
} else {
    // No post
    echo json_encode(
        array('message' => 'No User found')
    );
}

