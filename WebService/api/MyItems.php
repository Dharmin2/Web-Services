<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../core/database.php';
include_once '../Model/product.php';
include_once '../Model/JWT.php';
include_once '../Model/User.php';

$database = new Database();
$db = $database->getConnection();


$product = new Product($db);
$products_arr=array();  
$user = new User($db);
$users_arr=array();

$data = json_decode(file_get_contents("php://input"));
$jwt = $data->JWT;
$validateJWT = new JWT();

if ($validateJWT->is_valid($jwt)) {
    $name = $validateJWT->getUsername($jwt);
    $stmtUser = $user->getOne($name);
    $numUser = $stmtUser->rowCount();

    if($numUser>0){
        while ($row = $stmtUser->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_get=array(
                "id" => $id,
                "name" => $name,
                "password_hash" => $password_hash,
                "email" => $email,
                "funds" => $funds
            );
            
            array_push($users_arr, $user_get);
        }
        
    // set response code - 200 OK
        http_response_code(200);
        
    // show products data in json format
        //echo json_encode($users_arr, true);
    //var_dump($products_arr);
    }
    $stmt = $product->getMyItems($id);
    $num = $stmt->rowCount();
    if($num>0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item=array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "image" => $image
            );
            
            array_push($products_arr, $product_item);
        }
        
    // set response code - 200 OK
        http_response_code(200);
        
    // show products data in json format
        echo json_encode($products_arr, true);
    //var_dump($products_arr);
    }
}
?>