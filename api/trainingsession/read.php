<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/TrainingSession.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate User object
$trainingSession = new TrainingSession($db);

// User post query
$result = $trainingSession->read();
// Get row count
$num = $result->rowCount();

// Check if any users
if($num > 0) {
    // Post array
    $trainingSession_arr = array();    // Initialize a blank array
    $trainingSession_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $trainingSession_item = array(
            'SessionId' => $SessionId,
            'SessionDate' => $SessionDate,
            'PatientId' => $PatientId,
            'NrOfGoodCorrectImages' => $NrOfGoodCorrectImages,
            'NrOfGoodWrongImages' => $NrOfGoodWrongImages,
            'NrOfBadCorrectImages' => $NrOfBadCorrectImages,
            'NrOfBadWrongImages' => $NrOfBadWrongImages,
            'ElapsedTime' => $ElapsedTime,
            'IsTrainingCompleted' => $IsTrainingCompleted,
            'IsDataSent' => $IsDataSent
        );
        // Push to "data"
        array_push($trainingSession_arr['data'], $trainingSession_item);
    }
           // Turn to JSON & output
           echo json_encode($trainingSession_arr);
} else {
    // No post
    echo json_encode(
        array('message' => 'No sessions found')
    );
}

