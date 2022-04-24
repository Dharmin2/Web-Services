<?php
require_once('../Model/JWT.php');
$jwt = new jwt();
$url = "http://localhost/api/Login.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
	"Content-Type: application/json",
);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$name = $_POST['name'];
$password = $_POST['password'];
$arr = array('name' => $name, 'password' => $password);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resp);
curl_close($curl);
setcookie("JWT",$result,time()+6000);

if ($jwt->is_valid($result)) {
	// Redirect to index page
}
else {
	header('Location: http://localhost/Views/Login.php');
}
?>