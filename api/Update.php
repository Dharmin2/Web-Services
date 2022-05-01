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

$jwt = new JWT();
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

if ($jwt->is_valid($data->JWT)) {
// get posted data
	$product->name = $data->name;
	$product->price = $data->price;
	$product->description = $data->description;
	$product->image = $data->image;
	$product->update($data->id);
	echo '<script>window.location.href = "http://localhost/Views/Index.php"</script>';
}
?>