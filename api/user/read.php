<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate User object
$user = new User($db);

// User post query
$result = $user->read();
// Get row count
$num = $result->rowCount();

// Check if any users
if($num > 0) {
    // Post array
    $user_arr = array();    // Initialize a blank array
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'Email' => $Email,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Age' => $Age,
        );
        // Push to "data"
        array_push($user_arr['data'], $user_item);
    }
           // Turn to JSON & output
           echo json_encode($user_arr);
} else {
    // No post
    echo json_encode(
        array('messAge' => 'No User found')
    );
}

