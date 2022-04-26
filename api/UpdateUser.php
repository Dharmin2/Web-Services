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

// get posted data
$data = json_decode(file_get_contents("php://input"));
$oldPassword = $data->oldPassword;
$newPassword = $data->password;
$confirmPassword = $data->confirmPassword;
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

	while ($row = $stmt->fetch()) {
		if (password_verify($oldPassword, $password_hash)) {
			$user->password = $newPassword;
			echo $name;
			$user->update($name);
		}
		else {
			echo "Password doesn't match";
		}
	}
}
?>