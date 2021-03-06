<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../core/database.php';
include_once '../Model/user.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new User($db);
  
$data = json_decode(file_get_contents("php://input"));
$user->name = $data->name;
$user->password = $data->password;
$user->email = $data->email;
$user->create();
?>