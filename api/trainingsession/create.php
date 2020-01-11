<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/TrainingSession.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate User object
$trainingSession = new TrainingSession($db);


// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Assign values for user
$trainingSession->SessionId = $data->SessionId;
$trainingSession->SessionDate = $data->SessionDate;
$trainingSession->PatientId = $data->PatientId;
$trainingSession->NrOfGoodCorrectImages = $data->NrOfGoodCorrectImages;
$trainingSession->NrOfGoodWrongImages = $data->NrOfGoodWrongImages;
$trainingSession->NrOfBadCorrectImages = $data->NrOfBadCorrectImages;
$trainingSession->NrOfBadWrongImages = $data->NrOfBadWrongImages;
$trainingSession->ElapsedTime = $data->ElapsedTime;
$trainingSession->IsTrainingCompleted = $data->IsTrainingCompleted;
$trainingSession->IsDataSent = $data->IsDataSent;



// Create user
if($trainingSession->create()) {
    echo json_encode(
        array('message'=> 'Post created')
    );
} else {
    echo json_encode(
        array('message'=> 'Post NOT created')
    );
}
