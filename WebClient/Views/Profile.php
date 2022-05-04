<?php
require '../../vendor/autoload.php';
if (!isset($_COOKIE['JWT'])) {
    header('Location: http://localhost/WebClient/Views/Login.php');
}

$url = "http://localhost/WebService/api/Profile.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$arr = array('JWT' => $_COOKIE['JWT']);
$data = json_encode($arr);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);
//echo $resp;
$data = json_decode($resp, true);
// $myData = array_values($data[0]);
// echo $myData[1];
echo "<a href = '../Views/Index.php'>Home</a><br>";
echo "<a href = '../Views/AddFunds.php'>Add Funds</a><br>";
echo "<a href = '../Views/Profile.php'>View My Profile</a><br>";
echo "<a href = '../Views/MyItems.php'>View My Items</a><br>";
echo "<a href = '../Views/ChangePassword.php'>Change Password</a><br>";
echo "<a href = '../Views/CreateProduct.php'>Create Product</a><br>";
$bucket = 'cnkbucket';
$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => "AKIAUTZKO3SNYPVE6ILQ",
        'secret' => "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"
    ]
]);
if ($resp != null) {
    for ($i = 0; $i < count($data); $i++) {
        $myData = array_values($data[$i]);
        echo " <span><b>Name: ".$myData[1]."</b></span><br>";
        echo " <span><b>Email: ".$myData[3]."</b><span><br>";
        echo " <span><b>Funds: ".$myData[4]."</b><span><br>";

    }
}
?>