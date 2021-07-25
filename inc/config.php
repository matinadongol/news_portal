<?php
//buffer, ob -> to clean buffer we have to start buffer
ob_start();

session_start();

// defining constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'news_portal');
define('DB_PASSWORD', '');

define('SITE_URL', 'http://localhost/news_portal/');

define('ASSETS_URL', SITE_URL.'assets/');
define('CSS_URL', ASSETS_URL.'css/');
define('JS_URL', ASSETS_URL.'js/');

$conn= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('database connection failed.');
mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

mysqli_query($conn, "SET NAMES utf8"); //unicode characters are saved as same in database

define('UPLOAD_URL', SITE_URL.'upload/');
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/news_portal/upload/');
?> 