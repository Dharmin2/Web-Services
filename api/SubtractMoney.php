<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../core/database.php';
include_once '../Model/user.php';
include_once '../Model/JWT.php';
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
$jwt = $data->JWT;
$validateJWT = new JWT();

if ($validateJWT->is_valid($jwt)) {
	$user = new User($db);
	$name = $validateJWT->getUsername($jwt);
	$stmt = $user->getOne($name);
	$num = $stmt->rowCount();

	$stmt->bindColumn('id',$id);
	$stmt->bindColumn('name',$name);
	$stmt->bindColumn('email',$email);
	$stmt->bindColumn('password_hash',$password_hash);
	$stmt->bindColumn('funds',$funds);

	while ($row = $stmt->fetch()) {
		$user->funds = $funds + $data->funds;
		echo $user->funds;
		$user->subtractMoney($data->funds, $name);
	}
}
?>