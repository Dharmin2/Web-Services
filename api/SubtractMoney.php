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
include_once '../Model/Product.php';
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
$jwt = $data->JWT;
$validateJWT = new JWT();
$product = new Product($db);

if ($validateJWT->is_valid($jwt)) {
	$user = new User($db);
	$name = $validateJWT->getUsername($jwt);
	$stmt = $user->getOne($name);
	$stmtProduct = $product->getOne($data->id);
	$num = $stmt->rowCount();

	$stmt->bindColumn('id',$id);
	$stmt->bindColumn('name',$name);
	$stmt->bindColumn('email',$email);
	$stmt->bindColumn('password_hash',$password_hash);
	$stmt->bindColumn('funds',$funds);

	$stmtProduct->bindColumn('id',$idProduct);
	$stmtProduct->bindColumn('name',$nameProduct);
	$stmtProduct->bindColumn('description',$description);
	$stmtProduct->bindColumn('price',$price);
	$stmtProduct->bindColumn('image',$image);
	$productPrice = 10;
	// echo $productPrice;
	while ($row = $stmtProduct->fetch()) {
		$product = $product->getOne($data->id);
		$productPrice = $price;
		echo $productPrice;
	}
	while ($row = $stmt->fetch()) {
		if ($productPrice <= $funds) {
			$user->subtractMoney($productPrice, $name);
			echo '<script>alert("Product was purchased")</script>';
			echo '<script>window.location.href = "http://localhost/Views/Index.php"</script>';
		}
		else {
			echo '<script>alert("You don\'t have enough money to purchase this item")</script>';
			echo '<script>window.location.href = "http://localhost/Views/Index.php"</script>';
		}
	}
}
?>