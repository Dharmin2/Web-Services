<?php
require_once('../Model/JWT.php');
require '../../vendor/autoload.php';
$url = "http://localhost/WebService/api/Create.php";
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
$image = $_FILES['image']['name'];

$arr = array('name' => $name, 'price' => $price, 'description' => $description,'image' => $image,'JWT' => $_COOKIE['JWT']);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);

$s3 = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
	'credentials' => [
	    'key'    => "AKIAUTZKO3SNYPVE6ILQ",
	    'secret' => "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",
	]
]);

$key = $image;

$result = $s3->putObject([
	'Bucket' => 'cnkbucket',
	'Key'    => $key,
	'Body'   => 'this is the body!',
	//'SourceFile' => 'c:\samplefile.png' -- use this if you want to upload a file from a local location
]);

// var_dump($result);

header('Location: http://localhost/WebClient/Views/Index.php');