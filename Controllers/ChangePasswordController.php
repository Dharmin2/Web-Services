<?php
require_once('../Model/JWT.php');
require_once('../Model/User.php');

if (isset($_COOKIE['JWT'])) {
	$jwt = new JWT();
	$token = $_COOKIE['JWT'];
	if ($jwt->is_valid($token)) {
		$url = "http://localhost/api/UpdateUser.php";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$name = $jwt->getUsername($token);
		$oldPassword = $_POST['oldPassword'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['password_confirm'];
		$arr = array('oldPassword' => $oldPassword, 'password' => $password, 'confirmPassword' => $confirmPassword, 'name' => $name);
		$data = json_encode($arr);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$resp = curl_exec($curl);
		curl_close($curl);
	}
	else {
		header('Location: http://localhost/Views/Login.php');
	}
}
else {
	header('Location: http://localhost/Views/Login.php');
}
?>

