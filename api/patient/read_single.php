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

// Get Email
$patient->Email = isset($_GET['Email']) ? $_GET['Email'] : die();

// Get Patient
$patient->read_single();

// Create array

// $patient_arr = array(
//     'PatientId' => $patient->PatientId,
//     'DataToSent' => $patient->DataToSent,
//     'Email' => $patient->Email,
// );

$patient_arr = array(
    'PatientId' => $patient->PatientId,
    'DataToSent' => $patient->DataToSent,
    'Email' => $patient->Email,
);

// Make JSON
print_r(json_encode($patient_arr));

