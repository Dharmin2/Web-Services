<?php
session_start();
//inclusions 
include('core/autoload.php');
include('core/phpqrcode/qrlib.php');

///goal: E:/School/ecommerce/xampp/htdocs/project => /project/
$path = getcwd().'/';
$path = str_replace('\\', '/', $path);
$path = preg_replace('/^.+\/htdocs\//', '/', $path);
$path = preg_replace('/\/+/', '/', $path);
define('BASE', $path);
