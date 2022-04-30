<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../core/database.php';
include_once '../Model/product.php';
include_once '../Model/JWT.php';  
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = $data->JWT;
$validateJWT = new JWT();
if ($validateJWT->is_valid($jwt)) {
	$product->delete($data->id)
}
?>