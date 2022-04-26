<?php
$url = "http://localhost/api/CreateUser.php";
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
$email = $_POST['email'];
$arr = array('name' => $name, 'password' => $password, 'email' => $email);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);
header('Location: http://localhost/Views/Login.php');
?>