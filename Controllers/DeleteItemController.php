<?php
require_once('../Model/product.php');
$url = "http://localhost/api/Delete.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$arr = array('name' => $name, 'price' => $price, 'description' => $description);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);
header('Location: http://localhost/Views/editItem.php');
?>

