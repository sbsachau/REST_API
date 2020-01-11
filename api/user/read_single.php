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

// Get Email
$user->Email = isset($_GET['Email']) ? $_GET['Email'] : die();

// Get user
$user->read_single();

$user_arr = array(
    'Email' => $user->Email,
    'FirstName' => $user->FirstName,
    'LastName' => $user->LastName,
    'Age' => $user->Age,
);

// Make JSON
print_r(json_encode($user_arr));