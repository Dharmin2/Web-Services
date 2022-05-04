<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../core/database.php';
include_once '../Model/product.php';
include_once '../Model/JWT.php';
include_once '../Model/user.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = $data->JWT;
$validateJWT = new JWT();
if ($validateJWT->is_valid($jwt)) { 
	$stmt = $user->getOne($validateJWT->getUsername($jwt));

	$num = $stmt->rowCount();

	$stmt->bindColumn('id',$id);
	$stmt->bindColumn('name',$name);
	$stmt->bindColumn('email',$email);
	$stmt->bindColumn('password_hash',$password_hash);
	$stmt->bindColumn('funds',$funds);

	while ($row = $stmt->fetch()) {
		$product->name = $data->name;
		$product->price = $data->price;
		$product->description = $data->description;
		$product->image = $data->image;
		$product->userId = $id;
		$product->create();
	}
}
?>