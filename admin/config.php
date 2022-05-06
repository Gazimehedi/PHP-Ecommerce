<?php 
session_start();
$connection = mysqli_connect('localhost','root','','ecomm');
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/ecom_2/');
define('SITE_PATH', "http://localhost/ecom_2/");
function getBaseUrl() {
// output: /myproject/index.php
$currentPath = $_SERVER['PHP_SELF'];

// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
$pathInfo = pathinfo($currentPath);

// output: localhost
$hostName = $_SERVER['HTTP_HOST'];

// output: http://
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

// return: http://localhost/myproject/
return $protocol.$hostName.$pathInfo['dirname']."/";
}

define('PRODUCT_IMG_SITE_PATH', getBaseUrl().'media/product/');
define('PRODUCT_IMG_SERVER_PATH', SERVER_PATH.'media/product/');

require_once('functions.php');
