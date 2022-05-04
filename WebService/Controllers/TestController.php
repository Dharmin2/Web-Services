<?php
require '../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$Logger = new Logger('info');

$Logger->pushHandler(new StreamHandler('/xampp/htdocs/logs/log_file.log', Logger::DEBUG));
$Logger->info('My first Log');
?>