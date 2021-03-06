<?php
require '../../vendor/autoload.php';
if (!isset($_COOKIE['JWT'])) {
    header('Location: http://localhost/WebClient/Views/Login.php');
}

$url = "http://localhost/WebService/api/MyItems.php";
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
$bucket = 'cnkbucket';
$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => "AKIAUTZKO3SNYPVE6ILQ",
        'secret' => "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"
    ]
]);
echo "<a href = '../Views/Index.php'>Home</a><br>";
echo "<a href = '../Views/AddFunds.php'>Add Funds</a><br>";
echo "<a href = '../Views/Profile.php'>View My Profile</a><br>";
echo "<a href = '../Views/MyItems.php'>View My Items</a><br>";
echo "<a href = '../Views/ChangePassword.php'>Change Password</a><br>";
echo "<a href = '../Views/CreateProduct.php'>Create Product</a><br>";
echo "<a href = '../../WebService/Controllers/LogoutController.php'>Logout</a><br>";
if ($resp != null) {
    for ($i = 0; $i < count($data); $i++) {
        $myData = array_values($data[$i]);
        echo " <span><b>name: ".$myData[1]."</b></span><br>";
        echo " <span><b>description: ".$myData[2]."</b></span><br>";
        echo " <span><b>price: ".$myData[3]."</b><span><br>";
        echo " <span><b>File: ".$myData[4]."</b><span><br>";
        $keyname = $myData[4];
        try {
    // Get the object.
            $result = $s3->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $keyname
            ]);

            $request = $s3->createPresignedRequest($result, '+20 minutes');

        // Get the actual presigned-url
            $presignedUrl = (string)$request->getUri();

            echo '<a href="' . $presignedUrl . '">' . $presignedUrl . '<br><br></a>';
            echo "<a href='../../WebClient/Views/EditProduct.php?id=$myData[0]'>Edit this item</a><br>";
            echo "<a href='../../WebService/Controllers/DeleteItemController.php?id=$myData[0]'>Delete this item</a><br>";

        } catch (S3Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

    }
}
?>