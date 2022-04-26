<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'cnkbucket';
$keyname = 'StartScreen.png';

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
                'key'    => "AKIAUTZKO3SNYPVE6ILQ",
                'secret' => "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",
    ]
]);

try {
    // Get the object.
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key'    => $keyname
    ]);

    // Display the object in the browser.
    header("Content-Type: {$result['ContentType']}");
    header('Content-Disposition: attachment; filename='.$keyname); 
    echo $result['Body'];
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>
