<?php
require_once('../Model/JWT.php');
require_once('../Model/User.php');
include_once '../core/database.php';

$request_body = file_get_contents('php://input');
header("content-type: application/json");	

$database = new Database();
$db = $database->getConnection();
$data = (array) json_decode($request_body, true);
$user = new User($db);
$stmt = $user->getOne($data['name']);
$pass = $data['password'];
$num = $stmt->rowCount();

$stmt->bindColumn('id',$id);
$stmt->bindColumn('name',$name);
$stmt->bindColumn('email',$email);
$stmt->bindColumn('password_hash',$password_hash);

while ($row = $stmt->fetch()) {
	if (password_verify($data['password'], $password_hash)) {
		$jwt = new jwt();
		$token = $jwt->generate($data);
		echo $token;
	}
	else {
		echo "Password or username don't match";
	}
}
// echo $user->name;
// if($num > 0){
// 	$jwt = new JWT();

// 	if($user->password_hash == $data['password']){
// 		$token = $jwt->generate($data);
// 		echo $token;
// 	}
// 	else {
// 		echo "Passwords don't match";
// 	}
// }
?>













