<?php
require_once('../Model/User.php');
$url = "http://localhost/WebService/api/Delete.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$id = $_GET['id'];
$arr = array('id' => $id, 'JWT' => $_COOKIE['JWT']);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
header('Location: http://localhost/WebClient/Views/MyItems.php');
?>
